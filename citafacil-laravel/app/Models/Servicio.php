<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servicio extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'duracion_min', 'precio', 'activo'];

    protected function casts(): array
    {
        return [
            'precio' => 'decimal:2',
            'activo' => 'boolean',
        ];
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }

    public function scopeBuscar(Builder $query, ?string $texto): Builder
    {
        return $query->when($texto, function (Builder $q, string $texto) {
            $q->where('nombre', 'ilike', '%'.$texto.'%');
        });
    }
}
