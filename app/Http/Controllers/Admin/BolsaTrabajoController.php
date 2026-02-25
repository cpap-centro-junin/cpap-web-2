<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BolsaTrabajo;
use Illuminate\Http\Request;

class BolsaTrabajoController extends Controller
{
    public function index()
    {
        $ofertas = BolsaTrabajo::orderBy('fecha_publicacion', 'desc')->paginate(15);
        return view('admin.bolsa.index', compact('ofertas'));
    }

    public function create()
    {
        return view('admin.bolsa.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'              => 'required|string|max:255',
            'empresa'             => 'required|string|max:255',
            'ubicacion'           => 'required|string|max:255',
            'tipo'                => 'required|in:fulltime,parttime,freelance,consultoria',
            'area'                => 'required|in:investigacion,docencia,consultoria,gestion',
            'descripcion'         => 'required|string',
            'salario'             => 'nullable|string|max:255',
            'enlace_postulacion'  => 'nullable|url|max:500',
            'fecha_publicacion'   => 'required|date',
            'fecha_vencimiento'   => 'nullable|date|after_or_equal:fecha_publicacion',
            'activo'              => 'boolean',
        ]);

        $data['activo'] = $request->has('activo') ? (bool) $request->activo : true;

        BolsaTrabajo::create($data);

        return redirect()->route('admin.bolsa.index')
                         ->with('success', 'Oferta de trabajo creada correctamente.');
    }

    public function edit(BolsaTrabajo $bolsa)
    {
        return view('admin.bolsa.edit', ['oferta' => $bolsa]);
    }

    public function update(Request $request, BolsaTrabajo $bolsa)
    {
        $data = $request->validate([
            'titulo'              => 'required|string|max:255',
            'empresa'             => 'required|string|max:255',
            'ubicacion'           => 'required|string|max:255',
            'tipo'                => 'required|in:fulltime,parttime,freelance,consultoria',
            'area'                => 'required|in:investigacion,docencia,consultoria,gestion',
            'descripcion'         => 'required|string',
            'salario'             => 'nullable|string|max:255',
            'enlace_postulacion'  => 'nullable|url|max:500',
            'fecha_publicacion'   => 'required|date',
            'fecha_vencimiento'   => 'nullable|date|after_or_equal:fecha_publicacion',
            'activo'              => 'boolean',
        ]);

        $data['activo'] = $request->has('activo') ? (bool) $request->activo : false;

        $bolsa->update($data);

        return redirect()->route('admin.bolsa.index')
                         ->with('success', 'Oferta actualizada correctamente.');
    }

    public function destroy(BolsaTrabajo $bolsa)
    {
        $bolsa->delete();

        return redirect()->route('admin.bolsa.index')
                         ->with('success', 'Oferta eliminada correctamente.');
    }
}
