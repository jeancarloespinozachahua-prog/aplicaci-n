<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    /**
     * Atributos que se pueden asignar masivamente.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nombre',
        'dni',
        'foto_perfil',
        'idioma',
        'tema_visual',
        'edad',
        'peso',
        'altura',
        'nivel_diagnostico',
    ];
}
