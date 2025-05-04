@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <div class="bg-[#2E2E2E] rounded-lg p-8 shadow-lg max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-[#FFD700] mb-6">Añadir Cerveza a {{ $brewery->name }}</h1>
        
        @if(session('error'))
            <div class="bg-red-800 text-white p-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif
        
        <form action="{{ route('brewery.beers.store', $brewery) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Opción para elegir cerveza existente o nueva -->
            <div class="space-y-4">
                <div class="flex items-center space-x-4">
                    <input type="radio" id="existing_beer" name="beer_option" value="existing" checked
                        class="h-4 w-4 text-[#FFD700] focus:ring-[#FFD700] border-gray-700 bg-[#2E2E2E]">
                    <label for="existing_beer" class="text-white">Elegir una cerveza existente</label>
                </div>
                
                <div class="flex items-center space-x-4">
                    <input type="radio" id="new_beer" name="beer_option" value="new"
                        class="h-4 w-4 text-[#FFD700] focus:ring-[#FFD700] border-gray-700 bg-[#2E2E2E]">
                    <label for="new_beer" class="text-white">Crear una cerveza nueva</label>
                </div>
            </div>
            
            <!-- Sección para cerveza existente -->
            <div id="existing_beer_section">
                <label for="existing_beer_id" class="block text-sm font-medium text-[#CCCCCC]">Selecciona una cerveza existente *</label>
                <select id="existing_beer_id" name="existing_beer_id" class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                    <option value="">Selecciona una cerveza</option>
                    @foreach($existingBeers as $existingBeer)
                        <option value="{{ $existingBeer->id }}">{{ $existingBeer->name }} ({{ $existingBeer->category->name ?? 'Sin categoría' }}, {{ $existingBeer->abv }}%)</option>
                    @endforeach
                </select>
                @error('existing_beer_id')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Sección para cerveza nueva -->
            <div id="new_beer_section" class="hidden space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-[#CCCCCC]">Nombre de la cerveza *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}"
                        class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                    @error('name')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-[#CCCCCC]">Descripción *</label>
                    <textarea id="description" name="description" rows="4"
                        class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="beer_category_id" class="block text-sm font-medium text-[#CCCCCC]">Categoría *</label>
                        <select id="beer_category_id" name="beer_category_id" class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                            <option value="">Selecciona una categoría</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('beer_category_id')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="abv" class="block text-sm font-medium text-[#CCCCCC]">ABV (%) *</label>
                        <input type="number" id="abv" name="abv" value="{{ old('abv') }}" step="0.1" min="0" max="99.9"
                            class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                        @error('abv')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label for="ibu" class="block text-sm font-medium text-[#CCCCCC]">IBU</label>
                    <input type="number" id="ibu" name="ibu" value="{{ old('ibu') }}" min="0"
                        class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                    <p class="text-xs text-gray-400 mt-1">Índice de amargor de la cerveza (opcional)</p>
                    @error('ibu')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="image" class="block text-sm font-medium text-[#CCCCCC]">Imagen de la cerveza</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                    <p class="text-xs text-gray-400 mt-1">Formato recomendado: JPG, PNG. Tamaño máximo: 2MB.</p>
                    @error('image')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Botones -->
            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('brewery.beers.index', $brewery) }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-6 rounded">
                    Cancelar
                </a>
                <button type="submit" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-2 px-6 rounded">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const existingBeerRadio = document.getElementById('existing_beer');
    const newBeerRadio = document.getElementById('new_beer');
    
    const existingBeerSection = document.getElementById('existing_beer_section');
    const newBeerSection = document.getElementById('new_beer_section');
    
    function toggleSections() {
        if (existingBeerRadio.checked) {
            existingBeerSection.classList.remove('hidden');
            newBeerSection.classList.add('hidden');
        } else {
            existingBeerSection.classList.add('hidden');
            newBeerSection.classList.remove('hidden');
        }
    }
    
    existingBeerRadio.addEventListener('change', toggleSections);
    newBeerRadio.addEventListener('change', toggleSections);
    
    // Inicializar con el estado actual
    toggleSections();
});
</script>
@endpush
@endsection