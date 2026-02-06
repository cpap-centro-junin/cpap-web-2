<?php

namespace App\Http\Controllers;

use App\Models\Noticia;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::where('activo', true)
            ->latest()
            ->paginate(6);

        return view('noticias.index', compact('noticias'));
    }
}
