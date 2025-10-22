<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enfermedad extends Model
{
    protected $table = 'enfermedades'; // 👈 esto corrige el nombre
    protected $fillable = ['nombre', 'descripcion', 'sintomas'];
}
