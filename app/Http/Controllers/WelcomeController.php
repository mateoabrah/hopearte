<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Brewery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class WelcomeController extends Controller
{
    /**
     * Mostrar la página de bienvenida
     */
    public function index()
    {
        $bannerBeers = Beer::where('featured_in_banner', true)
            ->with('brewery', 'category')
            ->take(6) // Limita el número de cervezas en el banner
            ->get();
        
        // Verificar si las tablas existen antes de consultarlas
        $randomBeers = [];
        $featuredBreweries = [];
        $breweries = []; // Para el mapa
        
        if (Schema::hasTable('beers')) {
            try {
                $randomBeers = Beer::inRandomOrder()->limit(5)->get();
            } catch (\Exception $e) {
                $randomBeers = collect([]);
            }
        }
        
        if (Schema::hasTable('breweries')) {
            try {
                $featuredBreweries = Brewery::inRandomOrder()->limit(3)->get();
                
                // Obtener todas las cervecerías para el mapa
                $breweries = Brewery::whereNotNull('latitude')
                                   ->whereNotNull('longitude')
                                   ->get(['id', 'name', 'city', 'address', 'latitude', 'longitude', 'founded_year']);
            } catch (\Exception $e) {
                $featuredBreweries = collect([]);
                $breweries = collect([]);
            }
        }
        
        // Cambiamos 'home' por 'welcome'
        return view('welcome', compact('bannerBeers', 'randomBeers', 'featuredBreweries', 'breweries'));
    }
}
