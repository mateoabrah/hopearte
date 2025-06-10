<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Models\Beer;

Route::get('/check-beer-name', function (Request $request) {
    $name = $request->input('name');
    $breweryId = $request->input('brewery_id');
    
    // Comprobamos si ya existe una cerveza con ese nombre (usando el slug)
    $slug = Str::slug($name);
    $exists = Beer::where('slug', $slug)
        ->when($breweryId, function($query, $breweryId) {
            return $query->where('brewery_id', $breweryId);
        })
        ->exists();
    
    return response()->json(['exists' => $exists]);
});