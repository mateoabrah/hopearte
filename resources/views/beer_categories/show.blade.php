
@extends('layouts.app')

@section('content')
<div class="py-8 bg-[#2E2E2E]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl md:text-4xl font-bold text-[#FFD700]" data-aos="fade-up">{{ $beerCategory->name }}</h1>
            <a href="{{ route('beer_categories.index') }}" class="text-[#FFD700] hover:text-amber-400 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                <span class="text-sm font-medium">Volver</span>
            </a>
        </div>
        
        @if($beerCategory->description)
            <div class="bg-[#1A1A1A] rounded-lg shadow-lg p-4 mb-6" data-aos="fade-up" data-aos-delay="100">
                <h2 class="text-lg font-semibold text-[#FFD700] mb-2">Sobre esta categoría</h2>
                <p class="text-[#CCCCCC]">{{ $beerCategory->description }}</p>
            </div>
        @endif
        
        <!-- Heading con contador -->
        <div class="flex items-center justify-between mb-6" data-aos="fade-up" data-aos-delay="200">
            <div class="flex items-center">
                <h2 class="text-xl font-semibold text-[#FFD700] flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                    </svg>
                    Cervezas disponibles
                    <span class="ml-2 bg-[#FFD700] text-[#1A1A1A] text-xs px-2 py-0.5 rounded-full">
                        {{ $beers->total() }}
                    </span>
                </h2>
            </div>
        </div>

        <!-- Beer Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($beers as $beer)
                <div class="beer-item bg-[#3A3A3A] rounded-lg overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 transform hover:scale-105" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $loop->index * 50 }}">
                    
                    <!-- Imagen con botón de favorito superpuesto -->
                    <div class="relative">
                        <a href="{{ route('beers.show', $beer) }}">
                            @if($beer->image)
                                <img src="{{ asset('storage/' . $beer->image) }}" 
                                    alt="{{ $beer->name }}" 
                                    class="w-full h-40 object-cover">
                            @else
                                <div class="w-full h-40 bg-[#2E2E2E] flex items-center justify-center">
                                    <span class="text-3xl text-[#FFD700]"><i class="fas fa-beer"></i></span>
                                </div>
                            @endif
                        </a>
                        
                        <!-- Botón de favoritos -->
                        <div class="absolute top-3 right-3">
                            @auth
                                <form action="{{ route('beer_favorites.toggle') }}" method="POST" class="beer-favorite-form">
                                    @csrf
                                    <input type="hidden" name="beer_id" value="{{ $beer->id }}">
                                    <button type="submit" class="bg-[#2E2E2E] p-2 rounded-full hover:bg-[#4A4A4A] transition-all focus:outline-none">
                                        @if(Auth::user()->favoritedBeers->contains($beer->id))
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
                    
                    <!-- Información de la cerveza -->
                    <a href="{{ route('beers.show', $beer->id) }}">
                        <div class="p-3">
                            <div class="flex justify-between items-start mb-1.5">
                                <h3 class="text-lg font-bold text-[#FFD700] truncate">{{ $beer->name }}</h3>
                                <span class="bg-[#2E2E2E] text-[#CCCCCC] text-xs px-2 py-0.5 rounded-full">{{ $beer->abv }}% ABV</span>
                            </div>
                            
                            <p class="text-[#CCCCCC] text-xs mb-2 line-clamp-2">{{ $beer->description ?: 'Cerveza de ' . $beerCategory->name }}</p>
                            
                            <div class="flex justify-between items-center mt-1.5">
                                <span class="text-xs text-white bg-[#2E2E2E] px-1.5 py-0.5 rounded">{{ $beer->category->name ?? 'Sin categoría' }}</span>
                                
                                <span class="text-xs text-white">
                                    @if($beer->brewery)
                                        {{ $beer->brewery->name }}
                                    @else
                                        Cervecería desconocida
                                    @endif
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-8" id="no-results">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-gray-500 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                    </svg>
                    <p class="text-gray-400 text-lg">No se encontraron cervezas en esta categoría.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Paginación personalizada y mejorada -->
        <div class="mt-10 mb-6" data-aos="fade-up">
            @if($beers->hasPages())
                <div class="flex flex-col items-center">
                    <!-- Información de paginación -->
                    <div class="text-sm text-white mb-4">
                        Mostrando {{ $beers->firstItem() }} a {{ $beers->lastItem() }} de {{ $beers->total() }} resultados
                    </div>
                    
                    <!-- Controles de paginación -->
                    <div class="inline-flex rounded-md shadow-lg bg-[#2A2A2A] border border-[#444]">
                        <!-- Botón anterior -->
                        @if($beers->onFirstPage())
                            <span class="px-4 py-2 text-gray-500 border-r border-[#444] cursor-not-allowed">
                                &laquo;
                            </span>
                        @else
                            <a href="{{ $beers->previousPageUrl() }}" 
                               class="px-4 py-2 text-white hover:text-[#FFD700] border-r border-[#444] transition-colors">
                                &laquo;
                            </a>
                        @endif
                        
                        <!-- Números de página -->
                        @php
                            $currentPage = $beers->currentPage();
                            $lastPage = $beers->lastPage();
                            
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
                            <a href="{{ $beers->url(1) }}" class="hidden sm:block px-4 py-2 text-white hover:text-[#FFD700] border-r border-[#444] transition-colors">
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
                                <a href="{{ $beers->url($i) }}" 
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
                            <a href="{{ $beers->url($lastPage) }}" 
                               class="hidden sm:block px-4 py-2 text-white hover:text-[#FFD700] border-r border-[#444] transition-colors">
                                {{ $lastPage }}
                            </a>
                        @endif
                        
                        <!-- Botón siguiente -->
                        @if($beers->hasMorePages())
                            <a href="{{ $beers->nextPageUrl() }}" 
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
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestión de favoritos sin recargar la página completa
        const favoriteForms = document.querySelectorAll('.beer-favorite-form');
        
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
                    const message = data.isFavorited ? 'Añadida a favoritos' : 'Eliminada de favoritos';
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