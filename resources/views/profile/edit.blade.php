@extends('layouts.app')

@section('title', 'Perfil')

@section('content')

<div class="py-12 bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

        <!-- Encabezado -->

            <!-- Información del Perfil -->
            <div class="p-6 bg-white shadow-lg rounded-2xl">
                
                @include('profile.partials.update-profile-information-form')
            </div>

        <!-- Cambiar Contraseña -->
        <div class="p-6 bg-white shadow-lg rounded-2xl">
            <h3 class="text-lg font-semibold text-gray-800 mb-6 border-b pb-2">
                Seguridad - Cambiar Contraseña
            </h3>
            @include('profile.partials.update-password-form')
        </div>

        <!-- Eliminar Cuenta -->
        <div class="p-6 bg-white shadow-lg rounded-2xl border-l-4 border-red-500">
            <h3 class="text-lg font-semibold text-red-600 mb-6 border-b pb-2">
                Zona de Riesgo
            </h3>
            @include('profile.partials.delete-user-form')
        </div>

    </div>
</div>

@endsection