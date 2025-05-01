<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\BeerController;
use App\Http\Controllers\BeerCategoryController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BeerFavoriteController;
use App\Http\Controllers\BreweryFavoriteController;

// Ruta principal
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rutas existentes para las cervezas, categorías, etc.
Route::resource('beers', BeerController::class);
Route::resource('breweries', BreweryController::class);
Route::resource('beer_categories', BeerCategoryController::class);

// Ruta para favoritos del usuario
Route::get('/user/favorites', [UserController::class, 'favorites'])->name('user.favorites');

// Rutas para cervezas favoritas y cervecerías favoritas (con middleware auth aplicado directamente)
Route::middleware(['auth'])->group(function () {
    Route::get('/user/beer-favorites', [BeerFavoriteController::class, 'index'])->name('user.beer_favorites');
    Route::post('/beer-favorites', [BeerFavoriteController::class, 'store'])->name('beer_favorites.store');
    Route::delete('/beer-favorites/{beerId}', [BeerFavoriteController::class, 'destroy'])->name('beer_favorites.destroy');
    Route::post('/beer-favorites/toggle', [BeerFavoriteController::class, 'toggle'])->name('beer_favorites.toggle');
    
    Route::get('/user/brewery-favorites', [BreweryFavoriteController::class, 'index'])->name('user.brewery_favorites');
    Route::post('/brewery-favorites', [BreweryFavoriteController::class, 'store'])->name('brewery_favorites.store');
    Route::delete('/brewery-favorites/{breweryId}', [BreweryFavoriteController::class, 'destroy'])->name('brewery_favorites.destroy');
    Route::post('/brewery-favorites/toggle', [BreweryFavoriteController::class, 'toggle'])->name('brewery_favorites.toggle');
});

// Rutas de autenticación
require __DIR__ . '/auth.php';
