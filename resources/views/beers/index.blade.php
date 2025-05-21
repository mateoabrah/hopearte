@extends('layouts.app')

@section('content')
<div class="py-12 bg-[#2E2E2E]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Hero Section -->
        <div class="mb-10 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-[#FFD700] mb-4" data-aos="fade-up">Todas las Cervezas</h1>
            <p class="text-xl text-[#CCCCCC] mb-8" data-aos="fade-up" data-aos-delay="200">
                Explora nuestra colección completa de cervezas artesanales de las mejores cervecerías
            </p>
            
            <!-- Search and Filter -->
            <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4 mb-8" data-aos="fade-up" data-aos-delay="300">
                <form action="{{ route('beers.index') }}" method="GET" class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 w-full max-w-3xl">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre..." class="px-4 py-2 rounded-md bg-[#3A3A3A] border border-gray-700 text-white focus:border-[#FFD700] focus:outline-none flex-grow">
                    
                    <select name="category" class="px-4 py-2 rounded-md bg-[#3A3A3A] border border-gray-700 text-white focus:border-[#FFD700] focus:outline-none">
                        <option value="">Todas las categorías</option>
                        @foreach(\App\Models\BeerCategory::all() as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    
                    <button type="submit" class="px-4 py-2 bg-[#FFD700] text-[#2E2E2E] rounded-md hover:bg-[#FFA500] transition duration-300">
                        Filtrar
                    </button>
                </form>
            </div>
        </div>

        <!-- Beer Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @forelse($beers as $beer)
                <div class="bg-[#3A3A3A] rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                    <a href="{{ route('beers.show', $beer->id) }}">
                        <img src="{{ asset('storage/' . $beer->image) }}" 
                             alt="{{ $beer->name }}" 
                             class="w-full h-48 object-cover">
                        
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-xl font-bold text-[#FFD700] truncate">{{ $beer->name }}</h3>
                                <span class="bg-[#2E2E2E] text-[#CCCCCC] text-xs px-2 py-1 rounded-full">{{ $beer->abv }}% ABV</span>
                            </div>
                            
                            <p class="text-[#CCCCCC] text-sm mb-3 line-clamp-2">{{ $beer->description }}</p>
                            
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-sm text-white bg-[#2E2E2E] px-2 py-1 rounded">{{ $beer->category->name ?? 'Sin categoría' }}</span>
                                
                                <span class="text-sm text-white">
                                    @if($beer->brewery)
                                        {{ $beer->brewery->name }}
                                    @else
                                        Cervecería desconocida
                                    @endif
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-xl text-[#CCCCCC]">No se encontraron cervezas que coincidan con tu búsqueda.</p>
                    <a href="{{ route('beers.index') }}" class="mt-4 inline-block px-6 py-2 bg-[#FFD700] text-[#2E2E2E] rounded-md hover:bg-[#FFA500] transition duration-300">
                        Ver todas las cervezas
                    </a>
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        <div class="mt-12 flex justify-center" data-aos="fade-up">
            {{ $beers->links() }}
        </div>
    </div>
</div>

<!-- Scripts para animaciones AOS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true
    });
</script>
@endsection
