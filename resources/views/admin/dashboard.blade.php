
@extends('layouts.admin')

@section('header', 'Panel de Control')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
    <!-- Panel de bienvenida y accesos rápidos -->
    <div class="lg:col-span-3">
        <div class="bg-[#3A3A3A] p-4 sm:p-6 rounded-lg shadow-lg mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                <h1 class="text-xl sm:text-2xl font-bold text-[#FFD700]">Bienvenido al Panel de Administración</h1>
                <p class="text-sm text-gray-400 mt-1 sm:mt-0">{{ now()->format('d/m/Y') }}</p>
            </div>
            
            <p class="text-gray-300 mb-4">Desde aquí podrás gestionar todos los aspectos de tu sitio Hopearte.</p>
            
            <!-- Tarjetas de acceso rápido -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <a href="{{ route('admin.banner.index') }}" class="bg-[#2E2E2E] p-4 rounded-lg border border-[#4A4A4A] hover:border-[#FFD700] transition-all flex items-start">
                    <div class="w-10 h-10 rounded-full bg-[#FFD700] bg-opacity-20 flex items-center justify-center mr-3">
                        <i class="fas fa-images text-[#FFD700]"></i>
                    </div>
                    <div>
                        <h3 class="font-medium mb-1">Banner Principal</h3>
                        <p class="text-xs text-gray-400">Gestiona el banner principal</p>
                    </div>
                </a>
                
                <a href="#" class="bg-[#2E2E2E] p-4 rounded-lg border border-[#4A4A4A] hover:border-[#FFD700] transition-all flex items-start">
                    <div class="w-10 h-10 rounded-full bg-[#FFD700] bg-opacity-20 flex items-center justify-center mr-3">
                        <i class="fas fa-beer text-[#FFD700]"></i>
                    </div>
                    <div>
                        <h3 class="font-medium mb-1">Cervezas</h3>
                        <p class="text-xs text-gray-400">Gestiona el catálogo</p>
                    </div>
                </a>
                
                <a href="#" class="bg-[#2E2E2E] p-4 rounded-lg border border-[#4A4A4A] hover:border-[#FFD700] transition-all flex items-start">
                    <div class="w-10 h-10 rounded-full bg-[#FFD700] bg-opacity-20 flex items-center justify-center mr-3">
                        <i class="fas fa-industry text-[#FFD700]"></i>
                    </div>
                    <div>
                        <h3 class="font-medium mb-1">Cervecerías</h3>
                        <p class="text-xs text-gray-400">Administra cervecerías</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- Estadísticas del sitio con visualización mejorada -->
        <div class="bg-[#3A3A3A] p-4 sm:p-6 rounded-lg shadow-lg">
            <h2 class="text-lg sm:text-xl font-semibold mb-4 text-[#FFD700] border-b border-[#4A4A4A] pb-2">Estadísticas del sitio</h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-[#2E2E2E] p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-gray-400 text-sm">Total de usuarios</p>
                        <div class="w-8 h-8 rounded-full bg-blue-500 bg-opacity-20 flex items-center justify-center">
                            <i class="fas fa-users text-blue-400 text-sm"></i>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">{{ \App\Models\User::count() }}</p>
                    <div class="mt-2 text-xs text-gray-500">
                        <span class="text-green-400"><i class="fas fa-arrow-up mr-1"></i>5%</span> vs mes anterior
                    </div>
                </div>
                
                <div class="bg-[#2E2E2E] p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-gray-400 text-sm">Total de cervezas</p>
                        <div class="w-8 h-8 rounded-full bg-amber-500 bg-opacity-20 flex items-center justify-center">
                            <i class="fas fa-beer text-amber-400 text-sm"></i>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">{{ \App\Models\Beer::count() }}</p>
                    <div class="mt-2 text-xs text-gray-500">
                        <span class="text-green-400"><i class="fas fa-arrow-up mr-1"></i>12%</span> vs mes anterior
                    </div>
                </div>
                
                <div class="bg-[#2E2E2E] p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-gray-400 text-sm">Total de cervecerías</p>
                        <div class="w-8 h-8 rounded-full bg-purple-500 bg-opacity-20 flex items-center justify-center">
                            <i class="fas fa-industry text-purple-400 text-sm"></i>
                        </div>
                    </div>
                    <p class="text-2xl font-bold">{{ \App\Models\Brewery::count() }}</p>
                    <div class="mt-2 text-xs text-gray-500">
                        <span class="text-green-400"><i class="fas fa-arrow-up mr-1"></i>8%</span> vs mes anterior
                    </div>
                </div>
            </div>
            
            <!-- Gráfico simple de actividad reciente -->
            <div class="mt-6">
                <h3 class="text-sm font-medium text-gray-300 mb-3">Actividad reciente</h3>
                <div class="bg-[#2E2E2E] rounded-lg p-4 h-48 flex items-center justify-center">
                    <div class="text-center">
                        <div class="flex items-center justify-center gap-1 mb-2">
                            @for ($i = 1; $i <= 20; $i++)
                                <div class="w-2 bg-[#FFD700] opacity-{{ rand(20, 80) }}" style="height: {{ rand(10, 40) }}px;"></div>
                            @endfor
                        </div>
                        <p class="text-xs text-gray-400">Gráfico de visitas en los últimos 30 días</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Panel lateral derecho con actividad reciente y recursos -->
    <div class="lg:col-span-1">
        <!-- Usuario y resumen -->
        <div class="bg-[#3A3A3A] p-4 rounded-lg shadow-lg mb-6">
            <div class="flex items-center mb-4">
                <div class="h-12 w-12 rounded-full bg-[#2E2E2E] flex items-center justify-center text-lg font-medium mr-3">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div>
                    <h3 class="font-medium">{{ Auth::user()->name }}</h3>
                    <p class="text-xs text-gray-400">Administrador</p>
                </div>
            </div>
            <div class="pt-3 border-t border-[#4A4A4A]">
                <div class="flex justify-between text-sm mb-2">
                    <span class="text-gray-400">Último acceso:</span>
                    <span>{{ now()->subHours(rand(1, 24))->format('d/m H:i') }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Rol:</span>
                    <span class="px-2 py-0.5 bg-[#FFD700] bg-opacity-20 text-[#FFD700] rounded text-xs">Admin</span>
                </div>
            </div>
        </div>
        
        <!-- Actividad reciente -->
        <div class="bg-[#3A3A3A] p-4 rounded-lg shadow-lg mb-6">
            <h3 class="font-medium mb-3 text-[#FFD700]">Actividad reciente</h3>
            <div class="space-y-3">
                <div class="flex items-start">
                    <div class="w-8 h-8 rounded-full bg-green-500 bg-opacity-20 flex items-center justify-center mr-2 mt-0.5">
                        <i class="fas fa-plus text-green-400 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm">Nueva cerveza añadida</p>
                        <p class="text-xs text-gray-400">Hace 2 horas</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="w-8 h-8 rounded-full bg-blue-500 bg-opacity-20 flex items-center justify-center mr-2 mt-0.5">
                        <i class="fas fa-edit text-blue-400 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm">Banner actualizado</p>
                        <p class="text-xs text-gray-400">Hace 1 día</p>
                    </div>
                </div>
                <div class="flex items-start">
                    <div class="w-8 h-8 rounded-full bg-amber-500 bg-opacity-20 flex items-center justify-center mr-2 mt-0.5">
                        <i class="fas fa-user text-amber-400 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-sm">Nuevo usuario registrado</p>
                        <p class="text-xs text-gray-400">Hace 3 días</p>
                    </div>
                </div>
            </div>
            <div class="mt-3 pt-3 border-t border-[#4A4A4A]">
                <a href="#" class="text-[#FFD700] hover:underline text-xs">Ver todas las actividades →</a>
            </div>
        </div>
        
        <!-- Recursos rápidos -->
        <div class="bg-[#3A3A3A] p-4 rounded-lg shadow-lg">
            <h3 class="font-medium mb-3 text-[#FFD700]">Recursos rápidos</h3>
            <div class="space-y-2">
                <a href="#" class="block p-2 bg-[#2E2E2E] rounded hover:bg-[#333] text-sm">
                    <i class="fas fa-book-open mr-2 text-gray-400"></i>
                    Documentación
                </a>
                <a href="#" class="block p-2 bg-[#2E2E2E] rounded hover:bg-[#333] text-sm">
                    <i class="fas fa-cog mr-2 text-gray-400"></i>
                    Configuración
                </a>
                <a href="#" class="block p-2 bg-[#2E2E2E] rounded hover:bg-[#333] text-sm">
                    <i class="fas fa-question-circle mr-2 text-gray-400"></i>
                    Ayuda y soporte
                </a>
            </div>
        </div>
    </div>
</div>
@endsection