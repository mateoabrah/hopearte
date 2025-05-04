@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-[#2E2E2E] overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-white">
                <h1 class="text-2xl font-bold mb-6">Panel de Control</h1>
                
                <!-- Contenido del dashboard -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-[#3A3A3A] p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold text-[#FFD700] mb-4">Mis Cervezas Favoritas</h2>
                        <p class="text-gray-300 mb-4">Accede a tu colección de cervezas favoritas</p>
                        <a href="{{ route('user.beer_favorites') }}" class="inline-block bg-[#4A4A4A] hover:bg-[#555555] text-white px-4 py-2 rounded-md transition-colors">Ver favoritos</a>
                    </div>
                    
                    <div class="bg-[#3A3A3A] p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold text-[#FFD700] mb-4">Mis Cervecerías Favoritas</h2>
                        <p class="text-gray-300 mb-4">Descubre tus cervecerías guardadas</p>
                        <a href="{{ route('user.brewery_favorites') }}" class="inline-block bg-[#4A4A4A] hover:bg-[#555555] text-white px-4 py-2 rounded-md transition-colors">Ver favoritos</a>
                    </div>
                </div>
                
                <!-- Sección de perfil -->
                <div class="mt-8 bg-[#3A3A3A] p-6 rounded-lg shadow-md">
                    <h2 class="text-xl font-semibold text-[#FFD700] mb-4">Mi perfil</h2>
                    <div class="flex items-center space-x-4">
                        <div class="bg-[#4A4A4A] rounded-full p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-lg font-medium">{{ Auth::user()->name }}</p>
                            <p class="text-gray-400">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('profile.edit') }}" class="inline-block bg-[#4A4A4A] hover:bg-[#555555] text-white px-4 py-2 rounded-md transition-colors">Editar perfil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
