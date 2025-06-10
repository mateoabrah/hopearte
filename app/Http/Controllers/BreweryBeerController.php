<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\BeerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BreweryBeerController extends Controller
{
    /**
     * Verificar que el usuario puede gestionar esta cervecería
     */
    private function checkBreweryOwnership(Brewery $brewery)
    {
        if (auth()->user()->role !== 'admin' && auth()->user()->id !== $brewery->user_id) {
            abort(403, 'No tienes permisos para gestionar las cervezas de esta cervecería.');
        }
    }

    /**
     * Mostrar las cervezas de una cervecería
     */
    public function index($breweryParam)
    {
        // Intentar encontrar por ID
        if (is_numeric($breweryParam)) {
            $brewery = Brewery::find($breweryParam);
        } else {
            // Intentar encontrar por nombre o slug
            $brewery = Brewery::where('name', $breweryParam)->first();
            if (!$brewery) {
                $brewery = Brewery::all()->first(function($b) use ($breweryParam) {
                    return \Str::slug($b->name) === $breweryParam;
                });
            }
        }
        
        if (!$brewery) {
            abort(404);
        }
        
        $beers = $brewery->beers()->paginate(10);
        return view('brewery_beers.index', compact('brewery', 'beers'));
    }

    /**
     * Mostrar el formulario para añadir una cerveza
     */
    public function create($breweryParam)
    {
        // Intentar encontrar por ID
        if (is_numeric($breweryParam)) {
            $brewery = Brewery::find($breweryParam);
        } else {
            // Intentar encontrar por nombre o slug
            $brewery = Brewery::where('name', $breweryParam)->first();
            if (!$brewery) {
                $brewery = Brewery::all()->first(function($b) use ($breweryParam) {
                    return \Str::slug($b->name) === $breweryParam;
                });
            }
        }
        
        if (!$brewery) {
            abort(404, 'Cervecería no encontrada');
        }
        
        $this->checkBreweryOwnership($brewery);
        
        // Obtener todas las cervezas existentes para mostrar en el selector
        $existingBeers = Beer::orderBy('name')->get();
        $categories = BeerCategory::orderBy('name')->get();
        
        return view('brewery_beers.create', compact('brewery', 'existingBeers', 'categories'));
    }

    /**
     * Guardar la cerveza en la base de datos y asociarla a la cervecería
     */
    public function store(Request $request, Brewery $brewery)
    {
        $this->checkBreweryOwnership($brewery);
        
        // Validación del formulario
        $validated = $request->validate([
            'beer_option' => 'required|in:existing,new',
            // Valida existing_beer_id solo si beer_option es "existing"
            'existing_beer_id' => 'nullable|required_if:beer_option,existing|exists:beers,id',
            // Valida los campos solo si beer_option es "new"
            'name' => 'nullable|required_if:beer_option,new|string|max:255',
            'description' => 'nullable|required_if:beer_option,new|string',
            'abv' => 'nullable|required_if:beer_option,new|numeric|between:0.1,99.9',
            'ibu' => 'nullable|numeric|min:0',
            'beer_category_id' => 'nullable|required_if:beer_option,new|exists:beer_categories,id',
            'image' => 'nullable|image|max:2048'
        ]);
        
        if ($request->beer_option === 'existing') {
            // Añadir una cerveza existente a la cervecería
            $beer = Beer::findOrFail($request->existing_beer_id);
            
            // Verificar si la cerveza ya está asociada a esta cervecería
            if (!$brewery->beers()->where('beer_id', $beer->id)->exists()) {
                $brewery->beers()->attach($beer->id);
                return redirect()->route('brewery.beers.index', $brewery)
                    ->with('success', 'La cerveza existente ha sido añadida a tu cervecería correctamente.');
            } else {
                return back()->with('error', 'Esta cerveza ya está asociada a tu cervecería.');
            }
            
        } else {
            // Crear una nueva cerveza y asociarla a la cervecería
            $beer = new Beer();
            $beer->name = $request->name;
            
            // Generar un slug único
            $baseSlug = Str::slug($request->name);
            $slug = $baseSlug;
            $counter = 1;

            // Si el slug ya existe, añadir un sufijo numérico
            while (Beer::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $beer->slug = $slug;
            $beer->description = $request->description;
            $beer->abv = $request->abv;
            $beer->ibu = $request->ibu;
            $beer->beer_category_id = $request->beer_category_id;
            $beer->created_by = auth()->id();
            $beer->brewery_id = $brewery->id; // Añadimos esta línea para asignar la cervecería
            
            // Procesar la imagen si se ha subido una
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('beers', 'public');
                $beer->image = $path;
            }
            
            $beer->save();
            
            // Asociar la cerveza a la cervecería
            $brewery->beers()->attach($beer->id);
            
            return redirect()->route('brewery.beers.index', $brewery)
                ->with('success', 'La cerveza ha sido creada y añadida a tu cervecería correctamente.');
        }
    }

    /**
     * Eliminar la asociación entre una cerveza y una cervecería
     */
    public function destroy($breweryParam, $beerId)
    {
        // Buscar cervecería por ID o nombre/slug
        if (is_numeric($breweryParam)) {
            $brewery = Brewery::find($breweryParam);
        } else {
            $brewery = Brewery::where('name', $breweryParam)->first();
            if (!$brewery) {
                $brewery = Brewery::all()->first(function($b) use ($breweryParam) {
                    return \Str::slug($b->name) === $breweryParam;
                });
            }
        }
        
        if (!$brewery) {
            abort(404, 'Cervecería no encontrada');
        }
        
        // Verificar permisos
        $this->checkBreweryOwnership($brewery);
        
        // Buscar la cerveza
        $beer = Beer::find($beerId);
        if (!$beer) {
            return redirect()->route('brewery.beers.index', $brewery->getRouteKey())
                ->with('error', 'La cerveza no existe');
        }
        
        // Verificar que la cerveza pertenece a la cervecería
        if (!$brewery->beers()->where('beer_id', $beer->id)->exists()) {
            return redirect()->route('brewery.beers.index', $brewery->getRouteKey())
                ->with('error', 'Esta cerveza no pertenece a tu cervecería');
        }
        
        // Eliminar la relación (no la cerveza en sí, solo la asociación)
        $brewery->beers()->detach($beer->id);
        
        return redirect()->route('brewery.beers.index', $brewery->getRouteKey())
            ->with('success', 'La cerveza ha sido eliminada de tu cervecería correctamente');
    }
    
    /**
     * Mostrar el formulario para editar una cerveza de la cervecería
     */
    public function edit($breweryParam, $beerId)
    {
        // Buscar cervecería por ID o nombre/slug
        if (is_numeric($breweryParam)) {
            $brewery = Brewery::find($breweryParam);
        } else {
            $brewery = Brewery::where('name', $breweryParam)->first();
            if (!$brewery) {
                $brewery = Brewery::all()->first(function($b) use ($breweryParam) {
                    return \Str::slug($b->name) === $breweryParam;
                });
            }
        }
        
        if (!$brewery) {
            abort(404, 'Cervecería no encontrada');
        }
        
        // Buscar la cerveza por ID
        $beer = Beer::find($beerId);
        if (!$beer) {
            abort(404, 'Cerveza no encontrada');
        }
        
        $this->checkBreweryOwnership($brewery);
        
        // Verificar que la cerveza pertenece a la cervecería
        if (!$brewery->beers()->where('beer_id', $beer->id)->exists()) {
            abort(404, 'Esta cerveza no pertenece a tu cervecería');
        }
        
        // Obtener categorías para el formulario
        $categories = BeerCategory::orderBy('name')->get();
        
        return view('brewery_beers.edit', compact('brewery', 'beer', 'categories'));
    }

    /**
     * Actualizar una cerveza de la cervecería
     */
    public function update(Request $request, $breweryParam, Beer $beer)
    {
        // Buscar cervecería por ID o nombre/slug
        if (is_numeric($breweryParam)) {
            $brewery = Brewery::find($breweryParam);
        } else {
            $brewery = Brewery::where('name', $breweryParam)->first();
            if (!$brewery) {
                $brewery = Brewery::all()->first(function($b) use ($breweryParam) {
                    return \Str::slug($b->name) === $breweryParam;
                });
            }
        }
        
        if (!$brewery) {
            abort(404, 'Cervecería no encontrada');
        }
        
        $this->checkBreweryOwnership($brewery);
        
        // Verificar que la cerveza pertenece a la cervecería
        if (!$brewery->beers()->where('beer_id', $beer->id)->exists()) {
            abort(404, 'Esta cerveza no pertenece a tu cervecería');
        }
        
        // Validación del formulario
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'abv' => 'required|numeric|between:0.1,99.9',
            'ibu' => 'nullable|numeric|min:0',
            'beer_category_id' => 'required|exists:beer_categories,id',
            'image' => 'nullable|image|max:2048'
        ]);
        
        // Actualizar la cerveza
        $beer->name = $request->name;
        $beer->slug = Str::slug($request->name);
        $beer->description = $request->description;
        $beer->abv = $request->abv;
        $beer->ibu = $request->ibu;
        $beer->beer_category_id = $request->beer_category_id;
        
        // Procesar la imagen si se ha subido una nueva
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($beer->image && $beer->image !== 'beers/default.jpg') {
                Storage::disk('public')->delete($beer->image);
            }
            $path = $request->file('image')->store('beers', 'public');
            $beer->image = $path;
        }
        
        $beer->save();
        
        return redirect()->route('brewery.beers.index', $brewery->getRouteKey())
            ->with('success', 'La cerveza ha sido actualizada correctamente.');
    }
}