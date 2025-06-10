@extends('layouts.admin')

@section('header', 'Gestión del Banner')

@section('content')
<div class="bg-[#3A3A3A] p-2 sm:p-3 rounded-lg shadow-lg w-full">
    <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-3 gap-2">
        <div>
            <h1 class="text-lg sm:text-xl font-bold text-[#FFD700]">Gestión de Cervezas en el Banner</h1>
            <p class="text-gray-300 text-[10px] sm:text-xs">Arrastra para organizar o usa los botones para añadir/quitar cervezas</p>
        </div>
        <div class="bg-[#2E2E2E] rounded-lg px-2 sm:px-3 py-1 sm:py-1.5 self-start">
            <span class="text-[#FFD700] text-xs sm:text-sm font-medium">{{ $featuredBeers->count() }}</span>
            <span class="text-gray-400 text-xs sm:text-sm"> cervezas en el banner</span>
        </div>
    </div>
    
    @if(session('success'))
        <div class="bg-green-600 bg-opacity-90 text-white p-2 mb-3 rounded-md text-[10px] sm:text-xs flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-600 bg-opacity-90 text-white p-2 mb-3 rounded-md text-[10px] sm:text-xs flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
            {{ session('error') }}
        </div>
    @endif
    
    <!-- Contenedor flexible para las dos secciones principales -->
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-3">
        <!-- Sección 1: Banner Activo (a la izquierda en pantallas grandes) -->
        <div class="lg:col-span-2">
            <div class="bg-[#2E2E2E] p-2 sm:p-2.5 rounded-lg border border-[#4A4A4A] h-full">
                <h2 class="text-sm sm:text-base font-semibold mb-2 text-[#FFD700] border-b border-[#4A4A4A] pb-1.5 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 sm:h-4 w-3.5 sm:w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a1 1 0 0 1-1-1V8a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1M5 12a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h14a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1"/>
                    </svg>
                    Banner Activo 
                    <span class="ml-2 px-1.5 py-0.5 bg-[#1A1A1A] rounded-full text-[9px] sm:text-xs text-white">{{ $featuredBeers->count() }}</span>
                </h2>
                
                @if($featuredBeers->isEmpty())
                    <div class="bg-[#1A1A1A] border border-dashed border-[#4A4A4A] rounded-lg p-3 sm:p-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 sm:h-8 w-6 sm:w-8 mx-auto text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <p class="text-gray-400 text-xs sm:text-sm">No hay cervezas destacadas en el banner.</p>
                        <p class="text-gray-500 text-[9px] sm:text-xs mt-1">Usa la sección de la derecha para añadir cervezas.</p>
                    </div>
                @else
                    <!-- Vista ajustada para formato vertical en pantallas grandes -->
                    <div class="flex flex-col lg:h-[calc(100%-40px)] overflow-hidden">
                        <!-- Vista previa del banner -->
                        <div class="bg-[#1A1A1A] rounded-lg p-2 mb-3 relative overflow-hidden">
                            <div class="relative h-28 sm:h-32 rounded-lg overflow-hidden">
                                <!-- Fondo del banner -->
                                <div class="absolute inset-0 bg-gradient-to-r from-amber-900 to-amber-800 opacity-60"></div>
                                
                                <!-- Contenido del banner -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="flex justify-center items-center space-x-2">
                                        @foreach($featuredBeers->take(5) as $beer)
                                            <div class="relative w-10 sm:w-12 h-16 sm:h-20 rounded overflow-hidden bg-[#2E2E2E] shadow-lg">
                                                @if($beer->image)
                                                    <img src="{{ asset('storage/' . $beer->image) }}" class="w-full h-full object-cover" alt="{{ $beer->name }}">
                                                @else
                                                    <div class="w-full h-full bg-[#4A4A4A] flex items-center justify-center">
                                                        <i class="fas fa-beer text-amber-300"></i>
                                                    </div>
                                                @endif
                                                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-70 px-1 py-0.5 text-[7px] text-white text-center truncate">
                                                    {{ $beer->name }}
                                                </div>
                                            </div>
                                        @endforeach
                                        
                                        @if($featuredBeers->count() > 5)
                                            <div class="relative w-10 sm:w-12 h-16 sm:h-20 rounded overflow-hidden bg-[#2E2E2E] shadow-lg flex items-center justify-center">
                                                <span class="text-[#FFD700] text-xs sm:text-sm font-bold">+{{ $featuredBeers->count() - 5 }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <!-- Overlay de texto -->
                                <div class="absolute bottom-0 left-0 right-0 px-3 py-1.5 bg-black bg-opacity-50">
                                    <h3 class="text-white text-xs sm:text-sm font-bold">Cervezas destacadas</h3>
                                    <p class="text-gray-200 text-[8px] sm:text-[9px]">Así se verá en la página principal</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Lista de cervezas en el banner con opciones de arrastrar -->
                        <div class="flex-grow overflow-y-auto" style="max-height: 500px;">
                            <p class="text-[9px] sm:text-[10px] text-center text-gray-400 mb-2">
                                <i class="fas fa-arrows-alt-v mr-0.5"></i> Arrastra las cervezas para cambiar su orden
                            </p>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 xl:grid-cols-2 gap-2" id="banner-preview">
                                @foreach($featuredBeers as $index => $beer)
                                    <div data-id="{{ $beer->id }}" class="bg-[#1A1A1A] p-1.5 sm:p-2 rounded-lg relative group flex">
                                        <div class="absolute -top-1 -left-1 z-10 bg-[#333] text-[9px] sm:text-xs px-1.5 py-0.5 rounded-full text-gray-400">
                                            #{{ $index + 1 }}
                                        </div>
                                        <div class="cursor-move handle text-center text-gray-500 flex items-center justify-center mr-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
                                            </svg>
                                        </div>
                                        <div class="w-12 h-16 sm:w-14 sm:h-20 flex-shrink-0">
                                            @if($beer->image)
                                                <img src="{{ asset('storage/' . $beer->image) }}" class="w-full h-full object-cover rounded" alt="{{ $beer->name }}">
                                            @else
                                                <div class="w-full h-full bg-[#4A4A4A] rounded flex items-center justify-center text-gray-500">
                                                    <i class="fas fa-beer text-sm"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-2 flex-grow min-w-0">
                                            <h3 class="font-medium text-[10px] sm:text-xs truncate">{{ $beer->name }}</h3>
                                            <p class="text-[8px] sm:text-[10px] text-gray-400 truncate">{{ $beer->brewery->name }}</p>
                                            <p class="text-[8px] sm:text-[10px] text-gray-400 truncate">{{ $beer->category->name }}</p>
                                            <div class="flex gap-1 text-[7px] sm:text-[8px] text-gray-400 mt-0.5">
                                                <span title="Grados de alcohol">{{ $beer->abv }}% ABV</span>
                                                <span>|</span>
                                                <span title="Amargor">{{ $beer->ibu }} IBU</span>
                                            </div>
                                            <form action="{{ route('admin.banner.toggle', $beer) }}" method="POST" class="mt-1">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-red-500 hover:text-red-400 bg-[#1A1A1A] hover:bg-[#222] border border-red-500 px-1.5 py-0.5 rounded text-[8px] sm:text-[10px] opacity-90 group-hover:opacity-100 w-full">
                                                    <i class="fas fa-times mr-0.5"></i> Quitar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Sección 2: Cervezas Disponibles (a la derecha en pantallas grandes) -->
        <div class="lg:col-span-3">
            <div class="bg-[#2E2E2E] p-2 sm:p-2.5 rounded-lg h-full">
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center mb-2">
                    <h2 class="text-sm sm:text-base font-semibold text-[#FFD700] flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 sm:h-4 w-3.5 sm:w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Cervezas Disponibles
                        <span class="ml-2 px-1.5 py-0.5 bg-[#1A1A1A] rounded-full text-[9px] sm:text-xs text-white">{{ $availableBeers->count() }}</span>
                    </h2>
                    
                    <!-- Acciones rápidas en pantallas medianas y grandes -->
                    <div class="hidden sm:flex items-center space-x-2 mt-2 sm:mt-0">
                        <button id="clear-filters-top" class="text-[10px] text-gray-300 hover:text-[#FFD700] flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Limpiar filtros
                        </button>
                    </div>
                </div>
                
                <!-- Barra de filtros optimizada para organización horizontal -->
                <div class="bg-[#1A1A1A] p-2 rounded-lg mb-3">
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-2 mb-2">
                        <!-- Búsqueda por texto -->
                        <div class="relative sm:col-span-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <input type="text" id="beer-search" placeholder="Buscar cerveza..." 
                                class="w-full bg-[#2E2E2E] border border-[#4A4A4A] rounded text-[10px] sm:text-xs py-1.5 pl-7 pr-2 text-white focus:outline-none focus:border-[#FFD700]">
                        </div>
                        
                        <!-- Filtros en línea -->
                        <div>
                            <select id="category-filter" class="w-full bg-[#2E2E2E] border border-[#4A4A4A] rounded text-[10px] sm:text-xs py-1.5 px-2 text-white focus:outline-none focus:border-[#FFD700]">
                                <option value="">Todas las categorías</option>
                                @php
                                    // Extraer categorías únicas y ordenarlas alfabéticamente por nombre
                                    $categoriesCollection = $availableBeers->pluck('category')->unique('id');
                                    $categories = $categoriesCollection->sortBy('name');
                                @endphp
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div>
                            <select id="brewery-filter" class="w-full bg-[#2E2E2E] border border-[#4A4A4A] rounded text-[10px] sm:text-xs py-1.5 px-2 text-white focus:outline-none focus:border-[#FFD700]">
                                <option value="">Todas las cervecerías</option>
                                @php
                                    // Extraer cervecerías únicas y ordenarlas alfabéticamente por nombre
                                    $breweriesCollection = $availableBeers->pluck('brewery')->unique('id');
                                    $breweries = $breweriesCollection->sortBy('name');
                                @endphp
                                @foreach($breweries as $brewery)
                                    <option value="{{ $brewery->id }}">{{ $brewery->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="flex gap-2">
                            <select id="abv-filter" class="w-1/2 bg-[#2E2E2E] border border-[#4A4A4A] rounded text-[10px] sm:text-xs py-1.5 px-2 text-white focus:outline-none focus:border-[#FFD700]">
                                <option value="">ABV</option>
                                <option value="light">< 4%</option>
                                <option value="medium">4-6%</option>
                                <option value="strong">6-8%</option>
                                <option value="very-strong">> 8%</option>
                            </select>
                            
                            <select id="ibu-filter" class="w-1/2 bg-[#2E2E2E] border border-[#4A4A4A] rounded text-[10px] sm:text-xs py-1.5 px-2 text-white focus:outline-none focus:border-[#FFD700]">
                                <option value="">IBU</option>
                                <option value="low">< 20</option>
                                <option value="medium">20-40</option>
                                <option value="high">40-60</option>
                                <option value="very-high">> 60</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div class="text-[9px] sm:text-[10px] text-gray-400">
                            <span id="filter-count">{{ $availableBeers->count() }}</span> cervezas disponibles
                        </div>
                        <button id="clear-filters" class="sm:hidden text-[9px] sm:text-[10px] text-[#FFD700] hover:underline flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-2 sm:h-2.5 w-2 sm:w-2.5 mr-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Limpiar filtros
                        </button>
                    </div>
                </div>
                
                @if($availableBeers->isEmpty())
                    <div class="bg-[#1A1A1A] border border-dashed border-[#4A4A4A] rounded-lg p-3 sm:p-4 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 sm:h-8 w-6 sm:w-8 mx-auto text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                        <p class="text-gray-400 text-xs sm:text-sm">No hay cervezas disponibles para añadir.</p>
                        <p class="text-gray-500 text-[9px] sm:text-xs mt-1">Todas las cervezas están en el banner o no hay cervezas creadas.</p>
                    </div>
                @else
                    <!-- Grid de cervezas con altura flexible para aprovechar el espacio vertical -->
                    <div id="available-beers-container" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 overflow-y-auto pr-1 scrollbar-thin scrollbar-thumb-[#4A4A4A]" style="max-height: 500px;">
                        @foreach($availableBeers as $beer)
                            <div class="beer-item bg-[#1A1A1A] p-1.5 sm:p-2 rounded-lg hover:bg-[#222] transition-all flex flex-col" 
                                 data-category="{{ $beer->category->id }}" 
                                 data-brewery="{{ $beer->brewery->id }}" 
                                 data-name="{{ $beer->name }}"
                                 data-abv="{{ $beer->abv }}"
                                 data-ibu="{{ $beer->ibu }}">
                                <div class="w-full h-16 sm:h-20 mb-1 relative">
                                    @if($beer->image)
                                        <img src="{{ asset('storage/' . $beer->image) }}" class="w-full h-full object-cover rounded" alt="{{ $beer->name }}">
                                    @else
                                        <div class="w-full h-full bg-[#4A4A4A] rounded flex items-center justify-center text-gray-500">
                                            <i class="fas fa-beer text-sm sm:text-base"></i>
                                        </div>
                                    @endif
                                    <!-- Indicadores de ABV e IBU -->
                                    <div class="absolute bottom-0 left-0 right-0 flex justify-between px-1 py-0.5 bg-black bg-opacity-60 text-[7px] sm:text-[8px] text-white rounded-b">
                                        <span title="Grados de alcohol">{{ $beer->abv }}% ABV</span>
                                        <span title="Amargor">{{ $beer->ibu }} IBU</span>
                                    </div>
                                </div>
                                <div class="beer-details flex-grow">
                                    <h3 class="font-medium text-[10px] sm:text-xs beer-name truncate">{{ $beer->name }}</h3>
                                    <p class="text-[8px] sm:text-[10px] text-gray-400 brewery-name truncate">{{ $beer->brewery->name }}</p>
                                    <p class="text-[8px] sm:text-[10px] text-gray-400 category-name truncate">{{ $beer->category->name }}</p>
                                </div>
                                <form action="{{ route('admin.banner.toggle', $beer) }}" method="POST" class="mt-1">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-green-500 hover:text-green-400 bg-[#1A1A1A] hover:bg-[#222] border border-green-500 px-1 sm:px-1.5 py-0.5 rounded text-[8px] sm:text-[10px] w-full hover:bg-opacity-30">
                                        <i class="fas fa-plus mr-0.5"></i> Añadir
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
                
                <div id="no-results" class="hidden bg-[#1A1A1A] border border-dashed border-[#4A4A4A] rounded-lg p-2 sm:p-3 text-center mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 sm:h-6 w-5 sm:w-6 mx-auto text-gray-500 mb-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                    </svg>
                    <p class="text-gray-400 text-[10px] sm:text-xs">No se encontraron resultados con los filtros aplicados.</p>
                    <button id="reset-search" class="text-[#FFD700] hover:underline text-[8px] sm:text-[10px] mt-1">Reiniciar búsqueda</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    @keyframes flash-update {
        0% { opacity: 0.6; }
        50% { opacity: 0.8; }
        100% { opacity: 1; }
    }
    
    .flash-update {
        animation: flash-update 0.5s ease-in-out;
    }

    /* Estilo para transiciones suaves */
    .fixed {
        transition: opacity 0.3s ease;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('beer-search');
        const categoryFilter = document.getElementById('category-filter');
        const breweryFilter = document.getElementById('brewery-filter');
        const abvFilter = document.getElementById('abv-filter');
        const ibuFilter = document.getElementById('ibu-filter');
        const clearFiltersBtn = document.getElementById('clear-filters');
        const clearFiltersTopBtn = document.getElementById('clear-filters-top');
        const resetSearchBtn = document.getElementById('reset-search');
        const beerItems = document.querySelectorAll('.beer-item');
        const noResultsMessage = document.getElementById('no-results');
        const filterCountElem = document.getElementById('filter-count');
        
        // Función para actualizar la vista previa del banner
        function updateBannerPreview() {
            const bannerPreviewContainer = document.querySelector('.flex.justify-center.items-center.space-x-2');
            if (!bannerPreviewContainer) return;
            
            // Obtener el orden actual de las cervezas en el banner
            const orderedBeers = [];
            document.querySelectorAll('#banner-preview > div').forEach(item => {
                const beerId = item.getAttribute('data-id');
                const beerName = item.querySelector('h3').textContent;
                const beerImage = item.querySelector('img') ? item.querySelector('img').src : null;
                
                orderedBeers.push({
                    id: beerId,
                    name: beerName,
                    image: beerImage
                });
            });
            
            // Limpiar el contenedor de la vista previa
            bannerPreviewContainer.innerHTML = '';
            
            // Añadir las primeras 5 cervezas en el nuevo orden
            const previewBeers = orderedBeers.slice(0, 5);
            previewBeers.forEach(beer => {
                const beerElement = document.createElement('div');
                beerElement.className = 'relative w-10 sm:w-12 h-16 sm:h-20 rounded overflow-hidden bg-[#2E2E2E] shadow-lg';
                
                if (beer.image) {
                    beerElement.innerHTML = `
                        <img src="${beer.image}" class="w-full h-full object-cover" alt="${beer.name}">
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-70 px-1 py-0.5 text-[7px] text-white text-center truncate">
                            ${beer.name}
                        </div>
                    `;
                } else {
                    beerElement.innerHTML = `
                        <div class="w-full h-full bg-[#4A4A4A] flex items-center justify-center">
                            <i class="fas fa-beer text-amber-300"></i>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-70 px-1 py-0.5 text-[7px] text-white text-center truncate">
                            ${beer.name}
                        </div>
                    `;
                }
                
                bannerPreviewContainer.appendChild(beerElement);
            });
            
            // Añadir indicador "+X" si hay más de 5 cervezas
            if (orderedBeers.length > 5) {
                const extraElement = document.createElement('div');
                extraElement.className = 'relative w-10 sm:w-12 h-16 sm:h-20 rounded overflow-hidden bg-[#2E2E2E] shadow-lg flex items-center justify-center';
                extraElement.innerHTML = `<span class="text-[#FFD700] text-xs sm:text-sm font-bold">+${orderedBeers.length - 5}</span>`;
                bannerPreviewContainer.appendChild(extraElement);
            }
            
            // Animar el contenedor para dar feedback visual
            bannerPreviewContainer.classList.add('flash-update');
            setTimeout(() => {
                bannerPreviewContainer.classList.remove('flash-update');
            }, 500);
        }
        
        // Inicializar Sortable para drag and drop
        if (document.getElementById('banner-preview')) {
            new Sortable(document.getElementById('banner-preview'), {
                handle: '.handle',
                animation: 150,
                ghostClass: 'bg-[#444]',
                onEnd: function(evt) {
                    // Actualizar los números de posición
                    const items = document.querySelectorAll('#banner-preview > div');
                    items.forEach((item, index) => {
                        const positionLabel = item.querySelector('.absolute');
                        if (positionLabel) {
                            positionLabel.textContent = '#' + (index + 1);
                        }
                    });
                    
                    // Actualizar la vista previa del banner
                    updateBannerPreview();
                    
                    // Guardar automáticamente el nuevo orden
                    const orderedIds = Array.from(items).map(item => item.getAttribute('data-id'));
                    
                    // Mostrar indicador de guardado sutil
                    const savingIndicator = document.createElement('div');
                    savingIndicator.className = 'fixed top-4 right-4 bg-blue-600 text-white px-3 py-1.5 rounded-md text-xs z-50 flex items-center';
                    savingIndicator.innerHTML = `
                        <svg class="animate-spin -ml-0.5 mr-2 h-3 w-3 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Guardando...
                    `;
                    document.body.appendChild(savingIndicator);
                    
                    fetch('/admin/banner/reorder', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ ids: orderedIds })
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Error en la respuesta del servidor');
                        }
                        return response.json();
                    })
                    .then(data => {
                        // Eliminar indicador de guardado
                        savingIndicator.remove();
                        
                        if (data.success) {
                            // Mostrar notificación de éxito breve
                            const successIndicator = document.createElement('div');
                            successIndicator.className = 'fixed top-4 right-4 bg-green-600 text-white px-3 py-1.5 rounded-md text-xs z-50 flex items-center';
                            successIndicator.innerHTML = `
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                Orden guardado
                            `;
                            document.body.appendChild(successIndicator);
                            
                            // Auto-eliminar después de 2 segundos
                            setTimeout(() => {
                                successIndicator.style.opacity = '0';
                                setTimeout(() => successIndicator.remove(), 300);
                            }, 2000);
                        }
                    })
                    .catch(error => {
                        // Eliminar indicador de guardado
                        savingIndicator.remove();
                        
                        // Mostrar error
                        const errorIndicator = document.createElement('div');
                        errorIndicator.className = 'fixed top-4 right-4 bg-red-600 text-white px-3 py-1.5 rounded-md text-xs z-50 flex items-center';
                        errorIndicator.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            Error al guardar
                        `;
                        document.body.appendChild(errorIndicator);
                        
                        // Auto-eliminar después de 3 segundos
                        setTimeout(() => {
                            errorIndicator.style.opacity = '0';
                            setTimeout(() => errorIndicator.remove(), 300);
                        }, 3000);
                        
                        console.error('Error al guardar el orden:', error);
                    });
                }
            });
        }
        
        // Función para aplicar filtros
        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedCategory = categoryFilter.value;
            const selectedBrewery = breweryFilter.value;
            const selectedAbv = abvFilter.value;
            const selectedIbu = ibuFilter.value;
            let visibleItems = 0;
            
            beerItems.forEach(item => {
                const beerName = item.getAttribute('data-name').toLowerCase();
                const categoryId = item.getAttribute('data-category');
                const breweryId = item.getAttribute('data-brewery');
                const abvValue = parseFloat(item.getAttribute('data-abv'));
                const ibuValue = parseFloat(item.getAttribute('data-ibu'));
                
                // Verificar si cumple con los filtros básicos
                const matchesSearch = !searchTerm || beerName.includes(searchTerm);
                const matchesCategory = !selectedCategory || categoryId === selectedCategory;
                const matchesBrewery = !selectedBrewery || breweryId === selectedBrewery;
                
                // Verificar si cumple con el filtro de ABV
                let matchesAbv = true;
                if (selectedAbv) {
                    switch(selectedAbv) {
                        case 'light':
                            matchesAbv = abvValue < 4;
                            break;
                        case 'medium':
                            matchesAbv = abvValue >= 4 && abvValue < 6;
                            break;
                        case 'strong':
                            matchesAbv = abvValue >= 6 && abvValue < 8;
                            break;
                        case 'very-strong':
                            matchesAbv = abvValue >= 8;
                            break;
                    }
                }
                
                // Verificar si cumple con el filtro de IBU
                let matchesIbu = true;
                if (selectedIbu) {
                    switch(selectedIbu) {
                        case 'low':
                            matchesIbu = ibuValue < 20;
                            break;
                        case 'medium':
                            matchesIbu = ibuValue >= 20 && ibuValue < 40;
                            break;
                        case 'high':
                            matchesIbu = ibuValue >= 40 && ibuValue < 60;
                            break;
                        case 'very-high':
                            matchesIbu = ibuValue >= 60;
                            break;
                    }
                }
                
                // Aplicar todos los filtros
                if (matchesSearch && matchesCategory && matchesBrewery && matchesAbv && matchesIbu) {
                    item.style.display = '';
                    visibleItems++;
                } else {
                    item.style.display = 'none';
                }
            });
            
            // Actualizar contador
            filterCountElem.textContent = visibleItems;
            
            // Mostrar mensaje si no hay resultados
            if (visibleItems === 0 && beerItems.length > 0) {
                noResultsMessage.classList.remove('hidden');
            } else {
                noResultsMessage.classList.add('hidden');
            }
        }
        
        // Función para limpiar los filtros
        function clearFilters() {
            searchInput.value = '';
            categoryFilter.value = '';
            breweryFilter.value = '';
            abvFilter.value = '';
            ibuFilter.value = '';
            applyFilters();
        }
        
        // Eventos para los filtros
        searchInput.addEventListener('input', applyFilters);
        categoryFilter.addEventListener('change', applyFilters);
        breweryFilter.addEventListener('change', applyFilters);
        abvFilter.addEventListener('change', applyFilters);
        ibuFilter.addEventListener('change', applyFilters);
        clearFiltersBtn.addEventListener('click', clearFilters);
        if (clearFiltersTopBtn) {
            clearFiltersTopBtn.addEventListener('click', clearFilters);
        }
        resetSearchBtn.addEventListener('click', clearFilters);
    });
</script>
@endpush