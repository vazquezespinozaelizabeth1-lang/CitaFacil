<?php

namespace App\Http\Requests;

use App\Models\Horario;
use Illuminate\Validation\Rule;

class StoreHorarioRequest extends BaseFormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge(['activo' => $this->boolean('activo')]);
    }

    public function rules(): array
    {
        return [
            'dia_semana' => ['required', 'integer', Rule::in(array_keys(Horario::DIAS))],
            'hora_inicio' => ['required', 'date_format:H:i', $this->reglaUnica()],
            'hora_fin' => ['required', 'date_format:H:i', 'after:hora_inicio'],
            'activo' => ['boolean'],
        ];
    }

    /** Único por día y hora de inicio (igual que la restricción de la BD). */
    protected function reglaUnica()
    {
        return Rule::unique('horarios', 'hora_inicio')
            ->where('dia_semana', $this->input('dia_semana'));
    }

    public function attributes(): array
    {
        return [
            'dia_semana' => 'día de la semana',
            'hora_inicio' => 'hora de inicio',
            'hora_fin' => 'hora de fin',
        ];
    }

    public function messages(): array
    {
        return parent::messages() + [
            'hora_inicio.unique' => 'Ya existe un horario que inicia a esa hora ese día.',
            'hora_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio.',
        ];
    }
}
