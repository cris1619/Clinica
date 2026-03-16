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


    <div class="grid grid-cols-3 gap-6">

<a href="{{ route('usuarios.index') }}"
class="bg-purple-500 text-white p-6 rounded-lg">

Usuarios

</a>

<a href="{{ route('pacientes.index') }}"
class="bg-blue-500 text-white p-6 rounded-lg">

Pacientes

</a>

<a href="{{ route('citas.index') }}"
class="bg-green-500 text-white p-6 rounded-lg">

Citas

</a>

</div>

@endsection

