<?php

namespace App\Http\Requests\Concerns;

use App\Models\Cita;

trait ChoqueDeHorario
{
    public function after(): array
    {
        return [function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $choca = Cita::whereDate('fecha', $this->fecha)
                ->where('hora', $this->hora)
                ->where('estado', '!=', 'Cancelada')
                ->when($this->route('cita'), fn ($q, $cita) => $q->where('id', '!=', $cita->id))
                ->exists();

            if ($choca) {
                $validator->errors()->add('hora', 'Ya existe una cita en esa fecha y hora.');
            }
        }];
    }
}
