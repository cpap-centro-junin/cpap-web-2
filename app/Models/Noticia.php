<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'resumen',
        'contenido',
        'imagen',
        'autor',
        'categoria',
        'activo',
        'destacado',
    ];

    protected $casts = [
        'activo'    => 'boolean',
        'destacado' => 'boolean',
    ];
}
