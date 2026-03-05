<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class GaleriaImagen extends Model
{
    protected $table = 'galeria_imagenes';

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'categoria',
        'fecha',
        'destacado',
        'activo',
        'orden',
    ];

    protected $casts = [
        'fecha'     => 'date',
        'destacado' => 'boolean',
        'activo'    => 'boolean',
        'orden'     => 'integer',
    ];

    /* ── Scopes ────────────────────────────── */

    public function scopeActivos($query)
    {
        return $query->where('activo', true)->orderBy('orden')->orderByDesc('fecha')->orderByDesc('id');
    }

    public function scopeDestacados($query)
    {
        return $query->where('activo', true)->where('destacado', true)->orderBy('orden')->orderByDesc('fecha');
    }

    public function scopePorCategoria($query, string $categoria)
    {
        return $query->where('categoria', $categoria);
    }

    /* ── Accessors ─────────────────────────── */

    public function getImagenUrlAttribute(): string
    {
        if (!$this->imagen) {
            return '';
        }

        // Data URI
        if (str_starts_with($this->imagen, 'data:')) {
            return $this->imagen;
        }

        // URL externa
        if (str_starts_with($this->imagen, 'http')) {
            return $this->imagen;
        }

        return Storage::url($this->imagen);
    }

    /* ── Helpers estáticos ─────────────────── */

    public static function categoriasDisponibles(): array
    {
        return [
            'Ceremonias'    => 'Ceremonias',
            'Eventos'       => 'Eventos Académicos',
            'Institucional' => 'Institucional',
            'Congresos'     => 'Congresos y Conferencias',
            'Actividades'   => 'Actividades Sociales',
            'Otros'         => 'Otros',
        ];
    }
}
