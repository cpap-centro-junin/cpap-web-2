<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NormativaDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NormativaController extends Controller
{
    public function index()
    {
        $documentos = NormativaDocumento::orderBy('orden')->orderBy('id')->get();
        return view('admin.normativa.index', compact('documentos'));
    }

    public function create()
    {
        $iconos = NormativaDocumento::iconosDisponibles();
        return view('admin.normativa.create', compact('iconos'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'      => 'required|string|max:200',
            'descripcion' => 'nullable|string|max:500',
            'icono'       => 'required|string|max:50',
            'archivo_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'orden'       => 'nullable|integer|min:0',
        ]);

        $data['activo'] = $request->boolean('activo');
        $data['orden']  = $data['orden'] ?? 0;

        if ($request->hasFile('archivo_pdf')) {
            $file = $request->file('archivo_pdf');
            $data['archivo_nombre'] = $file->getClientOriginalName();
            $data['archivo_pdf'] = $file->store('normativa', 'public');
        }

        NormativaDocumento::create($data);

        return redirect()->route('admin.normativa.index')
            ->with('success', 'Documento normativo creado correctamente.');
    }

    public function edit(NormativaDocumento $normativa)
    {
        $iconos = NormativaDocumento::iconosDisponibles();
        return view('admin.normativa.edit', compact('normativa', 'iconos'));
    }

    public function update(Request $request, NormativaDocumento $normativa)
    {
        $data = $request->validate([
            'titulo'      => 'required|string|max:200',
            'descripcion' => 'nullable|string|max:500',
            'icono'       => 'required|string|max:50',
            'archivo_pdf' => 'nullable|file|mimes:pdf|max:10240',
            'orden'       => 'nullable|integer|min:0',
        ]);

        $data['activo'] = $request->boolean('activo');
        $data['orden']  = $data['orden'] ?? $normativa->orden;

        if ($request->hasFile('archivo_pdf')) {
            if ($normativa->archivo_pdf) {
                Storage::disk('public')->delete($normativa->archivo_pdf);
            }
            $file = $request->file('archivo_pdf');
            $data['archivo_nombre'] = $file->getClientOriginalName();
            $data['archivo_pdf'] = $file->store('normativa', 'public');
        }

        if ($request->boolean('eliminar_pdf') && !$request->hasFile('archivo_pdf')) {
            if ($normativa->archivo_pdf) {
                Storage::disk('public')->delete($normativa->archivo_pdf);
            }
            $data['archivo_pdf'] = null;
            $data['archivo_nombre'] = null;
        }

        $normativa->update($data);

        return redirect()->route('admin.normativa.index')
            ->with('success', 'Documento normativo actualizado correctamente.');
    }

    public function destroy(NormativaDocumento $normativa)
    {
        if ($normativa->archivo_pdf) {
            Storage::disk('public')->delete($normativa->archivo_pdf);
        }

        $normativa->delete();

        return redirect()->route('admin.normativa.index')
            ->with('success', 'Documento normativo eliminado correctamente.');
    }

    /**
     * Descargar PDF (ruta pública).
     */
    public function descargar(NormativaDocumento $documento)
    {
        if (!$documento->archivo_pdf || !Storage::disk('public')->exists($documento->archivo_pdf)) {
            abort(404, 'El documento no está disponible.');
        }

        $nombre = $documento->archivo_nombre ?? $documento->titulo . '.pdf';

        return Storage::disk('public')->download($documento->archivo_pdf, $nombre);
    }
}
