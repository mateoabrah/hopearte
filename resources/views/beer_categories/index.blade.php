@extends('layouts.app')

@section('content')
    <!-- Header Section - Con fondo de imagen difuminada y animaciones -->
    <header class="relative py-16 overflow-hidden">
        <!-- Fondo de imagen difuminada -->
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('images/beer-categories.jpg') }}" alt="Fondo de categorías de cerveza"
                class="w-full h-full object-cover filter brightness-40 blur-sm">
            <div class="absolute inset-0 bg-gradient-to-b from-[#000000cc] to-[#2E2E2Ecc]"></div>
        </div>

        <div class="max-w-7xl mx-auto text-center px-4 relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-[#FFD700] to-[#FFA500] mb-4 animate__animated animate__fadeInUp">
                Categorías de cerveza en <span class="logo-text">Hopearte</span>
            </h2>
            <p class="text-xl mb-6 text-[#CCCCCC] animate__animated animate__fadeIn animate__delay-1s">
                Explora las diferentes categorías y encuentra tu favorita.
            </p>
        </div>
    </header>

    <!-- Categorías Section - Diseño mejorado -->
    <section class="py-12 px-6 bg-gradient-to-br from-[#2E2E2E] to-[#222222] shadow-xl rounded-lg mx-4 my-8">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-[#FFD700] mb-6" data-aos="fade-up">Descubre las Categorías</h2>
            <p class="text-lg mb-8 text-[#CCCCCC] max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="200">
                Explora las diferentes variedades de cerveza artesanal disponibles en nuestra plataforma.
                Cada categoría representa un estilo único con sabores y aromas distintivos.
            </p>

            <!-- Grid de categorías con efectos de aparición -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($categories as $category)
                    <a href="{{ route('beer_categories.show', ['category' => $category->name]) }}"
                        class="bg-gradient-to-br from-[#3A3A3A] to-[#333333] p-6 rounded-xl shadow-lg hover:shadow-2xl 
                        transition-all duration-300 ease-in-out transform hover:scale-105 hover:from-[#444444] hover:to-[#383838]"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <h3 class="text-xl font-semibold text-[#FFD700] mb-3">{{ $category->name }}</h3>
                        <p class="text-sm text-[#CCCCCC]">{{ $category->description }}</p>
                        <div class="mt-4 text-xs text-[#FFD700]">
                            <span class="inline-block border border-[#FFD700] rounded-full px-3 py-1">Ver cervezas</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Opción de administración -->
            @auth
                @if(auth()->user()->role === 'admin')
                    <div class="mt-10" data-aos="fade-up">
                        <a href="{{ route('beer_categories.index') }}"
                            class="bg-[#FFD700] hover:bg-amber-500 text-[#2E2E2E] font-semibold py-2 px-5 rounded-full transition-colors text-sm shadow-md hover:shadow-lg">
                            Administrar categorías
                        </a>
                    </div>
                @endif
            @endauth
        </div>
    </section>

    <!-- Sección informativa sobre estilos de cerveza -->
    <section class="py-10 px-6 bg-[#1A1A1A] shadow-xl rounded-lg mx-4 mb-8">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-bold text-center text-[#FFD700] mb-6" data-aos="fade-up">¿Sabías que...?</h2>
            <div class="md:flex md:items-center md:gap-8">
                <div class="md:w-1/2 mb-6 md:mb-0" data-aos="fade-right">
                    <p class="text-[#CCCCCC] mb-4">
                        Existen más de 100 estilos de cerveza reconocidos en todo el mundo, cada uno con características 
                        únicas que lo distinguen. Desde las ligeras Lagers hasta las complejas Stouts, cada estilo tiene 
                        su propia historia y proceso de elaboración.
                    </p>
                    <p class="text-[#CCCCCC]">
                        En Hopearte te ayudamos a descubrir las sutilezas de cada estilo para que encuentres 
                        exactamente lo que estás buscando.
                    </p>
                </div>
                <div class="md:w-1/2" data-aos="fade-left" data-aos-delay="200">
                    <div class="bg-[#2E2E2E] p-6 rounded-xl shadow-lg">
                        <h3 class="text-xl font-semibold text-[#FFD700] mb-3">Los 5 estilos más populares</h3>
                        <ul class="text-[#CCCCCC] list-disc pl-5 space-y-2">
                            <li>IPA (India Pale Ale) - Caracterizada por su amargor y aroma a lúpulo</li>
                            <li>Lager - Suave, refrescante y de fermentación baja</li>
                            <li>Stout - Oscura y cremosa con notas de café y chocolate</li>
                            <li>Wheat Beer - Refrescante, turbia y con sutiles notas especiadas</li>
                            <li>Pale Ale - Equilibrada con notas a malta y lúpulo</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- AOS (Animate On Scroll) -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
    
    <script>
        // Inicializar AOS
        document.addEventListener('DOMContentLoaded', function () {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
        });
    </script>
@endpush

@push('styles')
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.css" />
@endpush