@extends('layouts.app')

@section('title', 'Registro')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-8">
    
    <h2 class="text-2xl font-bold text-center mb-6">
        Crear Cuenta
    </h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Nombre -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                Nombre
            </label>
            <input id="name"
                   type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autofocus
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">

            @error('name')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email -->
        <div class="mt-4">
            <label for="email" class="block text-sm font-medium text-gray-700">
                Email
            </label>
            <input id="email"
                   type="email"
                   name="email"
                   value="{{ old('email') }}"
                   required
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

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                Confirmar Contraseña
            </label>
            <input id="password_confirmation"
                   type="password"
                   name="password_confirmation"
                   required
                   class="mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Botones -->
        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('login') }}"
               class="text-sm text-blue-600 hover:underline">
                ¿Ya tienes cuenta?
            </a>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-black px-5 py-2 rounded-md shadow">
                Registrarse
            </button>
        </div>
    </form>
</div>
@endsection