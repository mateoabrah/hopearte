@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-[#1A1A1A] rounded-lg p-6 shadow-lg">
        <h1 class="text-2xl font-bold text-[#FFD700] mb-6">
            {{ isset($review) ? 'Editar reseña' : 'Escribir reseña para' }} {{ $reviewable->name }}
        </h1>
        
        <form action="{{ isset($review) ? route('reviews.update', $review->id) : route('reviews.store') }}" method="POST">
            @csrf
            @if(isset($review))
                @method('PUT')
            @endif
            
            <input type="hidden" name="reviewable_id" value="{{ $reviewable->id }}">
            <input type="hidden" name="reviewable_type" value="{{ $reviewableType }}">
            
            <div class="mb-6">
                <label class="block text-gray-300 mb-2">Calificación</label>
                <div class="flex items-center rating-stars">
                    @for($i = 1; $i <= 5; $i++)
                        <div class="mr-2 star-wrapper" data-rating="{{ $i }}">
                            <input type="radio" name="rating" id="rating-{{ $i }}" value="{{ $i }}" 
                                {{ (isset($review) && $review->rating == $i) || old('rating') == $i ? 'checked' : '' }}
                                class="hidden peer">
                            <label for="rating-{{ $i }}" class="cursor-pointer text-4xl star-label {{ (isset($review) && $review->rating >= $i) || old('rating') >= $i ? 'text-[#FFD700]' : 'text-gray-400' }}">
                                ★
                            </label>
                        </div>
                    @endfor
                </div>
                @error('rating')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-6">
                <label for="comment" class="block text-gray-300 mb-2">Comentario (opcional)</label>
                <textarea id="comment" name="comment" rows="5"
                    class="w-full rounded-md bg-[#2E2E2E] border-gray-700 text-white focus:border-[#FFD700] focus:ring focus:ring-[#FFD700] focus:ring-opacity-50">{{ isset($review) ? $review->comment : old('comment') }}</textarea>
                @error('comment')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex justify-between">
                <a href="{{ url()->previous() }}" 
                    class="bg-gray-700 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition">
                    Cancelar
                </a>
                <button type="submit" 
                    class="bg-[#FFD700] text-[#1A1A1A] px-4 py-2 rounded-md hover:bg-yellow-400 transition font-medium">
                    {{ isset($review) ? 'Actualizar reseña' : 'Publicar reseña' }}
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const stars = document.querySelectorAll('.star-wrapper');
        
        // Función para iluminar estrellas
        function updateStars(selectedRating) {
            stars.forEach(star => {
                const rating = parseInt(star.dataset.rating);
                const starLabel = star.querySelector('.star-label');
                
                if (rating <= selectedRating) {
                    starLabel.classList.remove('text-gray-400');
                    starLabel.classList.add('text-[#FFD700]');
                } else {
                    starLabel.classList.remove('text-[#FFD700]');
                    starLabel.classList.add('text-gray-400');
                }
            });
        }
        
        // Inicializar con valor existente si hay
        const checkedRadio = document.querySelector('input[name="rating"]:checked');
        if (checkedRadio) {
            updateStars(parseInt(checkedRadio.value));
        }
        
        // Agregar eventos de clic a cada estrella
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.dataset.rating);
                updateStars(rating);
                
                // Marcar el radio button correspondiente
                document.getElementById(`rating-${rating}`).checked = true;
            });
        });
    });
</script>
@endpush
@endsection