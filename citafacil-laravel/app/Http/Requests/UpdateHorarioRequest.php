<?php

namespace App\Http\Requests;

class UpdateHorarioRequest extends StoreHorarioRequest
{
    /** Al editar, el registro actual se ignora en la regla de unicidad. */
    protected function reglaUnica()
    {
        return parent::reglaUnica()->ignore($this->route('horario'));
    }
}
