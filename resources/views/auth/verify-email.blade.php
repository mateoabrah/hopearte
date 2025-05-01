@extends('layouts.app')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-[#2E2E2E] p-4">
    <div class="w-full max-w-md rounded-lg bg-[#3A3A3A] p-8 shadow-2xl">
        <div class="mb-6 text-center">
            <h2 class="text-3xl font-bold text-[#FFD700]">Verificar correo electrónico</h2>
        </div>

        <div class="mb-4 text-sm text-[#CCCCCC]">
            {{ __('Gracias por registrarte. Antes de comenzar, ¿podrías verificar tu dirección de correo electrónico haciendo clic en el enlace que acabamos de enviarte? Si no recibiste el correo, con gusto te enviaremos otro.') }}
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-sm text-[#FFD700]">
                {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.') }}
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button type="submit" class="rounded-md bg-[#FFD700] px-4 py-2 text-[#2E2E2E] hover:bg-[#FFA500] focus:outline-none">
                    {{ __('Reenviar email de verificación') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="text-sm text-[#FFD700] hover:text-[#FFA500]">
                    {{ __('Cerrar sesión') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
