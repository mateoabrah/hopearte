@extends('layouts.app')

@section('content')
<!-- Banner Section -->
<section class="relative w-full h-80 bg-cover bg-center" style="background-image: url('https://bc.thegrowler.ca/wp-content/uploads/2019/11/craft-beer-north-island.jpg');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 text-center text-white py-24">
        <h1 class="text-6xl font-extrabold mb-4">{{ $beer->name }}</h1>
        <p class="text-xl">{{ $beer->description }}</p>
    </div>
</section>

<!-- Beer Details Section -->
<section class="py-16 px-8 bg-[#2E2E2E] shadow-xl rounded-lg mx-4 my-12">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-5xl font-bold text-[#FFD700] text-center mb-8" data-aos="fade-up">Detalles de la Cerveza</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Imagen de la cerveza -->
            <div class="flex justify-center items-center">
                <img src="https://cdn.homebrewersassociation.org/wp-content/uploads/irish-red-ale-_1440-900x600.jpg" alt="Imagen de {{ $beer->name }}" class="rounded-xl shadow-xl">
            </div>

            <!-- Información de la cerveza -->
            <div>
                <p class="text-[#CCCCCC] text-sm mb-4"><strong>Estilo:</strong> {{ $beer->style }}</p>
                <p class="text-[#CCCCCC] text-sm mb-4"><strong>ABV:</strong> {{ $beer->abv }}%</p>
                <p class="text-[#CCCCCC] text-sm mb-4"><strong>Precio:</strong> ${{ $beer->price }}</p>
                <p class="text-[#CCCCCC] text-sm mb-4"><strong>Rating:</strong> {{ $beer->rating }} / 5</p>
                <p class="text-[#CCCCCC] text-sm mb-4"><strong>Descripción:</strong> {{ $beer->description }}</p>

                @auth
                <form action="{{ route('beer_favorites.toggle') }}" method="POST" class="mt-4">
                    @csrf
                    <input type="hidden" name="beer_id" value="{{ $beer->id }}">
                    <button type="submit" class="flex items-center space-x-2 bg-[#3A3A3A] hover:bg-[#444444] px-4 py-2 rounded-full transition-all">
                        @if(Auth::user()->favoritedBeers->contains($beer->id))
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#FFD700]" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                            <span class="text-[#FFD700]">Quitar de favoritos</span>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <span class="text-gray-300">Añadir a favoritos</span>
                        @endif
                    </button>
                </form>
                @endauth

                @auth
                    @if(!auth()->user()->is_admin && !auth()->user()->is_company)
                        <div class="mt-6">
                            <a href="{{ route('beers.review.create', $beer->id) }}" 
                               class="inline-block bg-[#FFD700] text-[#1A1A1A] px-4 py-2 rounded-md hover:bg-yellow-400 transition font-medium">
                                Escribir reseña
                            </a>
                        </div>
                    @endif
                @endauth
            </div>
        </div>

        <!-- Sección para mostrar las reseñas existentes -->
        <div class="mt-10">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-2xl font-bold text-[#FFD700]">Reseñas</h2>
                
                @auth
                    @if(!auth()->user()->is_admin && !auth()->user()->is_company)
                        <a href="{{ route('beers.review.create', $beer->id) }}" 
                           class="bg-[#FFD700] text-[#1A1A1A] px-3 py-1 rounded-md hover:bg-yellow-400 transition font-medium text-sm">
                            Escribir reseña
                        </a>
                    @endif
                @endauth
            </div>
            
            @if($beer->reviews->count() > 0)
                <div class="space-y-4">
                    @foreach($beer->reviews as $review)
                        <div class="bg-[#2E2E2E] rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div class="flex items-center mb-2">
                                        <span class="text-[#FFD700] text-lg">
                                            {{ $review->stars }}
                                        </span>
                                        <span class="ml-2 text-gray-400 text-sm">{{ $review->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    <p class="text-white">{{ $review->comment ?: 'Sin comentario.' }}</p>
                                    <p class="text-sm text-gray-400 mt-1">Por: {{ $review->user->name }}</p>
                                </div>
                                
                                @auth
                                    @if(auth()->id() === $review->user_id)
                                        <div class="flex space-x-2">
                                            <a href="{{ route('reviews.edit', $review->id) }}" class="text-blue-400 hover:text-blue-300">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300" 
                                                        onclick="return confirm('¿Estás seguro de que quieres eliminar esta reseña?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400">No hay reseñas todavía. ¡Sé el primero en dejar una!</p>
            @endif
        </div>

        <!-- Botón para volver -->
        <div class="text-center mt-8">
            <a href="{{ route('beers.index') }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] py-2 px-6 rounded-full text-lg transition-all duration-300 ease-in-out">
                Volver a la lista
            </a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Inicializar AOS (Animation on Scroll)
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true
        });
    });
</script>
@endpush
