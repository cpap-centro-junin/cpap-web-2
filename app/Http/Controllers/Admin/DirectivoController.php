<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Directivo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirectivoController extends Controller
{
    public function index()
    {
        $directivos = Directivo::orderBy('orden')->orderBy('id')->get();
        return view('admin.directivos.index', compact('directivos'));
    }

    public function create()
    {
        return view('admin.directivos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cargo'   => 'required|string|max:100',
            'nombre'  => 'required|string|max:200',
            'periodo' => 'nullable|string|max:50',
            'orden'   => 'nullable|integer|min:0',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['activo'] = $request->boolean('activo');
        $data['orden']  = $data['orden'] ?? 0;
        $data['periodo'] = $data['periodo'] ?? '2024-2026';

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $data['foto'] = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
        }

        Directivo::create($data);

        return redirect()->route('admin.directivos.index')
            ->with('success', 'Directivo creado correctamente.');
    }

    public function edit(Directivo $directivo)
    {
        return view('admin.directivos.edit', compact('directivo'));
    }

    public function update(Request $request, Directivo $directivo)
    {
        $data = $request->validate([
            'cargo'   => 'required|string|max:100',
            'nombre'  => 'required|string|max:200',
            'periodo' => 'nullable|string|max:50',
            'orden'   => 'nullable|integer|min:0',
            'foto'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['activo'] = $request->boolean('activo');
        $data['orden']  = $data['orden'] ?? $directivo->orden;

        if ($request->hasFile('foto')) {
            $rawFoto = $directivo->getOriginal('foto');
            if ($rawFoto && !str_starts_with($rawFoto, 'data:')) {
                Storage::disk('public')->delete($rawFoto);
            }
            $file = $request->file('foto');
            $data['foto'] = 'data:' . $file->getMimeType() . ';base64,' . base64_encode(file_get_contents($file->getRealPath()));
        }

        $directivo->update($data);

        return redirect()->route('admin.directivos.index')
            ->with('success', 'Directivo actualizado correctamente.');
    }

    public function destroy(Directivo $directivo)
    {
        $rawFoto = $directivo->getOriginal('foto');
        if ($rawFoto && !str_starts_with($rawFoto, 'data:')) {
            Storage::disk('public')->delete($rawFoto);
        }
        $directivo->delete();

        return back()->with('success', 'Directivo eliminado.');
    }
}
