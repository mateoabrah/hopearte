@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-[#2E2E2E] rounded-lg overflow-hidden shadow-xl mb-8">
        <div class="p-8">
            <h1 class="text-3xl font-bold text-[#FFD700] mb-6">Mi Perfil</h1>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Columna de información personal -->
                <div class="lg:col-span-2">
                    <div class="bg-[#3A3A3A] rounded-xl p-6 shadow-lg mb-6">
                        <h2 class="text-2xl font-semibold text-[#FFD700] mb-4">Información Personal</h2>
                        
                        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                            @csrf
                            @method('patch')
                            
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-300">Nombre</label>
                                <input id="name" name="name" type="text" value="{{ old('name', auth()->user()->name) }}" required autofocus 
                                    class="mt-1 block w-full rounded-md bg-[#2A2A2A] border-gray-700 text-white shadow-sm focus:border-[#FFD700] focus:ring focus:ring-[#FFD700] focus:ring-opacity-50">
                                @error('name')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                                <input id="email" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" required 
                                    class="mt-1 block w-full rounded-md bg-[#2A2A2A] border-gray-700 text-white shadow-sm focus:border-[#FFD700] focus:ring focus:ring-[#FFD700] focus:ring-opacity-50">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#FFD700] border border-transparent rounded-md font-semibold text-[#2E2E2E] hover:bg-amber-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FFD700]">
                                    Guardar cambios
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="bg-[#3A3A3A] rounded-xl p-6 shadow-lg">
                        <h2 class="text-2xl font-semibold text-[#FFD700] mb-4">Cambiar Contraseña</h2>
                        
                        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                            @csrf
                            @method('put')
                            
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-300">Contraseña actual</label>
                                <input id="current_password" name="current_password" type="password" required 
                                    class="mt-1 block w-full rounded-md bg-[#2A2A2A] border-gray-700 text-white shadow-sm focus:border-[#FFD700] focus:ring focus:ring-[#FFD700] focus:ring-opacity-50">
                                @error('current_password')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-300">Nueva contraseña</label>
                                <input id="password" name="password" type="password" required 
                                    class="mt-1 block w-full rounded-md bg-[#2A2A2A] border-gray-700 text-white shadow-sm focus:border-[#FFD700] focus:ring focus:ring-[#FFD700] focus:ring-opacity-50">
                                @error('password')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirmar nueva contraseña</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" required 
                                    class="mt-1 block w-full rounded-md bg-[#2A2A2A] border-gray-700 text-white shadow-sm focus:border-[#FFD700] focus:ring focus:ring-[#FFD700] focus:ring-opacity-50">
                                @error('password_confirmation')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#FFD700] border border-transparent rounded-md font-semibold text-[#2E2E2E] hover:bg-amber-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#FFD700]">
                                    Actualizar contraseña
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Columna de estadísticas del usuario -->
                <div>
                    <div class="bg-[#3A3A3A] rounded-xl p-6 shadow-lg mb-6">
                        <div class="flex flex-col items-center">
                            <div class="w-32 h-32 rounded-full bg-[#2A2A2A] flex items-center justify-center text-4xl text-[#FFD700] mb-4">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                            <h3 class="text-xl font-semibold text-white">{{ auth()->user()->name }}</h3>
                            <p class="text-gray-400">{{ auth()->user()->email }}</p>
                            
                            <div class="mt-4 text-gray-300">
                                <p>Miembro desde: {{ auth()->user()->created_at->format('d/m/Y') }}</p>
                                
                                @if(auth()->user()->is_company)
                                    <p class="mt-2 inline-flex items-center bg-blue-600 text-white px-3 py-1 rounded-full text-sm">
                                        Cuenta de empresa
                                    </p>
                                @elseif(auth()->user()->is_admin)
                                    <p class="mt-2 inline-flex items-center bg-red-600 text-white px-3 py-1 rounded-full text-sm">
                                        Administrador
                                    </p>
                                @else
                                    <p class="mt-2 inline-flex items-center bg-green-600 text-white px-3 py-1 rounded-full text-sm">
                                        Usuario
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-[#3A3A3A] rounded-xl p-6 shadow-lg">
                        <h3 class="text-xl font-semibold text-[#FFD700] mb-4">Estadísticas</h3>
                        
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-3 bg-[#2A2A2A] rounded-lg">
                                <span class="text-gray-300">Reseñas</span>
                                <span class="text-white font-bold">{{ auth()->user()->reviews->count() }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center p-3 bg-[#2A2A2A] rounded-lg">
                                <span class="text-gray-300">Cervezas favoritas</span>
                                <span class="text-white font-bold">{{ auth()->user()->favoritedBeers->count() }}</span>
                            </div>
                            
                            <div class="flex justify-between items-center p-3 bg-[#2A2A2A] rounded-lg">
                                <span class="text-gray-300">Cervecerías favoritas</span>
                                <span class="text-white font-bold">{{ auth()->user()->favoritedBreweries->count() }}</span>
                            </div>
                            
                            @if(auth()->user()->is_company)
                                <div class="flex justify-between items-center p-3 bg-[#2A2A2A] rounded-lg">
                                    <span class="text-gray-300">Mis cervecerías</span>
                                    <span class="text-white font-bold">{{ auth()->user()->breweries->count() }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center p-3 bg-[#2A2A2A] rounded-lg">
                                    <span class="text-gray-300">Mis cervezas</span>
                                    <span class="text-white font-bold">{{ auth()->user()->breweries->flatMap->beers->count() }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="mt-6">
                        <form method="POST" action="{{ route('profile.destroy') }}" class="p-6 bg-[#3A3A3A] rounded-xl border border-red-700">
                            @csrf
                            @method('delete')
                            
                            <h2 class="text-lg font-medium text-red-500">Eliminar cuenta</h2>
                            
                            <p class="mt-1 text-sm text-gray-400">
                                Una vez que se elimine tu cuenta, todos tus recursos y datos se eliminarán permanentemente.
                            </p>
                            
                            <div class="mt-6 flex justify-end">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500"
                                        onclick="return confirm('¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.')">
                                    Eliminar cuenta
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
