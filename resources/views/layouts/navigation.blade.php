<nav class="bg-[#1A1A1A] text-white fixed top-0 left-0 w-full z-50 shadow-lg border-b border-[#333]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('welcome') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Hopearte Logo" class="h-32 w-auto">
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center">
                <ul class="flex space-x-4 mr-6">
                    <li>
                        <a href="{{ route('welcome') }}"
                            class="nav-link relative px-3 py-5 text-sm font-medium transition-colors inline-block
                           {{ request()->routeIs('welcome') ? 'text-[#FFD700] active' : 'text-gray-300 hover:text-white' }}">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('beers.index') }}"
                            class="nav-link relative px-3 py-5 text-sm font-medium transition-colors inline-block
                           {{ request()->routeIs('beers.*') ? 'text-[#FFD700] active' : 'text-gray-300 hover:text-white' }}">
                            Cervezas
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('beer_categories.index') }}"
                            class="nav-link relative px-3 py-5 text-sm font-medium transition-colors inline-block
                           {{ request()->routeIs('beer_categories.*') ? 'text-[#FFD700] active' : 'text-gray-300 hover:text-white' }}">
                            Categorías
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('breweries.index') }}"
                            class="nav-link relative px-3 py-5 text-sm font-medium transition-colors inline-block
                           {{ request()->routeIs('breweries.*') ? 'text-[#FFD700] active' : 'text-gray-300 hover:text-white' }}">
                            Cervecerías
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->role === 'company' || auth()->user()->role === 'admin')
                            <li>
                                <a href="{{ route('my_breweries') }}"
                                    class="nav-link relative px-3 py-5 text-sm font-medium transition-colors inline-block
                                           {{ request()->routeIs('my_breweries') ? 'text-[#FFD700] active' : 'text-gray-300 hover:text-white' }}">
                                    Mis Cervecerías
                                </a>
                            </li>
                        @endif
                        @if(Auth::user()->role === 'admin')
                            <li>
                                <a href="{{ route('admin.dashboard') }}"
                                    class="nav-link relative px-3 py-5 text-sm font-medium transition-colors inline-block
                                           {{ request()->routeIs('admin.dashboard') ? 'text-[#FFD700] active' : 'text-gray-300 hover:text-white' }}">
                                    <i class="fas fa-tachometer-alt mr-1"></i> Panel de Control
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.banner.index') }}"
                                    class="nav-link relative px-3 py-5 text-sm font-medium transition-colors inline-block
                                           {{ request()->routeIs('admin.banner.*') ? 'text-[#FFD700] active' : 'text-gray-300 hover:text-white' }}">
                                    <i class="fas fa-images mr-1"></i> Gestor Banner
                                </a>
                            </li>
                            <!-- Se ha eliminado el elemento de gestor de categorías -->
                        @endif
                    @endauth
                </ul>

                <!-- Auth Links -->
                <div class="flex items-center space-x-3">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 group focus:outline-none">
                                <div
                                    class="h-8 w-8 rounded-full bg-gradient-to-r from-[#FFD700] to-[#FFA500] bg-opacity-20 flex items-center justify-center text-sm font-medium text-[#FFD700] group-hover:bg-opacity-30 transition-all">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span
                                    class="text-sm group-hover:text-[#FFD700] transition-colors">{{ Auth::user()->name }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 text-gray-400 group-hover:text-[#FFD700] transition-colors" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-[#2E2E2E] rounded-md shadow-lg py-1 z-50 border border-[#444]"
                                style="display: none;">
                                @if(Auth::user()->role === 'admin')
                                    <!-- Opciones de administración -->
                                    <a href="{{ route('admin.dashboard') }}"
                                        class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#3A3A3A] hover:text-white transition-colors">
                                        <i class="fas fa-tachometer-alt mr-2"></i> Panel de Control
                                    </a>
                                    <a href="{{ route('admin.banner.index') }}"
                                        class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#3A3A3A] hover:text-white transition-colors">
                                        <i class="fas fa-images mr-2"></i> Gestionar Banner
                                    </a>
                                    <!-- Se ha eliminado la opción de gestionar categorías -->
                                    <div class="border-t border-[#444] my-1"></div>
                                @endif
                                <a href="{{ route('dashboard') }}"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#3A3A3A] hover:text-white transition-colors">
                                    <i class="fas fa-tachometer-alt mr-2"></i> Panel Principal
                                </a>
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#3A3A3A] hover:text-white transition-colors">
                                    <i class="fas fa-user-edit mr-2"></i> Editar Perfil
                                </a>
                                <a href="{{ route('user.beer_favorites') }}"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#3A3A3A] hover:text-white transition-colors">
                                    <i class="fas fa-beer mr-2"></i> Cervezas Favoritas
                                </a>
                                <a href="{{ route('user.brewery_favorites') }}"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-[#3A3A3A] hover:text-white transition-colors">
                                    <i class="fas fa-industry mr-2"></i> Cervecerías Favoritas
                                </a>
                                <div class="border-t border-[#444] my-1"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-[#3A3A3A] hover:text-white transition-colors">
                                        <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm bg-transparent border border-[#FFD700] text-[#FFD700] hover:bg-[#FFD700] hover:text-[#1A1A1A] px-3 py-1.5 rounded-md transition-colors">
                            Iniciar Sesión
                        </a>
                        <a href="{{ route('register') }}"
                            class="text-sm bg-[#FFD700] text-[#1A1A1A] hover:bg-[#FFA500] px-3 py-1.5 rounded-md font-medium transition-colors">
                            Registrarse
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden" x-data="{ navOpen: false }">
                <button @click="navOpen = !navOpen" class="text-gray-300 hover:text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>

                <!-- Mobile Navigation Menu -->
                <div x-show="navOpen" @click.away="navOpen = false"
                    class="absolute top-16 right-0 left-0 bg-[#1A1A1A] shadow-lg border-b border-[#333]"
                    style="display: none;">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <a href="{{ route('welcome') }}"
                            class="{{ request()->routeIs('welcome') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-300 hover:bg-[#2E2E2E] hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                            Inicio
                        </a>
                        <a href="{{ route('beers.index') }}"
                            class="{{ request()->routeIs('beers.*') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-300 hover:bg-[#2E2E2E] hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                            Cervezas
                        </a>
                        <a href="{{ route('breweries.index') }}"
                            class="{{ request()->routeIs('breweries.*') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-300 hover:bg-[#2E2E2E] hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                            Cervecerías
                        </a>
                        <a href="{{ route('beer_categories.index') }}"
                            class="{{ request()->routeIs('beer_categories.*') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-300 hover:bg-[#2E2E2E] hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                            Categorías
                        </a>

                        @auth
                            @if(auth()->user()->role === 'company' || auth()->user()->role === 'admin')
                                <a href="{{ route('my_breweries') }}"
                                    class="{{ request()->routeIs('my_breweries') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-300 hover:bg-[#2E2E2E] hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                                    Mis Cervecerías
                                </a>
                            @endif
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}"
                                    class="{{ request()->routeIs('admin.dashboard') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-300 hover:bg-[#2E2E2E] hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                                    <i class="fas fa-tachometer-alt mr-2"></i> Panel de Control
                                </a>
                                <a href="{{ route('admin.banner.index') }}"
                                    class="{{ request()->routeIs('admin.banner.*') ? 'bg-[#2E2E2E] text-[#FFD700]' : 'text-gray-300 hover:bg-[#2E2E2E] hover:text-white' }} block px-3 py-2 rounded-md text-base font-medium">
                                    <i class="fas fa-images mr-2"></i> Gestor Banner
                                </a>
                                <!-- Se ha eliminado el enlace al gestor de categorías -->
                            @endif

                            <!-- Sección de usuario móvil -->
                            <div class="pt-4 pb-3 border-t border-[#333] mt-3">
                                <div class="flex items-center px-3">
                                    <div
                                        class="h-10 w-10 rounded-full bg-gradient-to-r from-[#FFD700] to-[#FFA500] bg-opacity-20 flex items-center justify-center text-[#FFD700] font-medium">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <div class="ml-3">
                                        <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                                        <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>
                                    </div>
                                </div>
                                <div class="mt-3 space-y-1 px-2">
                                    @if(Auth::user()->role === 'admin')
                                        <!-- Opciones administrativas para móvil -->
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-[#2E2E2E] hover:text-white">
                                            <i class="fas fa-tachometer-alt mr-2"></i> Panel de Control
                                        </a>
                                        <a href="{{ route('admin.banner.index') }}"
                                            class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-[#2E2E2E] hover:text-white">
                                            <i class="fas fa-images mr-2"></i> Gestionar Banner
                                        </a>
                                        <!-- Se ha eliminado la opción de gestionar categorías -->
                                        <div class="border-t border-[#333] my-2"></div>
                                    @endif
                                    <a href="{{ route('dashboard') }}"
                                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-[#2E2E2E] hover:text-white">
                                        <i class="fas fa-tachometer-alt mr-2"></i> Panel Principal
                                    </a>
                                    <a href="{{ route('profile.edit') }}"
                                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-[#2E2E2E] hover:text-white">
                                        <i class="fas fa-user-edit mr-2"></i> Editar Perfil
                                    </a>
                                    <a href="{{ route('user.beer_favorites') }}"
                                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-[#2E2E2E] hover:text-white">
                                        <i class="fas fa-beer mr-2"></i> Cervezas Favoritas
                                    </a>
                                    <a href="{{ route('user.brewery_favorites') }}"
                                        class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-[#2E2E2E] hover:text-white">
                                        <i class="fas fa-industry mr-2"></i> Cervecerías Favoritas
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-[#2E2E2E] hover:text-white">
                                            <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="pt-4 pb-3 border-t border-[#333] mt-3 px-3 flex flex-col space-y-2">
                                <a href="{{ route('login') }}"
                                    class="text-center block py-2 bg-transparent border border-[#FFD700] text-[#FFD700] hover:bg-[#FFD700] hover:text-[#1A1A1A] rounded-md transition-colors">
                                    Iniciar Sesión
                                </a>
                                <a href="{{ route('register') }}"
                                    class="text-center block py-2 bg-[#FFD700] text-[#1A1A1A] hover:bg-[#FFA500] rounded-md font-medium transition-colors">
                                    Registrarse
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<!-- Spacer to prevent content from hiding under fixed nav -->
<div class="h-16"></div>

<!-- Estilos específicos para la navegación -->
<style>
    /* Estilos para enlaces activos y hover */
    .nav-link {
        position: relative;
    }

    .nav-link.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #FFD700;
    }

    .nav-link:hover:not(.active)::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: rgba(255, 215, 0, 0.5);
        transition: all 0.3s ease;
    }
</style>