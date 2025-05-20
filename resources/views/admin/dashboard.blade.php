@extends('layouts.admin')

@section('header', 'Panel de Control')

@section('content')
<div class="bg-[#3A3A3A] p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-[#FFD700]">Bienvenido al Panel de Administración</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-[#2E2E2E] p-6 rounded-lg shadow border border-[#4A4A4A] hover:border-[#FFD700] transition-all">
            <h3 class="text-lg font-semibold mb-2">Cervezas</h3>
            <p class="text-gray-400">Gestiona todas las cervezas del catálogo.</p>
            <div class="mt-4">
                <a href="{{ route('beers.index') }}" class="text-[#FFD700] hover:underline">Ver cervezas →</a>
            </div>
        </div>
        
        <div class="bg-[#2E2E2E] p-6 rounded-lg shadow border border-[#4A4A4A] hover:border-[#FFD700] transition-all">
            <h3 class="text-lg font-semibold mb-2">Categorías</h3>
            <p class="text-gray-400">Administra las categorías de cervezas.</p>
            <div class="mt-4">
                <a href="{{ route('beer_categories.index') }}" class="text-[#FFD700] hover:underline">Ver categorías →</a>
            </div>
        </div>
        
        <div class="bg-[#2E2E2E] p-6 rounded-lg shadow border border-[#4A4A4A] hover:border-[#FFD700] transition-all">
            <h3 class="text-lg font-semibold mb-2">Cervecerías</h3>
            <p class="text-gray-400">Gestiona las cervecerías registradas.</p>
            <div class="mt-4">
                <a href="{{ route('breweries.index') }}" class="text-[#FFD700] hover:underline">Ver cervecerías →</a>
            </div>
        </div>
        
        <div class="bg-[#2E2E2E] p-6 rounded-lg shadow border border-[#4A4A4A] hover:border-[#FFD700] transition-all">
            <h3 class="text-lg font-semibold mb-2">Banner Principal</h3>
            <p class="text-gray-400">Administra las cervezas que aparecen en el banner.</p>
            <div class="mt-4">
                <a href="{{ route('admin.banner.index') }}" class="text-[#FFD700] hover:underline">Gestionar banner →</a>
            </div>
        </div>
    </div>
</div>
@endsection