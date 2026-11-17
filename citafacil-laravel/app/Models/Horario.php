<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    public const DIAS = [
        1 => 'Lunes',
        2 => 'Martes',
        3 => 'Miércoles',
        4 => 'Jueves',
        5 => 'Viernes',
        6 => 'Sábado',
        7 => 'Domingo',
    ];

    protected $fillable = ['dia_semana', 'hora_inicio', 'hora_fin', 'activo'];

    protected function casts(): array
    {
        return ['activo' => 'boolean'];
    }

    protected function nombreDia(): Attribute
    {
        return Attribute::get(fn () => self::DIAS[$this->dia_semana] ?? '');
    }
}