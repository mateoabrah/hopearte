<?php

namespace App\Http\Controllers;

use App\Models\Brewery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BreweryFavoriteController extends Controller
{
    /**
     * Constructor: requiere autenticación
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Ver cervecerías favoritas del usuario
     */
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favoritedBreweries()->paginate(12);
        
        return view('user.brewery_favorites', compact('favorites'));
    }

    /**
     * Alternar favorito
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'brewery_id' => 'required|exists:breweries,id'
        ]);
        
        $user = Auth::user();
        $breweryId = $request->brewery_id;
        
        // Si ya está en favoritos, quitarlo; si no, añadirlo
        if ($user->favoritedBreweries()->where('brewery_id', $breweryId)->exists()) {
            $user->favoritedBreweries()->detach($breweryId);
            $message = 'Cervecería eliminada de favoritos.';
        } else {
            $user->favoritedBreweries()->attach($breweryId);
            $message = 'Cervecería añadida a favoritos.';
        }
        
        // Si es una solicitud AJAX, devolver respuesta JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'isFavorited' => $user->favoritedBreweries()->where('brewery_id', $breweryId)->exists()
            ]);
        }
        
        return back()->with('success', $message);
    }

    /**
     * Eliminar una cervecería de favoritos
     */
    public function destroy($breweryId)
    {
        $user = Auth::user();
        
        // Verificar si existe la cervecería en favoritos y eliminarla
        if ($user->favoritedBreweries()->where('brewery_id', $breweryId)->exists()) {
            $user->favoritedBreweries()->detach($breweryId);
            return redirect()->route('user.brewery_favorites')->with('success', 'Cervecería eliminada de favoritos.');
        }
        
        return redirect()->route('user.brewery_favorites');
    }
}
