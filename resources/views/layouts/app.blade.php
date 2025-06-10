<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Animations (AOS) -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Swiper CSS para el slider -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    
    <!-- Leaflet CSS para mapas -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    
    <!-- Animate.css para animaciones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <!-- Tailwind CSS (usando CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FFD700',
                        secondary: '#FFA500',
                        dark: '#1A1A1A',
                        darkgray: '#2E2E2E',
                        mediumgray: '#3A3A3A',
                        lightgray: '#4A4A4A'
                    }
                }
            }
        }
    </script>

    <!-- Styles adicionales -->
    @stack('styles')

    <!-- Añadir en la sección de head -->
    <style>
        /* Fix para la visualización de textos con letras descendentes como "p", "g", "y", etc. */
        h1, h2, h3, .texto-con-descendentes {
            line-height: 1.2 !important;
            padding-bottom: 0.3em !important;
            margin-bottom: 0.3em !important;
            overflow: visible !important;
        }
        
        /* Específicamente para el texto del logo y títulos con gradiente */
        .text-transparent.bg-clip-text {
            padding-bottom: 0.3em !important;
            line-height: 1.3 !important;
            display: inline-block !important;
        }
        
        /* Para el texto "Hopearte" específicamente donde aparezca */
        [class*="title"] span.logo-text,
        h1 span.logo-text,
        h2 span.logo-text {
            display: inline-block !important;
            line-height: 1.4 !important;
            padding-bottom: 0.2em !important;
        }

        /* Regla para todos los mapas de Leaflet en la aplicación */
        .leaflet-container {
            z-index: 1 !important;
        }

        /* Asegurar que la barra de navegación siempre esté por encima */
        nav.fixed {
            z-index: 50 !important;
        }

        /* Controles de Leaflet */
        .leaflet-control {
            z-index: 10 !important;
        }

        .logo-container {
            height: 90px; /* Altura fija para el contenedor */
            overflow: hidden;
            position: relative;
            margin: 0;
            padding: 0;
            line-height: 0;
        }
        
        .logo-image {
            height: 120px; /* Tamaño real del logo */
            width: auto;
            display: block;
            position: absolute;
            top: -15px; /* Ajusta este valor para mover verticalmente el logo */
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gradient-to-b from-[#1A1A1A] to-[#2E2E2E] text-white">
    <!-- Incluye la navegación -->
    @include('layouts.navigation')
    
    <!-- Contenido principal -->
    <main class="mt-0">
        @yield('content')
    </main>
    

    <!-- Footer rediseñado -->
    <footer class="bg-[#1A1A1A] text-white py-8 mt-16">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-start justify-between">
                <!-- Logo y descripción -->
                <div class="w-full md:w-1/2 mb-6 md:mb-0">
                    <div class="logo-container">
                        <img src="{{ asset('images/logo.png') }}" alt="Hopearte Logo" class="logo-image">
                    </div>
                    <p class="text-gray-400 text-sm pr-4 max-w-lg mt-0 pt-0">Tu plataforma para descubrir las mejores cervezas artesanales y sus maestros cerveceros. Explora, califica y comparte tus experiencias.</p>
                    
                    <div class="mt-4 flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-[#FFD700] transition-colors">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12c0-5.52-4.48-10-10-10S2 6.48 2 12c0 4.84 3.44 8.87 8 9.8V15H8v-3h2V9.5C10 7.57 11.57 6 13.5 6H16v3h-2c-.55 0-1 .45-1 1v2h3v3h-3v6.95c5.05-.5 9-4.76 9-9.95z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-[#FFD700] transition-colors">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-[#FFD700] transition-colors">
                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2c2.717 0 3.056.01 4.122.06 1.065.05 1.79.217 2.428.465.66.254 1.216.598 1.772 1.153a4.908 4.908 0 0 1 1.153 1.772c.247.637.415 1.363.465 2.428.047 1.066.06 1.405.06 4.122 0 2.717-.01 3.056-.06 4.122-.05 1.065-.218 1.79-.465 2.428a4.883 4.883 0 0 1-1.153 1.772a4.915 4.915 0 0 1-1.772 1.153c-.637.247-1.363.415-2.428.465-1.066.047-1.405.06-4.122.06-2.717 0-3.056-.01-4.122-.06-1.065-.05-1.79-.218-2.428-.465a4.89 4.89 0 0 1-1.772-1.153 4.904 4.904 0 0 1-1.153-1.772c-.248-.637-.415-1.363-.465-2.428C2.013 15.056 2 14.717 2 12c0-2.717.01-3.056.06-4.122.05-1.066.217-1.79.465-2.428a4.88 4.88 0 0 1 1.153-1.772A4.897 4.897 0 0 1 5.45 2.525c.638-.248 1.362-.415 2.428-.465C8.944 2.013 9.283 2 12 2zm0 1.802c-2.67 0-2.986.01-4.04.059-.976.045-1.505.207-1.858.344-.466.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.048 1.055-.058 1.37-.058 4.04 0 2.67.01 2.986.058 4.04.045.977.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.04.058 2.67 0 2.987-.01 4.04-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.054.058-1.37.058-4.04 0-2.67-.01-2.986-.058-4.04-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 0 0-.748-1.15 3.098 3.098 0 0 0-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.054-.048-1.37-.058-4.04-.058zm0 3.063a5.135 5.135 0 1 1 0 10.27 5.135 5.135 0 0 1 0-10.27zm0 8.468a3.333 3.333 0 1 0 0-6.666 3.333 3.333 0 0 0 0 6.666zm6.538-8.671a1.2 1.2 0 1 1-2.4 0 1.2 1.2 0 0 1 2.4 0z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Enlaces rápidos -->
                <div class="w-full md:w-1/4 mb-6 md:mb-0">
                    <h3 class="text-lg font-semibold text-[#FFD700] mb-3">Enlaces rápidos</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('welcome') }}" class="text-gray-400 hover:text-[#FFD700] transition-colors">Inicio</a></li>
                        <li><a href="{{ route('beers.index') }}" class="text-gray-400 hover:text-[#FFD700] transition-colors">Cervezas</a></li>
                        <li><a href="{{ route('beer_categories.index') }}" class="text-gray-400 hover:text-[#FFD700] transition-colors">Categorías</a></li>
                        <li><a href="{{ route('breweries.index') }}" class="text-gray-400 hover:text-[#FFD700] transition-colors">Cervecerías</a></li>
                        @auth
                            @if(auth()->user()->role === 'company' || auth()->user()->role === 'admin')
                                <li><a href="{{ route('my_breweries') }}" class="text-gray-400 hover:text-[#FFD700] transition-colors">Mis Cervecerías</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>
                
                <!-- Contacto -->
                <div class="w-full md:w-1/4">
                    <h3 class="text-lg font-semibold text-[#FFD700] mb-3">Contacto</h3>
                    <div class="text-sm text-gray-400 space-y-2">
                        <p class="flex items-center">
                            <svg class="h-4 w-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                            info@hopearte.com
                        </p>
                        
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-6 pt-6 flex flex-col md:flex-row md:justify-between text-sm text-gray-500">
                <p>© {{ date('Y') }} Hopearte. Todos los derechos reservados.</p>
                <div class="mt-2 md:mt-0 space-x-4">
                    <a href="#" class="hover:text-gray-300 transition-colors">Política de Privacidad</a>
                    <a href="#" class="hover:text-gray-300 transition-colors">Términos de Uso</a>
                    <a href="#" class="hover:text-gray-300 transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </footer>
    ?>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Scripts básicos -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inicializar AOS (Animation on Scroll)
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 1000,
                easing: 'ease-in-out',
                once: true
            });
        });
    </script>
    
    <!-- Scripts adicionales específicos de cada página -->
    @stack('scripts')
</body>
</html>
