<?php

namespace Database\Seeders;

use App\Models\Paciente;
use Illuminate\Database\Seeder;

class PacienteSeeder extends Seeder
{
    public function run(): void
    {
        $pacientes = [
            ['nombre' => 'Ana López', 'telefono' => '7711234567', 'email' => 'ana@example.com', 'fecha_nacimiento' => '1990-03-12'],
            ['nombre' => 'Luis Pérez', 'telefono' => '7712345678', 'email' => null, 'fecha_nacimiento' => '1985-07-25'],
            ['nombre' => 'María Hernández', 'telefono' => '7713456789', 'email' => 'maria@example.com', 'fecha_nacimiento' => null],
            ['nombre' => 'Carlos Ramírez', 'telefono' => '7714567890', 'email' => 'carlos@example.com', 'fecha_nacimiento' => '1978-11-02'],
            ['nombre' => 'Sofía Martínez', 'telefono' => '7715678901', 'email' => null, 'fecha_nacimiento' => '2001-01-30'],
            ['nombre' => 'Jorge Sánchez', 'telefono' => '7716789012', 'email' => 'jorge@example.com', 'fecha_nacimiento' => '1995-09-18'],
            ['nombre' => 'Laura Torres', 'telefono' => '7717890123', 'email' => 'laura@example.com', 'fecha_nacimiento' => null],
            ['nombre' => 'Pedro Gómez', 'telefono' => '7718901234', 'email' => null, 'fecha_nacimiento' => '1969-05-07'],
        ];

        foreach ($pacientes as $paciente) {
            Paciente::create($paciente);
        }
    }
}
