@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto p-6">

<div class="flex justify-between items-center mb-6">

<h2 class="text-2xl font-bold mb-6">
Pacientes
</h2>

<a href="{{ route('dashboard') }}"
class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

Volver

</a>

</div>

{{-- alerta --}}
@if(session('success'))

<script>
Swal.fire({
icon: 'success',
title: '{{ session("success") }}',
showConfirmButton: false,
timer: 2000
});
</script>

@endif


<div class="flex justify-between mb-4">

<a href="{{ route('pacientes.create') }}"
class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

+ Registrar Paciente

</a>

<a href="{{ route('pacientes.trash') }}"
class="bg-red-600 hover:bg-red-700 text-black px-4 py-2 rounded">

Papelera

</a>


<form method="GET" action="{{ route('pacientes.index') }}">

<input type="text"
name="buscar"
placeholder="Buscar paciente..."
class="border rounded px-3 py-2">

</form>

</div>


<div class="bg-white shadow rounded-lg overflow-hidden">

<table class="w-full">

<thead class="bg-gray-100">

<tr>

<th class="p-3 text-left">ID</th>
<th class="p-3 text-left">Nombres</th>
<th class="p-3 text-left">Apellidos</th>
<th class="p-3 text-left">Documento</th>
<th class="p-3 text-left">Teléfono</th>
<th class="p-3 text-left">Acciones</th>

</tr>

</thead>

<tbody>

@foreach($pacientes as $paciente)

<tr class="border-t">

<td class="p-3">
{{ $paciente->id }}
</td>

<td class="p-3">
{{ $paciente->nombres }}
</td>

<td class="p-3">
{{ $paciente->apellidos }}
</td>

<td class="p-3">
{{ $paciente->documento }}
</td>

<td class="p-3">
{{ $paciente->telefono }}
</td>




<td class="p-3 flex gap-2">

<button
onclick="verPaciente({{ $paciente->id }})"
class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">

Ver

</button>

<a href="{{ route('pacientes.edit',$paciente->id) }}"
class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded">

Editar

</a>


<form id="delete-form-{{ $paciente->id }}"
action="{{ route('pacientes.destroy',$paciente->id) }}"
method="POST">

@csrf
@method('DELETE')

<button type="button"
onclick="confirmDelete({{ $paciente->id }})"
class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">

Eliminar

</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

<div id="modalPaciente"
class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center">

<div class="bg-white p-6 rounded-lg w-96">

<h2 class="text-xl font-bold mb-4">
Información del Paciente
</h2>

<div class="space-y-2">

<p><strong>Nombres:</strong> <span id="p_nombres"></span></p>
<p><strong>Apellidos:</strong> <span id="p_apellidos"></span></p>
<p><strong>Documento:</strong> <span id="p_documento"></span></p>
<p><strong>Teléfono:</strong> <span id="p_telefono"></span></p>
<p><strong>Email:</strong> <span id="p_email"></span></p>
<p><strong>Sexo:</strong> <span id="p_sexo"></span></p>

</div>

<div class="mt-4 text-right">

<button
onclick="cerrarModal()"
class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">

Cerrar

</button>

</div>

</div>

</div>

</div>


<div class="mt-4">

{{ $pacientes->links() }}

</div>

</div>


<script>

function confirmDelete(id){

Swal.fire({

title:'¿Eliminar paciente?',
text:'Esta acción no se puede deshacer',
icon:'warning',
showCancelButton:true,
confirmButtonColor:'#d33',
cancelButtonColor:'#3085d6',
confirmButtonText:'Sí, eliminar'

}).then((result)=>{

if(result.isConfirmed){

document.getElementById('delete-form-'+id).submit();

}

});

}

function verPaciente(id){

fetch('/admin/pacientes/'+id)

.then(response => response.json())

.then(data => {

document.getElementById('p_nombres').innerText = data.nombres
document.getElementById('p_apellidos').innerText = data.apellidos
document.getElementById('p_documento').innerText = data.documento
document.getElementById('p_telefono').innerText = data.telefono
document.getElementById('p_email').innerText = data.email
document.getElementById('p_sexo').innerText = data.sexo

document.getElementById('modalPaciente').classList.remove('hidden')
document.getElementById('modalPaciente').classList.add('flex')

})

}

function cerrarModal(){

document.getElementById('modalPaciente').classList.add('hidden')

}

</script>

@endsection

