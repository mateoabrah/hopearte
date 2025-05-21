@extends('layouts.admin')

@section('header', 'Panel de Control')

@section('content')
<div class="bg-[#3A3A3A] p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-[#FFD700]">Bienvenido al Panel de Administración</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-1 lg:grid-cols-1 gap-6">
        <!-- Solo mostramos la opción de Banner principal -->
        <div class="bg-[#2E2E2E] p-6 rounded-lg shadow border border-[#4A4A4A] hover:border-[#FFD700] transition-all">
            <h3 class="text-lg font-semibold mb-2">Banner Principal</h3>
            <p class="text-gray-400">Gestiona las imágenes y mensajes del banner principal del sitio.</p>
            <div class="mt-4">
                <a href="{{ route('admin.banner.index') }}" class="text-[#FFD700] hover:underline">Administrar banner →</a>
            </div>
        </div>
    </div>
    
    <!-- Opcional: Añadir estadísticas básicas del sitio -->
    <div class="mt-8 p-6 bg-[#2E2E2E] rounded-lg shadow">
        <h2 class="text-xl font-semibold mb-4 text-[#FFD700]">Estadísticas del sitio</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-[#3A3A3A] p-4 rounded-lg">
                <p class="text-gray-400">Total de usuarios</p>
                <p class="text-2xl font-bold">{{ \App\Models\User::count() }}</p>
            </div>
            
            <div class="bg-[#3A3A3A] p-4 rounded-lg">
                <p class="text-gray-400">Total de cervezas</p>
                <p class="text-2xl font-bold">{{ \App\Models\Beer::count() }}</p>
            </div>
            
            <div class="bg-[#3A3A3A] p-4 rounded-lg">
                <p class="text-gray-400">Total de cervecerías</p>
                <p class="text-2xl font-bold">{{ \App\Models\Brewery::count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection