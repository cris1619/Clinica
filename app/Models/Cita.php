<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cita extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'numero_fuente',
        'fecha',
        'hora_inicio',
        'hora_fin',
        'mensaje',
        'estado',
        'patient_id',
        'created_by',
        'updated_by',
        'cancelled_by',
        'cancel_reason'

    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class,'patient_id');
    }
}
