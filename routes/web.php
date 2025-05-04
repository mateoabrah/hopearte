<?php


use App\Http\Controllers\BeerCategoryController;
use App\Http\Controllers\BeerController;
use App\Http\Controllers\BeerFavoriteController;
use App\Http\Controllers\BreweryController;
use App\Http\Controllers\BreweryFavoriteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BreweryBeerController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\CompanyMiddleware;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

// Ruta principal (welcome)
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Rutas para usuarios autenticados
Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Favoritos de cerveza
    Route::post('/beer-favorites/toggle', [BeerFavoriteController::class, 'toggle'])->name('beer_favorites.toggle');
    Route::get('/favorites/beers', [BeerFavoriteController::class, 'index'])->name('user.beer_favorites');
    Route::delete('/beer-favorites/{beer}', [BeerFavoriteController::class, 'destroy'])->name('beer_favorites.destroy');
    
    // Favoritos de cervecería
    Route::post('/brewery-favorites/toggle', [BreweryFavoriteController::class, 'toggle'])->name('brewery_favorites.toggle');
    Route::get('/favorites/breweries', [BreweryFavoriteController::class, 'index'])->name('user.brewery_favorites');
    Route::delete('/brewery-favorites/{brewery}', [BreweryFavoriteController::class, 'destroy'])->name('brewery_favorites.destroy');
    
    // Reseñas
    Route::get('/beers/{beer}/review/create', [ReviewController::class, 'createForBeer'])->name('beers.review.create');
    Route::get('/breweries/{brewery}/review/create', [ReviewController::class, 'createForBrewery'])->name('breweries.review.create');
    Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    
    // Rutas para usuarios empresa o administradores
    Route::middleware([CompanyMiddleware::class])->group(function () {
        // IMPORTANTE: Coloca primero las rutas específicas
        Route::get('/breweries/create', [BreweryController::class, 'create'])->name('breweries.create');
        Route::post('/breweries', [BreweryController::class, 'store'])->name('breweries.store');
        Route::get('/my-breweries', [BreweryController::class, 'myBreweries'])->name('my_breweries');
        Route::get('/breweries/{brewery}/edit', [BreweryController::class, 'edit'])->name('breweries.edit');
        Route::put('/breweries/{brewery}', [BreweryController::class, 'update'])->name('breweries.update');
    });

    // Rutas para gestionar cervezas de una cervecería (solo para usuarios company o admin)
    Route::middleware(['auth', 'can:manage-brewery-beers'])->group(function () {
        Route::get('/my-breweries/{brewery}/beers', [BreweryBeerController::class, 'index'])->name('brewery.beers.index');
        Route::get('/my-breweries/{brewery}/beers/create', [BreweryBeerController::class, 'create'])->name('brewery.beers.create');
        Route::post('/my-breweries/{brewery}/beers', [BreweryBeerController::class, 'store'])->name('brewery.beers.store');
        Route::delete('/my-breweries/{brewery}/beers/{beer}', [BreweryBeerController::class, 'destroy'])->name('brewery.beers.destroy');
    });

    // Rutas solo para administradores
    Route::middleware([AdminMiddleware::class])->group(function () {
        // CRUD de cervezas (excepto index y show que son públicas)
        Route::get('/beers/create', [BeerController::class, 'create'])->name('beers.create');
        Route::post('/beers', [BeerController::class, 'store'])->name('beers.store');
        Route::get('/beers/{beer}/edit', [BeerController::class, 'edit'])->name('beers.edit');
        Route::put('/beers/{beer}', [BeerController::class, 'update'])->name('beers.update');
        Route::delete('/beers/{beer}', [BeerController::class, 'destroy'])->name('beers.destroy');
        
        // CRUD de categorías (excepto index y show que son públicas)
        Route::get('/beer-categories/create', [BeerCategoryController::class, 'create'])->name('beer_categories.create');
        Route::post('/beer-categories', [BeerCategoryController::class, 'store'])->name('beer_categories.store');
        Route::get('/beer-categories/{beerCategory}/edit', [BeerCategoryController::class, 'edit'])->name('beer_categories.edit');
        Route::put('/beer-categories/{beerCategory}', [BeerCategoryController::class, 'update'])->name('beer_categories.update');
        Route::delete('/beer-categories/{beerCategory}', [BeerCategoryController::class, 'destroy'])->name('beer_categories.destroy');
        
        // Eliminar cervecerías (solo admin)
        Route::delete('/breweries/{brewery}', [BreweryController::class, 'destroy'])->name('breweries.destroy');
    });
});

// IMPORTANTE: Coloca las rutas públicas DESPUÉS de las protegidas específicas
Route::get('/beers', [BeerController::class, 'index'])->name('beers.index');
Route::get('/beers/{beer}', [BeerController::class, 'show'])->name('beers.show');
Route::get('/breweries', [BreweryController::class, 'index'])->name('breweries.index');
Route::get('/breweries/{brewery}', [BreweryController::class, 'show'])->name('breweries.show');
Route::get('/beer-categories', [BeerCategoryController::class, 'index'])->name('beer_categories.index');
Route::get('/beer-categories/{beerCategory}', [BeerCategoryController::class, 'show'])->name('beer_categories.show');

require __DIR__.'/auth.php';
