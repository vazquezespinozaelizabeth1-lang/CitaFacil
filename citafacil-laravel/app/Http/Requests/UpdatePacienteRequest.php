<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdatePacienteRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:100'],
            'telefono' => ['required', 'digits:10'],
            'email' => [
                'nullable',
                'email',
                'max:100',
                Rule::unique('pacientes', 'email')->ignore($this->paciente),
            ],
            'fecha_nacimiento' => ['nullable', 'date', 'before:today'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'telefono' => 'teléfono',
            'email' => 'correo electrónico',
            'fecha_nacimiento' => 'fecha de nacimiento',
        ];
    }
}