@extends('layouts.app')

@section('title','Usuarios')

@section('content')


<div class="flex justify-between items-center mb-6">

<h1 class="text-2xl font-bold">
Gestión de Usuarios
</h1>

<a href="{{ route('usuarios.create') }}"
class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

+ Nuevo Usuario

</a>

</div>

<div class="grid grid-cols-3 gap-4 mb-6">

<div class="bg-white shadow rounded-lg p-4">
    <p class="text-gray-500 text-sm">Total Usuarios</p>
    <h2 class="text-3xl font-bold text-gray-800">
        {{ $totalUsuarios }}
    </h2>
</div>

</div>

<form method="GET" action="{{ route('usuarios.index') }}" class="mb-4">
<div x-data="{ search: '' }">

<div class="relative mb-6 w-80">

<span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">

</span>

<input
type="text"
x-model="search"
placeholder="Buscar usuario... 🔎"
class="border rounded-lg pl-10 pr-4 py-2 w-full focus:ring focus:ring-blue-200"
>

</div>



</form>

<div class="bg-white shadow rounded-lg overflow-hidden">

<table class="w-full text-sm text-left">

<thead class="bg-gray-100">

<tr>

<th class="p-3">ID</th>
<th class="p-3">Nombre</th>
<th class="p-3">Email</th>
<th class="p-3">Rol</th>
<th class="p-3">Acciones</th>

</tr>

</thead>

<tbody>

@foreach($usuarios as $user)

<tr class="border-t hover:bg-gray-50" x-show="
'{{ strtolower($user->name) }}'.includes(search.toLowerCase()) ||
'{{ strtolower($user->email) }}'.includes(search.toLowerCase())
"
class="border-t hover:bg-gray-50">

<td class="p-3">{{ $user->id }}</td>

<td class="p-3">{{ $user->name }}</td>

<td class="p-3">{{ $user->email }}</td>

<td class="p-3">
<span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs">
@php
$rol = $user->roles->first()->nombre ?? 'sin rol';
@endphp

@if($rol == 'administrador')

<span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-semibold">
Administrador
</span>

@elseif($rol == 'profesional')

<span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-semibold">
Profesional
</span>

@elseif($rol == 'agente')

<span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">
Agente
</span>

@elseif($rol == 'usuario')

<span class="bg-purple-100 text-purple-700 px-2 py-1 rounded text-xs font-semibold">
Usuario
</span>

@else

<span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">
Sin rol
</span>

@endif
</span>
</td>

<td class="p-3 flex gap-2">

<a href="{{ route('usuarios.edit',$user->id) }}"
class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
Editar
</a>

<form id="delete-user-{{ $user->id }}" action="{{ route('usuarios.destroy', $user->id) }}" method="POST" style="display:inline">
@csrf
@method('DELETE')

<button type="button"
onclick="confirmDelete({{ $user->id }})"
class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">

Eliminar

</button>

</form>


</td>

</tr>

@endforeach

</tbody>

</table>

<div class="mt-4">
{{ $usuarios->links() }}
</div>

</div>

@endsection
<script>

function confirmDelete(id) {

Swal.fire({
    title: '¿Eliminar usuario?',
    text: "Esta acción no se puede deshacer",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar'
}).then((result) => {

    if (result.isConfirmed) {
        document.getElementById('delete-user-' + id).submit();
    }

})

}

</script>