@extends('layouts.app')

@section('content')
<!-- Banner Section -->
<section class="relative w-full h-80 bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $beer->image) }}');">
    <div class="absolute inset-0 bg-black opacity-50"></div>
    <div class="relative z-10 text-center text-white py-24">
        <h1 class="text-6xl font-extrabold mb-4">{{ $beer->name }}</h1>
        <p class="text-xl max-w-3xl mx-auto">
            @if($beer->brewery)
                <span class="bg-[#FFD700] text-[#2E2E2E] px-4 py-1 rounded-full text-lg font-medium">
                    {{ $beer->brewery->name }}
                </span>
            @endif
        </p>
    </div>
</section>

<!-- Beer Details Section -->
<section class="py-16 px-8 bg-[#2E2E2E] shadow-xl rounded-lg mx-4 my-12">
    <div class="max-w-7xl mx-auto">
        <h2 class="text-5xl font-bold text-[#FFD700] text-center mb-12" data-aos="fade-up">Detalles de la Cerveza</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Imagen de la cerveza -->
            <div class="flex flex-col justify-center items-center">
                <div class="relative rounded-xl overflow-hidden shadow-2xl w-full max-w-md transform hover:scale-105 transition-all">
                    <img src="{{ asset('storage/' . $beer->image) }}" alt="Imagen de {{ $beer->name }}" class="w-full h-auto">
                    <div class="absolute top-0 right-0 bg-[#FFD700] text-[#2E2E2E] px-4 py-2 m-4 rounded-xl font-bold text-lg">
                        {{ $beer->abv }}% ABV
                    </div>
                </div>
                
                <!-- Valoración media -->
                <div class="mt-8 bg-[#3A3A3A] rounded-xl p-6 w-full max-w-md" data-aos="fade-up">
                    <h3 class="text-center text-2xl font-bold text-[#FFD700] mb-4">Valoración media</h3>
                    
                    @php
                        // Asegurar que obtenemos el valor más reciente de las reseñas
                        $beer->load('reviews');
                        $reviewCount = $beer->reviews->count();
                    @endphp
                    
                    @if($reviewCount > 0)
                        <div class="flex justify-center items-center">
                            <div class="text-5xl font-bold text-[#FFD700]">
                                {{ number_format($beer->average_rating, 1) }}
                            </div>
                            <div class="ml-2 text-2xl text-gray-400">/5</div>
                        </div>
                        <p class="text-center text-lg text-gray-400 mt-4">
                            Basada en {{ $reviewCount }} {{ $reviewCount == 1 ? 'opinión' : 'opiniones' }}
                        </p>
                    @else
                        <div class="flex flex-col items-center">
                            <div class="flex items-center">
                                <div class="text-3xl font-bold text-gray-500">Sin valoraciones</div>
                            </div>
                            <div class="flex mt-4">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-8 h-8 text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                            <p class="text-center text-lg text-gray-400 mt-4">
                                Sé el primero en valorar esta cerveza
                            </p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Información de la cerveza -->
            <div class="bg-[#3A3A3A] rounded-xl p-8 shadow-2xl">
                <h3 class="text-3xl font-bold text-[#FFD700] mb-8">Características</h3>
                
                <div class="space-y-8">
                    <!-- Estilo/Categoría -->
                    <div class="flex items-center">
                        <div class="bg-[#FFD700] p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h10a2 2 0 012 2v12a4 4 0 01-4 4H7z" />
                            </svg>
                        </div>
                        <div class="ml-6">
                            <p class="text-gray-400 text-lg">Estilo</p>
                            <p class="text-white text-2xl font-medium">{{ $beer->style ?? ($beer->category->name ?? 'No especificado') }}</p>
                        </div>
                    </div>
                    
                    <!-- ABV -->
                    <div class="flex items-center">
                        <div class="bg-[#FFD700] p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="ml-6">
                            <p class="text-gray-400 text-lg">Alcohol por volumen</p>
                            <p class="text-white text-2xl font-medium">{{ $beer->abv }}%</p>
                        </div>
                    </div>
                    
                    <!-- Precio -->
                    @if(isset($beer->price))
                    <div class="flex items-center">
                        <div class="bg-[#FFD700] p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-6">
                            <p class="text-gray-400 text-lg">Precio estimado</p>
                            <p class="text-white text-2xl font-medium">{{ $beer->price }} €</p>
                        </div>
                    </div>
                    @endif
                    
                    <!-- Cervecería -->
                    @if($beer->brewery)
                    <div class="flex items-center">
                        <div class="bg-[#FFD700] p-3 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#2E2E2E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="ml-6">
                            <p class="text-gray-400 text-lg">Cervecería</p>
                            <a href="{{ route('breweries.show', $beer->brewery->id) }}" class="text-[#FFD700] text-2xl font-medium hover:text-[#FFA500] transition">
                                {{ $beer->brewery->name }}
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Descripción -->
                <div class="mt-10">
                    <h3 class="text-2xl font-bold text-[#FFD700] mb-4">Descripción</h3>
                    <p class="text-[#CCCCCC] text-xl leading-relaxed">{{ $beer->description }}</p>
                </div>

                <!-- Acciones de usuario -->
                <div class="flex flex-wrap gap-4 mt-10">
                    @auth
                    <form action="{{ route('beer_favorites.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="beer_id" value="{{ $beer->id }}">
                        <button type="submit" class="flex items-center space-x-3 bg-[#2E2E2E] hover:bg-[#444444] px-6 py-3 rounded-xl transition-all">
                            @if(Auth::user()->favoritedBeers->contains($beer->id))
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FFD700]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                                <span class="text-[#FFD700] text-lg">Quitar de favoritos</span>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span class="text-gray-300 text-lg">Añadir a favoritos</span>
                            @endif
                        </button>
                    </form>
                    
                    @if(!auth()->user()->is_admin && !auth()->user()->is_company)
                        <a href="{{ route('beers.review.create', $beer->id) }}" 
                           class="inline-flex items-center bg-[#FFD700] text-[#2E2E2E] px-6 py-3 rounded-xl hover:bg-[#FFA500] transition font-medium text-lg">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            Escribir reseña
                        </a>
                    @endif
                    @endauth
                    
                    <a href="{{ route('beers.index') }}" class="inline-flex items-center bg-[#3A3A3A] hover:bg-[#4A4A4A] text-white px-6 py-3 rounded-xl transition-all text-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                        Volver a la lista
                    </a>
                </div>
            </div>
        </div>

        <!-- Sección para mostrar las reseñas existentes -->
        <div class="mt-16 bg-[#3A3A3A] rounded-xl p-8 shadow-2xl" data-aos="fade-up">
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-4xl font-bold text-[#FFD700]">Opiniones de usuarios</h2>
                
                @auth
                    @if(!auth()->user()->is_admin && !auth()->user()->is_company)
                        <a href="{{ route('beers.review.create', $beer->id) }}" 
                           class="bg-[#FFD700] text-[#1A1A1A] px-5 py-3 rounded-xl hover:bg-[#FFA500] transition font-medium flex items-center text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            Escribir reseña
                        </a>
                    @endif
                @endauth
            </div>
            
            @if($beer->reviews->count() > 0)
                <div class="space-y-6">
                    @foreach($beer->reviews->sortByDesc('created_at') as $review)
                        <div class="bg-[#2E2E2E] rounded-xl p-6 shadow-lg" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <div class="flex justify-between items-start">
                                <div class="flex items-start">
                                    <div class="bg-[#FFD700] text-[#2E2E2E] rounded-full h-16 w-16 flex items-center justify-center text-2xl font-bold">
                                        {{ substr($review->user->name, 0, 1) }}
                                    </div>
                                    <div class="ml-5">
                                        <div class="flex items-center">
                                            <span class="font-semibold text-white text-xl">{{ $review->user->name }}</span>
                                            <span class="ml-3 text-gray-400">· {{ $review->created_at->format('d/m/Y') }}</span>
                                        </div>
                                        
                                        <div class="flex items-center mt-2">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <svg class="w-6 h-6 text-[#FFD700]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @endif
                                            @endfor
                                            <span class="ml-2 text-lg text-[#FFD700] font-medium">{{ $review->rating }}/5</span>
                                        </div>
                                        
                                        <p class="text-white text-lg mt-4">{{ $review->comment ?: 'Sin comentario.' }}</p>
                                    </div>
                                </div>
                                
                                @auth
                                    @if(auth()->id() === $review->user_id)
                                        <div class="flex space-x-3">
                                            <a href="{{ route('reviews.edit', $review->id) }}" class="text-blue-400 hover:text-blue-300 bg-[#2A2A2A] p-3 rounded-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 bg-[#2A2A2A] p-3 rounded-full" 
                                                        onclick="return confirm('¿Estás seguro de que quieres eliminar esta reseña?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
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
                <div class="bg-[#2E2E2E] rounded-xl p-10 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-500 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <p class="text-gray-400 text-xl mb-6">No hay reseñas todavía para esta cerveza.</p>
                    @auth
                        @if(!auth()->user()->is_admin && !auth()->user()->is_company)
                            <a href="{{ route('beers.review.create', $beer->id) }}" 
                               class="inline-block bg-[#FFD700] text-[#1A1A1A] px-6 py-3 rounded-xl hover:bg-[#FFA500] transition font-medium text-lg">
                                ¡Sé el primero en dejar una reseña!
                            </a>
                        @endif
                    @else
                        <p class="text-gray-500 text-lg">
                            <a href="{{ route('login') }}" class="text-[#FFD700] hover:text-[#FFA500]">Inicia sesión</a> 
                            para dejar una reseña.
                        </p>
                    @endauth
                </div>
            @endif
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
