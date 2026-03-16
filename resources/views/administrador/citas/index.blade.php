@extends('layouts.app')

@section('title','Citas Médicas')

@section('content')

<div class="flex justify-between items-center mb-6">

<h1 class="text-2xl font-bold">
Agenda de Citas
</h1>

<a href="{{ route('citas.create') }}"
class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

+ Nueva Cita

</a>

<a href="{{ route('dashboard') }}"
class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">

Volver

</a>

</div>

<div class="bg-white shadow rounded-lg overflow-hidden">

<table class="w-full text-sm text-left">

<thead class="bg-gray-100">

<tr>

<th class="p-3">Fecha</th>
<th class="p-3">Hora Inicio</th>
<th class="p-3">Hora Fin</th>
<th class="p-3">Paciente</th>
<th class="p-3">Estado</th>
<th class="p-3">Acciones</th>

</tr>

</thead>

<tbody>

@foreach($citas as $cita)

<tr class="border-t hover:bg-gray-50">

<td class="p-3">
{{ $cita->fecha }}
</td>

<td class="p-3">
{{ $cita->hora_inicio }}
</td>

<td class="p-3">
{{ $cita->hora_fin }}
</td>

<td class="p-3">
{{ $cita->paciente->nombres }} {{ $cita->paciente->apellidos }}
</td>

<td class="p-3">

@if($cita->estado == 'programada')

<span class="bg-blue-100 text-blue-700 px-2 py-1 rounded text-xs font-semibold">
Programada
</span>

@elseif($cita->estado == 'modificada')

<span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs font-semibold">
Modificada
</span>

@elseif($cita->estado == 'cancelada')

<span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs font-semibold">
Cancelada
</span>

@elseif($cita->estado == 'asistida')

<span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-semibold">
Asistida
</span>

@else

<span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs font-semibold">
No asistida
</span>

@endif

</td>

<td class="p-3 flex gap-2">

<a href="{{ route('citas.edit',$cita->id) }}"
class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded">
Editar
</a>

<form id="cancel-form-{{ $cita->id }}"
action="{{ route('citas.destroy',$cita->id) }}"
method="POST">

@csrf
@method('DELETE')

<input type="hidden"
name="cancel_reason"
id="reason-{{ $cita->id }}">

<button type="button"
onclick="cancelarCita({{ $cita->id }})"
class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">

Cancelar

</button>

</form>
</td>

</tr>

@endforeach

</tbody>

</table>

<div class="mt-4">
{{ $citas->links() }}
</div>

</div>

@endsection
<script>

function cancelarCita(id) {

Swal.fire({

title: 'Cancelar cita',
text: 'Ingrese el motivo de cancelación',
input: 'text',

showCancelButton: true,

confirmButtonText: 'Cancelar cita',

cancelButtonText: 'Cerrar',

}).then((result) => {

if (result.isConfirmed) {

document.getElementById('reason-'+id).value = result.value;

document.getElementById('cancel-form-'+id).submit();

}

});

}

</script>