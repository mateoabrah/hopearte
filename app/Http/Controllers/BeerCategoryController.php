<?php

namespace App\Http\Controllers;

use App\Models\BeerCategory;
use Illuminate\Http\Request;

class BeerCategoryController extends Controller
{
    public function index()
    {
        // Obtener todas las categorías
        $categories = BeerCategory::all();
        return view('beer_categories.index', compact('categories'));
    }

    public function show(BeerCategory $beer_category)
    {
        // Obtener todas las cervezas asociadas a la categoría
        $beers = $beer_category->beers;

        // Pasar las cervezas junto con la categoría a la vista
        return view('beer_categories.show', compact('beer_category', 'beers'));
    }

    public function create()
    {
        return view('beer_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        BeerCategory::create($request->all());
        return redirect()->route('beer_categories.index')->with('success', 'Categoría creada exitosamente.');
    }

    public function edit(BeerCategory $beer_category)
    {
        return view('beer_categories.edit', compact('beer_category'));
    }

    public function update(Request $request, BeerCategory $beer_category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $beer_category->update($request->all());
        return redirect()->route('beer_categories.index')->with('success', 'Categoría actualizada.');
    }

    public function destroy(BeerCategory $beer_category)
    {
        $beer_category->delete();
        return redirect()->route('beer_categories.index')->with('success', 'Categoría eliminada.');
    }
}
