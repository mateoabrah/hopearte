<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $brewery->name }} - Hopearte</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Animations (AOS) -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body class="font-sans bg-gradient-to-b from-[#1A1A1A] to-[#2E2E2E] text-gray-100">

    <!-- Banner Section -->
    <section class="relative w-full h-80 bg-cover bg-center" style="background-image: url('https://bc.thegrowler.ca/wp-content/uploads/2019/11/craft-beer-north-island.jpg');">

        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 text-center text-white py-24">
            <h1 class="text-6xl font-extrabold mb-4">{{ $brewery->name }}</h1>
            <p class="text-xl">{{ $brewery->description }}</p>
        </div>
    </section>

    <!-- Brewery Details Section -->
    <section class="py-16 px-8 bg-[#2E2E2E] shadow-xl rounded-lg mx-4 my-12">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-5xl font-bold text-[#FFD700] text-center mb-8" data-aos="fade-up">Detalles de la Cervecería</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Imagen de la cervecería (opcional) -->
                <div class="flex justify-center items-center">
                    <img src="https://www.ediblebrooklyn.com/wp-content/uploads/2017/07/randolphbeer.jpg" alt="Imagen de {{ $brewery->name }}" class="rounded-xl shadow-xl">
                </div>

                <!-- Información de la cervecería -->
                <div>
                    <p class="text-[#CCCCCC] text-sm mb-4"><strong>Dirección:</strong> {{ $brewery->address }}</p>
                    <p class="text-[#CCCCCC] text-sm mb-4"><strong>Teléfono:</strong> {{ $brewery->phone_number }}</p>
                    <p class="text-[#CCCCCC] text-sm mb-4"><strong>Email:</strong> <a href="mailto:{{ $brewery->email }}" class="text-[#FFD700]">{{ $brewery->email }}</a></p>
                    <p class="text-[#CCCCCC] text-sm mb-4"><strong>Website:</strong> <a href="{{ $brewery->website }}" target="_blank" class="text-[#FFD700]">{{ $brewery->website }}</a></p>
                </div>
            </div>

            <!-- Botón para volver -->
            <div class="text-center mt-8">
                <a href="{{ route('breweries.index') }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-white py-2 px-6 rounded-full text-lg transition-all duration-300 ease-in-out">
                    Volver a la lista
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
