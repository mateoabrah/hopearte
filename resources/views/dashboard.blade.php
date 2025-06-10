
@extends('layouts.app')

@section('content')
<div class="py-8 mt-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-[#2E2E2E] overflow-hidden shadow-sm rounded-lg">
            <div class="p-5">
                <h1 class="text-xl font-bold text-[#FFD700] mb-4">Panel de Control</h1>
                
                <!-- Perfil simplificado -->
                <div class="bg-[#3A3A3A] p-4 rounded-lg shadow-sm mb-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="bg-[#4A4A4A] rounded-full p-2.5">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-medium text-white">{{ Auth::user()->name }}</p>
                                <p class="text-gray-400 text-sm">{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="bg-[#4A4A4A] hover:bg-[#555555] text-white px-3 py-1.5 rounded text-sm transition-colors flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Editar perfil
                        </a>
                    </div>
                </div>
                
                <!-- Grid de accesos rápidos -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
                    <!-- Cervezas favoritas -->
                    <div class="bg-[#3A3A3A] p-4 rounded-lg shadow-sm flex flex-col justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-[#FFD700] mb-1">Cervezas Favoritas</h2>
                            <p class="text-gray-300 text-sm mb-3">Accede a tu colección de cervezas favoritas</p>
                        </div>
                        <a href="{{ route('user.beer_favorites') }}" class="inline-flex items-center bg-[#4A4A4A] hover:bg-[#555555] text-white px-3 py-1.5 rounded text-sm transition-colors self-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            Ver favoritos
                        </a>
                    </div>
                    
                    <!-- Cervecerías favoritas -->
                    <div class="bg-[#3A3A3A] p-4 rounded-lg shadow-sm flex flex-col justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-[#FFD700] mb-1">Cervecerías Favoritas</h2>
                            <p class="text-gray-300 text-sm mb-3">Descubre tus cervecerías guardadas</p>
                        </div>
                        <a href="{{ route('user.brewery_favorites') }}" class="inline-flex items-center bg-[#4A4A4A] hover:bg-[#555555] text-white px-3 py-1.5 rounded text-sm transition-colors self-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            Ver favoritos
                        </a>
                    </div>
                    
                    <!-- Explorar cervezas -->
                    <div class="bg-[#3A3A3A] p-4 rounded-lg shadow-sm flex flex-col justify-between">
                        <div>
                            <h2 class="text-lg font-semibold text-[#FFD700] mb-1">Explorar Cervezas</h2>
                            <p class="text-gray-300 text-sm mb-3">Descubre nuevas cervezas artesanales</p>
                        </div>
                        <a href="{{ route('beers.index') }}" class="inline-flex items-center bg-[#4A4A4A] hover:bg-[#555555] text-white px-3 py-1.5 rounded text-sm transition-colors self-start">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Explorar
                        </a>
                    </div>
                </div>
                
                <!-- Enlaces rápidos -->
                <div class="bg-[#3A3A3A] p-4 rounded-lg shadow-sm">
                    <h2 class="text-lg font-semibold text-[#FFD700] mb-2">Enlaces Rápidos</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 text-sm">
                        @if(auth()->user()->is_company)
                            <a href="{{ route('my_breweries') }}" class="bg-[#4A4A4A] hover:bg-[#555555] text-white px-3 py-2 rounded transition-colors text-center">
                                Mis cervecerías
                            </a>
                        @endif
                        <a href="{{ route('breweries.index') }}" class="bg-[#4A4A4A] hover:bg-[#555555] text-white px-3 py-2 rounded transition-colors text-center">
                            Explorar cervecerías
                        </a>
                       
                        <a href="{{ route('beer_categories.index') }}" class="bg-[#4A4A4A] hover:bg-[#555555] text-white px-3 py-2 rounded transition-colors text-center">
                            Categorías de cervezas
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection