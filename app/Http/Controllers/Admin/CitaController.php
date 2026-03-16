<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cita;

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

        public function index(Request $request)
        {

        $fecha = $request->fecha;
        $estado = $request->estado;

        $citas = Cita::with('paciente')

        ->when($fecha,function($query,$fecha){

        $query->where('fecha',$fecha);

        })

        ->when($estado,function($query,$estado){

        $query->where('estado',$estado);

        })

        ->orderBy('fecha')
        ->orderBy('hora_inicio')

        ->paginate(10);

        return view('administrador.citas.index',compact('citas'));

        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrador.citas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    $request->validate([

    'patient_id'=>'required',
    'fecha'=>'required',
    'hora_inicio'=>'required',
    'hora_fin'=>'required'

    ]);

    $solape = Cita::where('fecha',$request->fecha)

    ->where(function($q) use ($request){

    $q->whereBetween('hora_inicio',[
    $request->hora_inicio,
    $request->hora_fin
    ])

    ->orWhereBetween('hora_fin',[
    $request->hora_inicio,
    $request->hora_fin
    ])

    ->orWhere(function($q2) use ($request){

    $q2->where('hora_inicio','<=',$request->hora_inicio)
    ->where('hora_fin','>=',$request->hora_fin);

    });

    })

    ->exists();

    if($solape){

    return back()->with('error','Este horario ya está ocupado');

    }

    Cita::create([

    'fecha'=>$request->fecha,
    'hora_inicio'=>$request->hora_inicio,
    'hora_fin'=>$request->hora_fin,
    'patient_id'=>$request->patient_id,
    'mensaje'=>$request->mensaje,
    'created_by'=>auth()->id()

    ]);

    return redirect()->route('citas.index')
    ->with('success','Cita creada correctamente');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cita $cita)
    {

    $cita->update([

    'fecha'=>$request->fecha,
    'hora_inicio'=>$request->hora_inicio,
    'hora_fin'=>$request->hora_fin,
    'mensaje'=>$request->mensaje,
    'estado'=>'modificada',
    'updated_by'=>auth()->id()

    ]);

    return redirect()->route('citas.index')
    ->with('success','Cita reprogramada');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Cita $cita)
{

$cita->update([

'estado'=>'cancelada',

'cancel_reason'=>$request->cancel_reason,

'cancelled_by'=>auth()->id()

]);

return redirect()->route('citas.index')
->with('success','Cita cancelada correctamente');

}
}
