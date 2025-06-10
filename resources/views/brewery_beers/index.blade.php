@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6 mt-12">
    <div class="bg-[#2E2E2E] rounded-lg p-6 shadow-md">
        <div class="flex justify-between items-center mb-5">
            <h1 class="text-2xl font-bold text-[#FFD700]">Cervezas de {{ $brewery->name }}</h1>
            
            <!-- Para el enlace de crear -->
            <a href="{{ route('brewery.beers.create', $brewery->getRouteKey()) }}" class="inline-block bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-1.5 px-4 rounded text-sm">
                <i class="fas fa-plus mr-1.5"></i> Añadir Cerveza
            </a>
        </div>
        
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-3 rounded mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif
        
        @if($beers->isEmpty())
            <div class="text-center py-8" data-aos="fade-up">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-500 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <p class="text-lg text-[#CCCCCC] mb-2">Aún no has añadido ninguna cerveza a esta cervecería.</p>
                <p class="text-[#CCCCCC] text-sm mb-4">Haz clic en el botón "Añadir Cerveza" para comenzar.</p>
                <a href="{{ route('brewery.beers.create', $brewery->id) }}" class="inline-block bg-[#FFD700] hover:bg-[#FFA500] text-[#2E2E2E] font-semibold py-1.5 px-4 rounded text-sm">
                    <i class="fas fa-plus mr-1.5"></i> Añadir mi primera cerveza
                </a>
            </div>
        @else
            <div class="overflow-x-auto rounded-lg border border-gray-700" data-aos="fade-up">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-left bg-[#3A3A3A] text-[#FFD700] text-sm">
                            <th class="p-3">Imagen</th>
                            <th class="p-3">Nombre</th>
                            <th class="p-3">Categoría</th>
                            <th class="p-3">ABV</th>
                            <th class="p-3">IBU</th>
                            <th class="p-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($beers as $beer)
                            <tr class="hover:bg-[#3A3A3A] transition-colors">
                                <td class="p-2.5">
                                    @if($beer->image)
                                        <img src="{{ asset('storage/' . $beer->image) }}" alt="{{ $beer->name }}" class="h-14 w-14 object-cover rounded">
                                    @else
                                        <div class="h-14 w-14 bg-gray-700 rounded flex items-center justify-center text-gray-500">
                                            <i class="fas fa-beer text-xl"></i>
                                        </div>
                                    @endif
                                </td>
                                <td class="p-2.5 text-white">{{ $beer->name }}</td>
                                <td class="p-2.5 text-white text-sm">{{ $beer->category->name ?? 'Sin categoría' }}</td>
                                <td class="p-2.5 text-white text-sm">{{ $beer->abv }}%</td>
                                <td class="p-2.5 text-white text-sm">{{ $beer->ibu ?? 'N/A' }}</td>
                                <td class="p-2.5">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('beers.show', $beer) }}" class="bg-[#4A4A4A] hover:bg-[#5A5A5A] text-white py-2 px-3 rounded flex items-center justify-center" title="Ver detalles">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <!-- Para el enlace de editar -->
                                        <a href="{{ route('brewery.beers.edit', [$brewery->getRouteKey(), $beer->id]) }}" class="bg-[#FFD700] hover:bg-amber-500 text-[#2E2E2E] py-2 px-3 rounded flex items-center justify-center" title="Editar">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <!-- Para el formulario de eliminar -->
                                        <form action="{{ route('brewery.beers.destroy', [$brewery->getRouteKey(), $beer->id]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta cerveza de tu cervecería?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-700 hover:bg-red-800 text-white py-2 px-3 rounded flex items-center justify-center" title="Eliminar de la cervecería">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-5">
                {{ $beers->links() }}
            </div>
        @endif
        
        <div class="mt-6">
            <a href="{{ route('my_breweries') }}" class="text-[#FFD700] hover:underline text-sm flex items-center">
                <i class="fas fa-arrow-left mr-1.5"></i> Volver a mis cervecerías
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.1/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    });
</script>
@endpush