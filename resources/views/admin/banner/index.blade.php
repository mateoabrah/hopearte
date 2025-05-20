@extends('layouts.admin')

@section('header', 'Gestión del Banner')

@section('content')
<div class="bg-[#3A3A3A] p-6 rounded-lg shadow-lg">
    <h1 class="text-2xl font-bold mb-6 text-[#FFD700]">Gestión de Cervezas en el Banner</h1>
    
    @if(session('success'))
        <div class="bg-green-600 text-white p-4 mb-6 rounded-md">
            {{ session('success') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-600 text-white p-4 mb-6 rounded-md">
            {{ session('error') }}
        </div>
    @endif
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Cervezas actualmente en el banner -->
        <div class="bg-[#2E2E2E] p-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4 text-[#FFD700] border-b border-[#4A4A4A] pb-2">
                Cervezas en el Banner ({{ $featuredBeers->count() }})
            </h2>
            
            @if($featuredBeers->isEmpty())
                <p class="text-gray-400 text-center py-6">No hay cervezas destacadas en el banner.</p>
            @else
                <div class="space-y-4">
                    @foreach($featuredBeers as $beer)
                        <div class="flex items-center bg-[#1A1A1A] p-3 rounded-lg hover:bg-opacity-80 transition-all">
                            <div class="flex-shrink-0 w-16 h-16 mr-4">
                                @if($beer->image)
                                    <img src="{{ asset('storage/' . $beer->image) }}" class="w-full h-full object-cover rounded" alt="{{ $beer->name }}">
                                @else
                                    <div class="w-full h-full bg-[#4A4A4A] rounded flex items-center justify-center text-gray-500">
                                        <i class="fas fa-beer text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <h3 class="font-medium">{{ $beer->name }}</h3>
                                <p class="text-sm text-gray-400">{{ $beer->brewery->name }} · {{ $beer->category->name }}</p>
                            </div>
                            <div>
                                <form action="{{ route('admin.banner.toggle', $beer) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-red-500 hover:text-red-400 bg-transparent border border-red-500 px-3 py-1 rounded-md text-sm">
                                        <i class="fas fa-times mr-1"></i> Quitar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        
        <!-- Cervezas disponibles para añadir -->
        <div class="bg-[#2E2E2E] p-4 rounded-lg">
            <h2 class="text-xl font-semibold mb-4 text-[#FFD700] border-b border-[#4A4A4A] pb-2">
                Cervezas Disponibles ({{ $availableBeers->count() }})
            </h2>
            
            @if($availableBeers->isEmpty())
                <p class="text-gray-400 text-center py-6">No hay cervezas disponibles para añadir.</p>
            @else
                <div class="space-y-4">
                    @foreach($availableBeers as $beer)
                        <div class="flex items-center bg-[#1A1A1A] p-3 rounded-lg hover:bg-opacity-80 transition-all">
                            <div class="flex-shrink-0 w-16 h-16 mr-4">
                                @if($beer->image)
                                    <img src="{{ asset('storage/' . $beer->image) }}" class="w-full h-full object-cover rounded" alt="{{ $beer->name }}">
                                @else
                                    <div class="w-full h-full bg-[#4A4A4A] rounded flex items-center justify-center text-gray-500">
                                        <i class="fas fa-beer text-2xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-grow">
                                <h3 class="font-medium">{{ $beer->name }}</h3>
                                <p class="text-sm text-gray-400">{{ $beer->brewery->name }} · {{ $beer->category->name }}</p>
                            </div>
                            <div>
                                <form action="{{ route('admin.banner.toggle', $beer) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="text-green-500 hover:text-green-400 bg-transparent border border-green-500 px-3 py-1 rounded-md text-sm">
                                        <i class="fas fa-plus mr-1"></i> Añadir
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection