<?php

namespace Database\Seeders;

use App\Models\Cita;
use App\Models\Recordatorio;
use Illuminate\Database\Seeder;

class RecordatorioSeeder extends Seeder
{
    public function run(): void
    {
        $citas = Cita::orderBy('id')->take(5)->get();

        foreach ($citas as $i => $cita) {
            Recordatorio::create([
                'cita_id' => $cita->id,
                'mensaje' => 'Le recordamos su cita en CitaFácil.',
                'fecha_envio' => $cita->fecha->copy()->subDay()->setTime(9, 0),
                'canal' => Recordatorio::CANALES[$i % 3],
                'enviado' => false,
            ]);
        }
    }
}
