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
</head>
<body class="font-sans antialiased bg-gradient-to-b from-[#1A1A1A] to-[#2E2E2E] text-white">
    <!-- Incluye la navegación -->
    @include('layouts.navigation')
    
    <!-- Contenido principal -->
    <main class="mt-20">
        @yield('content')
    </main>
    
    <!-- Footer común para todas las páginas -->
    <footer class="bg-[#1A1A1A] text-white py-10 mt-20">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap justify-between">
                <div class="w-full md:w-1/3 mb-8 md:mb-0">
                    <h3 class="text-xl font-bold text-[#FFD700] mb-4">Hopearte</h3>
                    <p class="text-gray-400">Tu plataforma para descubrir las mejores cervezas artesanales y cervecerías.</p>
                </div>
                
                <div class="w-full md:w-1/3 mb-8 md:mb-0">
                    <h3 class="text-xl font-bold text-[#FFD700] mb-4">Enlaces rápidos</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('welcome') }}" class="text-gray-400 hover:text-[#FFD700]">Inicio</a></li>
                        <li><a href="{{ route('beers.index') }}" class="text-gray-400 hover:text-[#FFD700]">Cervezas</a></li>
                        <li><a href="{{ route('breweries.index') }}" class="text-gray-400 hover:text-[#FFD700]">Cervecerías</a></li>
                    </ul>
                </div>
                
                <div class="w-full md:w-1/3">
                    <h3 class="text-xl font-bold text-[#FFD700] mb-4">Contáctanos</h3>
                    <p class="text-gray-400">info@hopearte.com</p>
                </div>
            </div>
            
            <div class="border-t border-gray-800 mt-8 pt-8 text-center">
                <p class="text-gray-500">© {{ date('Y') }} Hopearte. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

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
