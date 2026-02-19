<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::latest('fecha_inicio')->paginate(20);
        return view('admin.eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('admin.eventos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'        => 'required|string|max:255',
            'descripcion'   => 'required|string',
            'resumen'       => 'nullable|string|max:400',
            'lugar'         => 'nullable|string|max:255',
            'fecha_inicio'  => 'required|date',
            'fecha_fin'     => 'nullable|date|after_or_equal:fecha_inicio',
            'hora_inicio'   => 'nullable',
            'imagen_portada'=> 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'categoria'     => 'required|string',
        ]);

        $data['activo']    = $request->boolean('activo');
        $data['destacado'] = $request->boolean('destacado');

        if ($request->hasFile('imagen_portada')) {
            $file = $request->file('imagen_portada');
            $data['imagen_portada'] = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
        }

        Evento::create($data);

        return redirect()->route('admin.eventos.index')
            ->with('success', 'Evento creado correctamente.');
    }

    public function edit(Evento $evento)
    {
        return view('admin.eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $data = $request->validate([
            'titulo'        => 'required|string|max:255',
            'descripcion'   => 'required|string',
            'resumen'       => 'nullable|string|max:400',
            'lugar'         => 'nullable|string|max:255',
            'fecha_inicio'  => 'required|date',
            'fecha_fin'     => 'nullable|date|after_or_equal:fecha_inicio',
            'hora_inicio'   => 'nullable',
            'imagen_portada'=> 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'categoria'     => 'required|string',
        ]);

        $data['activo']    = $request->boolean('activo');
        $data['destacado'] = $request->boolean('destacado');

        if ($request->hasFile('imagen_portada')) {
            $rawImagen = $evento->getOriginal('imagen_portada');
            if ($rawImagen && !str_starts_with($rawImagen, 'data:')) {
                Storage::disk('public')->delete($rawImagen);
            }
            $file = $request->file('imagen_portada');
            $data['imagen_portada'] = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
        }

        $evento->update($data);

        return redirect()->route('admin.eventos.index')
            ->with('success', 'Evento actualizado correctamente.');
    }

    public function destroy(Evento $evento)
    {
        $rawImagen = $evento->getOriginal('imagen_portada');
        if ($rawImagen && !str_starts_with($rawImagen, 'data:')) {
            Storage::disk('public')->delete($rawImagen);
        }
        $evento->delete();

        return back()->with('success', 'Evento eliminado.');
    }
}
