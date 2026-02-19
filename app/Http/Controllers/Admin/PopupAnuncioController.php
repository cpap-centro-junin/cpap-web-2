<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PopupAnuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PopupAnuncioController extends Controller
{
    public function index()
    {
        $anuncios = PopupAnuncio::latest()->get();
        return view('admin.anuncios.index', compact('anuncios'));
    }

    public function create()
    {
        return view('admin.anuncios.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:200',
            'imagen' => 'required|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
        ]);

        $data['activo'] = $request->boolean('activo');

        if ($data['activo']) {
            PopupAnuncio::query()->update(['activo' => false]);
        }

        $file = $request->file('imagen');
        $data['imagen'] = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));

        PopupAnuncio::create($data);

        return redirect()->route('admin.anuncios.index')
            ->with('success', 'Anuncio creado correctamente.');
    }

    public function edit(PopupAnuncio $anuncio)
    {
        return view('admin.anuncios.edit', compact('anuncio'));
    }

    public function update(Request $request, PopupAnuncio $anuncio)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:200',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp,gif|max:4096',
        ]);

        $data['activo'] = $request->boolean('activo');

        if ($data['activo']) {
            PopupAnuncio::where('id', '!=', $anuncio->id)->update(['activo' => false]);
        }

        if ($request->hasFile('imagen')) {
            $rawImagen = $anuncio->getOriginal('imagen');
            if ($rawImagen && !str_starts_with($rawImagen, 'data:')) {
                Storage::disk('public')->delete($rawImagen);
            }
            $file = $request->file('imagen');
            $data['imagen'] = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
        }

        $anuncio->update($data);

        return redirect()->route('admin.anuncios.index')
            ->with('success', 'Anuncio actualizado correctamente.');
    }

    public function destroy(PopupAnuncio $anuncio)
    {
        $rawImagen = $anuncio->getOriginal('imagen');
        if ($rawImagen && !str_starts_with($rawImagen, 'data:')) {
            Storage::disk('public')->delete($rawImagen);
        }
        $anuncio->delete();

        return back()->with('success', 'Anuncio eliminado.');
    }

    public function toggleActivo(PopupAnuncio $anuncio)
    {
        if (!$anuncio->activo) {
            PopupAnuncio::query()->update(['activo' => false]);
            $anuncio->update(['activo' => true]);
            $msg = 'Anuncio activado. Aparecerá en la página de inicio.';
        } else {
            $anuncio->update(['activo' => false]);
            $msg = 'Anuncio desactivado.';
        }

        return back()->with('success', $msg);
    }
}
