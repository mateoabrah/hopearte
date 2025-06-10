
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Administración</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome para iconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Tailwind CSS (usando CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#FFD700',
                        secondary: '#FFA500',
                        dark: '#1A1A1A',
                        darkgray: '#2E2E2E',
                        mediumgray: '#3A3A3A',
                        lightgray: '#4A4A4A'
                    }
                }
            }
        }
    </script>

    <!-- Styles adicionales -->
    <style>
        /* Estilos para el texto del logo */
        .logo-text {
            background: linear-gradient(to right, #FFD700, #FFA500);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gradient-to-b from-[#1A1A1A] to-[#2E2E2E] text-white min-h-screen flex flex-col">
    <!-- Navegación horizontal -->
    <nav class="bg-[#1A1A1A] border-b border-[#333] shadow-md">
        <div class="max-w-full mx-auto px-4 sm:px-6">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="font-bold text-lg flex items-center">
                            <span class="logo-text">Hopearte</span>
                            <span class="text-gray-400 text-xs font-normal ml-1">Admin</span>
                        </a>
                    </div>
                    
                    <!-- Enlaces de navegación -->
                    <div class="hidden md:ml-10 md:flex md:space-x-4">
                        <a href="{{ route('admin.dashboard') }}" class="{{ Route::is('admin.dashboard') ? 'text-[#FFD700] border-b-2 border-[#FFD700]' : 'text-gray-300 hover:text-[#FFD700]' }} px-3 py-2 text-sm font-medium">
                            <i class="fas fa-tachometer-alt mr-1"></i> Panel de Control
                        </a>
                        <a href="{{ route('admin.banner.index') }}" class="{{ Route::is('admin.banner.*') ? 'text-[#FFD700] border-b-2 border-[#FFD700]' : 'text-gray-300 hover:text-[#FFD700]' }} px-3 py-2 text-sm font-medium">
                            <i class="fas fa-images mr-1"></i> Gestionar Banner
                        </a>
                        <a href="{{ route('welcome') }}" class="text-gray-300 hover:text-[#FFD700] px-3 py-2 text-sm font-medium">
                            <i class="fas fa-home mr-1"></i> Volver al sitio
                        </a>
                    </div>
                </div>
                
                <!-- Menú de usuario -->
                <div class="flex items-center" x-data="{ open: false }">
                    <div class="ml-3 relative">
                        <button @click="open = !open" class="flex items-center text-white focus:outline-none group">
                            <span class="hidden md:inline-block text-sm mr-2 group-hover:text-[#FFD700] transition-colors">{{ Auth::user()->name }}</span>
                            <div class="h-8 w-8 rounded-full bg-gradient-to-r from-[#FFD700] to-[#FFA500] bg-opacity-20 flex items-center justify-center text-sm font-medium text-[#FFD700]">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <i class="fas fa-chevron-down text-xs ml-1 group-hover:text-[#FFD700] transition-colors"></i>
                        </button>
                        
                        <!-- Menú desplegable - Con opciones administrativas añadidas -->
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 py-2 w-48 bg-[#1A1A1A] rounded-md shadow-lg z-10 border border-[#333]" style="display: none;">
                            <!-- Opciones de administración -->
                            <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700] transition-colors">
                                <i class="fas fa-tachometer-alt mr-2"></i> Panel de Control
                            </a>
                            <a href="{{ route('admin.banner.index') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700] transition-colors">
                                <i class="fas fa-images mr-2"></i> Gestionar Banner
                            </a>
                            <div class="border-t border-[#333] my-1"></div>
                            
                            <!-- Opciones de usuario comunes -->
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700] transition-colors">
                                <i class="fas fa-tachometer-alt mr-2"></i> Panel Principal
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700] transition-colors">
                                <i class="fas fa-user-edit mr-2"></i> Editar Perfil
                            </a>
                            <a href="{{ route('user.beer_favorites') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700] transition-colors">
                                <i class="fas fa-beer mr-2"></i> Cervezas Favoritas
                            </a>
                            <a href="{{ route('user.brewery_favorites') }}" class="block px-4 py-2 text-sm text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700] transition-colors">
                                <i class="fas fa-industry mr-2"></i> Cervecerías Favoritas
                            </a>
                            <div class="border-t border-[#333] my-1"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700] transition-colors">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Botón móvil menu -->
                <div class="flex items-center md:hidden" x-data="{ open: false }">
                    <button @click="open = !open" type="button" class="text-gray-400 hover:text-white focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <!-- Menú móvil -->
                    <div x-show="open" @click.away="open = false" class="absolute top-16 right-0 left-0 bg-[#1A1A1A] shadow-md z-10">
                        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                            <a href="{{ route('admin.dashboard') }}" class="{{ Route::is('admin.dashboard') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-300 hover:bg-[#2E2E2E] hover:text-[#FFD700]' }} block px-3 py-2 rounded-md text-base font-medium">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </a>
                            <a href="{{ route('admin.banner.index') }}" class="{{ Route::is('admin.banner.*') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-300 hover:bg-[#2E2E2E] hover:text-[#FFD700]' }} block px-3 py-2 rounded-md text-base font-medium">
                                <i class="fas fa-images mr-2"></i> Gestionar Banner
                            </a>
                            <a href="{{ route('welcome') }}" class="text-gray-300 hover:bg-[#2E2E2E] hover:text-[#FFD700] block px-3 py-2 rounded-md text-base font-medium">
                                <i class="fas fa-home mr-2"></i> Volver al sitio
                            </a>
                        </div>
                        <div class="pt-4 pb-3 border-t border-[#333]">
                            <div class="flex items-center px-5">
                                <div class="h-8 w-8 rounded-full bg-gradient-to-r from-[#FFD700] to-[#FFA500] bg-opacity-20 flex items-center justify-center text-sm font-medium text-[#FFD700]">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="ml-3">
                                    <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                                    <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
                                </div>
                            </div>
                            <!-- Menú móvil de usuario actualizado con opciones de administración -->
                            <div class="mt-3 px-2 space-y-1">
                                <!-- Opciones de administración -->
                                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700]">
                                    <i class="fas fa-tachometer-alt mr-2"></i> Panel de Control
                                </a>
                                <a href="{{ route('admin.banner.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700]">
                                    <i class="fas fa-images mr-2"></i> Gestionar Banner
                                </a>
                                <div class="border-t border-[#333] my-1"></div>
                                
                                <!-- Opciones de usuario comunes -->
                                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700]">
                                    <i class="fas fa-tachometer-alt mr-2"></i> Panel Principal
                                </a>
                                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700]">
                                    <i class="fas fa-user-edit mr-2"></i> Editar Perfil
                                </a>
                                <a href="{{ route('user.beer_favorites') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700]">
                                    <i class="fas fa-beer mr-2"></i> Cervezas Favoritas
                                </a>
                                <a href="{{ route('user.brewery_favorites') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700]">
                                    <i class="fas fa-industry mr-2"></i> Cervecerías Favoritas
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700]">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Contenido principal -->
    <div class="flex-1">
        <!-- Encabezado de la página -->
        <header class="bg-[#2E2E2E] p-4 shadow-md">
            <div class="max-w-full mx-auto px-4 sm:px-6">
                <h2 class="text-lg font-semibold text-[#FFD700]">@yield('header', 'Panel de Administración')</h2>
                @if (isset($breadcrumb))
                <div class="text-xs text-gray-400 mt-1">
                    {{ $breadcrumb }}
                </div>
                @endif
            </div>
        </header>
        
        <!-- Contenido principal -->
        <main class="p-4 sm:p-6 flex-grow">
            <div class="max-w-full mx-auto px-0 sm:px-6">
                @if (session('success') && !session()->has('success_displayed'))
                    <div class="bg-green-600 text-white p-3 mb-4 rounded-md">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                    {{ session()->flash('success_displayed', true) }}
                @endif
                
                @if (session('error') && !session()->has('error_displayed'))
                    <div class="bg-red-600 text-white p-3 mb-4 rounded-md">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle mr-2"></i>
                            <span>{{ session('error') }}</span>
                        </div>
                    </div>
                    {{ session()->flash('error_displayed', true) }}
                @endif
                
                @yield('content')
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="bg-[#1A1A1A] border-t border-[#333] py-3">
            <div class="max-w-full mx-auto px-4 sm:px-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-gray-400 text-xs">
                        &copy; {{ date('Y') }} Hopearte - Panel de Administración
                    </div>
                    <div class="mt-2 md:mt-0 text-xs">
                        <a href="{{ route('welcome') }}" class="text-gray-400 hover:text-[#FFD700] transition-colors">
                            <i class="fas fa-home mr-1"></i> Volver al sitio
                        </a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Scripts adicionales específicos de cada página -->
    @stack('scripts')
</body>
</html>