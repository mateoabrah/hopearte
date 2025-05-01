@extends('layouts.app')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-[#2E2E2E] p-4">
    <div class="w-full max-w-md rounded-lg bg-[#3A3A3A] p-8 shadow-2xl">
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-[#FFD700]">Restablecer contraseña</h2>
        </div>

        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-[#CCCCCC]">Email</label>
                <input id="email" class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none" 
                       type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
                @error('email')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-[#CCCCCC]">Contraseña</label>
                <input id="password" class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none" 
                       type="password" name="password" required autocomplete="new-password">
                @error('password')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-[#CCCCCC]">Confirmar contraseña</label>
                <input id="password_confirmation" class="mt-1 w-full rounded-md border border-gray-700 bg-[#2E2E2E] p-2 text-white focus:border-[#FFD700] focus:outline-none" 
                       type="password" name="password_confirmation" required autocomplete="new-password">
                @error('password_confirmation')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="rounded-md bg-[#FFD700] px-4 py-2 text-[#2E2E2E] hover:bg-[#FFA500] focus:outline-none">
                    {{ __('Restablecer contraseña') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
