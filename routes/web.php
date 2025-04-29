<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\BeerController;
use App\Http\Controllers\BeerCategoryController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Crear rutas para las cervecerías
Route::resource('breweries', BreweryController::class);

// Rutas para cervezas
Route::get('/beers', [BeerController::class, 'index'])->name('beers.index');
Route::get('/beers/create', [BeerController::class, 'create'])->name('beers.create');
Route::post('/beers', [BeerController::class, 'store'])->name('beers.store');
Route::get('/beers/{id}', [BeerController::class, 'show'])->name('beers.show');



Route::resource('beer_categories', BeerCategoryController::class);
Route::get('/beer_categories/{category}', [BeerCategoryController::class, 'show'])->name('beer_categories.show');



require __DIR__ . '/auth.php';
