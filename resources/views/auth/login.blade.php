@extends('layouts.app')

@section('content')
<!-- @vite(['resources/css/app.css', 'resources/js/app.js']) -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          'hopegold': '#FFD700',
          'hopedark': '#2E2E2E',
          'hopegray': '#3A3A3A',
        }
      }
    }
  }
</script>

<div class="flex min-h-screen items-center justify-center bg-[#2E2E2E] p-4">
    <div class="w-full max-w-md rounded-lg bg-[#3A3A3A] p-8 shadow-2xl">
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-[#FFD700]">Iniciar Sesión</h2>
        </div>
        
        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 text-sm text-[#FFD700]">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-[#CCCCCC]">Email</label>
                <input id="email" class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none" 
                       type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
                @error('email')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-[#CCCCCC]">Contraseña</label>
                <input id="password" class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none" 
                       type="password" name="password" required autocomplete="current-password">
                @error('password')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-700 bg-[#2E2E2E] text-[#FFD700] focus:ring-[#FFD700]" name="remember">
                    <span class="ml-2 text-sm text-[#CCCCCC]">Recordarme</span>
                </label>
            </div>

            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="text-sm text-[#FFD700] hover:text-[#FFA500]" href="{{ route('password.request') }}">
                        ¿Olvidaste tu contraseña?
                    </a>
                @endif

                <button type="submit" class="rounded-md bg-[#FFD700] px-4 py-2 text-[#2E2E2E] hover:bg-[#FFA500] focus:outline-none">
                    Iniciar Sesión
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
