@extends('layouts.app')

@section('content')
<!-- Header Section -->
<header class="bg-gradient-to-r from-[#4A4A4A] to-[#2E2E2E] text-white py-24 shadow-lg">
    <div class="max-w-7xl mx-auto text-center">
        <h1 class="text-7xl font-extrabold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-[#FFD700] to-[#FFA500] animate__animated animate__fadeInUp">
            Bienvenidos a Hopearte
        </h1>
        <p class="text-3xl mb-10 text-[#CCCCCC]">Conéctate y descubre nuevas cervezas artesanales en nuestra plataforma única.</p>

        <a href="{{ route('breweries.index') }}" class="bg-[#FFA500] hover:bg-[#FF8C00] text-white py-4 px-10 rounded-full text-xl transition-all duration-300 ease-in-out transform hover:scale-105">
            Explora Cervecerías
        </a>
    </div>
</header>

<!-- Main Content Section -->
<section class="py-16 px-8 bg-[#2E2E2E] shadow-xl rounded-lg mx-4 my-12">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-5xl font-bold text-[#FFD700] mb-8" data-aos="fade-up">¿Qué es Hopearte?</h2>
        <p class="text-xl mb-12 text-[#CCCCCC]" data-aos="fade-up" data-aos-delay="200">
            Hopearte es la plataforma para los amantes de la cerveza artesanal. Aquí podrás descubrir cervecerías,
            explorar productos exclusivos y conectar con otros apasionados.
        </p>

        <!-- Slider de Cerveza Destacada -->
        <div class="swiper mySwiper mb-12">
            <div class="swiper-wrapper">
                @foreach ($randomBeers as $beer)
                    <div class="swiper-slide">
                        <a href="{{ route('beers.show', $beer->id) }}">
                            <img src="https://cdn.homebrewersassociation.org/wp-content/uploads/irish-red-ale-_1440-900x600.jpg"
                                alt="Imagen de {{ $beer->name }}" class="rounded-xl shadow-xl">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>

        <!-- Botón para ir a categorías de cervezas -->
        <a href="{{ route('beer_categories.index') }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-3 px-6 rounded-full text-lg mb-8 inline-block transition-all duration-300 ease-in-out" data-aos="fade-up" data-aos-delay="400">
            Ver Categorías de Cerveza
        </a>

        <p class="text-xl mb-12 text-[#CCCCCC]" data-aos="fade-up" data-aos-delay="200">
            Descubre en que sitios se encuentra esa cerveza que tanto te gusta...
        </p>

        <!-- Mapa de OpenStreetMap -->
        <div id="map" class="w-full h-96 rounded-lg shadow-2xl mb-10 transition-all duration-500 transform hover:scale-105"></div>

        <!-- Enlaces rápidos -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <a href="{{ route('breweries.index') }}" class="bg-[#3A3A3A] p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-110" data-aos="fade-up" data-aos-delay="400">
                <h3 class="text-2xl font-semibold text-[#FFD700] mb-4">Descubre Cervecerías</h3>
                <p class="text-[#CCCCCC]">Explora cervecerías locales e internacionales y conoce sus cervezas artesanales más destacadas.</p>
            </a>

            <a href="{{ route('beers.index') }}" class="bg-[#3A3A3A] p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-110" data-aos="fade-up" data-aos-delay="600">
                <h3 class="text-2xl font-semibold text-[#FFD700] mb-4">Cerveza Exclusiva</h3>
                <p class="text-[#CCCCCC]">Accede a cervezas exclusivas, ediciones limitadas y recomendaciones personalizadas para ti.</p>
            </a>

            <a href="{{ route('breweries.index') }}" class="bg-[#3A3A3A] p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-110" data-aos="fade-up" data-aos-delay="800">
                <h3 class="text-2xl font-semibold text-[#FFD700] mb-4">Únete a la Comunidad</h3>
                <p class="text-[#CCCCCC]">Conéctate con otros entusiastas, comparte tu amor por la cerveza artesanal y participa en eventos únicos.</p>
            </a>
        </div>
    </div>
</section>
@endsection

@push('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<style>
    /* Personalización del tema oscuro para Leaflet */
    .leaflet-tile-pane {
        filter: grayscale(90%) invert(100%) contrast(70%) hue-rotate(180deg) brightness(80%);
    }
    .leaflet-control-attribution {
        background: rgba(46, 46, 46, 0.8) !important;
        color: #ccc !important;
    }
    .leaflet-control-attribution a {
        color: #FFD700 !important;
    }
    .leaflet-control-zoom a {
        background-color: #333 !important;
        color: #fff !important;
        border-color: #555 !important;
    }
    .leaflet-control-zoom a:hover {
        background-color: #444 !important;
    }
    .brewery-popup .leaflet-popup-content-wrapper {
        background-color: #2E2E2E;
        color: #FFFFFF;
        border-radius: 8px;
    }
    .brewery-popup .leaflet-popup-tip {
        background-color: #2E2E2E;
    }
    .brewery-popup-content h4 {
        color: #FFD700;
        margin-bottom: 5px;
        font-weight: bold;
    }
    .brewery-popup-content p {
        margin: 3px 0;
    }
    .brewery-popup-content a {
        display: inline-block;
        background-color: #FFD700;
        color: #2E2E2E;
        padding: 5px 10px;
        border-radius: 4px;
        text-decoration: none;
        margin-top: 8px;
        font-weight: bold;
        transition: all 0.3s ease;
    }
    .brewery-popup-content a:hover {
        background-color: #FFA500;
    }
</style>
@endpush

@push('scripts')
<!-- Leaflet JS para el mapa -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Swiper JS para el slider -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<!-- AOS (Animate On Scroll) -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>

<script>
    // Inicializar AOS
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true
        });
    });

    // Inicializar el mapa
    document.addEventListener('DOMContentLoaded', function() {
        // Crear mapa con centro en España
        var map = L.map('map').setView([40.4168, -3.7038], 6); // Centrado en España

        // Cargar capa de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Obtener datos de las cervecerías
        const breweries = @json($breweries ?? []);

        // Si no hay cervecerías, mostrar mensaje
        if (breweries.length === 0) {
            console.log("No hay cervecerías para mostrar en el mapa");
            var noBreweriesMarker = L.marker([40.4168, -3.7038]).addTo(map);
            noBreweriesMarker.bindPopup("<b>¡Bienvenido a Hopearte!</b><br>Aún no hay cervecerías registradas.").openPopup();
            return;
        }

        // Crear límites para ajustar el zoom automáticamente
        var bounds = L.latLngBounds();

        // Añadir marcadores para cada cervecería
        breweries.forEach(function(brewery) {
            if (brewery.latitude && brewery.longitude) {
                var marker = L.marker([brewery.latitude, brewery.longitude]).addTo(map);
                
                // Crear contenido personalizado para el popup
                var popupContent = `
                    <div class="brewery-popup-content">
                        <h4>${brewery.name}</h4>
                        <p><strong>Ciudad:</strong> ${brewery.city}</p>
                        <p><strong>Dirección:</strong> ${brewery.address}</p>
                        ${brewery.founded_year ? `<p><strong>Fundada en:</strong> ${brewery.founded_year}</p>` : ''}
                        <a href="/breweries/${brewery.id}">Ver detalles</a>
                    </div>
                `;
                
                // Añadir popup al marcador con clase personalizada
                marker.bindPopup(popupContent, {
                    className: 'brewery-popup',
                    maxWidth: 300
                });
                
                // Extender los límites para incluir este marcador
                bounds.extend([brewery.latitude, brewery.longitude]);
            }
        });

        // Si hay cervecerías con coordenadas, ajustar el mapa a sus límites
        if (bounds.isValid()) {
            map.fitBounds(bounds, {
                padding: [50, 50],
                maxZoom: 15
            });
        }
    });

    // Inicializar Swiper
    document.addEventListener('DOMContentLoaded', function() {
        var swiper = new Swiper('.mySwiper', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                768: { slidesPerView: 3 }
            }
        });
    });
</script>
@endpush