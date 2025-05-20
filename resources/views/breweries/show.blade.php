@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-[#2E2E2E] rounded-lg overflow-hidden shadow-xl">
        <!-- Imagen de cabecera de la cervecería -->
        <div class="relative h-80">
            @if($brewery->image)
                <img src="{{ asset('storage/' . $brewery->image) }}" alt="{{ $brewery->name }}" class="w-full h-full object-cover">
            @else
                <img src="https://images.unsplash.com/photo-1623937228271-992646fb0831?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" alt="{{ $brewery->name }}" class="w-full h-full object-cover">
            @endif
            
            <div class="absolute inset-0 bg-gradient-to-t from-[#1A1A1A] to-transparent"></div>
            
            <div class="absolute bottom-0 left-0 p-8">
                <h1 class="text-4xl font-bold text-white mb-2">{{ $brewery->name }}</h1>
                <p class="text-xl text-gray-300">
                    <span class="inline-flex items-center">
                        <!-- Aquí eliminamos el SVG del icono de ubicación y mantenemos solo el texto -->
                        {{ $brewery->location }}
                    </span>
                </p>
            </div>
            
            <div class="absolute top-4 right-4">
                @auth
                    <form action="{{ route('brewery_favorites.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="brewery_id" value="{{ $brewery->id }}">
                        <button type="submit" class="bg-[#2E2E2E] p-3 rounded-full hover:bg-[#4A4A4A] transition-all shadow-lg">
                            @if(Auth::user()->favoritedBreweries->contains($brewery->id))
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FFD700]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            @endif
                        </button>
                    </form>
                @endauth
            </div>
        </div>
        
        <div class="p-8">
            <!-- Datos de la cervecería -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-semibold text-[#FFD700] mb-4">
                        Sobre la cervecería
                    </h2>
                    <p class="text-gray-300 mb-6 leading-relaxed">{{ $brewery->description }}</p>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-[#3A3A3A] p-4 rounded-lg text-center transform hover:scale-105 transition-all shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-[#FFD700] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span class="text-gray-400 text-sm">Fundación</span>
                            <p class="text-white font-bold">{{ $brewery->founded_year }}</p>
                        </div>
                        
                        <div class="bg-[#3A3A3A] p-4 rounded-lg text-center transform hover:scale-105 transition-all shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-[#FFD700] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span class="text-gray-400 text-sm">Total de cervezas</span>
                            <p class="text-white font-bold">{{ $brewery->beers->count() }}</p>
                        </div>
                        
                        <div class="bg-[#3A3A3A] p-4 rounded-lg text-center transform hover:scale-105 transition-all shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-[#FFD700] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c-1.657 0-3-4.03-3-9s1.343-9 3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <span class="text-gray-400 text-sm">Web</span>
                            <a href="{{ $brewery->website }}" target="_blank" class="text-[#FFD700] font-bold truncate block hover:underline">Visitar</a>
                        </div>
                        
                        <div class="bg-[#3A3A3A] p-4 rounded-lg text-center transform hover:scale-105 transition-all shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mx-auto text-[#FFD700] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                            </svg>
                            <span class="text-gray-400 text-sm">Visitable</span>
                            <p class="text-white font-bold">{{ $brewery->visitable ? 'Sí' : 'No' }}</p>
                        </div>
                    </div>
                    
                    @if(auth()->check() && (auth()->user()->id === $brewery->user_id || auth()->user()->role === 'admin'))
                        <div class="mt-4 flex space-x-4">
                            <a href="{{ route('breweries.edit', $brewery) }}" class="bg-[#4A4A4A] hover:bg-[#5A5A5A] text-white py-2 px-4 rounded-lg shadow-md transition-all flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                                Editar
                            </a>
                            <a href="{{ route('brewery.beers.index', $brewery) }}" class="bg-[#FFD700] hover:bg-amber-500 text-[#2E2E2E] font-semibold py-2 px-4 rounded-lg shadow-md transition-all flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                </svg>
                                Gestionar Cervezas
                            </a>
                        </div>
                    @endif

                    @auth
                        @if(!auth()->user()->is_admin && !auth()->user()->is_company)
                            <div class="mt-6">
                                <a href="{{ route('breweries.review.create', $brewery->id) }}" 
                                   class="inline-flex items-center bg-[#FFD700] text-[#1A1A1A] px-4 py-2 rounded-lg hover:bg-amber-500 transition-all font-medium shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Escribir reseña
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
                
                <div>
                    <h2 class="text-2xl font-semibold text-[#FFD700] mb-4">
                        Ubicación
                    </h2>
                    
                    @if($brewery->latitude && $brewery->longitude)
                        <div id="brewery-map" class="h-72 rounded-xl shadow-2xl mb-6 border-2 border-[#444] overflow-hidden transform hover:scale-[1.02] transition-all duration-300"></div>
                        <div class="flex items-center bg-[#3A3A3A] p-4 rounded-xl mb-2 shadow-md">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FFD700] mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <p class="text-gray-300">{{ $brewery->address }}</p>
                        </div>
                        
                        @if($brewery->visitable)
                            <div class="inline-flex items-center bg-[#FFD700] text-[#2E2E2E] px-4 py-2 rounded-lg font-medium shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Se puede visitar
                            </div>
                        @endif
                    @else
                        <div class="bg-[#3A3A3A] rounded-xl p-6 text-center h-72 flex items-center justify-center shadow-xl">
                            <div class="text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                </svg>
                                <p class="text-gray-400 text-lg">No hay ubicación disponible para esta cervecería</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Cervezas de esta cervecería -->
            <div class="mt-12" data-aos="fade-up">
                <h2 class="text-2xl font-semibold text-[#FFD700] mb-6">
                    Cervezas de {{ $brewery->name }}
                </h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse ($brewery->beers as $beer)
                        <div class="bg-[#3A3A3A] rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-transform duration-300 hover:scale-105" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                            <div class="h-40 bg-gray-700 relative">
                                @if($beer->image)
                                    <img src="{{ asset('storage/' . $beer->image) }}" alt="{{ $beer->name }}" class="w-full h-full object-cover">
                                    <div class="absolute top-0 right-0 bg-[#FFD700] text-[#2E2E2E] px-3 py-1 m-2 rounded-lg text-sm font-bold">
                                        {{ $beer->abv }}% ABV
                                    </div>
                                @else
                                    <div class="flex items-center justify-center h-full">
                                        <span class="text-gray-500">Sin imagen</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-[#FFD700] mb-1">{{ $beer->name }}</h3>
                                <p class="text-sm text-gray-400 mb-2">{{ $beer->category->name }}</p>
                                
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-400 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M3 12h18m-18 0a3 3 0 01-3-3V7a3 3 0 013-3h18a3 3 0 013 3v2a3 3 0 01-3 3m-18 0v6a3 3 0 003 3h12a3 3 0 003-3v-6" />
                                        </svg>
                                        ABV: {{ $beer->abv }}%
                                    </span>
                                    <span class="text-gray-400 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-amber-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                                        </svg>
                                        IBU: {{ $beer->ibu }}
                                    </span>
                                </div>
                                
                                <a href="{{ route('beers.show', $beer->id) }}" class="mt-4 inline-block w-full text-center bg-[#4A4A4A] hover:bg-[#555555] text-white py-2 px-3 rounded-lg text-sm transition-colors shadow-md">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-[#3A3A3A] rounded-lg p-6 text-center shadow-lg" data-aos="fade-up">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>
                            <p class="text-gray-400 text-lg">Esta cervecería aún no tiene cervezas registradas.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Sección para mostrar las reseñas existentes -->
            <div class="mt-16" data-aos="fade-up">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-[#FFD700]">
                        Reseñas
                    </h2>
                    
                    @auth
                        @if(!auth()->user()->is_admin && !auth()->user()->is_company)
                            <a href="{{ route('breweries.review.create', $brewery->id) }}" 
                               class="inline-flex items-center bg-[#FFD700] text-[#1A1A1A] px-4 py-2 rounded-lg hover:bg-amber-500 transition-all font-medium shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 13V5a2 2 0 00-2-2H4a2 2 0 00-2 2v8a2 2 0 002 2h3l3 3 3-3h3a2 2 0 002-2zM5 7a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 3a1 1 0 100 2h3a1 1 0 100-2H6z" clip-rule="evenodd" />
                                </svg>
                                Escribir reseña
                            </a>
                        @endif
                    @endauth
                </div>
                
                @if($brewery->reviews->count() > 0)
                    <div class="space-y-4">
                        @foreach($brewery->reviews->sortByDesc('created_at') as $review)
                            <div class="bg-[#2E2E2E] rounded-lg p-5 shadow-lg transform hover:scale-[1.01] transition-all duration-300" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="flex items-center mb-2">
                                            <span class="font-semibold text-white text-lg">{{ $review->user->name }}</span>
                                            <span class="ml-3 text-gray-400 text-sm">· {{ $review->created_at->format('d/m/Y') }}</span>
                                        </div>
                                        
                                        <div class="flex items-center mt-1 mb-3">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $review->rating)
                                                    <svg class="w-5 h-5 text-[#FFD700]" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @else
                                                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                    </svg>
                                                @endif
                                            @endfor
                                        </div>
                                        
                                        <p class="text-white text-base">{{ $review->comment ?: 'Sin comentario.' }}</p>
                                    </div>
                                    
                                    @auth
                                        @if(auth()->id() === $review->user_id)
                                            <div class="flex space-x-2">
                                                <a href="{{ route('reviews.edit', $review->id) }}" class="text-blue-400 hover:text-blue-300 bg-[#2A2A2A] p-2 rounded-full shadow-md transition-colors">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                    </svg>
                                                </a>
                                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-400 hover:text-red-300 bg-[#2A2A2A] p-2 rounded-full shadow-md transition-colors" 
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
                    <div class="bg-[#3A3A3A] rounded-lg p-8 text-center shadow-lg" data-aos="fade-up">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <p class="text-gray-400 text-lg">No hay reseñas todavía. ¡Sé el primero en dejar una!</p>
                        
                        @auth
                            @if(!auth()->user()->is_admin && !auth()->user()->is_company)
                                <a href="{{ route('breweries.review.create', $brewery->id) }}" 
                                   class="inline-flex items-center mt-4 bg-[#FFD700] text-[#1A1A1A] px-6 py-3 rounded-lg hover:bg-amber-500 transition-all font-medium shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Escribir la primera reseña
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    <div class="mt-8 text-center" data-aos="fade-up">
        <a href="{{ route('breweries.index') }}" class="inline-flex items-center bg-[#3A3A3A] hover:bg-[#4A4A4A] text-white py-3 px-6 rounded-lg transition-colors shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Volver a cervecerías
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar animaciones
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true
        });
        
        // Inicializar mapa de la cervecería
        @if($brewery->latitude && $brewery->longitude)
            var breweryMap = L.map('brewery-map', {
                zoomControl: true,
                scrollWheelZoom: false
            }).setView([{{ $brewery->latitude }}, {{ $brewery->longitude }}], 15);
            
            // Usar un estilo de mapa con tonos grises intermedios
            L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                subdomains: 'abcd',
                maxZoom: 19
            }).addTo(breweryMap);
            
            // Crear un marcador simple como en la welcome
            var marker = L.marker([{{ $brewery->latitude }}, {{ $brewery->longitude }}])
                .addTo(breweryMap)
                .bindPopup("<b>{{ $brewery->name }}</b><br>{{ $brewery->address }}").openPopup();
        @else
            document.getElementById('brewery-map').innerHTML = '<div class="flex items-center justify-center h-full bg-[#3A3A3A]"><p class="text-gray-400">No hay ubicación disponible</p></div>';
        @endif
    });
</script>
@endpush
