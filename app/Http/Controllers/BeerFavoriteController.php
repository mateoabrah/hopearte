<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\BeerFavorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BeerFavoriteController extends Controller
{
    /**
     * Mostrar la lista de cervezas favoritas del usuario.
     */
    public function index()
    {
        $favorites = Auth::user()->favoritedBeers()->paginate(12);
        return view('user.beer_favorites', compact('favorites'));
    }

    /**
     * Añadir una cerveza a favoritos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'beer_id' => 'required|exists:beers,id',
        ]);

        BeerFavorite::firstOrCreate([
            'user_id' => Auth::id(),
            'beer_id' => $validated['beer_id'],
        ]);

        return back()->with('success', 'Cerveza añadida a favoritos.');
    }

    /**
     * Eliminar una cerveza de favoritos.
     */
    public function destroy($beerId)
    {
        BeerFavorite::where('user_id', Auth::id())
            ->where('beer_id', $beerId)
            ->delete();

        return back()->with('success', 'Cerveza eliminada de favoritos.');
    }

    /**
     * Alternar estado de favorito.
     */
    public function toggle(Request $request)
    {
        $validated = $request->validate([
            'beer_id' => 'required|exists:beers,id',
        ]);

        $favorite = BeerFavorite::where('user_id', Auth::id())
            ->where('beer_id', $validated['beer_id'])
            ->first();

        if ($favorite) {
            $favorite->delete();
            $status = 'removed';
        } else {
            BeerFavorite::create([
                'user_id' => Auth::id(),
                'beer_id' => $validated['beer_id'],
            ]);
            $status = 'added';
        }

        if ($request->wantsJson()) {
            return response()->json(['status' => $status]);
        }

        $message = $status === 'added' ? 'Cerveza añadida a favoritos.' : 'Cerveza eliminada de favoritos.';
        return back()->with('success', $message);
    }
}
