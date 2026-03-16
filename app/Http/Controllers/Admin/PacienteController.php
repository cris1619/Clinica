<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paciente;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{

    $buscar = $request->buscar;

    $pacientes = Paciente::when($buscar,function($query,$buscar){

        $query->where('nombres','like',"%$buscar%")
        ->orWhere('apellidos','like',"%$buscar%")
        ->orWhere('documento','like',"%$buscar%");

    })->paginate(5);

    $totalPacientes = Paciente::count();

    return view('administrador.pacientes.index',
        compact('pacientes','buscar','totalPacientes'));

}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    return view('administrador.pacientes.create');
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{

$request->validate([
'nombres'=>'required',
'apellidos'=>'required',
'documento'=>'required|unique:pacientes',
'telefono'=>'required'
]);

Paciente::create([

'nombres'=>$request->nombres,
'apellidos'=>$request->apellidos,
'documento'=>$request->documento,
'telefono'=>$request->telefono,
'email'=>$request->email,
'direccion'=>$request->direccion,
'sexo'=>$request->sexo,
'fecha_nacimiento'=>$request->fecha_nacimiento,

'created_by'=>auth()->id()

]);

return redirect()->route('pacientes.index')
->with('success','Paciente registrado correctamente');

}

    /**
     * Display the specified resource.
     */
    public function show(Paciente $paciente)
{
    return response()->json($paciente);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Paciente $paciente)
{
    return view('administrador.pacientes.edit', compact('paciente'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Paciente $paciente)
{

    $request->validate([
        'nombres'=>'required',
        'apellidos'=>'required',
        'telefono'=>'required'
    ]);

    $paciente->update([
        'nombres'=>$request->nombres,
        'apellidos'=>$request->apellidos,
        'telefono'=>$request->telefono,
        'email'=>$request->email,
        'direccion'=>$request->direccion,
        'sexo'=>$request->sexo,
        'fecha_nacimiento'=>$request->fecha_nacimiento,
        'updated_by'=>auth()->id()
    ]);

    return redirect()->route('pacientes.index')
    ->with('success','Paciente actualizado correctamente');

}

    /**
     * Remove the specified resource from storage.
     */
        public function destroy(Paciente $paciente)
    {
        $paciente->delete();

        return redirect()->route('pacientes.index')
        ->with('success','Paciente enviado a la papelera');
    }

    public function trash()
{
    $pacientes = Paciente::onlyTrashed()->paginate(10);

    return view('administrador.pacientes.trash', compact('pacientes'));
}
public function restore($id)
{
    Paciente::withTrashed()->find($id)->restore();

    return redirect()->route('pacientes.trash')
    ->with('success','Paciente restaurado correctamente');
}
public function forceDelete($id)
{
    Paciente::withTrashed()->find($id)->forceDelete();

    return redirect()->route('pacientes.trash')
    ->with('success','Paciente eliminado permanentemente');
}
}