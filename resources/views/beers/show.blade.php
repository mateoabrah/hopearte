@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Breadcrumb para mejor navegación -->
    <div class="text-sm text-gray-400 mb-4">
        <a href="{{ route('welcome') }}" class="hover:text-[#FFD700] transition">Inicio</a> &gt; 
        <a href="{{ route('beers.index') }}" class="hover:text-[#FFD700] transition">Cervezas</a> &gt; 
        <span class="text-gray-300">{{ $beer->name }}</span>
    </div>

    <div class="bg-[#2E2E2E] rounded-lg overflow-hidden shadow-lg">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-0">
            <!-- Imagen vertical de la cerveza (1/3 del ancho) -->
            <div class="relative md:h-[550px] bg-gradient-to-b from-black to-[#1A1A1A] flex items-center justify-center">
                <img src="{{ asset('storage/' . $beer->image) }}" alt="{{ $beer->name }}" class="w-auto h-full max-h-full object-contain p-4">
                
                <!-- Overlay para dar profundidad a la imagen -->
                <div class="absolute inset-0 bg-gradient-to-t from-[#1A1A1A] to-transparent opacity-40 pointer-events-none"></div>
                
                <!-- Indicador de ABV en la esquina superior izquierda -->
                <div class="absolute top-4 left-4 bg-[#FFD700] text-[#2E2E2E] px-3 py-1 rounded-full font-semibold z-10 shadow-md">
                    {{ $beer->abv }}% ABV
                </div>
                
                <!-- Botón de favorito en la esquina superior derecha -->
                <div class="absolute top-4 right-4 z-10">
                    @auth
                        <form action="{{ route('beer_favorites.toggle') }}" method="POST" class="beer-favorite-form">
                            @csrf
                            <input type="hidden" name="beer_id" value="{{ $beer->id }}">
                            <button type="submit" class="bg-[#2E2E2E] p-2 rounded-full hover:bg-[#4A4A4A] transition-all shadow-md">
                                @if(Auth::user()->favoritedBeers->contains($beer->id))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="red" style="color: red;">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" onmouseover="this.style.color='red'" onmouseout="this.style.color=''">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                @endif
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="bg-[#2E2E2E] p-2 rounded-full hover:bg-[#4A4A4A] transition-all block shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" onmouseover="this.style.color='red'" onmouseout="this.style.color=''">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </a>
                    @endauth
                </div>
            </div>
            
            <!-- Información principal (2/3 del ancho) -->
            <div class="md:col-span-2 p-6">
                <!-- Header con nombre, valoración y cervecería -->
                <div class="mb-6 border-b border-gray-700 pb-4">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-2">
                        <h1 class="text-3xl font-bold text-white">{{ $beer->name }}</h1>
                        
                        <!-- Valoración junto al título -->
                        @php
                            $beer->load('reviews');
                            $reviewCount = $beer->reviews->count();
                            $avgRating = $reviewCount > 0 ? $beer->average_rating : 0;
                            $fullStars = floor($avgRating);
                            $partialStar = $avgRating - $fullStars;
                        @endphp
                        
                        <div class="flex items-center mt-2 md:mt-0">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $fullStars)
                                        <svg class="w-5 h-5 text-[#FFD700]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @elseif($partialStar > 0 && $i == $fullStars + 1)
                                        <div class="relative w-5 h-5">
                                            <!-- Estrella base gris -->
                                            <svg class="absolute w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                            <!-- Estrella parcial dorada con clip-path -->
                                            <div class="absolute w-5 h-5 overflow-hidden" style="clip-path: inset(0 {{ (1 - $partialStar) * 100 }}% 0 0);">
                                                <svg class="w-5 h-5 text-[#FFD700]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    @else
                                        <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <div class="ml-2 text-[#FFD700] font-semibold">
                                {{ number_format($avgRating, 1) }}
                            </div>
                            <div class="ml-1 text-gray-400 text-sm">
                                ({{ $reviewCount }} {{ $reviewCount == 1 ? 'opinión' : 'opiniones' }})
                            </div>
                        </div>
                    </div>
                    
                    <!-- Enlace a cervecería en la parte superior del detalle -->
                    <div class="flex items-center">
                        @if($beer->brewery)
                            <!-- Corrección para incluir el ID de la cervecería en la ruta -->
                            <a href="{{ route('breweries.show', $beer->brewery) }}" class="text-[#FFD700] hover:text-[#FFA500] transition text-lg font-medium flex items-center">
                                @if($beer->brewery->image)
                                    <img src="{{ asset('storage/' . $beer->brewery->image) }}" alt="{{ $beer->brewery->name }}" class="w-6 h-6 object-cover rounded-full mr-2">
                                @endif
                                {{ $beer->brewery->name }}
                            </a>
                        @else
                            <span class="text-gray-400">Cervecería desconocida</span>
                        @endif
                    </div>
                </div>
                
                <!-- Información principal de la cerveza -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-[#FFD700] mb-3">
                        Sobre esta cerveza
                    </h2>
                    <p class="text-gray-300 mb-5 leading-relaxed">{{ $beer->description }}</p>
                    
                    <!-- Características de la cerveza en una fila -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
                        <!-- Estilo/Categoría - Modificado para convertirlo en enlace con nombre -->
                        <div class="bg-[#3A3A3A] p-4 rounded-lg text-center hover:bg-[#444] transition duration-200">
                            <div class="text-[#FFD700] text-sm mb-1">Estilo</div>
                            <div class="text-white font-medium">
                                @if($beer->category)
                                    <a href="{{ route('beers.index') }}?category={{ $beer->category->name }}" class="text-white hover:text-[#FFD700] transition">
                                        {{ $beer->style ?? $beer->category->name }}
                                    </a>
                                @else
                                    {{ $beer->style ?? 'No especificado' }}
                                @endif
                            </div>
                        </div>
                        
                        <!-- ABV -->
                        <div class="bg-[#3A3A3A] p-4 rounded-lg text-center hover:bg-[#444] transition duration-200">
                            <div class="text-[#FFD700] text-sm mb-1">ABV</div>
                            <div class="text-white font-medium">{{ $beer->abv }}%</div>
                        </div>
                        
                        <!-- IBU si está disponible -->
                        @if($beer->ibu)
                        <div class="bg-[#3A3A3A] p-4 rounded-lg text-center hover:bg-[#444] transition duration-200">
                            <div class="text-[#FFD700] text-sm mb-1">IBU</div>
                            <div class="text-white font-medium">{{ $beer->ibu }}</div>
                        </div>
                        @endif
                        
                        <!-- Precio si está disponible -->
                        @if(isset($beer->price))
                        <div class="bg-[#3A3A3A] p-4 rounded-lg text-center hover:bg-[#444] transition duration-200">
                            <div class="text-[#FFD700] text-sm mb-1">Precio</div>
                            <div class="text-white font-medium">{{ $beer->price }} €</div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Información de la cervecería -->
                    @if($beer->brewery)
                    <div class="bg-[#3A3A3A] rounded-lg p-4 hover:bg-[#444] transition duration-200 mb-5">
                        <h3 class="text-lg font-bold text-[#FFD700] mb-3">Cervecería</h3>
                        <div class="flex items-center">
                            @if($beer->brewery->image)
                                <img src="{{ asset('storage/' . $beer->brewery->image) }}" alt="{{ $beer->brewery->name }}" class="w-12 h-12 object-cover rounded-full">
                            @else
                                <div class="w-12 h-12 bg-gray-700 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            @endif
                            <div class="ml-3">
                                <a href="{{ route('breweries.show', $beer->brewery) }}" class="text-[#FFD700] font-medium hover:text-[#FFA500] transition">
                                    {{ $beer->brewery->name }}
                                </a>
                                <p class="text-gray-400 text-sm">{{ $beer->brewery->location }}</p>
                            </div>
                        </div>
                        <!-- Botón "Ver cervecería" -->
                        <a href="{{ route('breweries.show', $beer->brewery) }}" class="block text-center mt-3 text-sm text-[#FFD700] hover:text-[#FFA500] transition">
                            Ver cervecería
                        </a>
                    </div>
                    @endif
                    
                    <!-- Acciones de usuario -->
                    <div class="flex flex-wrap gap-3 mt-6">
                        @auth
                        <form action="{{ route('beer_favorites.toggle') }}" method="POST" class="favorite-button-large">
                            @csrf
                            <input type="hidden" name="beer_id" value="{{ $beer->id }}">
                            <button type="submit" class="flex items-center space-x-2 bg-[#3A3A3A] hover:bg-[#444444] px-4 py-2 rounded-md transition-all text-sm">
                                @if(Auth::user()->favoritedBeers->contains($beer->id))
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="red" style="color: red;">
                                        <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-red-500">Quitar de favoritos</span>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" onmouseover="this.style.color='red'" onmouseout="this.style.color=''">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    <span class="text-gray-300">Añadir a favoritos</span>
                                @endif
                            </button>
                        </form>
                        
                        @if(!auth()->user()->is_admin && !auth()->user()->is_company)
                            <a href="{{ route('beers.review.create', $beer->id) }}" 
                               class="inline-flex items-center bg-[#FFD700] text-[#2E2E2E] px-4 py-2 rounded-md hover:bg-[#FFA500] transition font-medium text-sm">
                               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                Escribir reseña
                            </a>
                        @endif
                        @endauth
                        
                        <a href="{{ route('beers.index') }}" class="inline-flex items-center bg-[#3A3A3A] hover:bg-[#4A4A4A] text-white px-4 py-2 rounded-md transition-all text-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                            </svg>
                            Volver a la lista
                        </a>
                    </div>
                </div>
                
                <!-- Sección de reseñas de usuarios -->
                <div class="mt-10 border-t border-gray-700 pt-6">
                    <div class="flex justify-between items-center mb-5">
                        <h2 class="text-xl font-semibold text-[#FFD700]">Opiniones de usuarios</h2>
                        
                        @auth
                            @if(!auth()->user()->is_admin && !auth()->user()->is_company)
                                <a href="{{ route('beers.review.create', $beer->id) }}" 
                                   class="bg-[#FFD700] text-[#1A1A1A] px-3 py-1.5 rounded-md hover:bg-[#FFA500] transition font-medium flex items-center text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Escribir reseña
                                </a>
                            @endif
                        @endauth
                    </div>
                    
                    @if($beer->reviews->count() > 0)
                        <div class="space-y-4 max-h-96 overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-transparent">
                            @foreach($beer->reviews->sortByDesc('created_at') as $review)
                                <div class="bg-[#3A3A3A] rounded-lg p-4 shadow-sm" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-start">
                                            <div class="bg-[#FFD700] text-[#2E2E2E] rounded-full h-10 w-10 flex items-center justify-center text-sm font-bold">
                                                {{ substr($review->user->name, 0, 1) }}
                                            </div>
                                            <div class="ml-3">
                                                <div class="flex items-center">
                                                    <span class="font-semibold text-white text-sm">{{ $review->user->name }}</span>
                                                    <span class="ml-2 text-gray-400 text-xs">· {{ $review->created_at->format('d/m/Y') }}</span>
                                                </div>
                                                
                                                <div class="flex items-center mt-1">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $review->rating)
                                                            <svg class="w-4 h-4 text-[#FFD700]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                            </svg>
                                                        @else
                                                            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                    <span class="ml-1.5 text-xs text-[#FFD700] font-medium">{{ $review->rating }}/5</span>
                                                </div>
                                                
                                                <p class="text-white text-sm mt-2 leading-relaxed">{{ $review->comment ?: 'Sin comentario.' }}</p>
                                            </div>
                                        </div>
                                        
                                        @auth
                                            @if(auth()->id() === $review->user_id)
                                                <div class="flex space-x-1">
                                                    <a href="{{ route('reviews.edit', $review->id) }}" class="text-blue-400 hover:text-blue-300 bg-[#2A2A2A] p-1.5 rounded-full">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-400 hover:text-red-300 bg-[#2A2A2A] p-1.5 rounded-full" 
                                                                onclick="return confirm('¿Estás seguro de que quieres eliminar esta reseña?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
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
                        <div class="bg-[#3A3A3A] rounded-lg p-8 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2H5a2 2 0 00-2 2v2M7 7h10" />
                            </svg>
                            <p class="text-gray-400 text-base mb-4">No hay reseñas todavía para esta cerveza.</p>
                            @auth
                                @if(!auth()->user()->is_admin && !auth()->user()->is_company)
                                    <a href="{{ route('beers.review.create', $beer->id) }}" 
                                       class="inline-block bg-[#FFD700] text-[#1A1A1A] px-5 py-2 rounded-md hover:bg-[#FFA500] transition font-medium text-sm">
                                        ¡Sé el primero en dejar una reseña!
                                    </a>
                                @endif
                            @else
                                <p class="text-gray-500 text-sm">
                                    <a href="{{ route('login') }}" class="text-[#FFD700] hover:text-[#FFA500]">Inicia sesión</a> 
                                    para dejar una reseña.
                                </p>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicialización de animaciones
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
        
        // Gestión de favoritos sin recargar la página
        const favoriteForms = document.querySelectorAll('.beer-favorite-form, .favorite-button-large');
        
        favoriteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const button = this.querySelector('button');
                const svgContainer = button.querySelector('svg') || button;
                
                // Efecto visual inmediato
                button.classList.add('animate-pulse');
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                .then(response => response.json())
                .then data => {
                    // Actualizar todos los botones de favoritos en la página
                    document.querySelectorAll('.beer-favorite-form button svg, .favorite-button-large button svg').forEach(svg => {
                        svg.outerHTML = data.isFavorited
                            ? '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="red" style="color: red;"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" /></svg>'
                            : '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" onmouseover="this.style.color=\'red\'" onmouseout="this.style.color=\'\'"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></path></svg>';
                    });
                    
                    // Actualizar textos en botones grandes
                    document.querySelectorAll('.favorite-button-large button span').forEach(span => {
                        if (data.isFavorited) {
                            span.textContent = 'Quitar de favoritos';
                            span.classList.remove('text-gray-300');
                            span.classList.add('text-red-500');
                        } else {
                            span.textContent = 'Añadir a favoritos';
                            span.classList.remove('text-red-500');
                            span.classList.add('text-gray-300');
                        }
                    });
                    
                    // Mostrar notificación
                    const message = data.isFavorited ? 'Cerveza añadida a favoritos' : 'Cerveza eliminada de favoritos';
                    showNotification(message);
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error al actualizar favoritos', 'error');
                })
                .finally(() => {
                    button.classList.remove('animate-pulse');
                });
            });
        });
        
        // Función para mostrar notificaciones
        function showNotification(message, type = 'success') {
            // Eliminar notificaciones existentes
            const existingNotifications = document.querySelectorAll('.notification-toast');
            existingNotifications.forEach(notification => {
                document.body.removeChild(notification);
            });
            
            const notification = document.createElement('div');
            notification.className = `notification-toast fixed bottom-4 right-4 px-4 py-2 rounded-md text-sm text-white transform transition-all duration-500 opacity-0 translate-y-2 ${type === 'success' ? 'bg-[#4CAF50]' : 'bg-[#F44336]'} shadow-lg z-50`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.classList.remove('opacity-0', 'translate-y-2');
                notification.classList.add('opacity-100', 'translate-y-0');
            }, 10);
            
            setTimeout(() => {
                notification.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 500);
            }, 3000);
        }
    });
</script>
@endpush