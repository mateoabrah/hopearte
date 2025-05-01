@extends('layouts.app')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-[#2E2E2E] p-4">
    <div class="w-full max-w-md rounded-lg bg-[#3A3A3A] p-8 shadow-2xl">
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-[#FFD700]">Confirmar contraseña</h2>
        </div>
        
        <div class="mb-4 text-sm text-[#CCCCCC]">
            {{ __('Esta es un área segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.') }}
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-[#CCCCCC]">Contraseña</label>
                <input id="password" class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none" 
                       type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit" class="rounded-md bg-[#FFD700] px-4 py-2 text-[#2E2E2E] hover:bg-[#FFA500] focus:outline-none">
                    {{ __('Confirmar') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
