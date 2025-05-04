<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\BeerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
    public function index(Brewery $brewery)
    {
        $this->checkBreweryOwnership($brewery);
        
        // Obtener todas las cervezas asociadas a esta cervecería
        $beers = $brewery->beers()->paginate(10);
        
        return view('brewery_beers.index', compact('brewery', 'beers'));
    }

    /**
     * Mostrar el formulario para añadir una cerveza
     */
    public function create(Brewery $brewery)
    {
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
            $beer->slug = Str::slug($request->name);
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
    public function destroy(Brewery $brewery, Beer $beer)
    {
        $this->checkBreweryOwnership($brewery);
        
        // Eliminar la relación entre la cervecería y la cerveza
        $brewery->beers()->detach($beer->id);
        
        return redirect()->route('brewery.beers.index', $brewery)
            ->with('success', 'La cerveza ha sido eliminada de tu cervecería correctamente.');
    }
}