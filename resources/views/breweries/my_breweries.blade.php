@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-[#FFD700]">Mis Cervecerías</h1>
        <a href="{{ route('breweries.create') }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-1.5 px-4 rounded flex items-center text-sm">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Añadir cervecería
        </a>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 mb-4 text-sm" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    
    @if($breweries->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5" data-aos="fade-up">
            @foreach($breweries as $brewery)
                <div class="bg-[#2E2E2E] rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105">
                    <div class="h-36 bg-gray-700 overflow-hidden">
                        @if($brewery->image)
                            <img src="{{ asset('storage/' . $brewery->image) }}" alt="{{ $brewery->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="flex items-center justify-center h-full bg-gray-800">
                                <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 22V12h6v10"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h2 class="text-lg font-bold text-[#FFD700] mb-1.5">{{ $brewery->name }}</h2>
                        <p class="text-gray-300 text-sm mb-3">{{ $brewery->city ?? $brewery->location }}</p>
                        
                        <div class="flex items-center justify-between text-xs text-gray-400 mb-3">
                            <span class="flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $brewery->founded_year ?? 'N/A' }}
                            </span>
                            <span class="flex items-center">
                                <svg class="w-3.5 h-3.5 mr-1 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                                {{ $brewery->beers ? $brewery->beers->count() : 0 }} cervezas
                            </span>
                        </div>
                        
                        <div class="flex justify-between space-x-2">
                            <a href="{{ route('breweries.show', $brewery) }}" class="bg-[#3A3A3A] hover:bg-[#4A4A4A] text-white py-1 px-2.5 rounded text-xs w-full text-center">
                                <i class="fas fa-eye mr-1"></i> Ver detalles
                            </a>
                            <a href="{{ route('breweries.edit', $brewery) }}" class="bg-[#4A4A4A] hover:bg-[#5A5A5A] text-white py-1 px-2.5 rounded text-xs w-full text-center">
                                <i class="fas fa-edit mr-1"></i> Editar
                            </a>
                        </div>
                        
                        <div class="mt-3">
                            <a href="{{ route('brewery.beers.index', $brewery) }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-1 px-3 rounded text-xs w-full block text-center">
                                <i class="fas fa-beer mr-1"></i> Gestionar cervezas
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-6">
            {{ $breweries->links() }}
        </div>
    @else
        <div class="bg-[#2E2E2E] rounded-lg p-6 text-center" data-aos="fade-up">
            <svg class="w-12 h-12 mx-auto text-gray-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
            </svg>
            <h3 class="text-lg text-white mb-3">Aún no has registrado ninguna cervecería</h3>
            <p class="text-gray-300 mb-4 text-sm">Comienza a añadir tus establecimientos para que los usuarios puedan descubrirlos.</p>
            <a href="{{ route('breweries.create') }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-1.5 px-4 rounded inline-block text-sm">
                <i class="fas fa-plus-circle mr-1.5"></i>
                Crear mi primera cervecería
            </a>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    });
</script>
@endpush