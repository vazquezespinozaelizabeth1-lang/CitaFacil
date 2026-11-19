<?php

namespace App\Http\Requests;

use App\Http\Requests\Concerns\ChoqueDeHorario;
use App\Models\Cita;
use Illuminate\Validation\Rule;

class UpdateCitaRequest extends BaseFormRequest
{
    use ChoqueDeHorario;

    public function rules(): array
    {
        return [
            'paciente_id' => ['required', 'integer', 'exists:pacientes,id'],
            'servicio_id' => ['required', 'integer', 'exists:servicios,id'],
            'fecha' => ['required', 'date'],
            'hora' => ['required', 'date_format:H:i'],
            'motivo' => ['required', 'string', 'min:3', 'max:150'],
            'estado' => ['required', Rule::in(Cita::ESTADOS)],
        ];
    }

    public function attributes(): array
    {
        return [
            'paciente_id' => 'paciente',
            'servicio_id' => 'servicio',
        ];
    }
}
