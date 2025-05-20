@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header de la página -->
    <div class="bg-gradient-to-r from-[#3A3A3A] to-[#2E2E2E] p-8 rounded-lg shadow-xl mb-10">
        <h1 class="text-4xl font-bold text-[#FFD700] mb-4">Cervecerías</h1>
        <p class="text-xl text-gray-300">Explora las mejores cervecerías artesanales y descubre sus creaciones únicas.</p>
        
        <!-- Barra de búsqueda -->
        <div class="mt-6">
            <form action="{{ route('breweries.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <input type="text" name="search" placeholder="Buscar cervecerías..." value="{{ request('search') }}" 
                    class="flex-grow bg-[#4A4A4A] text-white rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#FFD700]">
                
                <button type="submit" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] px-6 py-2 rounded-md font-semibold transition-colors">
                    Buscar
                </button>
            </form>
        </div>
    </div>
    
    <!-- Filtros -->
    <div class="bg-[#3A3A3A] p-6 rounded-lg shadow-lg mb-10">
        <h3 class="text-xl font-semibold text-[#FFD700] mb-4">Filtrar por ubicación</h3>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <a href="{{ route('breweries.index') }}" class="bg-[#4A4A4A] hover:bg-[#555555] text-center text-white py-2 px-4 rounded transition-colors {{ !request('location') ? 'border-2 border-[#FFD700]' : '' }}">
                Todas
            </a>
            <a href="{{ route('breweries.index', ['location' => 'Barcelona']) }}" class="bg-[#4A4A4A] hover:bg-[#555555] text-center text-white py-2 px-4 rounded transition-colors {{ request('location') == 'Barcelona' ? 'border-2 border-[#FFD700]' : '' }}">
                Barcelona
            </a>
            <a href="{{ route('breweries.index', ['location' => 'Madrid']) }}" class="bg-[#4A4A4A] hover:bg-[#555555] text-center text-white py-2 px-4 rounded transition-colors {{ request('location') == 'Madrid' ? 'border-2 border-[#FFD700]' : '' }}">
                Madrid
            </a>
            <a href="{{ route('breweries.index', ['location' => 'Valencia']) }}" class="bg-[#4A4A4A] hover:bg-[#555555] text-center text-white py-2 px-4 rounded transition-colors {{ request('location') == 'Valencia' ? 'border-2 border-[#FFD700]' : '' }}">
                Valencia
            </a>
        </div>
    </div>

    <!-- Lista de cervecerías -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse ($breweries as $brewery)
            <div class="bg-[#3A3A3A] rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105" data-aos="fade-up">
                <div class="relative h-48">                    <img src="{{ asset('storage/' . $brewery->image) }}" alt="{{ $brewery->name }}" class="w-full h-full object-cover">
                    
                    <div class="absolute top-4 right-4">
                        @auth
                            <form action="{{ route('brewery_favorites.toggle') }}" method="POST">
                                @csrf
                                <input type="hidden" name="brewery_id" value="{{ $brewery->id }}">
                                <button type="submit" class="bg-[#2E2E2E] p-2 rounded-full hover:bg-[#4A4A4A] transition-all">
                                    @if(Auth::user()->favoritedBreweries->contains($brewery->id))
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FFD700]" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                        </svg>
                                    @endif
                                </button>
                            </form>
                        @endauth
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-semibold text-[#FFD700] mb-2">{{ $brewery->name }}</h3>
                            <p class="text-gray-400 text-sm mb-2">{{ $brewery->location }}</p>
                        </div>
                    </div>
                    
                    <p class="text-gray-300 mb-4 line-clamp-3">{{ $brewery->description }}</p>
                    
                    <div class="flex items-center text-sm text-gray-400 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-[#FFD700]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>{{ $brewery->founded_year }} - {{ $brewery->beers ? $brewery->beers->count() : 0 }} cervezas</span>
                    </div>
                    
                    <a href="{{ route('breweries.show', $brewery->id) }}" class="inline-block bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] py-2 px-4 rounded font-medium transition-colors">
                        Ver detalles
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-[#2E2E2E] rounded-lg p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 14h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="text-xl text-gray-400">No se encontraron cervecerías</h3>
                <p class="text-gray-500 mt-2">Intenta con otra búsqueda o elimina los filtros aplicados.</p>
            </div>
        @endforelse
    </div>

    <!-- Paginación -->
    <div class="mt-10">
        {{ $breweries->links() }}
    </div>

    <!-- Mapa de ubicaciones -->
    <div class="mt-16">
        <h2 class="text-2xl font-bold text-[#FFD700] mb-6">Ubicaciones de nuestras cervecerías</h2>
        <div id="breweries-map" class="w-full h-96 rounded-lg shadow-xl"></div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Leaflet JS para el mapa -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- AOS (Animate On Scroll) -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>

<script>
    // Inicializar AOS
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true
        });
        
        // Inicializar el mapa de cervecerías
        var map = L.map('breweries-map').setView([40.4168, -3.7038], 6); // Centrado en España
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Añadir marcadores para cada cervecería
        @foreach($breweries as $brewery)
            @if($brewery->latitude && $brewery->longitude)
                L.marker([{{ $brewery->latitude }}, {{ $brewery->longitude }}])
                    .addTo(map)
                    .bindPopup("<b>{{ $brewery->name }}</b><br>{{ $brewery->location }}<br><a href='{{ route('breweries.show', $brewery->id) }}'>Ver detalles</a>");
            @endif
        @endforeach
    });
</script>
@endpush
