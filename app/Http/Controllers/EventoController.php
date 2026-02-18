<?php

namespace App\Http\Controllers;

use App\Models\Evento;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::where('activo', true)
            ->orderBy('fecha_inicio', 'desc')
            ->paginate(9);

        $destacados = Evento::where('activo', true)
            ->where('destacado', true)
            ->orderBy('fecha_inicio', 'desc')
            ->take(3)
            ->get();

        return view('eventos.index', compact('eventos', 'destacados'));
    }

    public function show(Evento $evento)
    {
        abort_if(!$evento->activo, 404);

        $relacionados = Evento::where('activo', true)
            ->where('id', '!=', $evento->id)
            ->where('categoria', $evento->categoria)
            ->orderBy('fecha_inicio', 'desc')
            ->take(3)
            ->get();

        return view('eventos.show', compact('evento', 'relacionados'));
    }
}
