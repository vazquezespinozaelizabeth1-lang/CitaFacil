<?php

namespace App\Http\Requests\Concerns;

use App\Models\Cita;
use App\Models\Servicio;
use Illuminate\Support\Carbon;

trait ChoqueDeHorario
{
    public function after(): array
    {
        return [function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $inicio = Carbon::createFromFormat('H:i', $this->hora);
            $fin = $inicio->copy()->addMinutes(Servicio::find($this->servicio_id)->duracion_min);

            $choca = Cita::with('servicio')
                ->whereDate('fecha', $this->fecha)
                ->where('estado', '!=', 'Cancelada')
                ->when($this->route('cita'), fn ($q, $cita) => $q->where('id', '!=', $cita->id))
                ->get()
                ->contains(function ($otra) use ($inicio, $fin) {
                    $otraIni = Carbon::createFromFormat('H:i', $otra->hora);
                    $otraFin = $otraIni->copy()->addMinutes($otra->servicio->duracion_min);

                    return $inicio < $otraFin && $fin > $otraIni;
                });

            if ($choca) {
                $validator->errors()->add('hora', 'Ya hay una cita en ese horario.');
            }
        }];
    }
}