@extends('layouts.app')
@section('title', 'Dashboard Agente')

@section('content')
    <h1>Dashboard Agente</h1>
    Nombre: {{ Auth::user()->name }} <br>
    Email: {{ Auth::user()->email }} <br>
    <form action="{{ route('logout') }}" method="POST" style="margin:0">
                        @csrf
                        <button type="submit" class="btn-logout">Cerrar sesión</button>
                    </form>
    <br>
                    
<div class="grid grid-cols-2 gap-6">

<a href="{{ route('pacientes.create') }}"
class="bg-blue-500 text-white p-6 rounded-lg shadow">

Registrar Paciente

</a>

<a href="{{ route('citas.create') }}"
class="bg-green-500 text-white p-6 rounded-lg shadow">

Agendar Cita

</a>

</div>
@endsection


