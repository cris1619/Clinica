@extends('layouts.app')

@section('title','Editar Usuario')

@section('content')

<h1 class="text-2xl font-bold mb-6">
Editar Usuario
</h1>

<form action="{{ route('usuarios.update',$user->id) }}" method="POST" class="space-y-4">

@csrf
@method('PUT')

<div>
<label class="block">Nombre</label>
<input type="text" name="name" value="{{ $user->name }}" class="border p-2 w-full rounded">
</div>

<div>
<label class="block">Email</label>
<input type="email" name="email" value="{{ $user->email }}" class="border p-2 w-full rounded">
</div>

<div>
<label class="block">Rol</label>

<select name="rol_id" class="border p-2 w-full rounded">

@foreach($roles as $rol)

<option value="{{ $rol->id }}"
{{ $user->roles->first()->id == $rol->id ? 'selected' : '' }}>

{{ $rol->nombre }}

</option>

@endforeach

</select>

</div>

<button class="bg-blue-500 text-black px-4 py-2 rounded">
Actualizar Usuario
</button>

</form>

@endsection