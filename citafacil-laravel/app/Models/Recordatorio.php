<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Recordatorio extends Model
{
    public const CANALES = ['correo', 'sms', 'whatsapp'];

    protected $fillable = ['cita_id', 'mensaje', 'fecha_envio', 'canal', 'enviado'];

    protected function casts(): array
    {
        return [
            'fecha_envio' => 'datetime',
            'enviado' => 'boolean',
        ];
    }

    public function cita(): BelongsTo
    {
        return $this->belongsTo(Cita::class);
    }
}