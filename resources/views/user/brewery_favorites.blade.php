@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 mt-12">
    <h1 class="text-2xl font-bold text-[#FFD700] mb-6">Mis Cervecerías Favoritas</h1>

    @if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-400 text-green-700 px-3 py-2 rounded mb-4 text-sm">
        {{ session('success') }}
    </div>
    @endif

    @if ($favorites->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5" data-aos="fade-up">
        @foreach ($favorites as $brewery)
        <div class="bg-[#2E2E2E] rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
            <div class="relative h-40 bg-gray-700 overflow-hidden">
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
                <form action="{{ route('brewery_favorites.destroy', $brewery->id) }}" method="POST" class="absolute top-2 right-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-[#1A1A1A] p-2 rounded-full hover:bg-[#4A4A4A] transition-all shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="red" style="color: red;">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="p-3">
                <h3 class="text-lg font-bold text-[#FFD700] mb-1 truncate">{{ $brewery->name }}</h3>
                <div class="flex items-center text-xs text-gray-300 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1 text-[#FFD700]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ $brewery->location }}
                </div>
                
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center text-xs text-gray-400">
                        <svg class="w-3.5 h-3.5 mr-1 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        {{ $brewery->founded_year ?? 'N/A' }}
                    </div>
                    <div class="flex items-center text-xs text-gray-400">
                        <svg class="w-3.5 h-3.5 mr-1 text-[#FFD700]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        {{ $brewery->beers ? $brewery->beers->count() : 0 }} cervezas
                    </div>
                </div>
                
                <a href="{{ route('breweries.show', $brewery) }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] px-3 py-1 rounded text-xs font-semibold transition-colors shadow-sm w-full block text-center">
                    <i class="fas fa-brewery mr-1"></i> Ver detalles
                </a>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-6">
        {{ $favorites->links() }}
    </div>
    
    @else
    <div class="bg-[#2E2E2E] p-6 rounded-lg text-center shadow-md" data-aos="fade-up">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" viewBox="0 0 20 20" fill="red" style="color: red; margin-bottom: 0.75rem;">
            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
        </svg>
        <p class="text-white text-lg mb-3">Aún no has añadido ninguna cervecería a favoritos.</p>
        <p class="text-gray-400 text-sm mb-4">Añade cervecerías a tus favoritos para acceder rápidamente a ellas y estar al día con sus novedades.</p>
        <a href="{{ route('breweries.index') }}" class="inline-block bg-[#FFD700] text-[#2E2E2E] px-5 py-2 rounded-lg font-semibold hover:bg-[#FFA500] transition-all duration-300 text-sm">
            <i class="fas fa-beer mr-1.5"></i> Explorar cervecerías
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