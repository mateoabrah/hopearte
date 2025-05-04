<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeerFavoriteController extends Controller
{
    /**
     * Constructor: requiere autenticación
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Ver cervezas favoritas del usuario
     */
    public function index()
    {
        $user = Auth::user();
        $favorites = $user->favoritedBeers()->with(['brewery', 'category'])->paginate(12);
        
        return view('user.beer_favorites', compact('favorites'));
    }

    /**
     * Alternar favorito
     */
    public function toggle(Request $request)
    {
        $request->validate([
            'beer_id' => 'required|exists:beers,id'
        ]);
        
        $user = Auth::user();
        $beerId = $request->beer_id;
        
        // Si ya está en favoritos, quitarlo; si no, añadirlo
        if ($user->favoritedBeers()->where('beer_id', $beerId)->exists()) {
            $user->favoritedBeers()->detach($beerId);
            $message = 'Cerveza eliminada de favoritos.';
        } else {
            $user->favoritedBeers()->attach($beerId);
            $message = 'Cerveza añadida a favoritos.';
        }
        
        // Si es una solicitud AJAX, devolver respuesta JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'isFavorited' => $user->favoritedBeers()->where('beer_id', $beerId)->exists()
            ]);
        }
        
        return back()->with('success', $message);
    }
    
    /**
     * Eliminar una cerveza de favoritos
     */
    public function destroy(Beer $beer)
    {
        $user = Auth::user();
        
        // Verificar si la cerveza está en favoritos
        if ($user->favoritedBeers()->where('beer_id', $beer->id)->exists()) {
            $user->favoritedBeers()->detach($beer->id);
            return back()->with('success', 'Cerveza eliminada de favoritos.');
        }
        
        return back()->with('error', 'Esta cerveza no está en tus favoritos.');
    }
}
