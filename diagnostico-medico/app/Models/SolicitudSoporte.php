<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudSoporte extends Model
{
    /**
     * Los campos que pueden ser asignados masivamente.
     */
    protected $fillable = [
        'nombre',
        'dni',
        'asunto',
        'mensaje',
        'archivo',
        'estado',
    ];
}
