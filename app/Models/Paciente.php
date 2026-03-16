<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use SoftDeletes;

    protected $fillable = [

        'nombres',
        'apellidos',
        'documento',
        'telefono',
        'direccion',
        'email',
        'fecha_nacimiento',
        'sexo',
        'created_by',
        'updated_by'

        ];

    public function citas()
{
    return $this->hasMany(Cita::class,'patient_id');
}
}

