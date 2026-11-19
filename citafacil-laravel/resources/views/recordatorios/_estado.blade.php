<span @class(['badge', 'text-bg-success' => $recordatorio->enviado, 'text-bg-warning' => !$recordatorio->enviado])>
    {{ $recordatorio->enviado ? 'Enviado' : 'Pendiente' }}
</span>
