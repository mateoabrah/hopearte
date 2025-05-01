<?php

namespace App\Http\Controllers;

use App\Models\Brewery;
use App\Models\BreweryFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BreweryFavoriteController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Mostrar la lista de cervecerías favoritas del usuario.
     */
    public function index()
    {
        $favorites = Auth::user()->favoritedBreweries()->paginate(12);
        return view('user.brewery_favorites', compact('favorites'));
    }

    /**
     * Añadir una cervecería a favoritos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brewery_id' => 'required|exists:breweries,id',
        ]);

        BreweryFavorite::firstOrCreate([
            'user_id' => Auth::id(),
            'brewery_id' => $validated['brewery_id'],
        ]);

        return back()->with('success', 'Cervecería añadida a favoritos.');
    }

    /**
     * Eliminar una cervecería de favoritos.
     */
    public function destroy($breweryId)
    {
        BreweryFavorite::where('user_id', Auth::id())
            ->where('brewery_id', $breweryId)
            ->delete();

        return back()->with('success', 'Cervecería eliminada de favoritos.');
    }

    /**
     * Alternar estado de favorito.
     */
    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'brewery_id' => 'required|exists:breweries,id',
        ]);

        $favorite = BreweryFavorite::where('user_id', Auth::id())
            ->where('brewery_id', $validated['brewery_id'])
            ->first();

        if ($favorite) {
            $favorite->delete();
            $status = 'removed';
        } else {
            BreweryFavorite::create([
                'user_id' => Auth::id(),
                'brewery_id' => $validated['brewery_id'],
            ]);
            $status = 'added';
        }

        if ($request->wantsJson()) {
            return response()->json(['status' => $status]);
        }

        $message = $status === 'added' ? 'Cervecería añadida a favoritos.' : 'Cervecería eliminada de favoritos.';
        return back()->with('success', $message);
    }
}
