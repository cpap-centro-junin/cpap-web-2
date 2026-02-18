<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VerificacionLog extends Model
{
    /**
     * Nombre de la tabla
     */
    protected $table = 'verificaciones_log';

    /**
     * Deshabilitar updated_at (solo usamos created_at)
     */
    public $timestamps = false;

    /**
     * Campos asignables masivamente
     */
    protected $fillable = [
        'codigo_verificacion',
        'ip_address',
        'user_agent',
        'resultado',
    ];

    /**
     * Scope: Verificaciones exitosas
     */
    public function scopeExitosas($query)
    {
        return $query->where('resultado', 'exitoso');
    }

    /**
     * Scope: Verificaciones fallidas
     */
    public function scopeFallidas($query)
    {
        return $query->whereIn('resultado', ['codigo_invalido', 'documento_inactivo']);
    }

    /**
     * Scope: Verificaciones por IP
     */
    public function scopePorIp($query, $ip)
    {
        return $query->where('ip_address', $ip);
    }

    /**
     * Scope: Verificaciones recientes (últimas 24 horas)
     */
    public function scopeRecientes($query)
    {
        return $query->where('created_at', '>=', now()->subDay());
    }
}
