@extends('layouts.app')

@section('title','Crear Usuario')

@section('content')

<h1 class="text-2xl font-bold mb-6">
Crear Usuario
</h1>

<form action="{{ route('usuarios.store') }}" method="POST" class="space-y-4">

@csrf

<div>
<label class="block">Nombre</label>
<input type="text" name="name" class="border p-2 w-full rounded" required>
</div>

<div>
<label class="block">Email</label>
<input type="email" name="email" class="border p-2 w-full rounded" required>
</div>

<div>
<label class="block">Contraseña</label>
<input type="password" name="password" class="border p-2 w-full rounded" required>
</div>

<div>
<label class="block">Rol</label>

<select name="rol_id" class="border p-2 w-full rounded" required>

<option value="">Seleccione un rol</option>

@foreach($roles as $rol)

<option value="{{ $rol->id }}">
{{ $rol->nombre }}
</option>

@endforeach

</select>

</div>

<button class="bg-blue-500 text-black px-4 py-2 rounded">
Crear Usuario
</button>

</form>

@endsection