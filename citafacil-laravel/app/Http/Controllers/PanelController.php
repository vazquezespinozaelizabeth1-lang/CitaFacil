<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Recordatorio;
use App\Models\Servicio;

class PanelController extends Controller
{
    public function __invoke()
    {
        $citasHoy = Cita::whereDate('fecha', today())->count();
        $citasPendientes = Cita::where('estado', 'Pendiente')->count();
        $totalPacientes = Paciente::count();
        $serviciosActivos = Servicio::where('activo', true)->count();
        $recordatoriosPorEnviar = Recordatorio::where('enviado', false)->count();

        $proximasCitas = Cita::with(['paciente', 'servicio'])
            ->whereDate('fecha', '>=', today())
            ->where('estado', '!=', 'Cancelada')
            ->orderBy('fecha')
            ->orderBy('hora')
            ->take(5)
            ->get();

        return view('panel', compact(
            'citasHoy',
            'citasPendientes',
            'totalPacientes',
            'serviciosActivos',
            'recordatoriosPorEnviar',
            'proximasCitas'
        ));
    }
}