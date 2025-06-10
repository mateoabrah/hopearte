@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 mt-12">
    <h1 class="text-2xl font-bold text-[#FFD700] mb-6">Mis Cervezas Favoritas</h1>

    @if (session('success'))
    <div class="bg-green-100 border-l-4 border-green-400 text-green-700 px-3 py-2 rounded mb-4 text-sm">
        {{ session('success') }}
    </div>
    @endif

    @if ($favorites->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5" data-aos="fade-up">
        @foreach ($favorites as $beer)
        <div class="bg-[#2E2E2E] rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 hover:scale-105">
            <div class="relative h-40">
                <img src="{{ asset('storage/' . $beer->image) }}" alt="{{ $beer->name }}" class="w-full h-full object-cover">
                <div class="absolute top-0 right-0 bg-[#FFD700] text-black px-2 py-0.5 m-2 rounded-md text-xs font-bold">
                    {{ $beer->abv }}% ABV
                </div>
                <!-- Formulario corregido para eliminar cerveza favorita -->
                <form action="{{ route('beer_favorites.toggle') }}" method="POST" class="absolute top-2 right-2">
                    @csrf
                    <input type="hidden" name="beer_id" value="{{ $beer->id }}">
                    <button type="submit" class="bg-[#1A1A1A] p-2 rounded-full hover:bg-[#4A4A4A] transition-all shadow-md">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#DC2626]" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="p-3">
                <h3 class="text-lg font-bold text-[#FFD700] mb-1 truncate">{{ $beer->name }}</h3>
                <div class="flex items-center text-xs text-gray-300 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1 text-[#FFD700]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    {{ $beer->brewery->name }}
                </div>
                
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center text-xs">
                        <span class="bg-[#3A3A3A] text-gray-300 px-1.5 py-0.5 rounded">
                            {{ $beer->category->name ?? 'Sin categoría' }}
                        </span>
                    </div>
                    <div class="flex items-center text-xs">
                        @if($beer->ibu)
                            <span class="text-gray-400 ml-2"><i class="fas fa-balance-scale mr-1"></i> {{ $beer->ibu }} IBU</span>
                        @endif
                    </div>
                </div>
                
                <div class="flex justify-between items-center">
                    <span class="text-xs text-[#FFD700] font-bold flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 4v7a4 4 0 01-4 4H8a4 4 0 01-4-4V4" />
                        </svg>
                        ABV: {{ $beer->abv }}%
                    </span>
                    <a href="{{ route('beers.show', $beer) }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] px-2.5 py-1 rounded text-xs font-semibold transition-colors shadow-sm">
                        Ver detalles
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-6">
        {{ $favorites->links() }}
    </div>
    
    @else
    <div class="bg-[#2E2E2E] p-6 rounded-lg text-center shadow-md" data-aos="fade-up">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-[#DC2626] mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
        </svg>
        <p class="text-white text-lg mb-3">Aún no has añadido ninguna cervecería a favoritos.</p>
        <p class="text-gray-400 text-sm mb-4">Las cervecerías favoritas te permiten guardar y acceder rápidamente a tus productores preferidos.</p>
        <a href="{{ route('breweries.index') }}" class="inline-block bg-[#FFD700] text-[#2E2E2E] px-5 py-2 rounded-lg font-semibold hover:bg-[#FFA500] transition-all duration-300 text-sm">
            <i class="fas fa-industry mr-1.5"></i> Explorar cervecerías
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