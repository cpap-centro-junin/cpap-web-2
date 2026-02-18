<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::latest()->paginate(20);
        return view('admin.noticias.index', compact('noticias'));
    }

    public function create()
    {
        return view('admin.noticias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'    => 'required|string|max:255',
            'resumen'   => 'nullable|string|max:400',
            'contenido' => 'required|string',
            'autor'     => 'nullable|string|max:150',
            'categoria' => 'required|string',
            'imagen'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data['activo']    = $request->boolean('activo');
        $data['destacado'] = $request->boolean('destacado');
        $data['autor']     = $data['autor'] ?? 'Redacción CPAP';

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('noticias', 'public');
        }

        Noticia::create($data);

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia creada correctamente.');
    }

    public function edit(Noticia $noticia)
    {
        return view('admin.noticias.edit', compact('noticia'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $data = $request->validate([
            'titulo'    => 'required|string|max:255',
            'resumen'   => 'nullable|string|max:400',
            'contenido' => 'required|string',
            'autor'     => 'nullable|string|max:150',
            'categoria' => 'required|string',
            'imagen'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $data['activo']    = $request->boolean('activo');
        $data['destacado'] = $request->boolean('destacado');
        $data['autor']     = $data['autor'] ?? 'Redacción CPAP';

        if ($request->hasFile('imagen')) {
            if ($noticia->imagen) {
                Storage::disk('public')->delete($noticia->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('noticias', 'public');
        }

        $noticia->update($data);

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia actualizada correctamente.');
    }

    public function destroy(Noticia $noticia)
    {
        if ($noticia->imagen) {
            Storage::disk('public')->delete($noticia->imagen);
        }
        $noticia->delete();
        return back()->with('success', 'Noticia eliminada.');
    }

    public function show(Noticia $noticia)
    {
        return view('noticias.show', compact('noticia'));
    }
}

