@extends('layouts.app')

@push('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<style>
    #map {
        height: 400px;
        width: 100%;
        background: #333; /* Fondo oscuro */
        border: 2px solid #555; /* Borde más oscuro */
        margin-bottom: 20px;
        border-radius: 0.375rem; /* Mantener esquinas redondeadas */
    }
    /* Personalización del tema oscuro para Leaflet */
    .leaflet-tile-pane {
        filter: grayscale(90%) invert(100%) contrast(70%) hue-rotate(180deg) brightness(80%);
    }
    .leaflet-control-attribution {
        background: rgba(46, 46, 46, 0.8) !important; /* Fondo oscuro semi-transparente */
        color: #ccc !important; /* Texto claro */
    }
    .leaflet-control-attribution a {
        color: #FFD700 !important; /* Enlaces en color dorado */
    }
    .leaflet-control-zoom a {
        background-color: #333 !important;
        color: #fff !important;
        border-color: #555 !important;
    }
    .leaflet-control-zoom a:hover {
        background-color: #444 !important;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-8 mt-16">
    <div class="bg-[#2E2E2E] rounded-lg p-8 shadow-lg max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-[#FFD700] mb-6">Crear nueva cervecería</h1>
        
        <form action="{{ route('breweries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <!-- Información básica -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-[#CCCCCC]">Nombre *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                    @error('name')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="city" class="block text-sm font-medium text-[#CCCCCC]">Ciudad *</label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}" required
                        class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                    @error('city')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div>
                <label for="address" class="block text-sm font-medium text-[#CCCCCC]">Dirección *</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" required
                    class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                @error('address')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="description" class="block text-sm font-medium text-[#CCCCCC]">Descripción *</label>
                <textarea id="description" name="description" rows="5" required
                    class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Sección del mapa -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-[#FFD700] mb-4">Ubicación en el mapa</h2>
                <p class="text-[#CCCCCC] mb-4">Haz clic en el mapa para seleccionar la ubicación de tu cervecería o introduce las coordenadas manualmente.</p>
                
                <div id="map-container" class="mb-4 relative">
                    <div id="map" class="rounded-lg"></div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="latitude" class="block text-sm font-medium text-[#CCCCCC]">Latitud *</label>
                        <input type="text" id="latitude" name="latitude" value="{{ old('latitude') }}" required
                            class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                        @error('latitude')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="longitude" class="block text-sm font-medium text-[#CCCCCC]">Longitud *</label>
                        <input type="text" id="longitude" name="longitude" value="{{ old('longitude') }}" required
                            class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                        @error('longitude')
                            <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                
                <div class="mt-4">
                    <div class="flex items-center space-x-2">
                        <input type="text" id="addressSearch" placeholder="Buscar ubicación por dirección" 
                            class="flex-1 rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                        <button type="button" id="searchLocation" class="bg-[#4A4A4A] text-white py-2 px-4 rounded hover:bg-[#555555]">
                            Buscar
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Otros campos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="founded_year" class="block text-sm font-medium text-[#CCCCCC]">Año de fundación</label>
                    <input type="number" id="founded_year" name="founded_year" value="{{ old('founded_year', date('Y')) }}" min="1800" max="{{ date('Y') }}"
                        class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                    @error('founded_year')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="website" class="block text-sm font-medium text-[#CCCCCC]">Sitio web</label>
                    <input type="url" id="website" name="website" value="{{ old('website') }}" placeholder="https://ejemplo.com"
                        class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                    @error('website')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="flex items-center">
                <input type="checkbox" id="visitable" name="visitable" value="1" {{ old('visitable') ? 'checked' : '' }}
                    class="h-4 w-4 text-[#FFD700] focus:ring-[#FFD700] border-gray-700 bg-[#2E2E2E]">
                <label for="visitable" class="ml-2 text-sm text-[#CCCCCC]">¿Se puede visitar la cervecería?</label>
            </div>
            
            <!-- Imagen -->
            <div>
                <label for="image" class="block text-sm font-medium text-[#CCCCCC]">Imagen de la cervecería</label>
                <input type="file" id="image" name="image" accept="image/*"
                    class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none">
                <p class="text-xs text-gray-400 mt-1">Formato recomendado: JPG, PNG. Tamaño máximo: 2MB</p>
                @error('image')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Botones -->
            <div class="flex justify-end space-x-4 mt-8">
                <a href="{{ route('my_breweries') }}" class="bg-gray-600 hover:bg-gray-700 text-white py-2 px-6 rounded">
                    Cancelar
                </a>
                <button type="submit" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-2 px-6 rounded">
                    Guardar cervecería
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<!-- Asegurarse de cargar Leaflet antes de nuestro script -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM cargado, inicializando mapa...');
    
    // Inicializar el mapa después de un pequeño retraso
    setTimeout(function() {
        initMap();
    }, 500);
    
    function initMap() {
        try {
            // Verificar que Leaflet está disponible
            if (typeof L === 'undefined') {
                console.error('Leaflet (L) no está definido. Asegúrate de que la biblioteca se ha cargado correctamente.');
                return;
            }
            
            console.log('Leaflet disponible, creando mapa...');
            
            // Crear el mapa con opciones básicas
            var map = L.map('map').setView([40.4168, -3.7038], 5);
            
            // Añadir capa de mapa de OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                maxZoom: 19
            }).addTo(map);
            
            console.log('Mapa inicializado correctamente');
            
            // Variable para el marcador
            var marker;
            
            // Evento de clic en el mapa
            map.on('click', function(e) {
                setMarker(e.latlng.lat, e.latlng.lng);
            });
            
            // Función para establecer un marcador
            function setMarker(lat, lng) {
                // Si ya existe un marcador, eliminarlo
                if (marker) {
                    map.removeLayer(marker);
                }
                
                // Añadir nuevo marcador
                marker = L.marker([lat, lng], {
                    draggable: true
                }).addTo(map);
                
                // Actualizar campos del formulario
                document.getElementById('latitude').value = lat.toFixed(8);
                document.getElementById('longitude').value = lng.toFixed(8);
                
                // Actualizar dirección y ciudad cuando se mueve el marcador
                marker.on('dragend', function() {
                    var pos = marker.getLatLng();
                    document.getElementById('latitude').value = pos.lat.toFixed(8);
                    document.getElementById('longitude').value = pos.lng.toFixed(8);
                    
                    // Obtener dirección y ciudad
                    getAddressFromCoords(pos.lat, pos.lng);
                });
                
                // Obtener dirección y ciudad iniciales
                getAddressFromCoords(lat, lng);
            }
            
            // Obtener dirección a partir de coordenadas
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
                    .catch(error => console.error('Error obteniendo dirección:', error));
            }
            
            // Configurar botón de búsqueda de dirección
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
                    .catch(error => console.error('Error en búsqueda:', error));
            }
            
            // Configurar Enter en campo de búsqueda
            document.getElementById('addressSearch').addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    searchAddress();
                }
            });
            
            // Actualizar mapa si se cambian las coordenadas manualmente
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
            
        } catch (error) {
            console.error('Error al inicializar el mapa:', error);
        }
    }
});
</script>
@endpush