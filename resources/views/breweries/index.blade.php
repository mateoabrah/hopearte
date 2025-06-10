
@extends('layouts.app')

@section('content')
<div class="py-8 bg-[#2E2E2E]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section - Reducido -->
        <div class="mb-6 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-[#FFD700] mb-3" data-aos="fade-up">Cervecerías Artesanales</h1>
            <p class="text-lg text-[#CCCCCC] mb-6" data-aos="fade-up" data-aos-delay="200">
                Explora las mejores cervecerías artesanales y descubre sus creaciones únicas
            </p>
        </div>
        
        <!-- Sistema de filtros idéntico al del banner -->
        <div class="bg-[#1A1A1A] rounded-lg shadow-lg p-4 mb-8" data-aos="fade-up" data-aos-delay="300">
            <div class="flex items-center justify-between mb-3">
                <h3 class="text-lg font-semibold text-[#FFD700] flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Cervecerías Disponibles <span class="ml-2 bg-[#FFD700] text-[#1A1A1A] text-xs px-2 py-0.5 rounded-full">{{ $breweries->total() }}</span>
                </h3>
                
                <a href="{{ route('breweries.index') }}" id="clear-filters-top" class="text-sm text-gray-400 hover:text-[#FFD700] flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Limpiar filtros
                </a>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <!-- Búsqueda por nombre -->
                <div class="relative">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" id="brewery-search" name="search" value="{{ request('search') }}" placeholder="Buscar cervecería..." 
                           class="w-full bg-[#2E2E2E] border border-[#4A4A4A] rounded text-[10px] sm:text-xs py-1.5 pl-7 pr-2 text-white focus:outline-none focus:border-[#FFD700]">
                </div>
                
                <!-- Filtro por ciudad -->
                <div>
                    <select id="city-filter" name="city" class="w-full bg-[#2E2E2E] border border-[#4A4A4A] rounded text-[10px] sm:text-xs py-1.5 px-2 text-white focus:outline-none focus:border-[#FFD700]">
                        <option value="">Todas las ciudades</option>
                        <option value="Barcelona" {{ request('city') == 'Barcelona' ? 'selected' : '' }}>Barcelona</option>
                        <option value="Madrid" {{ request('city') == 'Madrid' ? 'selected' : '' }}>Madrid</option>
                        <option value="Valencia" {{ request('city') == 'Valencia' ? 'selected' : '' }}>Valencia</option>
                        <option value="Sevilla" {{ request('city') == 'Sevilla' ? 'selected' : '' }}>Sevilla</option>
                        <option value="Bilbao" {{ request('city') == 'Bilbao' ? 'selected' : '' }}>Bilbao</option>
                    </select>
                </div>
                
                <!-- Filtro por visitable -->
                <div>
                    <select id="visitable-filter" name="visitable" class="w-full bg-[#2E2E2E] border border-[#4A4A4A] rounded text-[10px] sm:text-xs py-1.5 px-2 text-white focus:outline-none focus:border-[#FFD700]">
                        <option value="">Todas</option>
                        <option value="1" {{ request('visitable') == '1' ? 'selected' : '' }}>Visitables</option>
                        <option value="0" {{ request('visitable') == '0' ? 'selected' : '' }}>No visitables</option>
                    </select>
                </div>
                
                <!-- Filtro de ordenación -->
                <div class="flex gap-2">
                    <select id="order-by-filter" name="order_by" class="w-3/4 bg-[#2E2E2E] border border-[#4A4A4A] rounded text-[10px] sm:text-xs py-1.5 px-2 text-white focus:outline-none focus:border-[#FFD700]">
                        <option value="name" {{ request('order_by') == 'name' ? 'selected' : '' }}>Nombre</option>
                        <option value="founded_year" {{ request('order_by') == 'founded_year' ? 'selected' : '' }}>Año</option>
                        <option value="city" {{ request('order_by') == 'city' ? 'selected' : '' }}>Ciudad</option>
                        <option value="rating" {{ request('order_by') == 'rating' ? 'selected' : '' }}>Valoración</option>
                    </select>
                    
                    <select id="order-direction" name="order_direction" class="w-1/4 bg-[#2E2E2E] border border-[#4A4A4A] rounded text-[10px] sm:text-xs py-1.5 px-2 text-white focus:outline-none focus:border-[#FFD700]">
                        <option value="asc" {{ request('order_direction') == 'asc' ? 'selected' : '' }}>↑</option>
                        <option value="desc" {{ request('order_direction') == 'desc' ? 'selected' : '' }}>↓</option>
                    </select>
                </div>
            </div>
            
            <div class="flex items-center justify-between mt-3">
                <div class="text-[9px] sm:text-[10px] text-gray-400">
                    <span id="filter-count">{{ $breweries->total() }}</span> cervecerías disponibles
                </div>
                <button type="submit" id="apply-filters" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#1A1A1A] px-4 py-1.5 rounded-md text-xs font-medium transition-colors flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Aplicar Filtros
                </button>
            </div>
        </div>

        <!-- Brewery Grid - con el mismo estilo que Beer Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse ($breweries as $brewery)
                <div class="bg-[#3A3A3A] rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $loop->index * 50 }}">
                    
                    <!-- Imagen con botón de favorito superpuesto -->
                    <div class="relative">
                        <a href="{{ route('breweries.show', $brewery) }}">
                            <img src="{{ asset('storage/' . $brewery->image) }}" 
                                alt="{{ $brewery->name }}" 
                                class="w-full h-40 object-cover">
                        </a>
                        
                        <!-- Botón de favoritos -->
                        <div class="absolute top-3 right-3">
                            @auth
                                <form action="{{ route('brewery_favorites.toggle') }}" method="POST" class="brewery-favorite-form">
                                    @csrf
                                    <input type="hidden" name="brewery_id" value="{{ $brewery->id }}">
                                    <button type="submit" class="bg-[#2E2E2E] p-2 rounded-full hover:bg-[#4A4A4A] transition-all focus:outline-none">
                                        @if(Auth::user()->favoritedBreweries->contains($brewery->id))
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#DC2626]" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-300 hover:text-[#DC2626]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        @endif
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="bg-[#2E2E2E] p-2 rounded-full hover:bg-[#4A4A4A] transition-all block">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-300 hover:text-[#DC2626]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </a>
                            @endauth
                        </div>
                    </div>
                    
                    <!-- Información de la cervecería -->
                    <a href="{{ route('breweries.show', $brewery) }}">
                        <div class="p-3">
                            <div class="flex justify-between items-start mb-1.5">
                                <h3 class="text-lg font-bold text-[#FFD700] truncate">{{ $brewery->name }}</h3>
                                <span class="bg-[#2E2E2E] text-[#CCCCCC] text-xs px-2 py-0.5 rounded-full">
                                    {{ $brewery->founded_year }}
                                </span>
                            </div>
                            
                            <p class="text-[#CCCCCC] text-xs mb-2 line-clamp-2">{{ $brewery->description }}</p>
                            
                            <div class="flex justify-between items-center mt-1.5">
                                <span class="text-xs text-white bg-[#2E2E2E] px-1.5 py-0.5 rounded">{{ $brewery->city ?? $brewery->location }}</span>
                                
                                <span class="text-xs text-white">
                                    {{ $brewery->beers ? $brewery->beers->count() : 0 }} cervezas
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-8" id="no-results">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 14h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-gray-400 text-lg">No se encontraron cervecerías que coincidan con tu búsqueda.</p>
                    <a href="{{ route('breweries.index') }}" id="reset-search" class="mt-3 inline-block px-4 py-1.5 bg-[#FFD700] text-[#2E2E2E] rounded-md hover:bg-[#FFA500] transition duration-300 text-sm">
                        Ver todas las cervecerías
                    </a>
                </div>
            @endforelse
        </div>
        
        <!-- Paginación personalizada y mejorada -->
        <div class="mt-10 mb-6" data-aos="fade-up">
            @if($breweries->hasPages())
                <div class="flex flex-col items-center">
                    <!-- Información de paginación -->
                    <div class="text-sm text-white mb-4">
                        Mostrando {{ $breweries->firstItem() }} a {{ $breweries->lastItem() }} de {{ $breweries->total() }} resultados
                    </div>
                    
                    <!-- Controles de paginación -->
                    <div class="inline-flex rounded-md shadow-lg bg-[#2A2A2A] border border-[#444]">
                        <!-- Botón anterior -->
                        @if($breweries->onFirstPage())
                            <span class="px-4 py-2 text-gray-500 border-r border-[#444] cursor-not-allowed">
                                &laquo;
                            </span>
                        @else
                            <a href="{{ $breweries->previousPageUrl() }}" 
                               class="px-4 py-2 text-white hover:text-[#FFD700] border-r border-[#444] transition-colors">
                                &laquo;
                            </a>
                        @endif
                        
                        <!-- Números de página -->
                        @php
                            $currentPage = $breweries->currentPage();
                            $lastPage = $breweries->lastPage();
                            
                            // Determinar el rango de páginas a mostrar
                            $range = 2; // Mostrar 2 páginas a cada lado
                            $start = max($currentPage - $range, 1);
                            $end = min($currentPage + $range, $lastPage);
                            
                            // Asegurar que siempre mostramos 5 páginas si hay suficientes
                            if ($end - $start < 4 && $lastPage > 5) {
                                if ($currentPage < 3) {
                                    $end = min(5, $lastPage);
                                } elseif ($currentPage > $lastPage - 2) {
                                    $start = max($lastPage - 4, 1);
                                }
                            }
                        @endphp
                        
                        @if($start > 1)
                            <a href="{{ $breweries->url(1) }}" class="hidden sm:block px-4 py-2 text-white hover:text-[#FFD700] border-r border-[#444] transition-colors">
                                1
                            </a>
                            @if($start > 2)
                                <span class="hidden sm:block px-3 py-2 text-gray-400 border-r border-[#444]">...</span>
                            @endif
                        @endif
                        
                        @for($i = $start; $i <= $end; $i++)
                            @if($i == $currentPage)
                                <span class="px-4 py-2 bg-[#FFD700] text-[#1A1A1A] font-medium border-r border-[#444]">
                                    {{ $i }}
                                </span>
                            @else
                                <a href="{{ $breweries->url($i) }}" 
                                   class="hidden sm:block px-4 py-2 text-white hover:text-[#FFD700] border-r border-[#444] transition-colors">
                                    {{ $i }}
                                </a>
                            @endif
                        @endfor
                        
                        <!-- Versión móvil simplificada -->
                        <span class="sm:hidden px-4 py-2 text-white border-r border-[#444]">
                            {{ $currentPage }} / {{ $lastPage }}
                        </span>
                        
                        @if($end < $lastPage)
                            @if($end < $lastPage - 1)
                                <span class="hidden sm:block px-3 py-2 text-gray-400 border-r border-[#444]">...</span>
                            @endif
                            <a href="{{ $breweries->url($lastPage) }}" 
                               class="hidden sm:block px-4 py-2 text-white hover:text-[#FFD700] border-r border-[#444] transition-colors">
                                {{ $lastPage }}
                            </a>
                        @endif
                        
                        <!-- Botón siguiente -->
                        @if($breweries->hasMorePages())
                            <a href="{{ $breweries->nextPageUrl() }}" 
                               class="px-4 py-2 text-white hover:text-[#FFD700] transition-colors">
                                &raquo;
                            </a>
                        @else
                            <span class="px-4 py-2 text-gray-500 cursor-not-allowed">
                                &raquo;
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </div>

        <!-- Mapa de ubicaciones - Conservado pero estilizado -->
        <div class="mt-10" data-aos="fade-up">
            <h2 class="text-xl font-bold text-[#FFD700] mb-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Ubicaciones de las cervecerías
            </h2>
            <div id="breweries-map" class="w-full h-80 rounded-lg shadow-lg"></div>
        </div>
    </div>
</div>

@push('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        /* Personalización del tema oscuro para Leaflet */
        .leaflet-tile-pane {
            filter: grayscale(90%) invert(100%) contrast(70%) hue-rotate(180deg) brightness(80%);
        }

        .leaflet-control-attribution {
            background: rgba(46, 46, 46, 0.8) !important;
            color: #ccc !important;
        }

        .leaflet-control-attribution a {
            color: #FFD700 !important;
        }

        .leaflet-control-zoom a {
            background-color: #333 !important;
            color: #fff !important;
            border-color: #555 !important;
        }

        .leaflet-control-zoom a:hover {
            background-color: #444 !important;
        }

        .brewery-popup .leaflet-popup-content-wrapper {
            background-color: #2E2E2E;
            color: #FFFFFF;
            border-radius: 8px;
        }

        .brewery-popup .leaflet-popup-tip {
            background-color: #2E2E2E;
        }

        .brewery-popup-content h4 {
            color: #FFD700;
            margin-bottom: 4px;
            font-weight: bold;
        }

        .brewery-popup-content p {
            margin: 2px 0;
            font-size: 0.9em;
        }

        .brewery-popup-content a {
            display: inline-block;
            background-color: #FFD700;
            color: #2E2E2E;
            padding: 4px 8px;
            border-radius: 4px;
            text-decoration: none;
            margin-top: 6px;
            font-weight: bold;
            transition: all 0.3s ease;
            font-size: 0.9em;
        }

        .brewery-popup-content a:hover {
            background-color: #FFA500;
        }
    </style>
@endpush

@push('scripts')
<!-- Leaflet JS para el mapa -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('brewery-search');
        const cityFilter = document.getElementById('city-filter');
        const visitableFilter = document.getElementById('visitable-filter');
        const orderByFilter = document.getElementById('order-by-filter');
        const orderDirection = document.getElementById('order-direction');
        const clearFiltersBtn = document.getElementById('clear-filters-top');
        const resetSearchBtn = document.getElementById('reset-search');
        const applyFiltersBtn = document.getElementById('apply-filters');
        
        // Función para aplicar filtros
        function applyFilters() {
            const url = new URL(window.location);
            
            // Actualizar parámetros de búsqueda
            if (searchInput.value) {
                url.searchParams.set('search', searchInput.value);
            } else {
                url.searchParams.delete('search');
            }
            
            // Actualizar filtros de ciudad
            if (cityFilter.value) {
                url.searchParams.set('city', cityFilter.value);
            } else {
                url.searchParams.delete('city');
            }
            
            // Actualizar filtros de visitable
            if (visitableFilter.value) {
                url.searchParams.set('visitable', visitableFilter.value);
            } else {
                url.searchParams.delete('visitable');
            }
            
            // Actualizar ordenación
            if (orderByFilter.value) {
                url.searchParams.set('order_by', orderByFilter.value);
            } else {
                url.searchParams.delete('order_by');
            }
            
            if (orderDirection.value) {
                url.searchParams.set('order_direction', orderDirection.value);
            } else {
                url.searchParams.delete('order_direction');
            }
            
            // Redirigir a la URL con los filtros aplicados
            window.location.href = url.toString();
        }
        
        // Función para limpiar los filtros
        function clearFilters() {
            window.location.href = "{{ route('breweries.index') }}";
        }
        
        // Eventos para los botones
        if (applyFiltersBtn) {
            applyFiltersBtn.addEventListener('click', applyFilters);
        }
        
        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', clearFilters);
        }
        
        if (resetSearchBtn) {
            resetSearchBtn.addEventListener('click', clearFilters);
        }
        
        // Añadir evento de tecla "Enter" para la búsqueda
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                applyFilters();
            }
        });
        
        // Inicializar el mapa de cervecerías
        var map = L.map('breweries-map').setView([40.4, 1.5], 6);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
        
        // Crear límites para ajustar el zoom automáticamente
        var bounds = L.latLngBounds();
        
        // Añadir puntos de anclaje para asegurar que Madrid, Cataluña y Baleares siempre sean visibles
        bounds.extend([40.4168, -3.7038]); // Madrid
        bounds.extend([41.3851, 2.1734]);  // Barcelona
        bounds.extend([39.5696, 2.6502]);  // Palma de Mallorca
        
        // Añadir marcadores para cada cervecería con popups mejorados
        @foreach($breweries as $brewery)
            @if($brewery->latitude && $brewery->longitude)
                var marker = L.marker([{{ $brewery->latitude }}, {{ $brewery->longitude }}]).addTo(map);
                
                var popupContent = `
                    <div class="brewery-popup-content">
                        <h4>{{ $brewery->name }}</h4>
                        <p><strong>Ciudad:</strong> {{ $brewery->city ?? $brewery->location }}</p>
                        @if($brewery->address)
                        <p><strong>Dirección:</strong> {{ $brewery->address }}</p>
                        @endif
                        @if($brewery->founded_year)
                        <p><strong>Fundada en:</strong> {{ $brewery->founded_year }}</p>
                        @endif
                        <a href="{{ route('breweries.show', $brewery->id) }}">Ver detalles</a>
                    </div>
                `;
                
                marker.bindPopup(popupContent, {
                    className: 'brewery-popup',
                    maxWidth: 280
                });
                
                // Extender los límites para incluir este marcador
                bounds.extend([{{ $brewery->latitude }}, {{ $brewery->longitude }}]);
            @endif
        @endforeach
        
        // Si hay cervecerías con coordenadas, ajustar el mapa a sus límites
        if (bounds.isValid()) {
            map.fitBounds(bounds, {
                padding: [40, 40],
                maxZoom: 7,
                minZoom: 6
            });
        } else {
            map.setView([40.4, 1.5], 6);
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestión de favoritos sin recargar la página completa
        const favoriteForms = document.querySelectorAll('.brewery-favorite-form');
        
        favoriteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(this);
                const button = this.querySelector('button');
                const svgContainer = button;
                
                // Efecto visual inmediato antes de la respuesta del servidor
                svgContainer.classList.add('animate-pulse');
                
                fetch(this.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                })
                .then(response => response.json())
                .then(data => {
                    // Actualizar el icono según la respuesta
                    svgContainer.innerHTML = data.isFavorited
                        ? '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#DC2626]" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" /></svg>'
                        : '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-300 hover:text-[#DC2626]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></path></svg>';
                    
                    // Mostrar una notificación temporal
                    const message = data.isFavorited ? 'Cervecería añadida a favoritos' : 'Cervecería eliminada de favoritos';
                    showNotification(message);
                })
                .catch(error => {
                    console.error('Error:', error);
                    showNotification('Error al actualizar favoritos', 'error');
                })
                .finally(() => {
                    svgContainer.classList.remove('animate-pulse');
                });
            });
        });
        
        // Función para mostrar notificaciones temporales
        function showNotification(message, type = 'success') {
            // Crear elemento de notificación
            const notification = document.createElement('div');
            notification.className = `fixed bottom-4 right-4 px-4 py-2 rounded-md text-sm text-white transform transition-all duration-500 opacity-0 translate-y-2 ${type === 'success' ? 'bg-[#4CAF50]' : 'bg-[#F44336]'}`;
            notification.textContent = message;
            document.body.appendChild(notification);
            
            // Mostrar notificación con animación
            setTimeout(() => {
                notification.classList.remove('opacity-0', 'translate-y-2');
                notification.classList.add('opacity-100', 'translate-y-0');
            }, 10);
            
            // Ocultar después de 3 segundos
            setTimeout(() => {
                notification.classList.add('opacity-0', 'translate-y-2');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 500);
            }, 3000);
        }
    });
</script>
@endpush
@endsection