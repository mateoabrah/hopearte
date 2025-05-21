
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-[#2E2E2E] rounded-lg overflow-hidden shadow-xl mb-8">
        <div class="p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-[#FFD700]">{{ $beerCategory->name }}</h1>
                
                <a href="{{ route('beer_categories.index') }}" class="text-gray-400 hover:text-[#FFD700]">
                    <i class="fas fa-arrow-left mr-2"></i> Volver a categorías
                </a>
            </div>
            
            <div class="mb-8 bg-[#3A3A3A] p-6 rounded-lg">
                <p class="text-lg text-gray-300">{{ $beerCategory->description }}</p>
            </div>
            
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-[#FFD700] mb-4">Cervezas en esta categoría</h2>
                
                @if($beers->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach($beers as $beer)
                            <div class="bg-[#3A3A3A] rounded-lg overflow-hidden shadow-md hover:shadow-lg transform hover:scale-[1.02] transition-all duration-300">
                                <div class="h-48 bg-gray-800 overflow-hidden">
                                    @if($beer->image)
                                        <img src="{{ asset('storage/' . $beer->image) }}" alt="{{ $beer->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-[#2E2E2E]">
                                            <span class="text-4xl text-[#FFD700]">
                                                <i class="fas fa-beer"></i>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="p-6">
                                    <h3 class="text-xl font-semibold mb-2 text-[#FFD700]">{{ $beer->name }}</h3>
                                    <p class="text-gray-400 text-sm mb-1">
                                        <span class="font-semibold">Brewery:</span> 
                                        <a href="{{ route('breweries.show', $beer->brewery) }}" class="hover:text-[#FFD700]">
                                            {{ $beer->brewery->name }}
                                        </a>
                                    </p>
                                    <p class="text-gray-400 text-sm mb-3">
                                        <span class="font-semibold">ABV:</span> {{ $beer->abv }}%
                                    </p>
                                    
                                    <div class="mt-4">
                                        <a href="{{ route('beers.show', $beer) }}" class="text-[#FFD700] hover:underline">
                                            Ver detalles <i class="fas fa-arrow-right ml-1"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-8">
                        {{ $beers->links() }}
                    </div>
                @else
                    <div class="bg-[#3A3A3A] p-8 rounded-lg text-center">
                        <p class="text-gray-400 text-lg">No hay cervezas disponibles en esta categoría.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
