<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Colegiado extends Model
{
    use HasFactory;

    /**
     * Nombre de la tabla
     */
    protected $table = 'colegiados';

    /**
     * Campos asignables masivamente
     */
    protected $fillable = [
        'codigo_cpap',
        'dni',
        'nombres',
        'apellidos',
        'email',
        'telefono',
        'fecha_nacimiento',
        'foto',
        'especialidad',
        'universidad',
        'anio_graduacion',
        'descripcion',
        'cv_path',
        'estado',
        'fecha_colegiatura',
    ];

    /**
     * Casteo de atributos
     */
    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_colegiatura' => 'date',
        'anio_graduacion' => 'integer',
    ];

    /**
     * Relación: Un colegiado tiene muchas habilitaciones
     */
    public function habilitaciones(): HasMany
    {
        return $this->hasMany(Habilitacion::class);
    }

    /**
     * Relación: Obtener la habilitación activa actual
     */
    public function habilitacionActiva()
    {
        return $this->hasOne(Habilitacion::class)
            ->where('activo', true)
            ->latest('fecha_subida');
    }

    /**
     * Accessor: Nombre completo
     */
    public function getNombreCompletoAttribute(): string
    {
        return "{$this->nombres} {$this->apellidos}";
    }

    /**
     * Accessor: Estado badge para vista
     */
    public function getEstadoBadgeAttribute(): string
    {
        return $this->estado === 'activo'
            ? '<span class="badge badge-success">ACTIVO</span>'
            : '<span class="badge badge-danger">INACTIVO</span>';
    }

    /**
     * Scope: Buscar colegiados activos
     */
    public function scopeActivos($query)
    {
        return $query->where('estado', 'activo');
    }

    /**
     * Scope: Buscar colegiados inactivos
     */
    public function scopeInactivos($query)
    {
        return $query->where('estado', 'inactivo');
    }

    /**
     * Scope: Búsqueda por DNI, código o nombres
     *
     * Soporta:
     *  - "12345678"           → DNI exacto
     *  - "CPAP-2026-001"      → código CPAP
     *  - "María Elena"        → solo nombres
     *  - "García Torres"      → solo apellidos
     *  - "María Elena García" → nombre + apellido parcial
     *  - "María Elena García Torres" → nombre completo
     */
    public function scopeBuscar($query, $termino)
    {
        $termino = trim($termino);

        return $query->where(function ($q) use ($termino) {

            // 1. DNI y código CPAP (usan índice B-tree, muy rápido)
            $q->where('dni', 'like', "%{$termino}%")
              ->orWhere('codigo_cpap', 'like', "%{$termino}%");

            // 2. Nombre completo en orden normal: "María Elena García Torres"
            $q->orWhereRaw("CONCAT(nombres, ' ', apellidos) LIKE ?", ["%{$termino}%"]);

            // 3. Nombre completo en orden invertido: "García Torres María Elena"
            $q->orWhereRaw("CONCAT(apellidos, ' ', nombres) LIKE ?", ["%{$termino}%"]);

            // 4. FULLTEXT search (usa índice idx_busqueda, escala a miles de registros)
            //    Cada palabra de 3+ chars debe aparecer en el registro → "+María* +Elena* +García*"
            $palabras = array_filter(
                preg_split('/\s+/', $termino),
                fn($p) => mb_strlen($p) >= 3
            );
            if (!empty($palabras)) {
                $boolQuery = implode(' ', array_map(fn($p) => "+{$p}*", $palabras));
                $q->orWhereRaw(
                    "MATCH(nombres, apellidos, especialidad) AGAINST(? IN BOOLEAN MODE)",
                    [$boolQuery]
                );
            }
        });
    }
}
