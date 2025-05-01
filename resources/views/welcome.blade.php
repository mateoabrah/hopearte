<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hopearte - Conectando a los amantes de la cerveza artesanal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Animations (AOS) -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Swiper CSS for the slider -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<body class="font-sans bg-gradient-to-b from-[#1A1A1A] to-[#2E2E2E] text-gray-100">


    <!-- Navbar fixed -->
    <nav
        class="bg-[#1A1A1A] text-white p-4 fixed top-0 left-0 w-full z-50 shadow-lg transition-all duration-300 ease-in-out">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('welcome') }}"
                class="text-2xl font-bold text-[#FFD700] hover:text-[#FAC843] transition-all duration-300 ease-in-out">
                Hopearte
            </a>
            <div class="flex items-center">
                <ul class="flex space-x-6 mr-6">
                    <li><a href="{{ route('welcome') }}"
                            class="text-lg hover:text-[#FFD700] transition-all duration-300 ease-in-out">Inicio</a></li>
                    <li><a href="{{ route('beer_categories.index') }}"
                            class="text-lg hover:text-[#FFD700] transition-all duration-300 ease-in-out">Categorías</a></li>
                    <li><a href="{{ route('breweries.index') }}"
                            class="text-lg hover:text-[#FFD700] transition-all duration-300 ease-in-out">Cervecerías</a>
                    </li>
                </ul>
                <div class="flex space-x-2">
                    <a href="{{ route('login') }}"
                        class="text-sm border border-[#FFD700] text-[#FFD700] hover:bg-[#FFD700] hover:text-[#2E2E2E] py-1 px-3 rounded-full transition-all duration-300 ease-in-out">
                        Iniciar sesión
                    </a>
                    <a href="{{ route('register') }}"
                        class="text-sm bg-[#2E2E2E] border border-[#CCCCCC] text-[#CCCCCC] hover:bg-[#3A3A3A] py-1 px-3 rounded-full transition-all duration-300 ease-in-out">
                        Registrarse
                    </a>
                </div>
            </div>
        </div>
    </nav>


    <!-- Mobile Menu Button -->
    <div class="lg:hidden flex items-center space-x-4">
        <button class="text-white focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
    </div>

    <!-- Mobile Menu (hidden by default) -->
    <div class="lg:hidden absolute top-0 left-0 w-full bg-[#1A1A1A] text-white p-6 space-y-4 hidden">
        <ul class="flex flex-col space-y-4">
            <li><a href="{{ route('welcome') }}" class="hover:text-[#FFD700]">Inicio</a></li>
            <li><a href="{{ route('breweries.index') }}" class="hover:text-[#FFD700]">Cervecerías</a></li>
            <li><a href="{{ route('beers.index') }}" class="hover:text-[#FFD700]">Cerveza Exclusiva</a></li>
            <li><a href="{{ route('beer_categories.index') }}" class="hover:text-[#FFD700]">Categorías</a></li>
        </ul>
        <div class="flex flex-col space-y-2 pt-2 border-t border-gray-700">
            <a href="{{ route('login') }}" class="text-sm text-[#FFD700] hover:underline">Iniciar sesión</a>
            <a href="{{ route('register') }}" class="text-sm text-[#CCCCCC] hover:underline">Registrarse</a>
        </div>
    </div>


    <!-- Header Section -->
    <header class="bg-gradient-to-r from-[#4A4A4A] to-[#2E2E2E] text-white py-24 shadow-lg">
        <div class="max-w-7xl mx-auto text-center">
            <h1
                class="text-7xl font-extrabold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-[#FFD700] to-[#FFA500] animate__animated animate__fadeInUp">
                Bienvenidos a Hopearte
            </h1>
            <p class="text-3xl mb-10 text-[#CCCCCC]">Conéctate y descubre nuevas cervezas artesanales en nuestra
                plataforma única.</p>

            <a href="{{ route('breweries.index') }}"
                class="bg-[#FFA500] hover:bg-[#FF8C00] text-white py-4 px-10 rounded-full text-xl transition-all duration-300 ease-in-out transform hover:scale-105">
                Explora Cervecerías
            </a>
        </div>
    </header>


    <!-- <div class="breadcrumb py-4 text-[#CCCCCC]">
        <a href="{{ route('welcome') }}" class="hover:text-[#FFD700]">Inicio</a> /
        <a href="{{ route('breweries.index') }}" class="hover:text-[#FFD700]">Cervecerías</a> /
        <span class="text-[#FFD700]">Cerveza Exclusiva</span>
    </div> -->




    <!-- Main Content Section -->
    <section class="py-16 px-8 bg-[#2E2E2E] shadow-xl rounded-lg mx-4 my-12">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-5xl font-bold text-[#FFD700] mb-8" data-aos="fade-up">¿Qué es Hopearte?</h2>
            <p class="text-xl mb-12 text-[#CCCCCC]" data-aos="fade-up" data-aos-delay="200">
                Hopearte es la plataforma para los amantes de la cerveza artesanal. Aquí podrás descubrir cervecerías,
                explorar productos exclusivos y conectar con otros apasionados.
            </p>


            <p class="text-xl mb-12 text-[#CCCCCC]" data-aos="fade-up" data-aos-delay="200">
                Aquí te dejamos una muestra de lo que nos apasiona...
            </p>
            <!-- Slider de Cerveza Destacada -->
            <div class="swiper mySwiper mb-12">
                <div class="swiper-wrapper">
                    @foreach ($beers as $beer)
                        <div class="swiper-slide">
                            <!-- Enlace a la página individual de la cerveza -->
                            <a href="{{ route('beers.show', $beer->id) }}">
                                <!-- <img src="{{ $beer->image_url ?? 'https://cdn.homebrewersassociation.org/wp-content/uploads/irish-red-ale-_1440-900x600.jpg' . $beer->name }}"
                                                    alt="{{ $beer->name }}" class="rounded-lg shadow-lg"> -->
                                <img src="https://cdn.homebrewersassociation.org/wp-content/uploads/irish-red-ale-_1440-900x600.jpg"
                                    alt="Imagen de {{ $beer->name }}" class="rounded-xl shadow-xl">
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- Agregar navegación -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

            <!-- Botón para ir a categorías de cervezas -->
            <a href="{{ route('beer_categories.index') }}"
                class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-3 px-6 rounded-full text-lg mb-8 inline-block transition-all duration-300 ease-in-out"
                data-aos="fade-up" data-aos-delay="400">
                Ver Categorías de Cerveza
            </a>


            <p class="text-xl mb-12 text-[#CCCCCC]" data-aos="fade-up" data-aos-delay="200">
                Descubre en que sitios se encuentra esa cerveza que tanto te gusta...
            </p>
            <!-- Mapa de OpenStreetMap -->
            <div id="map"
                class="w-full h-96 rounded-lg shadow-2xl mb-10 transition-all duration-500 transform hover:scale-105">
            </div>

            <!-- Botón para explorar cervecerías -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Enlace a las cervecerías -->
                <a href="{{ route('breweries.index') }}"
                    class="bg-[#3A3A3A] p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-110"
                    data-aos="fade-up" data-aos-delay="400">
                    <h3 class="text-2xl font-semibold text-[#FFD700] mb-4">Descubre Cervecerías</h3>
                    <p class="text-[#CCCCCC]">Explora cervecerías locales e internacionales y conoce sus cervezas
                        artesanales más destacadas.</p>
                </a>

                <!-- Enlace a cervezas exclusivas -->
                <a href="{{ route('beers.index') }}"
                    class="bg-[#3A3A3A] p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-110"
                    data-aos="fade-up" data-aos-delay="600">
                    <h3 class="text-2xl font-semibold text-[#FFD700] mb-4">Cerveza Exclusiva</h3>
                    <p class="text-[#CCCCCC]">Accede a cervezas exclusivas, ediciones limitadas y recomendaciones
                        personalizadas para ti.</p>
                </a>

                <!-- Enlace a la comunidad -->
                <a href="{{ route('breweries.index') }}"
                    class="bg-[#3A3A3A] p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-110"
                    data-aos="fade-up" data-aos-delay="800">
                    <h3 class="text-2xl font-semibold text-[#FFD700] mb-4">Únete a la Comunidad</h3>
                    <p class="text-[#CCCCCC]">Conéctate con otros entusiastas, comparte tu amor por la cerveza artesanal
                        y participa en eventos únicos.</p>
                </a>
            </div>

        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-[#1A1A1A] text-white py-8">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-sm text-[#CCCCCC]">&copy; 2025 Hopearte. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        // Inicializar el mapa
        var map = L.map('map').setView([41.3851, 2.1734], 13); // Coordenadas de Barcelona (puedes cambiar esto por la ubicación que prefieras)

        // Cargar capa de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Marcador
        var marker = L.marker([41.3851, 2.1734]).addTo(map);
        marker.bindPopup("<b>¡Bienvenido a Hopearte!</b><br>Ubicación ejemplo.").openPopup();

        // Inicializar AOS (Animation on Scroll)
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true
        });

        // Inicializar Swiper
        var swiper = new Swiper('.mySwiper', {
            slidesPerView: 1,
            spaceBetween: 10,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                768: {
                    slidesPerView: 3,
                },
            },
        });
    </script>

</body>

</html>