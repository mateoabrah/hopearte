@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <h1 class="text-3xl font-bold text-white mb-8">Mis Cervezas Favoritas</h1>

    @if (session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    @if ($favorites->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($favorites as $beer)
        <div class="bg-[#2E2E2E] rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300">            <div class="relative">
                <img src="{{ asset('storage/' . $beer->image) }}" alt="{{ $beer->name }}" class="w-full h-48 object-cover">
                <form action="{{ route('beer_favorites.destroy', $beer->id) }}" method="POST" class="absolute top-2 right-2">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-[#1A1A1A] p-2 rounded-full hover:bg-red-700 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FFD700]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="p-4">
                <h3 class="text-xl font-bold text-white mb-2">{{ $beer->name }}</h3>
                <p class="text-gray-300 mb-2">{{ $beer->brewery->name }}</p>
                <p class="text-[#FFD700] font-bold">ABV: {{ $beer->abv }}%</p>
                <div class="mt-4">
                    <a href="{{ route('beers.show', $beer->id) }}" class="text-[#FFD700] hover:underline">Ver detalles</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <div class="mt-6">
        {{ $favorites->links() }}
    </div>
    
    @else
    <div class="bg-[#2E2E2E] p-8 rounded-lg text-center">
        <p class="text-white text-xl mb-4">Aún no has añadido ninguna cerveza a favoritos.</p>
        <a href="{{ route('beers.index') }}" class="inline-block bg-[#FFD700] text-[#2E2E2E] px-6 py-3 rounded-lg font-semibold hover:bg-[#FAC843] transition-all duration-300">
            Explorar cervezas
        </a>
    </div>
    @endif
</div>
@endsection