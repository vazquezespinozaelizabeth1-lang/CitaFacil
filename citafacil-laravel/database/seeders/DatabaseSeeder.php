<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            PacienteSeeder::class,
            ServicioSeeder::class,
            HorarioSeeder::class,
            CitaSeeder::class,
            RecordatorioSeeder::class,
        ]);
    }
}