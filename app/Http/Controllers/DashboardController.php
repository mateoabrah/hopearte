<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Beer;
use App\Models\Brewery;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Mostrar el dashboard del usuario
     */
    public function index()
    {
        $user = Auth::user();
        
        // Obtener estadísticas del usuario
        $stats = [
            'favoritedBeers' => $user->favoritedBeers()->count(),
            'favoritedBreweries' => $user->favoritedBreweries()->count(),
        ];
        
        // Si es empresa, añadir stats específicos
        if ($user->role === 'company') {
            $stats['ownedBreweries'] = $user->breweries()->count();
        }
        
        // Si es admin, añadir stats generales
        if ($user->role === 'admin') {
            $stats['totalUsers'] = \App\Models\User::count();
            $stats['totalBeers'] = Beer::count();
            $stats['totalBreweries'] = Brewery::count();
        }
        
        return view('dashboard', compact('user', 'stats'));
    }
}