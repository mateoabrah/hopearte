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
        $query = Beer::query();
        
        // Filtrado por búsqueda
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }
        
        // Filtrado por categoría
        if ($request->has('category') && $request->category) {
            $query->where('beer_category_id', $request->category);
        }
        
        // Filtrado por cervecería
        if ($request->has('brewery') && $request->brewery) {
            $query->where('brewery_id', $request->brewery);
        }
        
        // Filtrado por ABV (alcohol by volume)
        if ($request->has('min_abv') && $request->has('max_abv')) {
            $query->whereBetween('abv', [$request->min_abv, $request->max_abv]);
        }
        
        // Ordenar resultados
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                case 'abv_asc':
                    $query->orderBy('abv', 'asc');
                    break;
                case 'abv_desc':
                    $query->orderBy('abv', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        // Obtener resultados paginados
        $beers = $query->with(['brewery', 'category'])->paginate(12);
        
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
     * Mostrar una cerveza específica
     */
    public function show(Beer $beer)
    {
        $beer->load(['brewery', 'category']);
        
        // Opcional: Cargar cervezas similares (misma categoría o cervecería)
        $similarBeers = Beer::where('id', '!=', $beer->id)
                        ->where(function($q) use ($beer) {
                            $q->where('beer_category_id', $beer->beer_category_id)
                              ->orWhere('brewery_id', $beer->brewery_id);
                        })
                        ->with(['brewery', 'category'])
                        ->limit(4)
                        ->get();
        
        return view('beers.show', compact('beer', 'similarBeers'));
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
