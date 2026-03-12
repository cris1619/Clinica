@extends('layouts.app')
@section('title', 'Dashboard Administrador')

@section('content')
    <h1>Dashboard Administrador</h1>
    Nombre: {{ Auth::user()->name }} <br>
    Email: {{ Auth::user()->email }} <br>
    <form action="{{ route('logout') }}" method="POST" style="margin:0">
                        @csrf
                        <button type="submit" class="btn-logout">Cerrar sesión</button>
                    </form>

    <br>

    <a href="{{ route('usuarios.index') }}" 
        class="bg-blue-500 text-black px-4 py-2 rounded">
        Administrar usuarios
    </a>

@endsection

