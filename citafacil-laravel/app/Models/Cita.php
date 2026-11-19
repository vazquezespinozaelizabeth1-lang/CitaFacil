<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cita extends Model
{
    public const ESTADOS = ['Pendiente', 'Confirmada', 'Cancelada'];

    protected $fillable = ['paciente_id', 'servicio_id', 'fecha', 'hora', 'motivo', 'estado'];

    protected function casts(): array
    {
        return ['fecha' => 'date'];
    }

    // PostgreSQL devuelve 09:00:00; las vistas muestran 09:00
    protected function hora(): Attribute
    {
        return Attribute::get(fn ($valor) => substr($valor, 0, 5));
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    public function servicio(): BelongsTo
    {
        return $this->belongsTo(Servicio::class);
    }

    public function recordatorios(): HasMany
    {
        return $this->hasMany(Recordatorio::class);
    }
}
