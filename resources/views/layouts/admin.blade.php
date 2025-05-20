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
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gradient-to-b from-[#1A1A1A] to-[#2E2E2E] text-white">
    <div class="min-h-screen flex">
        <!-- Sidebar de administración -->
        <aside class="w-64 bg-[#1A1A1A] min-h-screen p-4">
            <div class="mb-8">
                <h1 class="text-xl font-bold text-[#FFD700]">Hopearte Admin</h1>
            </div>
            
            <!-- Menú de navegación -->
            <nav>
                <ul class="space-y-2">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('admin.dashboard') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700]' }} flex items-center p-2 rounded-md transition-colors" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('beer_categories.*') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700]' }} flex items-center p-2 rounded-md transition-colors" href="{{ route('beer_categories.index') }}">
                            <i class="fas fa-tags mr-2"></i> Categorías
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('beers.*') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700]' }} flex items-center p-2 rounded-md transition-colors" href="{{ route('beers.index') }}">
                            <i class="fas fa-beer mr-2"></i> Cervezas
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('breweries.*') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700]' }} flex items-center p-2 rounded-md transition-colors" href="{{ route('breweries.index') }}">
                            <i class="fas fa-industry mr-2"></i> Cervecerías
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('admin.banner.*') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700]' }} flex items-center p-2 rounded-md transition-colors" href="{{ route('admin.banner.index') }}">
                            <i class="fas fa-images mr-2"></i> Gestionar Banner
                        </a>
                    </li>
                    
                    <li class="nav-item mt-8">
                        <a class="nav-link text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700] flex items-center p-2 rounded-md transition-colors" href="{{ route('welcome') }}">
                            <i class="fas fa-home mr-2"></i> Volver al sitio
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>
        
        <!-- Contenido principal -->
        <div class="flex-1">
            <!-- Barra superior -->
            <header class="bg-[#2E2E2E] p-4 shadow">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-semibold">@yield('header', 'Panel de Administración')</h2>
                    
                    <!-- Menú de usuario -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-white focus:outline-none">
                            <span class="mr-2">{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        <!-- Menú desplegable -->
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 py-2 w-48 bg-[#1A1A1A] rounded-md shadow-lg z-10">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-gray-400 hover:bg-[#2E2E2E] hover:text-[#FFD700]">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Cerrar sesión
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </header>
            
            <!-- Contenido -->
            <main class="p-6">
                @if (session('success'))
                    <div class="bg-green-600 text-white p-4 mb-6 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if (session('error'))
                    <div class="bg-red-600 text-white p-4 mb-6 rounded-md">
                        {{ session('error') }}
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Scripts adicionales específicos de cada página -->
    @stack('scripts')
</body>
</html>