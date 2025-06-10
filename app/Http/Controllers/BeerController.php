<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\BeerCategory;
use App\Models\Brewery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeerController extends Controller
{
    /**
     * Mostrar lista de cervezas
     */
    public function index(Request $request)
    {
        $query = Beer::with(['brewery', 'category']);
        
        // Búsqueda por nombre
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('description', 'like', "%{$searchTerm}%");
        }
        
        // Filtrar por categoría usando nombre
        if ($request->has('category')) {
            $categoryName = $request->category;
            
            if (is_numeric($categoryName)) {
                $query->where('beer_category_id', $categoryName);
            } else {
                $query->whereHas('category', function($q) use ($categoryName) {
                    $q->where('name', 'like', "%{$categoryName}%");
                });
            }
        }
        
        // Filtro por cervecería
        if ($request->filled('brewery')) {
            $breweryParam = $request->brewery;
            
            // Si es numérico, tratar como ID
            if (is_numeric($breweryParam)) {
                $query->where('brewery_id', $breweryParam);
            } 
            // Si no es numérico, buscar por nombre
            else {
                $query->whereHas('brewery', function($q) use ($breweryParam) {
                    $q->where('name', 'like', "%{$breweryParam}%");
                });
            }
        }
        
        // Filtro por ABV (graduación alcohólica)
        if ($request->filled('abv')) {
            switch ($request->abv) {
                case 'light':
                    $query->where('abv', '<', 4);
                    break;
                case 'medium':
                    $query->whereBetween('abv', [4, 6]);
                    break;
                case 'strong':
                    $query->whereBetween('abv', [6, 8]);
                    break;
                case 'very-strong':
                    $query->where('abv', '>', 8);
                    break;
            }
        }
        
        // Filtro por IBU (amargor)
        if ($request->filled('ibu')) {
            switch ($request->ibu) {
                case 'low':
                    $query->where('ibu', '<', 20);
                    break;
                case 'medium':
                    $query->whereBetween('ibu', [20, 40]);
                    break;
                case 'high':
                    $query->whereBetween('ibu', [40, 60]);
                    break;
                case 'very-high':
                    $query->where('ibu', '>', 60);
                    break;
            }
        }
        
        // Cargar relaciones necesarias y paginar resultados
        $beers = $query->paginate(12)
                       ->withQueryString(); // Importante para mantener los parámetros de filtro en la paginación
        
        // Obtener todas las categorías para el filtro
        $categories = BeerCategory::all();
        
        // Obtener todas las cervecerías para el filtro
        $breweries = Brewery::all();
        
        return view('beers.index', compact('beers', 'categories', 'breweries'));
    }

    /**
     * Mostrar el formulario para crear una nueva cerveza
     */
    public function create()
    {
        $categories = BeerCategory::all();
        $breweries = Brewery::all();
        
        return view('beers.create', compact('categories', 'breweries'));
    }

    /**
     * Almacenar una nueva cerveza
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'brewery_id' => 'required|exists:breweries,id',
            'beer_category_id' => 'required|exists:beer_categories,id',
            'abv' => 'required|numeric|min:0|max:100',
            'ibu' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('beers/uploads', 'public');
        }
        
        $beer = Beer::create($validated);
        
        return redirect()->route('beers.show', $beer)->with('success', 'Cerveza creada exitosamente.');
    }

    /**
     * Mostrar detalles de una cerveza
     */
    public function show($beerParam)
    {
        // Intentar encontrar por ID (para mantener compatibilidad)
        if (is_numeric($beerParam)) {
            $beer = Beer::find($beerParam);
            if ($beer) {
                return view('beers.show', compact('beer'));
            }
        }
        
        // Intentar encontrar por nombre exacto
        $beer = Beer::where('name', $beerParam)->first();
        if (!$beer) {
            // Intentar encontrar por slug
            $beer = Beer::all()->first(function($b) use ($beerParam) {
                return \Str::slug($b->name) === $beerParam;
            });
        }
        
        if (!$beer) {
            abort(404, 'Cerveza no encontrada');
        }
        
        return view('beers.show', compact('beer'));
    }

    /**
     * Mostrar el formulario para editar una cerveza
     */
    public function edit(Beer $beer)
    {
        $categories = BeerCategory::all();
        $breweries = Brewery::all();
        
        return view('beers.edit', compact('beer', 'categories', 'breweries'));
    }

    /**
     * Actualizar una cerveza específica
     */
    public function update(Request $request, Beer $beer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'brewery_id' => 'required|exists:breweries,id',
            'beer_category_id' => 'required|exists:beer_categories,id',
            'abv' => 'required|numeric|min:0|max:100',
            'ibu' => 'nullable|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);
        
        if ($request->hasFile('image')) {
            // Eliminar imagen anterior si existe
            if ($beer->image && $beer->image !== 'beers/default.jpg') {
                Storage::disk('public')->delete($beer->image);
            }
            $validated['image'] = $request->file('image')->store('beers/uploads', 'public');
        }
        
        $beer->update($validated);
        
        return redirect()->route('beers.show', $beer)->with('success', 'Cerveza actualizada exitosamente.');
    }

    /**
     * Eliminar una cerveza
     */
    public function destroy(Beer $beer)
    {
        // Eliminar imagen si existe
        if ($beer->image && $beer->image !== 'beers/default.jpg') {
            Storage::disk('public')->delete($beer->image);
        }
        
        $beer->delete();
        
        return redirect()->route('beers.index')->with('success', 'Cerveza eliminada exitosamente.');
    }
}
