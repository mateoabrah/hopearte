@extends('layouts.app')

@section('content')
    <!-- Sección de categorías de cervezas -->
    <section class="py-16 px-8 bg-[#2E2E2E] shadow-xl rounded-lg mx-4 my-12">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-5xl font-bold text-[#FFD700] mb-8" data-aos="fade-up">Categorías de Cervezas</h2>
            <p class="text-xl mb-12 text-[#CCCCCC]" data-aos="fade-up" data-aos-delay="200">
                Explora las diferentes categorías de cervezas y encuentra tu estilo favorito.
            </p>

            @if(session('success'))
                <div class="bg-green-600 text-white p-4 rounded mb-6 text-center" data-aos="fade-up" data-aos-delay="200">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-[#3A3A3A] shadow-lg rounded-xl p-8">
                <table class="min-w-full border border-[#555] text-[#CCCCCC]">
                    <thead>
                        <tr class="bg-[#444] text-[#FFD700]">
                            <th class="px-6 py-3">ID</th>
                            <th class="px-6 py-3">Nombre</th>
                            <th class="px-6 py-3">Descripción</th>
                            <th class="px-6 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="border-t border-[#555] text-center">
                                <td class="px-6 py-4">{{ $category->id }}</td>
                                <td class="px-6 py-4">{{ $category->name }}</td>
                                <td class="px-6 py-4">{{ \Str::limit($category->description, 100) }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('beer_categories.edit', $category) }}" class="text-[#FFD700] hover:text-[#FFA500]">Editar</a>
                                    <form action="{{ route('beer_categories.destroy', $category) }}" method="POST" class="inline-block ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-10 text-center">
                <a href="{{ route('beer_categories.create') }}" class="bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] px-6 py-3 rounded-lg font-bold shadow-lg">
                    Agregar Nueva Categoría
                </a>
            </div>
        </div>
    </section>
@endsection
