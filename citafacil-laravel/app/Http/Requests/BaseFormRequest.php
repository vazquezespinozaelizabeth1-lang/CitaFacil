<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es obligatorio.',
            'string' => 'El campo :attribute debe ser texto.',
            'email' => 'El campo :attribute debe ser un correo válido.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'boolean' => 'El campo :attribute debe ser verdadero o falso.',
            'date' => 'El campo :attribute debe ser una fecha válida.',
            'date_format' => 'El campo :attribute debe tener el formato :format.',
            'digits' => 'El campo :attribute debe tener :digits dígitos.',
            'unique' => 'Ya existe un registro con ese valor en :attribute.',
            'exists' => 'El valor elegido en :attribute no existe.',
            'in' => 'El valor elegido en :attribute no es válido.',
            'confirmed' => 'La confirmación de :attribute no coincide.',
            'before' => 'El campo :attribute debe ser una fecha anterior a :date.',
            'after' => 'El campo :attribute debe ser posterior a :date.',
            'after_or_equal' => 'El campo :attribute debe ser :date o una fecha posterior.',
            'between.numeric' => 'El campo :attribute debe estar entre :min y :max.',
            'min.string' => 'El campo :attribute debe tener al menos :min caracteres.',
            'max.string' => 'El campo :attribute no puede superar :max caracteres.',
            'min.numeric' => 'El campo :attribute debe ser como mínimo :min.',
            'max.numeric' => 'El campo :attribute debe ser como máximo :max.',
        ];
    }
}
