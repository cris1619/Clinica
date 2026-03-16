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

<a href="{{ route('dashboard') }}"
class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

Volver

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

@php
$rol = $user->roles->first();
@endphp

<button
type="button"
onclick="openRoleModal({{ $user->id }}, {{ $rol->id ?? 0 }})"
class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-semibold hover:bg-blue-200">

{{ $rol->nombre ?? 'Sin rol' }}

</button>

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
<!-- MODAL CAMBIAR ROL -->

<div id="roleModal"
class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

<div class="bg-white p-6 rounded-lg shadow-lg w-96">

<h2 class="text-lg font-bold mb-4">
Cambiar rol
</h2>

<form id="roleForm" method="POST">

@csrf
@method('PUT')

<select name="rol_id" id="rolSelect"
class="w-full border rounded p-2 mb-4">

@foreach($roles as $role)

<option value="{{ $role->id }}">
{{ $role->nombre }}
</option>

@endforeach

</select>

<div class="flex justify-end gap-2">

<button type="button"
onclick="closeRoleModal()"
class="bg-gray-200 px-4 py-2 rounded">

Cancelar

</button>

<button type="submit"
class="bg-blue-500 text-white px-4 py-2 rounded">

Guardar

</button>

</div>

</form>

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
function openRoleModal(userId, rolId){

let modal = document.getElementById('roleModal');
let form = document.getElementById('roleForm');
let select = document.getElementById('rolSelect');

form.action = "/admin/usuarios/" + userId + "/rol";

select.value = rolId;

modal.classList.remove('hidden');
modal.classList.add('flex');

}

function closeRoleModal(){

let modal = document.getElementById('roleModal');

modal.classList.remove('flex');
modal.classList.add('hidden');

}

</script>