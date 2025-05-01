<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $beer->name }} - Hopearte</title>

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
            <h1 class="text-6xl font-extrabold mb-4">{{ $beer->name }}</h1>
            <p class="text-xl">{{ $beer->description }}</p>
        </div>
    </section>

    <!-- Beer Details Section -->
    <section class="py-16 px-8 bg-[#2E2E2E] shadow-xl rounded-lg mx-4 my-12">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-5xl font-bold text-[#FFD700] text-center mb-8" data-aos="fade-up">Detalles de la Cerveza</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Imagen de la cerveza -->
                <div class="flex justify-center items-center">
                  <!--  <img src="{{ $beer->image_url }}" alt="Imagen de {{ $beer->name }}" class="rounded-xl shadow-xl"> -->
                  <img src="https://cdn.homebrewersassociation.org/wp-content/uploads/irish-red-ale-_1440-900x600.jpg" alt="Imagen de {{ $beer->name }}" class="rounded-xl shadow-xl">
                </div>

                <!-- Información de la cerveza -->
                <div>
                    <p class="text-[#CCCCCC] text-sm mb-4"><strong>Estilo:</strong> {{ $beer->style }}</p>
                    <p class="text-[#CCCCCC] text-sm mb-4"><strong>ABV:</strong> {{ $beer->abv }}%</p>
                    <p class="text-[#CCCCCC] text-sm mb-4"><strong>Precio:</strong> ${{ $beer->price }}</p>
                    <p class="text-[#CCCCCC] text-sm mb-4"><strong>Rating:</strong> {{ $beer->rating }} / 5</p>
                    <p class="text-[#CCCCCC] text-sm mb-4"><strong>Descripción:</strong> {{ $beer->description }}</p>

                    @auth
                    <form action="{{ route('beer_favorites.toggle') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="beer_id" value="{{ $beer->id }}">
                        <button type="submit" class="flex items-center space-x-2 bg-[#3A3A3A] hover:bg-[#444444] px-4 py-2 rounded-full transition-all">
                            @if(Auth::user()->favoritedBeers->contains($beer->id))
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#FFD700]" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                                </svg>
                                <span class="text-[#FFD700]">Quitar de favoritos</span>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span class="text-gray-300">Añadir a favoritos</span>
                            @endif
                        </button>
                    </form>
                    @endauth
                </div>
            </div>

            <!-- Botón para volver -->
            <div class="text-center mt-8">
                <a href="{{ route('beers.index') }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] py-2 px-6 rounded-full text-lg transition-all duration-300 ease-in-out">
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
