<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateServicioRequest extends StoreServicioRequest
{
    public function rules(): array
    {
        $reglas = parent::rules();

        // El nombre puede repetirse solo consigo mismo
        $reglas['nombre'] = [
            'required', 'string', 'min:3', 'max:100',
            Rule::unique('servicios', 'nombre')->ignore($this->route('servicio')),
        ];

        return $reglas;
    }
}
