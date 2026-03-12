@extends('layouts.app')

@section('title','Usuarios')

@section('content')

<h1 class="text-2xl font-bold mb-6">
Gestión de Usuarios
</h1>

<a href="{{ route('usuarios.create') }}"
class="bg-green-500 text-black px-4 py-2 rounded mb-4 inline-block">
Crear usuario
</a>

<table class="w-full border">

<thead class="bg-gray-100">
<tr>
<th class="p-2">ID</th>
<th class="p-2">Nombre</th>
<th class="p-2">Email</th>
<th class="p-2">Rol</th>
<th class="p-2">Acciones</th>
</tr>
</thead>

<tbody>

@foreach($usuarios as $user)

<tr class="border-t">

<td class="p-2">{{ $user->id }}</td>

<td class="p-2">{{ $user->name }}</td>

<td class="p-2">{{ $user->email }}</td>

<td class="p-2">

@foreach($user->roles as $rol)
{{ $rol->nombre }}
@endforeach

</td>

<td class="p-2 flex gap-2">

<a href="{{ route('usuarios.edit',$user->id) }}"
class="bg-yellow-500 text-black px-3 py-1 rounded">
Editar
</a>

<form action="{{ route('usuarios.destroy',$user->id) }}" method="POST">

@csrf
@method('DELETE')

<button class="bg-red-500 text-black px-3 py-1 rounded">
Eliminar
</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

@endsection