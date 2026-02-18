<?php

namespace App\Http\Controllers;

use App\Models\Noticia;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::where('activo', true)
            ->latest()
            ->paginate(9);

        $destacadas = Noticia::where('activo', true)
            ->where('destacado', true)
            ->latest()
            ->take(3)
            ->get();

        return view('noticias.index', compact('noticias', 'destacadas'));
    }

    public function show(Noticia $noticia)
    {
        abort_if(!$noticia->activo, 404);

        $relacionadas = Noticia::where('activo', true)
            ->where('id', '!=', $noticia->id)
            ->where('categoria', $noticia->categoria)
            ->latest()
            ->take(3)
            ->get();

        return view('noticias.show', compact('noticia', 'relacionadas'));
    }
}

