<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Servicio;
use Illuminate\Database\Seeder;

class CitaSeeder extends Seeder
{
    public function run(): void
    {
        $pacientes = Paciente::pluck('id');
        $servicios = Servicio::pluck('id');

        foreach (range(1, 10) as $i) {
            Cita::create([
                'paciente_id' => $pacientes->random(),
                'servicio_id' => $servicios->random(),
                'fecha' => now()->addDays($i)->toDateString(),
                'hora' => sprintf('%02d:00', 8 + $i),
                'motivo' => 'Consulta de seguimiento',
                'estado' => Cita::ESTADOS[$i % 3],
            ]);
        }
    }
}
