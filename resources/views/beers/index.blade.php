@extends('layouts.app')

@section('content')
    <!-- Sección de cervezas destacadas -->
    <section class="py-16 px-8 bg-[#2E2E2E] shadow-xl rounded-lg mx-4 my-12">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-5xl font-bold text-[#FFD700] mb-8" data-aos="fade-up">Cervezas Destacadas</h2>
            <p class="text-xl mb-12 text-[#CCCCCC]" data-aos="fade-up" data-aos-delay="200">
                Explora nuestra selección de cervezas artesanales de diversas cervecerías.
            </p>

            <!-- Slider de cervezas -->
            <div class="swiper-container mb-10">
                <div class="swiper-wrapper">
                    @foreach($beers as $beer)
                        <div class="swiper-slide">
                            <div class="bg-[#3A3A3A] p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-110" data-aos="fade-up">
                                <img src="{{ $beer->image }}" alt="{{ $beer->name }}" class="w-full h-48 object-cover rounded-lg mb-4">
                                <h3 class="text-2xl font-semibold text-[#FFD700] mb-4">{{ $beer->name }}</h3>
                                <p class="text-[#CCCCCC]">{{ \Str::limit($beer->description, 100) }}</p>
                                <a href="{{ route('beers.show', $beer->id) }}" class="text-[#FFD700] hover:text-[#FFA500] mt-4 inline-block">Ver más</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Agrega los controles del slider (opcional) -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

        </div>
    </section>
@endsection

@section('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
        // Inicializar el slider (Swiper)
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            },
        });
    </script>
@endsection
