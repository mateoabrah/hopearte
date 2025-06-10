@extends('layouts.app')

@section('content')
    <!-- Hero Section - Versión más compacta -->
    <header class="relative py-10 overflow-hidden">
        <!-- Fondo de imagen difuminada -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/hero-background.jpg') }}" alt="Fondo de cervezas artesanales"
                class="w-full h-full object-cover filter brightness-40 blur-sm">
            <div class="absolute inset-0 bg-gradient-to-b from-[#000000cc] to-[#2E2E2Ecc]"></div>
        </div>

        <div class="max-w-6xl mx-auto text-center px-4 relative z-10">
            <h1 class="text-3xl md:text-4xl font-extrabold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-[#FFD700] to-[#FFA500] animate__animated animate__fadeInUp">
                Descubre tu próxima cerveza favorita
            </h1>
            <p class="text-sm md:text-base mb-4 text-white">
                Explora las nuevas cervezas artesanales de pequeños maestros cerveceros
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-3 mt-4">
                <!-- Botón principal con sombra -->
                <a href="{{ route('breweries.index') }}"
                    class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] py-2 px-5 rounded-full text-sm transition-all duration-300 ease-in-out transform hover:scale-105 font-semibold shadow-lg shadow-amber-700/30">
                    <i class="fas fa-beer mr-1"></i>Explora Cervecerías
                </a>

                <!-- Botón secundario - Modificado para usar el nombre IPA en lugar del ID -->
                <a href="{{ route('beers.index') }}?category=IPA"
                    class="bg-transparent hover:bg-white/10 text-white border border-white/30 py-2 px-5 rounded-full text-sm transition-all duration-300 ease-in-out">
                    <i class="fas fa-search mr-1"></i>Búscame una IPA
                </a>
            </div>

            <!-- Estadísticas en fila más compacta -->
            <div class="flex justify-center gap-6 mt-6 text-white/80">
                <div class="text-center">
                    <p class="text-2xl font-bold text-[#FFD700]">{{ $breweries->count() }}</p>
                    <p class="text-xs">Cervecerías</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-[#FFD700]">{{ isset($beers) ? $beers->count() : '+200' }}</p>
                    <p class="text-xs">Cervezas</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-[#FFD700]">{{ isset($beer_categories) ? $beer_categories->count() : '24' }}</p>
                    <p class="text-xs">Estilos</p>
                </div>
            </div>
        </div>
    </header>

    <!-- Banner de cervezas destacadas (movido aquí para que sea más visible) -->
    <section class="py-6 px-4 bg-[#1A1A1A] shadow-lg rounded-lg mx-3 mt-4 mb-6">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold text-center text-[#FFD700] mb-4" data-aos="fade-up">Cervezas Destacadas</h2>

            @if($bannerBeers->isEmpty())
                <div class="text-center py-6 bg-[#2E2E2E] rounded-xl">
                    <div class="text-3xl text-[#4A4A4A] mb-2">
                        <i class="fas fa-beer"></i>
                    </div>
                    <p class="text-base text-[#CCCCCC]">No hay cervezas destacadas actualmente.</p>
                    <p class="text-[#999999] mt-2 text-xs">¡Vuelve pronto para descubrir nuestras recomendaciones!</p>
                </div>
            @else
                <!-- Contenedor del Swiper - Más compacto -->
                <div class="beer-banner-container">
                    <div class="swiper beerBanner">
                        <div class="swiper-wrapper">
                            @foreach($bannerBeers as $beer)
                                <div class="swiper-slide">
                                    <!-- Contenido de cada slide - se mantiene igual -->
                                    <div class="bg-[#2E2E2E] rounded-xl overflow-hidden shadow-md h-full">
                                        <div class="relative h-40 overflow-hidden">
                                            <img src="{{ asset('storage/' . $beer->image) }}" alt="{{ $beer->name }}"
                                                class="w-full h-full object-cover transition-transform duration-500 transform hover:scale-110">

                                            <div
                                                class="absolute top-0 right-0 bg-[#FFD700] text-black px-2 py-0.5 m-2 rounded-full text-xs font-bold">
                                                {{ $beer->abv }}% ABV
                                            </div>
                                        </div>

                                        <div class="p-3">
                                            <div class="flex justify-between items-start mb-1.5">
                                                <h3 class="text-base font-bold text-[#FFD700] line-clamp-2">{{ $beer->name }}
                                                </h3>
                                                <span
                                                    class="text-xs bg-[#3A3A3A] text-gray-300 px-1.5 py-0.5 rounded inline-block transition-colors">{{ $beer->category->name }}</span>
                                            </div>

                                            <div class="flex items-center mb-1.5 text-xs text-[#CCCCCC]">
                                                <i class="fas fa-industry mr-1"></i>
                                                <a href="{{ route('breweries.show', $beer->brewery) }}" class="hover:text-[#FFD700] transition-colors">
                                                    {{ $beer->brewery->name }}
                                                </a>
                                            </div>

                                            <p class="text-gray-400 mb-3 line-clamp-2 text-xs">
                                                {{ \Illuminate\Support\Str::limit($beer->description, 70) }}
                                            </p>

                                            <div class="flex justify-between items-center">
                                                <div class="flex items-center text-xs">
                                                    @if($beer->ibu)
                                                        <span class="text-gray-400"><i class="fas fa-balance-scale mr-1"></i>
                                                            {{ $beer->ibu }} IBU</span>
                                                    @endif
                                                </div>
                                                <a href="{{ route('beers.show', $beer) }}"
                                                    class="bg-[#FFD700] hover:bg-[#FFA500] text-black px-2.5 py-0.5 rounded-full text-xs font-semibold transition-colors duration-300">
                                                    Ver detalles
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Navegación y paginación -->
                        <div class="swiper-pagination mt-3"></div>
                        <div class="swiper-button-next text-[#FFD700]"></div>
                        <div class="swiper-button-prev text-[#FFD700]"></div>
                    </div>
                </div>

                <div class="flex justify-center mt-4" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{ route('beers.index') }}"
                        class="bg-[#3A3A3A] hover:bg-[#4A4A4A] text-[#FFD700] border border-[#FFD700] px-4 py-1.5 rounded-full text-sm font-semibold transition-all duration-300 group">
                        Ver todas las cervezas
                        <i class="fas fa-long-arrow-alt-right ml-2 group-hover:ml-3 transition-all"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Main Content Section - Información sobre Hopearte -->
    <section class="py-8 px-6 bg-[#2E2E2E] shadow-xl rounded-lg mx-4 mb-6">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-[#FFD700] mb-4" data-aos="fade-up">¿Qué es Hopearte?</h2>
            <p class="text-base mb-6 text-[#CCCCCC]" data-aos="fade-up" data-aos-delay="200">
                Hopearte es la plataforma para los amantes de la cerveza artesanal. Aquí podrás descubrir cervecerías,
                explorar productos exclusivos y conectar con otros apasionados.
            </p>

            <!-- Botón para ir a categorías de cervezas -->
            <a href="{{ route('beer_categories.index') }}"
                class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-1.5 px-4 rounded-full text-sm mb-4 inline-block transition-all duration-300 ease-in-out"
                data-aos="fade-up" data-aos-delay="300">
                Ver Categorías de Cerveza
            </a>

            <!-- Enlaces rápidos en grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <a href="{{ route('breweries.index') }}"
                    class="bg-[#3A3A3A] p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105"
                    data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-xl font-semibold text-[#FFD700] mb-3">Descubre Cervecerías</h3>
                    <p class="text-[#CCCCCC] text-sm">Explora cervecerías locales e internacionales y conoce sus cervezas
                        artesanales más destacadas.</p>
                </a>

                <a href="{{ route('beers.index') }}"
                    class="bg-[#3A3A3A] p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105"
                    data-aos="fade-up" data-aos-delay="600">
                    <h3 class="text-xl font-semibold text-[#FFD700] mb-3">Cerveza Exclusiva</h3>
                    <p class="text-[#CCCCCC] text-sm">Accede a cervezas exclusivas, ediciones limitadas y recomendaciones
                        personalizadas para ti.</p>
                </a>

                <a href="{{ route('breweries.index') }}"
                    class="bg-[#3A3A3A] p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105"
                    data-aos="fade-up" data-aos-delay="800">
                    <h3 class="text-xl font-semibold text-[#FFD700] mb-3">Descubre Categorías</h3>
                    <p class="text-[#CCCCCC] text-sm">Explora los diferentes estilos de cerveza, sus características y encuentra
                        nuevas variedades que se adapten a tus gustos.</p>
                </a>
            </div>
        </div>
    </section>

    <!-- Sección de mapa -->
    <section class="py-6 px-4 bg-[#1A1A1A] shadow-lg rounded-lg mx-3 mb-6">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-2xl font-bold text-[#FFD700] mb-3" data-aos="fade-up">Encuentra Cervecerías</h2>
            <p class="text-base mb-4 text-[#CCCCCC]" data-aos="fade-up" data-aos-delay="200">
                Descubre en qué sitios se encuentra esa cerveza que tanto te gusta...
            </p>

            <!-- Mapa de OpenStreetMap -->
            <div id="map" class="w-full h-72 rounded-lg shadow-xl mb-4 transition-all duration-500 transform hover:scale-105"></div>
        </div>
    </section>

    <!-- Sección sobre cerveza artesanal - Profesional y con llamado a la acción -->
    <section class="py-10 px-6 bg-gradient-to-br from-[#2E2E2E] to-[#1A1A1A] shadow-xl rounded-lg mx-3 mb-8">
        <div class="max-w-7xl mx-auto">
            <div class="md:flex md:items-center md:gap-12">
                <div class="md:w-1/2 mb-8 md:mb-0" data-aos="fade-right">
                    <h2 class="text-3xl font-bold text-[#FFD700] mb-4">El universo de la cerveza artesanal</h2>
                    <div class="h-1 w-24 bg-gradient-to-r from-[#FFD700] to-[#FFA500] rounded-full mb-6"></div>
                    
                    <p class="text-[#CCCCCC] mb-5 leading-relaxed">
                        A diferencia de las cervezas industriales, las <span class="text-white font-medium">cervezas artesanales</span> 
                        son creadas por maestros cerveceros independientes que priorizan la calidad, 
                        los ingredientes naturales y procesos tradicionales con un toque innovador.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="bg-black/20 p-4 rounded-lg border-l-2 border-[#FFD700]">
                            <h4 class="text-white font-medium mb-2">Variedad única</h4>
                            <p class="text-[#CCCCCC] text-sm">Desde IPAs cítricas hasta Stouts achocolatadas, cada estilo cuenta una historia.</p>
                        </div>
                        <div class="bg-black/20 p-4 rounded-lg border-l-2 border-[#FFD700]">
                            <h4 class="text-white font-medium mb-2">Sabor auténtico</h4>
                            <p class="text-[#CCCCCC] text-sm">Matices complejos, aromas distintivos y un carácter inconfundible en cada sorbo.</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-4 mt-6">
                        <a href="{{ route('beers.index') }}" 
                           class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] py-3 px-6 rounded-full text-sm font-bold transition-all duration-300 ease-in-out transform hover:scale-105 shadow-lg shadow-amber-700/30 flex items-center">
                            <i class="fas fa-beer mr-2"></i>Explorar cervezas artesanales
                        </a>
                        <a href="{{ route('beer_categories.index') }}" 
                           class="bg-transparent hover:bg-white/10 text-white border border-white/30 py-3 px-6 rounded-full text-sm font-medium transition-all duration-300 ease-in-out flex items-center">
                            <i class="fas fa-list-ul mr-2"></i>Ver los diferentes estilos
                        </a>
                    </div>
                </div>
                
                <div class="md:w-1/2 relative" data-aos="fade-left" data-aos-delay="200">
                    <div class="aspect-w-16 aspect-h-9 rounded-xl overflow-hidden shadow-2xl">
                        <img src="{{ asset('images/cerveza-artesanal.jpg') }}" alt="El arte de la cerveza artesanal" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-4 -right-4 bg-[#1A1A1A] p-4 rounded-lg shadow-xl border border-[#3A3A3A] max-w-xs hidden md:block">
                        <div class="flex items-center">
                            <div class="bg-[#FFD700] p-2 rounded-full mr-3">
                                <i class="fas fa-lightbulb text-[#2E2E2E]"></i>
                            </div>
                            <p class="text-white text-sm">¿Sabías que la cerveza artesanal puede tener más de 100 estilos diferentes reconocidos?</p>
                        </div>
                    </div>
                </div>
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
            margin-bottom: 4px;
            font-weight: bold;
        }

        .brewery-popup-content p {
            margin: 2px 0;
            font-size: 0.9em;
        }

        .brewery-popup-content a {
            display: inline-block;
            background-color: #FFD700;
            color: #2E2E2E;
            padding: 4px 8px;
            border-radius: 4px;
            text-decoration: none;
            margin-top: 6px;
            font-weight: bold;
            transition: all 0.3s ease;
            font-size: 0.9em;
        }

        .brewery-popup-content a:hover {
            background-color: #FFA500;
        }


        .beer-banner-container {
            margin-bottom: 20px; /* Reducido de 30px */
        }

        .beer-banner-container .swiper {
            padding: 0 35px 40px; /* Reducido de 0 40px 50px */
        }

        .beer-banner-container .swiper-button-next,
        .beer-banner-container .swiper-button-prev {
            color: #FFD700;
            background-color: rgba(26, 26, 26, 0.7);
            width: 35px; /* Reducido de 40px */
            height: 35px; /* Reducido de 40px */
            border-radius: 50%;
        }

        .beer-banner-container .swiper-button-next:after,
        .beer-banner-container .swiper-button-prev:after {
            font-size: 16px; /* Reducido de 20px */
        }

        .beer-banner-container .swiper-pagination-bullet {
            background: #FFD700;
        }

        .beer-banner-container .swiper-slide {
            height: auto;
            transition: opacity 0.3s ease;
        }

        .beer-banner-container .swiper-slide-visible {
            opacity: 1;
        }

        /* Para fijar el tamaño de las slides y que se vean 3 */
        @media (min-width: 768px) {
            .beer-banner-container .swiper-slide {
                max-width: calc(33.333% - 15px);
            }
        }

        /* Pantallas más pequeñas */
        @media (max-width: 767px) and (min-width: 640px) {
            .beer-banner-container .swiper-slide {
                max-width: calc(50% - 10px);
            }
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
        // Inicializar AOS - Reducido tiempo de animación
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                duration: 800, // Reducido de 1000
                easing: 'ease-in-out',
                once: true
            });
        });

        // Inicializar el mapa
        document.addEventListener('DOMContentLoaded', function () {
            // Crear mapa con centro en las coordenadas exactas especificadas
            var map = L.map('map').setView([40.75460790052489, 0.6643184483630236], 6);

            // Cargar capa de OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Obtener datos de las cervecerías
            const breweries = @json($breweries ?? []);

            // Si no hay cervecerías, mostrar mensaje
            if (breweries.length === 0) {
                console.log("No hay cervecerías para mostrar en el mapa");
                var noBreweriesMarker = L.marker([40.75460790052489, 0.6643184483630236]).addTo(map);
                noBreweriesMarker.bindPopup("<b>¡Bienvenido a Hopearte!</b><br>Aún no hay cervecerías registradas.").openPopup();
                return;
            }

            // Crear límites para ajustar el zoom automáticamente
            var bounds = L.latLngBounds();

            // Añadir marcadores para cada cervecería
            breweries.forEach(function (brewery) {
                if (brewery.latitude && brewery.longitude) {
                    var marker = L.marker([brewery.latitude, brewery.longitude]).addTo(map);

                    // Crear contenido personalizado para el popup
                    var popupContent = `
                        <div class="brewery-popup-content">
                            <h4>${brewery.name}</h4>
                            <p><strong>Ciudad:</strong> ${brewery.city}</p>
                            <p><strong>Dirección:</strong> ${brewery.address}</p>
                            ${brewery.founded_year ? `<p><strong>Fundada en:</strong> ${brewery.founded_year}</p>` : ''}
                            <a href="/breweries/${brewery.slug || encodeURIComponent(brewery.name.toLowerCase().replace(/ /g, '-'))}">Ver detalles</a>
                        </div>
                    `;

                    // Añadir popup al marcador con clase personalizada
                    marker.bindPopup(popupContent, {
                        className: 'brewery-popup',
                        maxWidth: 280 // Reducido de 300
                    });

                    // Extender los límites para incluir este marcador
                    bounds.extend([brewery.latitude, brewery.longitude]);
                }
            });

            // Si hay cervecerías con coordenadas, ajustar el mapa a sus límites
            if (bounds.isValid()) {
                // Ampliar los límites pero con restricciones
                map.fitBounds(bounds, {
                    padding: [40, 40], // Reducido de [50, 50]
                    maxZoom: 8,
                    minZoom: 7
                });

                // Si los límites resultantes son demasiado amplios o estrechos, ajustar a una vista que incluya Cataluña y Baleares
                if (map.getZoom() < 7 || map.getZoom() > 8) {
                    map.setView([40.5, 2.5], 7);
                }
            } else {
                // Si no hay límites válidos, establecer la vista predeterminada
                map.setView([40.5, 2.5], 7);
            }
        });

        // Inicializar Swiper - Ajustado para ser más compacto
        document.addEventListener('DOMContentLoaded', function () {
            // Banner de cervezas destacadas
            var beerBanner = new Swiper('.beerBanner', {
                // Configuración base igual
                slidesPerView: 1,
                spaceBetween: 15,
                slideToClickedSlide: false, // Cambiado a false para evitar el avance al hacer clic
                loop: {{ $bannerBeers->count() > 3 ? 'true' : 'false' }},
                loopAdditionalSlides: 3,
                speed: 500, // Reducido de 600
                watchSlidesProgress: true,

                // Breakpoints optimizados
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 12,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 15,
                    },
                    1024: {
                        slidesPerView: 5, // 4 cervezas en pantallas grandes
                        spaceBetween: 15,
                    }
                },

                autoplay: {
                    delay: 3500,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true // Pausa al pasar el ratón
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    dynamicBullets: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                slideVisibleClass: 'swiper-slide-visible',
                centeredSlides: {{ $bannerBeers->count() <= 3 ? 'false' : 'false' }},
                grabCursor: true,
            });
            
            // Prevenir que los clics en enlaces dentro de slides activen el cambio de slide
            document.querySelectorAll('.beerBanner .swiper-slide a').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.stopPropagation(); // Detiene la propagación del evento
                });
            });
        });
    </script>
@endpush