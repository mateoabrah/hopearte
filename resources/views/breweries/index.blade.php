<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hopearte - Cervecerías</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Animations (AOS) -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="font-sans bg-gradient-to-b from-[#1A1A1A] to-[#2E2E2E] text-gray-100">


<nav
        class="bg-[#1A1A1A] text-white p-4 fixed top-0 left-0 w-full z-50 shadow-lg transition-all duration-300 ease-in-out">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('beers.index') }}"
                class="text-2xl font-bold text-[#FFD700] hover:text-[#FAC843] transition-all duration-300 ease-in-out">Hopearte</a>
            <ul class="flex space-x-6">
                <li><a href="{{ route('beers.index') }}"
                        class="text-lg hover:text-[#FFD700] transition-all duration-300 ease-in-out">Inicio</a></li>
                <li><a href="{{ route('beer_categories.index') }}"
                        class="text-lg hover:text-[#FFD700] transition-all duration-300 ease-in-out">Categorías</a></li>
                <li><a href="{{ route('breweries.index') }}"
                        class="text-lg hover:text-[#FFD700] transition-all duration-300 ease-in-out">Cervecerías</a>
                </li>

            </ul>
        </div>
    </nav> 
    <!-- Header Section -->
    <header class="bg-gradient-to-r from-[#4A4A4A] to-[#2E2E2E] text-white py-24 shadow-lg">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-7xl font-extrabold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-[#FFD700] to-[#FFA500] animate__animated animate__fadeInUp">
                Cervecerías en Hopearte
            </h1>
            <p class="text-3xl mb-10 text-[#CCCCCC]">Explora cervecerías locales e internacionales que ofrecen cervezas artesanales únicas.</p>
        </div>
    </header>

    <!-- Breweries List Section -->
    <section class="py-16 px-8 bg-[#2E2E2E] shadow-xl rounded-lg mx-4 my-12">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-5xl font-bold text-[#FFD700] text-center mb-8" data-aos="fade-up">Nuestras Cervecerías</h2>

            <!-- Listado de Cervecerías -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($breweries as $brewery)
                    <div class="bg-[#3A3A3A] p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-110" data-aos="fade-up">
                        <h3 class="text-2xl font-semibold text-[#FFD700] mb-4">{{ $brewery->name }}</h3>
                        <p class="text-[#CCCCCC] mb-4">{{ Str::limit($brewery->description, 150) }}</p>

                        <!-- Datos adicionales -->
                        <p class="text-[#CCCCCC] text-sm mb-2"><strong>Dirección:</strong> {{ $brewery->address }}</p>
                        <p class="text-[#CCCCCC] text-sm mb-2"><strong>Teléfono:</strong> {{ $brewery->phone_number }}</p>
                        <p class="text-[#CCCCCC] text-sm mb-2"><strong>Email:</strong> <a href="mailto:{{ $brewery->email }}" class="text-[#FFD700]">{{ $brewery->email }}</a></p>
                        <p class="text-[#CCCCCC] text-sm mb-4"><strong>Website:</strong> <a href="{{ $brewery->website }}" target="_blank" class="text-[#FFD700]">{{ $brewery->website }}</a></p>

                        <a href="{{ route('breweries.show', $brewery->id) }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] py-2 px-6 rounded-full text-lg transition-all duration-300 ease-in-out">
                            Ver más
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-[#1A1A1A] text-white py-8">
        <div class="max-w-7xl mx-auto text-center">
            <p class="text-sm text-[#CCCCCC]">&copy; 2025 Hopearte. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Animations JS -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Inicializar AOS (Animation on Scroll)
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true
        });
    </script>

</body>
</html>
