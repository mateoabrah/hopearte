@extends('layouts.app')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-[#2E2E2E] p-4">
    <div class="w-full max-w-md rounded-lg bg-[#3A3A3A] p-8 shadow-2xl">
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-[#FFD700]">Recuperar contraseña</h2>
        </div>
        
        <div class="mb-4 text-sm text-[#CCCCCC]">
            {{ __('¿Olvidaste tu contraseña? No hay problema. Simplemente indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña.') }}
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-[#FFD700]">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-[#CCCCCC]">Email</label>
                <input id="email" class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none" 
                       type="email" name="email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mt-4">
                <a class="text-sm text-[#FFD700] hover:text-[#FFA500]" href="{{ route('login') }}">
                    Volver al inicio de sesión
                </a>
                
                <button type="submit" class="rounded-md bg-[#FFD700] px-4 py-2 text-[#2E2E2E] hover:bg-[#FFA500] focus:outline-none">
                    {{ __('Enviar enlace') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
