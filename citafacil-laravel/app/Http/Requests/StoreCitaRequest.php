<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ChoqueDeHorario;

class StoreCitaRequest extends BaseFormRequest
{
    use ChoqueDeHorario;

    public function rules(): array
    {
        return [
            'paciente_id' => ['required', 'integer', 'exists:pacientes,id'],
            'servicio_id' => ['required', 'integer', 'exists:servicios,id'],
            'fecha'       => ['required', 'date', 'after_or_equal:today'],
            'hora'        => ['required', 'date_format:H:i'],
            'motivo'      => ['required', 'string', 'min:3', 'max:150'],
            'estado'      => ['required', 'in:Pendiente,Confirmada,Cancelada'],
        ];
    }

    public function attributes(): array
    {
        return ['paciente_id' => 'paciente', 'servicio_id' => 'servicio'];
    }
}