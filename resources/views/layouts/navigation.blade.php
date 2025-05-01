<nav class="bg-[#1A1A1A] text-white p-4 fixed top-0 left-0 w-full z-50 shadow-lg transition-all duration-300 ease-in-out">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="{{ route('welcome') }}" class="text-2xl font-bold text-[#FFD700] hover:text-[#FAC843] transition-all duration-300 ease-in-out">
            Hopearte
        </a>

        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center">
            <ul class="flex space-x-6 mr-6">
                <li>
                    <a href="{{ route('welcome') }}" 
                       class="text-lg hover:text-[#FFD700] transition-all duration-300 ease-in-out 
                       {{ request()->routeIs('welcome') ? 'text-[#FFD700]' : '' }}">
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="{{ route('beers.index') }}" 
                       class="text-lg hover:text-[#FFD700] transition-all duration-300 ease-in-out
                       {{ request()->routeIs('beers.*') ? 'text-[#FFD700]' : '' }}">
                        Cervezas
                    </a>
                </li>
                <li>
                    <a href="{{ route('breweries.index') }}" 
                       class="text-lg hover:text-[#FFD700] transition-all duration-300 ease-in-out
                       {{ request()->routeIs('breweries.*') ? 'text-[#FFD700]' : '' }}">
                        Cervecerías
                    </a>
                </li>
                @auth
                    @if(Auth::user()->role === 'admin')
                        <li>
                            <a href="{{ route('dashboard') }}" 
                               class="text-lg hover:text-[#FFD700] transition-all duration-300 ease-in-out
                               {{ request()->routeIs('dashboard') ? 'text-[#FFD700]' : '' }}">
                                Panel Admin
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            <!-- Auth Links -->
            <div class="flex items-center space-x-3">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-1 bg-[#3A3A3A] hover:bg-[#444444] py-1 px-3 rounded-full transition-all duration-300 ease-in-out">
                            <span class="text-[#FFD700]">{{ Auth::user()->name }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-[#FFD700]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-[#3A3A3A] rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-white hover:bg-[#444444]">
                                Mi Perfil
                            </a>
                            <a href="{{ route('user.beer_favorites') }}" class="block px-4 py-2 text-sm text-white hover:bg-[#444444]">
                                Cervezas Favoritas
                            </a>
                            <a href="{{ route('user.brewery_favorites') }}" class="block px-4 py-2 text-sm text-white hover:bg-[#444444]">
                                Cervecerías Favoritas
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-white hover:bg-[#444444]">
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm border border-[#FFD700] text-[#FFD700] hover:bg-[#FFD700] hover:text-[#2E2E2E] py-1 px-3 rounded-full transition-all duration-300 ease-in-out">
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="text-sm bg-[#2E2E2E] border border-[#CCCCCC] text-[#CCCCCC] hover:bg-[#3A3A3A] py-1 px-3 rounded-full transition-all duration-300 ease-in-out">
                        Registrarse
                    </a>
                @endauth
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button @click="navOpen = !navOpen" class="text-white focus:outline-none" x-data="{ navOpen: false }">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div class="md:hidden absolute w-full left-0 bg-[#2E2E2E] shadow-lg mt-2 hidden" x-show="navOpen" @click.away="navOpen = false" x-data="{ navOpen: false }">
        <ul class="flex flex-col space-y-2 p-4">
            <li>
                <a href="{{ route('welcome') }}" class="block py-2 text-white hover:text-[#FFD700]">Inicio</a>
            </li>
            <li>
                <a href="{{ route('beers.index') }}" class="block py-2 text-white hover:text-[#FFD700]">Cervezas</a>
            </li>
            <li>
                <a href="{{ route('breweries.index') }}" class="block py-2 text-white hover:text-[#FFD700]">Cervecerías</a>
            </li>
            @auth
                @if(Auth::user()->role === 'admin')
                    <li>
                        <a href="{{ route('dashboard') }}" class="block py-2 text-white hover:text-[#FFD700]">Panel Admin</a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('profile.edit') }}" class="block py-2 text-white hover:text-[#FFD700]">Mi Perfil</a>
                </li>
                <li>
                    <a href="{{ route('user.favorites') }}" class="block py-2 text-white hover:text-[#FFD700]">Mis Favoritos</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left py-2 text-white hover:text-[#FFD700]">
                            Cerrar Sesión
                        </button>
                    </form>
                </li>
            @else
                <li class="pt-2 border-t border-gray-700 mt-2">
                    <a href="{{ route('login') }}" class="block py-2 text-[#FFD700] hover:underline">Iniciar Sesión</a>
                </li>
                <li>
                    <a href="{{ route('register') }}" class="block py-2 text-[#CCCCCC] hover:underline">Registrarse</a>
                </li>
            @endauth
        </ul>
    </div>
</nav>

<!-- Spacer to prevent content from hiding under fixed nav -->
<div class="h-16"></div>

<!-- En app.blade.php, añade justo después del script de Tailwind -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
