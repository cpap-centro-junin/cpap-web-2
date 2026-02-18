<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Directivo extends Model
{
    protected $fillable = [
        'cargo',
        'nombre',
        'especialidad',
        'foto',
        'periodo',
        'orden',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
        'orden'  => 'integer',
    ];

    /**
     * Icono Font Awesome según el cargo.
     */
    public function getIconAttribute(): string
    {
        return match (strtolower($this->cargo)) {
            'presidente'    => 'fa-star',
            'vicepresidente'=> 'fa-award',
            'secretario', 'secretaria' => 'fa-pen-nib',
            'tesorero', 'tesorera'     => 'fa-coins',
            default                    => 'fa-handshake',
        };
    }
}
