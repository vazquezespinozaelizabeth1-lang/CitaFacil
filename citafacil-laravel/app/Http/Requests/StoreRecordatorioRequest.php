<?php

namespace App\Http\Requests;

use App\Models\Recordatorio;
use Illuminate\Validation\Rule;

class StoreRecordatorioRequest extends BaseFormRequest
{
    public function rules(): array
    {
        return [
            'cita_id' => ['required', 'integer', 'exists:citas,id'],
            'mensaje' => ['required', 'string', 'min:5', 'max:255'],
            'fecha_envio' => ['required', 'date_format:Y-m-d\TH:i'],
            'canal' => ['required', Rule::in(Recordatorio::CANALES)],
            'enviado' => ['required', 'boolean'],
        ];
    }

    public function attributes(): array
    {
        return [
            'cita_id' => 'cita',
            'fecha_envio' => 'fecha y hora de envío',
        ];
    }

    protected function prepareForValidation(): void
    {
        $valor = $this->input('enviado', false);

        $this->merge([
            'enviado' => match ($valor) {
                true, 1, '1', 'on' => true,
                false, 0, '0' => false,
                default => $valor,
            },
        ]);
    }
}
