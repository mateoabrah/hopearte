@extends('layouts.app')

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #map {
        height: 300px;
        width: 100%;
        background: #333;
        border: 1px solid #555;
        border-radius: 0.375rem;
    }
    .leaflet-tile-pane { filter: grayscale(90%) invert(100%) contrast(70%) hue-rotate(180deg) brightness(80%); }
    .leaflet-control-attribution { background: rgba(46, 46, 46, 0.8) !important; color: #ccc !important; }
    .leaflet-control-attribution a { color: #FFD700 !important; }
    .leaflet-control-zoom a { background-color: #333 !important; color: #fff !important; border-color: #555 !important; }
    .leaflet-control-zoom a:hover { background-color: #444 !important; }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-6 mt-12">
    <div class="bg-[#2E2E2E] rounded-lg p-6 shadow-md max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-[#FFD700]">Editar cervecería</h1>
            <a href="{{ route('my_breweries') }}" class="text-[#FFD700] hover:underline text-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Volver a mis cervecerías
            </a>
        </div>
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif
        
        <form action="{{ route('breweries.update', $brewery) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Columna izquierda -->
                <div class="space-y-4">
                    <!-- Información básica -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-[#CCCCCC] mb-1">Nombre *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $brewery->name) }}" required
                            class="w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="city" class="block text-sm font-medium text-[#CCCCCC] mb-1">Ciudad *</label>
                        <input type="text" id="city" name="city" value="{{ old('city', $brewery->city) }}" required
                            class="w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                        @error('city')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="address" class="block text-sm font-medium text-[#CCCCCC] mb-1">Dirección *</label>
                        <input type="text" id="address" name="address" value="{{ old('address', $brewery->address) }}" required
                            class="w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                        @error('address')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="description" class="block text-sm font-medium text-[#CCCCCC] mb-1">Descripción *</label>
                        <textarea id="description" name="description" rows="3" required
                            class="w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">{{ old('description', $brewery->description) }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="founded_year" class="block text-sm font-medium text-[#CCCCCC] mb-1">Año de fundación</label>
                            <input type="number" id="founded_year" name="founded_year" value="{{ old('founded_year', $brewery->founded_year) }}" min="1800" max="{{ date('Y') }}"
                                class="w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                            @error('founded_year')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="website" class="block text-sm font-medium text-[#CCCCCC] mb-1">Sitio web</label>
                            <input type="url" id="website" name="website" value="{{ old('website', $brewery->website) }}" placeholder="https://ejemplo.com"
                                class="w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                            @error('website')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" id="visitable" name="visitable" value="1" {{ old('visitable', $brewery->visitable) ? 'checked' : '' }}
                            class="h-4 w-4 text-[#FFD700] focus:ring-[#FFD700] border-gray-700 bg-[#2E2E2E]">
                        <label for="visitable" class="ml-2 text-sm text-[#CCCCCC]">¿Se puede visitar la cervecería?</label>
                    </div>
                    
                    <!-- Imagen -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-[#CCCCCC] mb-1">Imagen de la cervecería</label>
                        
                        @if($brewery->image)
                            <div class="mb-2 flex items-center">
                                <img src="{{ asset('storage/' . $brewery->image) }}" alt="{{ $brewery->name }}" class="h-16 w-16 object-cover rounded-md mr-2">
                                <span class="text-xs text-gray-400">Imagen actual</span>
                            </div>
                        @endif
                        
                        <input type="file" id="image" name="image" accept="image/*"
                            class="w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-1.5 text-white focus:border-[#FFD700] focus:outline-none text-sm">
                        <p class="text-xs text-gray-400 mt-1">JPG o PNG. Máx: 2MB.</p>
                        @error('image')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <!-- Columna derecha - Mapa -->
                <div>
                    <h2 class="text-lg font-semibold text-[#FFD700] mb-2">Ubicación</h2>
                    
                    <!-- Búsqueda de dirección -->
                    <div class="mb-3">
                        <div class="flex items-center space-x-1.5">
                            <input type="text" id="addressSearch" placeholder="Buscar ubicación por dirección" 
                                class="flex-1 rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white text-sm focus:border-[#FFD700] focus:outline-none">
                            <button type="button" id="searchLocation" class="bg-[#4A4A4A] text-white py-2 px-3 rounded hover:bg-[#555555]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Mapa -->
                    <div id="map" class="mb-3"></div>
                    
                    <!-- Coordenadas -->
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="latitude" class="block text-sm font-medium text-[#CCCCCC] mb-1">Latitud *</label>
                            <input type="text" id="latitude" name="latitude" value="{{ old('latitude', $brewery->latitude) }}" required
                                class="w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none text-sm">
                            @error('latitude')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="longitude" class="block text-sm font-medium text-[#CCCCCC] mb-1">Longitud *</label>
                            <input type="text" id="longitude" name="longitude" value="{{ old('longitude', $brewery->longitude) }}" required
                                class="w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none text-sm">
                            @error('longitude')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">Haz clic en el mapa para seleccionar la ubicación o introduce las coordenadas manualmente.</p>
                </div>
            </div>
            
            <!-- Botones -->
            <div class="flex justify-end space-x-3 mt-6">
                <a href="{{ route('my_breweries') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded text-sm">
                    Cancelar
                </a>
                <button type="submit" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-2 px-5 rounded text-sm">
                    Actualizar cervecería
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Coordenadas de la cervecería
    var breweryLat = {{ $brewery->latitude ?: 'null' }};
    var breweryLng = {{ $brewery->longitude ?: 'null' }};
    
    setTimeout(function() {
        // Verificar que Leaflet está disponible
        if (typeof L === 'undefined') {
            console.error('Error: Leaflet no está disponible');
            return;
        }
        
        // Centro y zoom
        var mapCenter = breweryLat && breweryLng ? [breweryLat, breweryLng] : [40.4168, -3.7038];
        var initialZoom = breweryLat && breweryLng ? 15 : 5;
        
        // Crear mapa
        var map = L.map('map').setView(mapCenter, initialZoom);
        
        // Añadir capa de mapa
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19
        }).addTo(map);
        
        // Variable para el marcador
        var marker;
        
        // Evento de clic
        map.on('click', function(e) {
            setMarker(e.latlng.lat, e.latlng.lng);
        });
        
        // Función para establecer marcador
        function setMarker(lat, lng) {
            if (marker) {
                map.removeLayer(marker);
            }
            
            marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);
            
            document.getElementById('latitude').value = lat.toFixed(8);
            document.getElementById('longitude').value = lng.toFixed(8);
            
            marker.on('dragend', function() {
                var pos = marker.getLatLng();
                document.getElementById('latitude').value = pos.lat.toFixed(8);
                document.getElementById('longitude').value = pos.lng.toFixed(8);
                getAddressFromCoords(pos.lat, pos.lng);
            });
            
            getAddressFromCoords(lat, lng);
        }
        
        // Si tenemos coordenadas, colocar marcador inicial
        if (breweryLat && breweryLng) {
            setMarker(breweryLat, breweryLng);
        }
        
        // Obtener dirección
        function getAddressFromCoords(lat, lng) {
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.address) {
                        var street = data.address.road || '';
                        var number = data.address.house_number || '';
                        document.getElementById('address').value = (street + ' ' + number).trim();
                        
                        var city = data.address.city || data.address.town || data.address.village || '';
                        if (city) {
                            document.getElementById('city').value = city;
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }
        
        // Búsqueda de dirección
        document.getElementById('searchLocation').addEventListener('click', searchAddress);
        
        function searchAddress() {
            var query = document.getElementById('addressSearch').value;
            if (!query) return;
            
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        var lat = parseFloat(data[0].lat);
                        var lon = parseFloat(data[0].lon);
                        
                        map.setView([lat, lon], 14);
                        setMarker(lat, lon);
                    } else {
                        alert('No se encontró la dirección.');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
        
        // Evento Enter en búsqueda
        document.getElementById('addressSearch').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                searchAddress();
            }
        });
        
        // Actualizar mapa desde coordenadas
        document.getElementById('latitude').addEventListener('change', updateMapFromCoords);
        document.getElementById('longitude').addEventListener('change', updateMapFromCoords);
        
        function updateMapFromCoords() {
            var lat = parseFloat(document.getElementById('latitude').value);
            var lng = parseFloat(document.getElementById('longitude').value);
            
            if (!isNaN(lat) && !isNaN(lng)) {
                map.setView([lat, lng], 14);
                setMarker(lat, lng);
            }
        }
    }, 300);
});
</script>
@endpush