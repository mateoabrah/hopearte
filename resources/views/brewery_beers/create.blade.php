@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 mt-12">
    <div class="bg-[#2E2E2E] rounded-lg p-6 shadow-md max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold text-[#FFD700] mb-5">Añadir Cerveza a {{ $brewery->name }}</h1>
        
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif
        
        <form action="{{ route('brewery.beers.store', $brewery) }}" method="POST" enctype="multipart/form-data" class="space-y-5" id="beer-form">
            @csrf
            
            <!-- Opción para elegir cerveza existente o nueva -->
            <div class="space-y-3">
                <div class="flex items-center space-x-3">
                    <input type="radio" id="existing_beer" name="beer_option" value="existing" {{ old('beer_option', 'existing') == 'existing' ? 'checked' : '' }}
                        class="h-4 w-4 text-[#FFD700] focus:ring-[#FFD700] border-gray-700 bg-[#2E2E2E]">
                    <label for="existing_beer" class="text-white text-sm">Elegir una cerveza existente</label>
                </div>
                
                <div class="flex items-center space-x-3">
                    <input type="radio" id="new_beer" name="beer_option" value="new" {{ old('beer_option') == 'new' ? 'checked' : '' }}
                        class="h-4 w-4 text-[#FFD700] focus:ring-[#FFD700] border-gray-700 bg-[#2E2E2E]">
                    <label for="new_beer" class="text-white text-sm">Crear una cerveza nueva</label>
                </div>
            </div>
            
            <!-- Sección para cerveza existente -->
            <div id="existing_beer_section">
                <label for="existing_beer_id" class="block text-sm font-medium text-[#CCCCCC]">Selecciona una cerveza existente *</label>
                <select id="existing_beer_id" name="existing_beer_id" class="mt-1 w-full rounded border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                    <option value="">Selecciona una cerveza</option>
                    @foreach($existingBeers as $existingBeer)
                        <option value="{{ $existingBeer->id }}" {{ old('existing_beer_id') == $existingBeer->id ? 'selected' : '' }}>
                            {{ $existingBeer->name }} ({{ $existingBeer->category->name ?? 'Sin categoría' }}, {{ $existingBeer->abv }}%)
                        </option>
                    @endforeach
                </select>
                @error('existing_beer_id')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Sección para cerveza nueva -->
            <div id="new_beer_section" class="hidden space-y-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-[#CCCCCC]">Nombre de la cerveza *</label>
                    <div class="relative">
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="mt-1 w-full rounded border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none"
                            autocomplete="off">
                        <div id="name-spinner" class="hidden absolute right-3 top-1/2 transform -translate-y-1/2">
                            <svg class="animate-spin h-5 w-5 text-[#FFD700]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </div>
                    </div>
                    <div id="name-error" class="mt-1 text-xs text-red-500 hidden">Este nombre de cerveza ya existe. Por favor, elige otro nombre.</div>
                    @error('name')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="description" class="block text-sm font-medium text-[#CCCCCC]">Descripción *</label>
                    <textarea id="description" name="description" rows="4"
                        class="mt-1 w-full rounded border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label for="beer_category_id" class="block text-sm font-medium text-[#CCCCCC]">Categoría *</label>
                        <select id="beer_category_id" name="beer_category_id" class="mt-1 w-full rounded border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                            <option value="">Selecciona una categoría</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('beer_category_id')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="abv" class="block text-sm font-medium text-[#CCCCCC]">ABV (%) *</label>
                        <input type="number" id="abv" name="abv" value="{{ old('abv') }}" step="0.1" min="0" max="99.9"
                            class="mt-1 w-full rounded border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                        @error('abv')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div>
                    <label for="ibu" class="block text-sm font-medium text-[#CCCCCC]">IBU</label>
                    <input type="number" id="ibu" name="ibu" value="{{ old('ibu') }}" min="0"
                        class="mt-1 w-full rounded border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                    <p class="text-xs text-gray-400 mt-1">Índice de amargor de la cerveza (opcional)</p>
                    @error('ibu')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="image" class="block text-sm font-medium text-[#CCCCCC]">Imagen de la cerveza</label>
                    <input type="file" id="image" name="image" accept="image/*"
                        class="mt-1 w-full rounded border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                    <p class="text-xs text-gray-400 mt-1">Formato recomendado: JPG, PNG. Tamaño máximo: 2MB.</p>
                    @error('image')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Botones -->
            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('brewery.beers.index', $brewery) }}" class="bg-gray-600 hover:bg-gray-700 text-white py-1.5 px-4 rounded text-sm">
                    Cancelar
                </a>
                <button type="submit" id="submit-button" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-1.5 px-4 rounded text-sm">
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
    
    const nameInput = document.getElementById('name');
    const nameSpinner = document.getElementById('name-spinner');
    const nameError = document.getElementById('name-error');
    const submitButton = document.getElementById('submit-button');
    const beerForm = document.getElementById('beer-form');
    
    let nameTimer;
    let isNameValid = true;
    
    function toggleSections() {
        if (existingBeerRadio.checked) {
            existingBeerSection.classList.remove('hidden');
            newBeerSection.classList.add('hidden');
            isNameValid = true;
        } else {
            existingBeerSection.classList.add('hidden');
            newBeerSection.classList.remove('hidden');
            validateBeerName(); // Validar inmediatamente si hay un valor
        }
        
        updateSubmitButton();
    }
    
    function validateBeerName() {
        if (!newBeerRadio.checked) return;
        
        const beerName = nameInput.value.trim();
        
        if (beerName === '') {
            nameError.classList.add('hidden');
            nameInput.classList.remove('border-red-500');
            isNameValid = false;
            updateSubmitButton();
            return;
        }
        
        // Mostrar spinner de carga
        nameSpinner.classList.remove('hidden');
        
        // Realizar la verificación mediante AJAX
        fetch(`${window.location.origin}/check-beer-name?name=${encodeURIComponent(beerName)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la respuesta del servidor');
                }
                return response.json();
            })
            .then(data => {
                nameSpinner.classList.add('hidden');
                
                if (data.exists) {
                    nameError.textContent = "Este nombre de cerveza ya existe. Por favor, elige otro nombre.";
                    nameError.classList.remove('hidden');
                    nameInput.classList.add('border-red-500');
                    isNameValid = false;
                } else {
                    nameError.classList.add('hidden');
                    nameInput.classList.remove('border-red-500');
                    isNameValid = true;
                }
                
                updateSubmitButton();
            })
            .catch(error => {
                console.error('Error al verificar el nombre:', error);
                nameSpinner.classList.add('hidden');
                // En caso de error de conexión, permitimos continuar pero mostramos advertencia
                nameError.textContent = "No se pudo verificar si el nombre existe. Por favor, intenta con otro nombre.";
                nameError.classList.remove('hidden');
                isNameValid = false;
                updateSubmitButton();
            });
    }
    
    function updateSubmitButton() {
        if (newBeerRadio.checked && !isNameValid) {
            submitButton.disabled = true;
            submitButton.classList.add('opacity-50', 'cursor-not-allowed');
            submitButton.classList.remove('hover:bg-[#FFA500]');
        } else {
            submitButton.disabled = false;
            submitButton.classList.remove('opacity-50', 'cursor-not-allowed');
            submitButton.classList.add('hover:bg-[#FFA500]');
        }
    }
    
    // Validar nombre con debounce para no hacer demasiadas peticiones
    nameInput.addEventListener('input', function() {
        clearTimeout(nameTimer);
        nameTimer = setTimeout(validateBeerName, 500);
    });
    
    // Evento de cambio para los radio buttons
    existingBeerRadio.addEventListener('change', toggleSections);
    newBeerRadio.addEventListener('change', toggleSections);
    
    // Validación del formulario antes de enviar
    beerForm.addEventListener('submit', function(e) {
        if (newBeerRadio.checked) {
            const beerName = nameInput.value.trim();
            
            // Si el nombre está vacío
            if (beerName === '') {
                e.preventDefault();
                nameError.textContent = "El nombre de la cerveza es obligatorio.";
                nameError.classList.remove('hidden');
                nameInput.classList.add('border-red-500');
                nameInput.focus();
                return false;
            }
            
            // Si el nombre no es válido (ya existe)
            if (!isNameValid) {
                e.preventDefault();
                nameError.classList.remove('hidden');
                nameInput.classList.add('border-red-500');
                nameInput.focus();
                return false;
            }
        } else {
            // Validar que se haya seleccionado una cerveza existente
            if (document.getElementById('existing_beer_id').value === '') {
                e.preventDefault();
                return false;
            }
        }
        
        return true;
    });
    
    // Inicializar con el estado actual
    toggleSections();
});
</script>
@endpush
@endsection