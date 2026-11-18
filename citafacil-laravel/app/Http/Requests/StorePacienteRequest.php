<?php

namespace App\Http\Requests;

class StorePacienteRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:100'],
            'telefono' => ['required', 'digits:10'],
            'email' => ['nullable', 'email', 'max:100', 'unique:pacientes,email'],
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