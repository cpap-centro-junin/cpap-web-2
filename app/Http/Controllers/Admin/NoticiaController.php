<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::latest()->get();
        return view('admin.noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('admin.noticias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $noticia = new Noticia();
        $noticia->titulo = $request->titulo;
        $noticia->contenido = $request->contenido;
        $noticia->activo = $request->has('activo');

        // ✅ GUARDAR IMAGEN
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('noticias', 'public');
            $noticia->imagen = $path;
        }

        $noticia->save();

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia creada correctamente');
    }

    public function edit(Noticia $noticia)
    {
        return view('admin.noticias.edit', compact('noticia'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $noticia->titulo = $request->titulo;
        $noticia->contenido = $request->contenido;
        $noticia->activo = $request->has('activo');

        // ✅ ACTUALIZAR IMAGEN
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('noticias', 'public');
            $noticia->imagen = $path;
        }

        $noticia->save();

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia actualizada correctamente');
    }

    public function destroy(Noticia $noticia)
    {
        $noticia->delete();
        return back()->with('success', 'Noticia eliminada');
    }

    public function show(Noticia $noticia)
    {
        return view('noticias.show', compact('noticia'));
    }
}
