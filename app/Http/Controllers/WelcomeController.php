<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Brewery;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        // Obtén datos para mostrar en la página de bienvenida
        $beers = Beer::take(5)->get();
        $breweries = Brewery::take(3)->get();
        
        return view('welcome', [
            'beers' => $beers,
            'breweries' => $breweries
        ]);
    }
}
