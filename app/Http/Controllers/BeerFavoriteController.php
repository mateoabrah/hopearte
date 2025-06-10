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
        $beer = Beer::findOrFail($request->beer_id);
        $user = auth()->user();
        
        // Si ya es favorito, eliminar; si no, añadir
        if ($user->favoritedBeers()->where('beer_id', $beer->id)->exists()) {
            $user->favoritedBeers()->detach($beer->id);
            $isFavorited = false;
        } else {
            $user->favoritedBeers()->attach($beer->id);
            $isFavorited = true;
        }
        
        if ($request->ajax()) {
            return response()->json(['isFavorited' => $isFavorited]);
        }
        
        return back()->with('success', $isFavorited ? 'Cerveza añadida a favoritos' : 'Cerveza eliminada de favoritos');
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
