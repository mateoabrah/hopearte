<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hopearte - {{ $beer_category->name }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-sans bg-gradient-to-b from-[#1A1A1A] to-[#2E2E2E] text-gray-100">

    <!-- Header Section -->
    <header class="bg-gradient-to-r from-[#4A4A4A] to-[#2E2E2E] text-white py-24 shadow-lg">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-7xl font-extrabold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-[#FFD700] to-[#FFA500]">
                {{ $beer_category->name }}
            </h1>
            <p class="text-3xl mb-10 text-[#CCCCCC]">{{ $beer_category->description }}</p>
        </div>
    </header>

    <!-- Beers Section -->
    <section class="py-16 px-8 bg-[#2E2E2E] shadow-xl rounded-lg mx-4 my-12">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-5xl font-bold text-[#FFD700] mb-8">Cervezas de la Categoría</h2>
            <p class="text-xl mb-12 text-[#CCCCCC]">Descubre las cervezas que pertenecen a esta categoría.</p>

            <!-- Lista de cervezas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($beers as $beer)
                    <a href="{{ route('beers.show', $beer->id) }}"
                        class="bg-[#3A3A3A] p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-110">
                        <h3 class="text-2xl font-semibold text-[#FFD700] mb-4">{{ $beer->name }}</h3>
                        <p class="text-[#CCCCCC]">{{ Str::limit($beer->description, 100) }}</p>
                    </a>
                @endforeach
            </div>

            <!-- Botón para volver -->
            <div class="text-center mt-8">
                <a href="{{ route('beer_categories.index') }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] py-2 px-6 rounded-full text-lg transition-all duration-300 ease-in-out">
                    Volver a las categorías
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

</body>

</html>
