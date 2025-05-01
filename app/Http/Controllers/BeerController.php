<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use Illuminate\Http\Request;

class BeerController extends Controller
{
    // Mostrar todas las cervezas
    public function index(Request $request)
    {
        $query = Beer::with('category');
        
        // Intentamos cargar la relación brewery de forma segura
        try {
            $query->with('brewery');
        } catch (\Exception $e) {
            // Solo registramos el error pero continuamos
            \Log::error('Error cargando relación brewery: ' . $e->getMessage());
        }
        
        // Búsqueda por texto (nombre o descripción)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        
        // Filtro por categoría
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        
        // Ordenar (opcional)
        $query->orderBy('name', 'asc');
        
        // Obtener resultados paginados
        $beers = $query->paginate(12)->withQueryString();
        
        // Obtener todas las categorías para el selector
        $categories = \App\Models\BeerCategory::orderBy('name')->get();
        
        return view('beers.index', compact('beers', 'categories'));
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
