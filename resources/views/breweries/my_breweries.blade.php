@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-[#FFD700]">Mis Cervecerías</h1>
        <a href="{{ route('breweries.create') }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-2 px-6 rounded flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Añadir cervecería
        </a>
    </div>
    
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    
    @if($breweries->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($breweries as $brewery)
                <div class="bg-[#2E2E2E] rounded-lg shadow-lg overflow-hidden">                    <div class="h-40 bg-gray-700 overflow-hidden">
                        <img src="{{ asset('storage/' . $brewery->image) }}" alt="{{ $brewery->name }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-[#FFD700] mb-2">{{ $brewery->name }}</h2>
                        <p class="text-gray-300 mb-4">{{ $brewery->city }}</p>
                        <div class="flex justify-between">
                            <a href="{{ route('breweries.show', $brewery) }}" class="text-blue-400 hover:text-blue-300">
                                Ver detalles
                            </a>
                            <a href="{{ route('breweries.edit', $brewery) }}" class="text-[#FFD700] hover:text-[#FFA500]">
                                Editar
                            </a>
                        </div>
                        <div class="flex space-x-2 mt-4">
                            <a href="{{ route('breweries.edit', $brewery) }}" class="bg-[#4A4A4A] hover:bg-[#5A5A5A] text-white py-1 px-3 rounded-md text-sm">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <a href="{{ route('brewery.beers.index', $brewery) }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-1 px-3 rounded-md text-sm">
                                <i class="fas fa-beer"></i> Cervezas
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $breweries->links() }}
        </div>
    @else
        <div class="bg-[#2E2E2E] rounded-lg p-8 text-center">
            <h3 class="text-xl text-white mb-4">Aún no has registrado ninguna cervecería</h3>
            <p class="text-gray-300 mb-6">Comienza a añadir tus establecimientos para que los usuarios puedan descubrirlos.</p>
            <a href="{{ route('breweries.create') }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-2 px-6 rounded inline-block">
                Crear mi primera cervecería
            </a>
        </div>
    @endif
</div>
@endsection