<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enfermedad;

class EnfermedadSeeder extends Seeder
{
    public function run()
    {
        Enfermedad::create([
            'nombre' => 'Gripe',
            'descripcion' => 'Infección viral común con síntomas respiratorios.',
            'sintomas' => 'fiebre,tos,dolor de cabeza,congestión'
        ]);

        Enfermedad::create([
            'nombre' => 'Migraña',
            'descripcion' => 'Dolor de cabeza intenso acompañado de sensibilidad a la luz.',
            'sintomas' => 'dolor de cabeza,náuseas,sensibilidad a la luz'
        ]);

        Enfermedad::create([
            'nombre' => 'COVID-19',
            'descripcion' => 'Enfermedad respiratoria causada por el coronavirus SARS-CoV-2.',
            'sintomas' => 'fiebre,tos,dificultad para respirar,perdida del olfato'
        ]);
    }
}

