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
@endsection

