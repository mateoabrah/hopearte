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
                <p class="text-xl text-gray-300">{{ $brewery->location }}</p>
            </div>
            
            <div class="absolute top-4 right-4">
                @auth
                    <form action="{{ route('brewery_favorites.toggle') }}" method="POST">
                        @csrf
                        <input type="hidden" name="brewery_id" value="{{ $brewery->id }}">
                        <button type="submit" class="bg-[#2E2E2E] p-3 rounded-full hover:bg-[#4A4A4A] transition-all">
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
                    <h2 class="text-2xl font-semibold text-[#FFD700] mb-4">Sobre la cervecería</h2>
                    <p class="text-gray-300 mb-6">{{ $brewery->description }}</p>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-[#3A3A3A] p-4 rounded-lg text-center">
                            <span class="text-gray-400 text-sm">Fundación</span>
                            <p class="text-white font-bold">{{ $brewery->founded_year }}</p>
                        </div>
                        
                        <div class="bg-[#3A3A3A] p-4 rounded-lg text-center">
                            <span class="text-gray-400 text-sm">Total de cervezas</span>
                            <p class="text-white font-bold">{{ $brewery->beers->count() }}</p>
                        </div>
                        
                        <div class="bg-[#3A3A3A] p-4 rounded-lg text-center">
                            <span class="text-gray-400 text-sm">Web</span>
                            <a href="{{ $brewery->website }}" target="_blank" class="text-[#FFD700] font-bold truncate block hover:underline">Visitar</a>
                        </div>
                        
                        <div class="bg-[#3A3A3A] p-4 rounded-lg text-center">
                            <span class="text-gray-400 text-sm">Visitable</span>
                            <p class="text-white font-bold">{{ $brewery->visitable ? 'Sí' : 'No' }}</p>
                        </div>
                    </div>
                    
                    @if(auth()->check() && (auth()->user()->id === $brewery->user_id || auth()->user()->role === 'admin'))
                        <div class="mt-4 flex space-x-4">
                            <a href="{{ route('breweries.edit', $brewery) }}" class="bg-[#4A4A4A] hover:bg-[#5A5A5A] text-white py-2 px-4 rounded-md">
                                <i class="fas fa-edit mr-2"></i> Editar
                            </a>
                            <a href="{{ route('brewery.beers.index', $brewery) }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-2 px-4 rounded-md">
                                <i class="fas fa-beer mr-2"></i> Gestionar Cervezas
                            </a>
                        </div>
                    @endif

                    @auth
                        @if(!auth()->user()->is_admin && !auth()->user()->is_company)
                            <div class="mt-6">
                                <a href="{{ route('breweries.review.create', $brewery->id) }}" 
                                   class="inline-block bg-[#FFD700] text-[#1A1A1A] px-4 py-2 rounded-md hover:bg-yellow-400 transition font-medium">
                                    Escribir reseña
                                </a>
                            </div>
                        @endif
                    @endauth
                </div>
                
                <div>
                    <h2 class="text-2xl font-semibold text-[#FFD700] mb-4">Ubicación</h2>
                    <div id="brewery-map" class="h-64 rounded-lg shadow-lg mb-4"></div>
                    <p class="text-gray-300">{{ $brewery->address }}</p>
                </div>
            </div>
            
            <!-- Cervezas de esta cervecería -->
            <div class="mt-12">
                <h2 class="text-2xl font-semibold text-[#FFD700] mb-6">Cervezas de {{ $brewery->name }}</h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @forelse ($brewery->beers as $beer)
                        <div class="bg-[#3A3A3A] rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-transform duration-300 hover:scale-105">
                            <div class="h-40 bg-gray-700">
                                @if($beer->image)
                                    <img src="{{ asset('storage/' . $beer->image) }}" alt="{{ $beer->name }}" class="w-full h-full object-cover">
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
                                    <span class="text-gray-400">ABV: {{ $beer->abv }}%</span>
                                    <span class="text-gray-400">IBU: {{ $beer->ibu }}</span>
                                </div>
                                
                                <a href="{{ route('beers.show', $beer->id) }}" class="mt-4 inline-block bg-[#4A4A4A] hover:bg-[#555555] text-white py-1 px-3 rounded text-sm transition-colors">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-[#3A3A3A] rounded-lg p-6 text-center">
                            <p class="text-gray-400">Esta cervecería aún no tiene cervezas registradas.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Sección para mostrar las reseñas existentes -->
            <div class="mt-10">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-[#FFD700]">Reseñas</h2>
                    
                    @auth
                        @if(!auth()->user()->is_admin && !auth()->user()->is_company)
                            <a href="{{ route('breweries.review.create', $brewery->id) }}" 
                               class="bg-[#FFD700] text-[#1A1A1A] px-3 py-1 rounded-md hover:bg-yellow-400 transition font-medium text-sm">
                                Escribir reseña
                            </a>
                        @endif
                    @endauth
                </div>
                
                @if($brewery->reviews->count() > 0)
                    <div class="space-y-4">
                        @foreach($brewery->reviews as $review)
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
        </div>
    </div>
    
    <div class="mt-8 text-center">
        <a href="{{ route('breweries.index') }}" class="inline-block bg-[#3A3A3A] hover:bg-[#4A4A4A] text-white py-2 px-6 rounded transition-colors">
            Volver a cervecerías
        </a>
    </div>
</div>
@endsection

@push('scripts')
<!-- Leaflet JS para el mapa -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar mapa de la cervecería
        @if($brewery->latitude && $brewery->longitude)
            var breweryMap = L.map('brewery-map').setView([{{ $brewery->latitude }}, {{ $brewery->longitude }}], 14);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(breweryMap);
            
            L.marker([{{ $brewery->latitude }}, {{ $brewery->longitude }}])
                .addTo(breweryMap)
                .bindPopup("<b>{{ $brewery->name }}</b><br>{{ $brewery->address }}").openPopup();
        @else
            document.getElementById('brewery-map').innerHTML = '<div class="flex items-center justify-center h-full bg-gray-700"><p class="text-gray-400">No hay ubicación disponible</p></div>';
        @endif
    });
</script>
@endpush
