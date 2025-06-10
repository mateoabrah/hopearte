@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-xl font-bold text-[#FFD700]">Editar Cerveza: {{ $brewery->name }}</h1>
        <a href="{{ route('brewery.beers.index', $brewery->getRouteKey()) }}" class="text-[#FFD700] hover:text-amber-400 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="text-sm font-medium">Volver</span>
        </a>
    </div>
    
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 mb-4 text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="bg-[#2E2E2E] rounded-lg shadow p-5 mb-4">
        <form action="{{ route('brewery.beers.update', [$brewery->getRouteKey(), $beer->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="name" class="block text-white text-sm mb-1">Nombre:</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $beer->name) }}" class="w-full bg-[#3A3A3A] text-white border border-gray-600 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#FFD700]">
                </div>
                
                <div>
                    <label for="beer_category_id" class="block text-white text-sm mb-1">Categoría:</label>
                    <select name="beer_category_id" id="beer_category_id" class="w-full bg-[#3A3A3A] text-white border border-gray-600 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#FFD700]">
                        <option value="">Selecciona una categoría...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('beer_category_id', $beer->beer_category_id) == $category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="mb-4">
                <label for="description" class="block text-white text-sm mb-1">Descripción:</label>
                <textarea name="description" id="description" rows="3" class="w-full bg-[#3A3A3A] text-white border border-gray-600 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#FFD700]">{{ old('description', $beer->description) }}</textarea>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="abv" class="block text-white text-sm mb-1">ABV (%):</label>
                    <input type="number" name="abv" id="abv" value="{{ old('abv', $beer->abv) }}" step="0.1" min="0" max="99.9" class="w-full bg-[#3A3A3A] text-white border border-gray-600 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#FFD700]">
                </div>
                
                <div>
                    <label for="ibu" class="block text-white text-sm mb-1">IBU (opcional):</label>
                    <input type="number" name="ibu" id="ibu" value="{{ old('ibu', $beer->ibu) }}" min="0" class="w-full bg-[#3A3A3A] text-white border border-gray-600 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#FFD700]">
                </div>
            </div>
            
            <div class="flex flex-col md:flex-row gap-4 mb-4">
                <div class="md:w-1/3">
                    <label class="block text-white text-sm mb-1">Imagen actual:</label>
                    @if($beer->image)
                        <div class="w-24 h-24 overflow-hidden rounded">
                            <img src="{{ asset('storage/' . $beer->image) }}" alt="{{ $beer->name }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <p class="text-gray-400 text-sm">No hay imagen</p>
                    @endif
                </div>
                
                <div class="md:w-2/3">
                    <label for="image" class="block text-white text-sm mb-1">Nueva imagen (opcional):</label>
                    <input type="file" name="image" id="image" class="w-full bg-[#3A3A3A] text-white border border-gray-600 rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-[#FFD700]">
                </div>
            </div>
            
            <div class="flex justify-end space-x-2">
                <a href="{{ route('brewery.beers.index', $brewery->getRouteKey()) }}" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-1.5 rounded text-sm">Cancelar</a>
                <button type="submit" class="bg-[#FFD700] hover:bg-amber-500 text-[#2E2E2E] font-medium px-3 py-1.5 rounded text-sm">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>
@endsection