<?php

namespace Database\Seeders;

use App\Models\Servicio;
use Illuminate\Database\Seeder;

class ServicioSeeder extends Seeder
{
    public function run(): void
    {
        $servicios = [
            ['nombre' => 'Consulta general', 'descripcion' => 'Revisión médica general', 'duracion_min' => 30, 'precio' => 350.00, 'activo' => true],
            ['nombre' => 'Consulta de seguimiento', 'descripcion' => 'Control posterior a un tratamiento', 'duracion_min' => 20, 'precio' => 250.00, 'activo' => true],
            ['nombre' => 'Limpieza dental', 'descripcion' => 'Limpieza y revisión dental', 'duracion_min' => 45, 'precio' => 500.00, 'activo' => true],
            ['nombre' => 'Terapia física', 'descripcion' => null, 'duracion_min' => 60, 'precio' => 600.00, 'activo' => false],
        ];

        foreach ($servicios as $servicio) {
            Servicio::create($servicio);
        }
    }
}
