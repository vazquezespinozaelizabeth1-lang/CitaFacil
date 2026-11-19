<?php

namespace App\Http\Requests;

class StoreServicioRequest extends BaseFormRequest
{
    protected function prepareForValidation(): void
    {
        $this->merge(['activo' => $this->boolean('activo')]);
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'min:3', 'max:100', 'unique:servicios,nombre'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'duracion_min' => ['required', 'integer', 'between:5,480'],
            'precio' => ['required', 'numeric', 'between:0,999999.99'],
            'activo' => ['boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nombre' => 'nombre',
            'descripcion' => 'descripción',
            'duracion_min' => 'duración',
            'precio' => 'precio',
        ];
    }
}
