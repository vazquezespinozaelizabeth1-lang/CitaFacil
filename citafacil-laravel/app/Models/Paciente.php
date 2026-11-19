<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
    protected $fillable = ['nombre', 'telefono', 'email', 'fecha_nacimiento'];

    protected function casts(): array
    {
        return ['fecha_nacimiento' => 'date'];
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
