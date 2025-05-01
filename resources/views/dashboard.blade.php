@extends('layouts.app')

@section('content')
<div class="py-12 bg-[#2E2E2E]">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-[#3A3A3A] overflow-hidden shadow-xl rounded-lg p-6">
            <h2 class="text-3xl font-bold text-[#FFD700] mb-6">Bienvenido a HopeArte</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tarjeta de estadísticas 1 -->
                <div class="bg-[#2E2E2E] p-6 rounded-lg shadow-md hover:shadow-lg transition-all" data-aos="fade-up">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-[#FFD700]">Cervezas</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FFD700]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <p class="text-3xl font-bold text-white">24</p>
                    <p class="text-[#CCCCCC] mt-2">Cervezas disponibles</p>
                </div>
                
                <!-- Tarjeta de estadísticas 2 -->
                <div class="bg-[#2E2E2E] p-6 rounded-lg shadow-md hover:shadow-lg transition-all" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-[#FFD700]">Categorías</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FFD700]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <p class="text-3xl font-bold text-white">8</p>
                    <p class="text-[#CCCCCC] mt-2">Categorías disponibles</p>
                </div>
                
                <!-- Tarjeta de estadísticas 3 -->
                <div class="bg-[#2E2E2E] p-6 rounded-lg shadow-md hover:shadow-lg transition-all" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-semibold text-[#FFD700]">Usuarios</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#FFD700]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <p class="text-3xl font-bold text-white">{{ \App\Models\User::count() }}</p>
                    <p class="text-[#CCCCCC] mt-2">Usuarios registrados</p>
                </div>
            </div>
            
            <!-- Accesos rápidos -->
            <div class="mt-10">
                <h3 class="text-2xl font-semibold text-[#FFD700] mb-4">Accesos rápidos</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="{{ route('beers.index') }}" class="bg-[#2E2E2E] p-5 rounded-lg text-center hover:bg-[#444444] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-[#FFD700] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <span class="text-white font-medium">Ver cervezas</span>
                    </a>
                    
                    <a href="{{ route('profile.edit') }}" class="bg-[#2E2E2E] p-5 rounded-lg text-center hover:bg-[#444444] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-[#FFD700] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span class="text-white font-medium">Mi perfil</span>
                    </a>
                    
                    <a href="#" class="bg-[#2E2E2E] p-5 rounded-lg text-center hover:bg-[#444444] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-[#FFD700] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="text-white font-medium">Eventos</span>
                    </a>
                    
                    <a href="#" class="bg-[#2E2E2E] p-5 rounded-lg text-center hover:bg-[#444444] transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-[#FFD700] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-white font-medium">Contacto</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline-block">
                        @csrf
                        <button type="submit" class="w-full bg-[#2E2E2E] p-5 rounded-lg text-center hover:bg-[#444444] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto text-[#FFD700] mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="text-white font-medium">Cerrar sesión</span>
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Actividad reciente -->
            <div class="mt-10">
                <h3 class="text-2xl font-semibold text-[#FFD700] mb-4">Actividad reciente</h3>
                <div class="bg-[#2E2E2E] rounded-lg p-4">
                    <ul class="divide-y divide-gray-700">
                        <li class="py-3 flex items-center">
                            <div class="bg-[#FFD700] rounded-full h-8 w-8 flex items-center justify-center mr-3">
                                <span class="text-[#2E2E2E] font-bold">N</span>
                            </div>
                            <div>
                                <p class="text-white">Nueva cerveza <span class="text-[#FFD700]">Alhambra Reserva 1925</span> añadida</p>
                                <p class="text-[#CCCCCC] text-sm">Hace 2 horas</p>
                            </div>
                        </li>
                        <li class="py-3 flex items-center">
                            <div class="bg-[#FFD700] rounded-full h-8 w-8 flex items-center justify-center mr-3">
                                <span class="text-[#2E2E2E] font-bold">U</span>
                            </div>
                            <div>
                                <p class="text-white">Usuario <span class="text-[#FFD700]">Carlos</span> se ha registrado</p>
                                <p class="text-[#CCCCCC] text-sm">Hace 4 horas</p>
                            </div>
                        </li>
                        <li class="py-3 flex items-center">
                            <div class="bg-[#FFD700] rounded-full h-8 w-8 flex items-center justify-center mr-3">
                                <span class="text-[#2E2E2E] font-bold">C</span>
                            </div>
                            <div>
                                <p class="text-white">Categoría <span class="text-[#FFD700]">IPA</span> actualizada</p>
                                <p class="text-[#CCCCCC] text-sm">Hace 1 día</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts para animaciones AOS -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>
@endsection
