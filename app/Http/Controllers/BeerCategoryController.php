<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\BeerCategory;
use Illuminate\Http\Request;

class BeerCategoryController extends Controller
{
    /**
     * Mostrar lista de categorías de cerveza
     */
    public function index()
    {
        $categories = BeerCategory::withCount('beers')->get();
        
        return view('beer_categories.index', compact('categories'));
    }

    /**
     * Mostrar el formulario para crear una nueva categoría
     */
    public function create()
    {
        return view('beer_categories.create');
    }

    /**
     * Almacenar una nueva categoría
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        
        $category = BeerCategory::create($validated);
        
        return redirect()->route('beer_categories.index')->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Mostrar una categoría específica
     */
    public function show($category = null)
    {
        // Si no hay categoría, redirigir a la lista
        if (!$category) {
            return redirect()->route('beer_categories.index');
        }
        
        // Primero intentar buscar por ID
        if (is_numeric($category)) {
            $beerCategory = BeerCategory::find($category);
        } else {
            // Si no es numérico, buscar por nombre
            $beerCategory = BeerCategory::where('name', 'like', "%{$category}%")->first();
        }
        
        // Si no se encuentra, redirigir con mensaje
        if (!$beerCategory) {
            return redirect()->route('beer_categories.index')
                ->with('error', 'Categoría no encontrada');
        }
        
        // Obtener cervezas que pertenecen a esta categoría
        $beers = Beer::where('beer_category_id', $beerCategory->id)->paginate(12);
        
        return view('beer_categories.show', compact('beerCategory', 'beers'));
    }

    /**
     * Mostrar el formulario para editar una categoría
     */
    public function edit(BeerCategory $beerCategory)
    {
        return view('beer_categories.edit', compact('beerCategory'));
    }

    /**
     * Actualizar una categoría específica
     */
    public function update(Request $request, BeerCategory $beerCategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
        ]);
        
        $beerCategory->update($validated);
        
        return redirect()->route('beer_categories.index')->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Eliminar una categoría
     */
    public function destroy(BeerCategory $beerCategory)
    {
        $beerCategory->delete();
        
        return redirect()->route('beer_categories.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}
