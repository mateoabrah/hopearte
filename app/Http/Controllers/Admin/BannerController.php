<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Beer;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Mostrar la página de gestión del banner
     */
    public function index()
    {
        // Verificar si la columna existe en la tabla
        $hasColumn = \Schema::hasColumn('beers', 'featured_in_banner');
        
        if ($hasColumn) {
            $featuredBeers = Beer::where('featured_in_banner', true)
                              ->with('brewery', 'category')
                              ->get();
                              
            $availableBeers = Beer::where('featured_in_banner', false)
                               ->with('brewery', 'category')
                               ->get();
        } else {
            $featuredBeers = collect([]);
            $availableBeers = Beer::with('brewery', 'category')->get();
        }
                           
        return view('admin.banner.index', compact('featuredBeers', 'availableBeers'));
    }
    
    /**
     * Activar/desactivar una cerveza en el banner
     */
    public function toggleFeatured(Beer $beer)
    {
        // Verificar si la columna existe en la tabla
        $hasColumn = \Schema::hasColumn('beers', 'featured_in_banner');
        
        if (!$hasColumn) {
            return back()->with('error', 'No se puede modificar el banner. La columna featured_in_banner no existe en la tabla de cervezas.');
        }
        
        $beer->featured_in_banner = !$beer->featured_in_banner;
        $beer->save();
        
        $status = $beer->featured_in_banner ? 'añadida al' : 'eliminada del';
        
        return back()->with('success', "Cerveza {$beer->name} {$status} banner exitosamente.");
    }
}
