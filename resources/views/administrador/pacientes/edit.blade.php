@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto p-6">

<h2 class="text-2xl font-bold mb-6">
Editar Paciente
</h2>

@if ($errors->any())

<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">

<ul>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>

</div>

@endif

<form action="{{ route('pacientes.update',$paciente->id) }}" method="POST">

@csrf
@method('PUT')

<div class="grid grid-cols-2 gap-6">

<div>
<label class="block font-semibold mb-1">Nombres *</label>
<input type="text" name="nombres"
value="{{ $paciente->nombres }}"
class="w-full border rounded px-3 py-2">
</div>

<div>
<label class="block font-semibold mb-1">Apellidos *</label>
<input type="text" name="apellidos"
value="{{ $paciente->apellidos }}"
class="w-full border rounded px-3 py-2">
</div>

<div>
<label class="block font-semibold mb-1">Documento *</label>
<input type="text"
value="{{ $paciente->documento }}"
class="w-full border rounded px-3 py-2 bg-gray-100">
</div>

<div>
<label class="block font-semibold mb-1">Teléfono *</label>
<input type="text" name="telefono"
value="{{ $paciente->telefono }}"
class="w-full border rounded px-3 py-2">
</div>

<div>
<label class="block font-semibold mb-1">Email</label>
<input type="email" name="email"
value="{{ $paciente->email }}"
class="w-full border rounded px-3 py-2">
</div>

<div>
<label class="block font-semibold mb-1">Sexo</label>

<select name="sexo" class="w-full border rounded px-3 py-2">

<option value="">Seleccionar</option>

<option value="M" {{ $paciente->sexo == 'M' ? 'selected' : '' }}>
Masculino
</option>

<option value="F" {{ $paciente->sexo == 'F' ? 'selected' : '' }}>
Femenino
</option>

</select>

</div>

<div>
<label class="block font-semibold mb-1">Fecha de nacimiento</label>

<input type="date"
name="fecha_nacimiento"
value="{{ $paciente->fecha_nacimiento }}"
class="w-full border rounded px-3 py-2">

</div>

<div>
<label class="block font-semibold mb-1">Dirección</label>

<input type="text"
name="direccion"
value="{{ $paciente->direccion }}"
class="w-full border rounded px-3 py-2">

</div>

</div>

<div class="mt-6 flex gap-4">

<button type="submit"
class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded">

Actualizar Paciente

</button>

<a href="{{ route('pacientes.index') }}"
class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">

Cancelar

</a>

</div>

</form>

</div>

@endsection