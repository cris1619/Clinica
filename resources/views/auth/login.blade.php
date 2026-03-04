@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-8">
    
    <h2 class="text-2xl font-bold text-center mb-6">
        Iniciar Sesión
    </h2>

    {{-- Mensaje de estado (ej: contraseña restablecida) --}}
    @if (session('status'))
        <div class="mb-4 text-green-600 text-sm bg-green-100 p-3 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                Email
            </label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autofocus
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">

            @error('email')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block text-sm font-medium text-gray-700">
                Contraseña
            </label>
            <input id="password"
                   type="password"
                   name="password"
                   required
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">

            @error('password')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center mt-4">
            <input id="remember"
                   type="checkbox"
                   name="remember"
                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">

            <label for="remember" class="ml-2 text-sm text-gray-600">
                Recordarme
            </label>
        </div>

        <!-- Botones -->
        <div class="flex items-center justify-between mt-6">
            
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-sm text-blue-600 hover:underline">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif

            <button type="submit">
                Ingresar
            </button>
        </div>

        <!-- Link a registro -->
        <div class="text-center mt-6">
            <a href="{{ route('register') }}"
               class="text-sm text-gray-600 hover:underline">
                ¿No tienes cuenta? Crear una
            </a>
        </div>

    </form>
</div>
@endsection