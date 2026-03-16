@extends('layouts.app')

@section('content')

<div class="max-w-6xl mx-auto p-6">
<a href="{{ route('pacientes.index') }}"
class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

Volver

</a>
<h2 class="text-2xl font-bold mb-6">
Pacientes Eliminados
</h2>

<table class="w-full border">


<thead>

<tr>
<th>ID</th>
<th>Nombre</th>
<th>Documento</th>
<th>Acciones</th>
</tr>

</thead>

<tbody>

@foreach($pacientes as $paciente)

<tr>

<td>{{ $paciente->id }}</td>

<td>
{{ $paciente->nombres }} {{ $paciente->apellidos }}
</td>

<td>{{ $paciente->documento }}</td>

<td class="flex gap-2">

<form action="{{ route('pacientes.restore',$paciente->id) }}" method="POST">
@csrf
@method('PUT')

<button class="bg-green-500 text-white px-3 py-1 rounded">
Restaurar
</button>

</form>

<form action="{{ route('pacientes.forceDelete',$paciente->id) }}" method="POST">
@csrf
@method('DELETE')

<button class="bg-red-600 text-white px-3 py-1 rounded">
Eliminar definitivo
</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection