<?php

namespace Database\Seeders;

use App\Models\Horario;
use Illuminate\Database\Seeder;

class HorarioSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 5) as $dia) {
            Horario::create([
                'dia_semana' => $dia,
                'hora_inicio' => '09:00',
                'hora_fin' => '18:00',
                'activo' => true,
            ]);
        }
    }
}