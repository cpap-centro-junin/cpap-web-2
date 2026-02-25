<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BolsaTrabajo extends Model
{
    protected $table = 'bolsa_trabajo';

    protected $fillable = [
        'titulo',
        'empresa',
        'ubicacion',
        'tipo',
        'area',
        'descripcion',
        'salario',
        'enlace_postulacion',
        'nombre_contacto',
        'email_contacto',
        'fecha_publicacion',
        'fecha_vencimiento',
        'activo',
        'revisado',
    ];

    protected $casts = [
        'fecha_publicacion' => 'date',
        'fecha_vencimiento' => 'date',
        'activo' => 'boolean',
        'revisado' => 'boolean',
    ];

    /**
     * Scope para ofertas activas y no vencidas.
     */
    public function scopeVigentes($query)
    {
        return $query->where('activo', true)
                     ->where(function ($q) {
                         $q->whereNull('fecha_vencimiento')
                           ->orWhere('fecha_vencimiento', '>=', now()->toDateString());
                     });
    }

    /**
     * Scope para solicitudes pendientes (enviadas desde el sitio público).
     */
    public function scopeSolicitudes($query)
    {
        return $query->where('activo', false);
    }

    /**
     * Scope para solicitudes no revisadas.
     */
    public function scopeNoRevisadas($query)
    {
        return $query->where('revisado', false)->where('activo', false);
    }

    /**
     * Label legible del tipo.
     */
    public function getTipoLabelAttribute(): string
    {
        return match ($this->tipo) {
            'fulltime'     => 'Tiempo Completo',
            'parttime'     => 'Medio Tiempo',
            'freelance'    => 'Freelance',
            'consultoria'  => 'Consultoría',
            default        => $this->tipo,
        };
    }

    /**
     * Label legible del área.
     */
    public function getAreaLabelAttribute(): string
    {
        return match ($this->area) {
            'investigacion' => 'Investigación',
            'docencia'      => 'Docencia',
            'consultoria'   => 'Consultoría',
            'gestion'       => 'Gestión Cultural',
            default         => $this->area,
        };
    }
}
