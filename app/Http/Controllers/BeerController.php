<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use Illuminate\Http\Request;

class BeerController extends Controller
{
    // Mostrar todas las cervezas
    public function index()
    {
        $beers = Beer::all();
        return view('welcome', compact('beers')); // Pasar las cervezas a la vista
    }

    // Mostrar una cerveza específica
    public function show($id)
    {
        $beer = Beer::findOrFail($id);
        return view('beers.show', compact('beer'));
    }

    // Crear una cerveza
    public function create()
    {
        return view('beers.create');
    }

    // Almacenar la cerveza
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'alcohol_percentage' => 'required|numeric',
            // Agregar validaciones según sea necesario
        ]);

        Beer::create($validated);

        return redirect()->route('beers.index');
    }
}
