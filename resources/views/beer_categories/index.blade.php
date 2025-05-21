@extends('layouts.app')

@section('content')
    <!-- Header Section -->
    <header class="bg-gradient-to-r from-[#4A4A4A] to-[#2E2E2E] text-white py-24 shadow-lg">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-7xl font-extrabold mb-6 text-transparent bg-clip-text bg-gradient-to-r from-[#FFD700] to-[#FFA500]">
                Categorías de Cerveza
            </h1>
            <p class="text-3xl mb-10 text-[#CCCCCC]">Explora las diferentes categorías y encuentra tu favorita.</p>
        </div>
    </header>

    <!-- Categorías Section -->
    <section class="py-16 px-8 bg-[#2E2E2E] shadow-xl rounded-lg mx-4 my-12">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-5xl font-bold text-[#FFD700] mb-8">Descubre las Categorías</h2>
            <p class="text-xl mb-12 text-[#CCCCCC]">Explora las diferentes variedades de cerveza artesanal disponibles en nuestra plataforma.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($categories as $category)
                    <a href="{{ route('beer_categories.show', $category->id) }}"
                       class="bg-[#3A3A3A] p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 ease-in-out transform hover:scale-105">
                        <h3 class="text-2xl font-semibold text-[#FFD700] mb-4">{{ $category->name }}</h3>
                        <p class="text-[#CCCCCC]">{{ $category->description }}</p>
                    </a>
                @endforeach
            </div>

            <!-- Solo mostramos la opción de creación (no edición) -->
            @auth
                @if(auth()->user()->role === 'admin')
                    <div class="mt-12">
                        <a href="{{ route('beer_categories.index') }}"
                           class="bg-[#FFD700] hover:bg-amber-500 text-[#2E2E2E] font-semibold py-3 px-6 rounded-full transition-colors">
                            Administrar categorías
                        </a>
                    </div>
                @endif
            @endauth
        </div>
    </section>
@endsection
