<?php

namespace App\Http\Controllers;

use App\Models\Brewery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BreweryController extends Controller
{
    public function index()
    {
        // Obtener todas las cervecerías
        $breweries = Brewery::all();

        // Pasar las cervecerías a la vista
        return view('breweries.index', compact('breweries'));
    }

    public function show($id)
    {
        // Obtener la cervecería por su ID
        $brewery = Brewery::findOrFail($id);

        // Pasar la cervecería a la vista
        return view('breweries.show', compact('brewery'));
    }

    public function create()
    {
        return view('breweries.create');
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'email' => 'nullable|string|email|max:255',
            'website' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validación para la imagen
        ]);

        // Subir la imagen si existe
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('breweries', 'public'); // Guarda en la carpeta 'storage/app/public/breweries'
        }

        // Crear la cervecería
        $brewery = Brewery::create([
            'user_id' => auth()->id(), // Asumiendo que el usuario está autenticado
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'website' => $request->website,
            'image' => $imagePath, // Guardar la ruta de la imagen
        ]);

        // Redirigir a la lista de cervecerías o a la página de la cervecería recién creada
        return redirect()->route('breweries.index');
    }

    public function edit($id)
    {
        // Obtener la cervecería para editarla
        $brewery = Brewery::findOrFail($id);

        // Pasar la cervecería a la vista de edición
        return view('breweries.edit', compact('brewery'));
    }

    public function update(Request $request, $id)
    {
        // Validar la solicitud
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'email' => 'nullable|string|email|max:255',
            'website' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Obtener la cervecería
        $brewery = Brewery::findOrFail($id);

        // Subir la nueva imagen si se proporciona
        if ($request->hasFile('image')) {
            // Eliminar la imagen antigua si existe
            if ($brewery->image) {
                Storage::disk('public')->delete($brewery->image);
            }

            // Subir la nueva imagen
            $imagePath = $request->file('image')->store('breweries', 'public');
        } else {
            $imagePath = $brewery->image; // Mantener la imagen actual si no se proporciona una nueva
        }

        // Actualizar los datos de la cervecería
        $brewery->update([
            'name' => $request->name,
            'description' => $request->description,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'website' => $request->website,
            'image' => $imagePath, // Actualizar la imagen
        ]);

        // Redirigir a la vista de la cervecería actualizada
        return redirect()->route('breweries.show', $brewery->id);
    }

    public function destroy($id)
    {
        // Obtener la cervecería
        $brewery = Brewery::findOrFail($id);

        // Eliminar la imagen si existe
        if ($brewery->image) {
            Storage::disk('public')->delete($brewery->image);
        }

        // Eliminar la cervecería
        $brewery->delete();

        // Redirigir al listado de cervecerías
        return redirect()->route('breweries.index');
    }
}
