<?php

namespace App\Http\Controllers;

use App\Models\Beer;
use App\Models\Brewery;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    /**
     * Constructor: solo usuarios autenticados pueden escribir reseñas
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Mostrar el formulario para crear una reseña para una cerveza
     */
    public function createForBeer($beerId)
    {
        $beer = Beer::findOrFail($beerId);
        return view('reviews.create', [
            'reviewable' => $beer,
            'reviewableType' => 'beer',
            'backUrl' => route('beers.show', $beer->id),
        ]);
    }
    
    /**
     * Mostrar el formulario para crear una reseña para una cervecería
     */
    public function createForBrewery($breweryId)
    {
        $brewery = Brewery::findOrFail($breweryId);
        return view('reviews.create', [
            'reviewable' => $brewery,
            'reviewableType' => 'brewery',
            'backUrl' => route('breweries.show', $brewery->id),
        ]);
    }
    
    /**
     * Almacenar una nueva reseña para una cerveza o cervecería
     */
    public function store(Request $request)
    {
        $request->validate([
            'reviewable_id' => 'required|integer',
            'reviewable_type' => ['required', Rule::in(['beer', 'brewery'])],
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);
        
        $user = Auth::user();
        
        // Determinar el modelo a utilizar
        $reviewableClass = ($request->reviewable_type === 'beer') ? Beer::class : Brewery::class;
        $reviewableId = $request->reviewable_id;
        
        // Verificar si el modelo existe
        $reviewable = $reviewableClass::findOrFail($reviewableId);
        
        // Verificar si el usuario ya ha dejado una reseña
        $existingReview = $reviewable->reviews()->where('user_id', $user->id)->first();
        
        if ($existingReview) {
            // Actualizar la reseña existente
            $existingReview->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
            $message = '¡Reseña actualizada con éxito!';
        } else {
            // Crear una nueva reseña
            $reviewable->reviews()->create([
                'user_id' => $user->id,
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]);
            $message = '¡Reseña añadida con éxito!';
        }
        
        // Redireccionar de vuelta al detalle del elemento
        $redirectRoute = $request->reviewable_type === 'beer' 
            ? route('beers.show', $reviewableId) 
            : route('breweries.show', $reviewableId);
            
        return redirect($redirectRoute)->with('success', $message);
    }
    
    /**
     * Mostrar el formulario para editar una reseña existente
     */
    public function edit($id)
    {
        $review = Review::findOrFail($id);
        
        // Asegurarse de que el usuario es el propietario de la reseña
        $this->authorize('update', $review);
        
        $reviewableType = $review->reviewable_type === Beer::class ? 'beer' : 'brewery';
        
        return view('reviews.create', [
            'review' => $review,
            'reviewable' => $review->reviewable,
            'reviewableType' => $reviewableType,
        ]);
    }
    
    /**
     * Actualizar una reseña existente
     */
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        
        // Asegurarse de que el usuario es el propietario de la reseña
        $this->authorize('update', $review);
        
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);
        
        $review->update([
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        
        // Determinar a dónde redireccionar
        $reviewable = $review->reviewable;
        $reviewableType = $review->reviewable_type === Beer::class ? 'beer' : 'brewery';
        $redirectRoute = $reviewableType === 'beer' 
            ? route('beers.show', $reviewable->id) 
            : route('breweries.show', $reviewable->id);
            
        return redirect($redirectRoute)->with('success', '¡Reseña actualizada con éxito!');
    }
    
    /**
     * Eliminar una reseña
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        
        // Asegurarse de que el usuario es el propietario de la reseña
        $this->authorize('delete', $review);
        
        // Guardar la información del reviewable antes de eliminar la reseña
        $reviewable = $review->reviewable;
        $isForBeer = $review->reviewable_type === Beer::class;
        
        $review->delete();
        
        // Redireccionar de vuelta al detalle del elemento
        $redirectRoute = $isForBeer 
            ? route('beers.show', $reviewable->id) 
            : route('breweries.show', $reviewable->id);
            
        return redirect($redirectRoute)->with('success', 'Reseña eliminada con éxito');
    }
}