@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <div class="bg-[#2E2E2E] rounded-lg p-8 shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-[#FFD700]">Cervezas de {{ $brewery->name }}</h1>
            
            <a href="{{ route('brewery.beers.create', $brewery) }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-2 px-4 rounded-md">
                <i class="fas fa-plus mr-2"></i> Añadir Cerveza
            </a>
        </div>
        
        @if(session('success'))
            <div class="bg-green-800 text-white p-4 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-800 text-white p-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif
        
        @if($beers->isEmpty())
            <div class="text-center py-10">
                <p class="text-xl text-[#CCCCCC]">Aún no has añadido ninguna cerveza a esta cervecería.</p>
                <p class="text-[#CCCCCC] mt-2">Haz clic en el botón "Añadir Cerveza" para comenzar.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-left bg-[#3A3A3A] text-[#FFD700]">
                            <th class="p-3">Imagen</th>
                            <th class="p-3">Nombre</th>
                            <th class="p-3">Categoría</th>
                            <th class="p-3">ABV</th>
                            <th class="p-3">IBU</th>
                            <th class="p-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($beers as $beer)
                            <tr class="hover:bg-[#3A3A3A]">
                                <td class="p-3">
                                    @if($beer->image)
                                        <img src="{{ asset('storage/' . $beer->image) }}" alt="{{ $beer->name }}" class="h-16 w-16 object-cover rounded">
                                    @else
                                        <div class="h-16 w-16 bg-gray-700 rounded flex items-center justify-center text-gray-500">
                                            <i class="fas fa-beer text-2xl"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="p-3 text-white">{{ $beer->name }}</td>
                                <td class="p-3 text-white">{{ $beer->category->name ?? 'Sin categoría' }}</td>
                                <td class="p-3 text-white">{{ $beer->abv }}%</td>
                                <td class="p-3 text-white">{{ $beer->ibu ?? 'N/A' }}</td>
                                <td class="p-3">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('beers.show', $beer) }}" class="bg-blue-700 hover:bg-blue-800 text-white py-1 px-3 rounded-md text-sm" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('brewery.beers.destroy', [$brewery, $beer]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta cerveza de tu cervecería?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-700 hover:bg-red-800 text-white py-1 px-3 rounded-md text-sm" title="Eliminar de la cervecería">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">
                {{ $beers->links() }}
            </div>
        @endif
        
        <div class="mt-8">
            <a href="{{ route('my_breweries') }}" class="text-[#FFD700] hover:underline">
                <i class="fas fa-arrow-left mr-1"></i> Volver a mis cervecerías
            </a>
        </div>
    </div>
</div>
@endsection