<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\BeerCategory; // Añade esta importación
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
            ->orderBy('banner_position') // Añadir esta línea para ordenar por posición
            ->take(6) // Limita el número de cervezas en el banner
            ->get();
        
        // Verificar si las tablas existen antes de consultarlas
        $randomBeers = [];
        $featuredBreweries = [];
        $breweries = []; // Para el mapa
        $beers = collect([]); // Añade esta variable
        $beer_categories = collect([]); // Añade esta variable
        
        if (Schema::hasTable('beers')) {
            try {
                $randomBeers = Beer::inRandomOrder()->limit(5)->get();
                $beers = Beer::all(); // Obtener todas las cervezas
            } catch (\Exception $e) {
                $randomBeers = collect([]);
                $beers = collect([]);
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
        
        // Añade esta parte para obtener las categorías de cerveza
        if (Schema::hasTable('beer_categories')) {
            try {
                $beer_categories = BeerCategory::all();
            } catch (\Exception $e) {
                $beer_categories = collect([]);
            }
        }
        
        // Cambiamos 'home' por 'welcome' y añadimos las nuevas variables
        return view('welcome', compact(
            'bannerBeers', 
            'randomBeers', 
            'featuredBreweries', 
            'breweries',
            'beers',
            'beer_categories'
        ));
    }
}
