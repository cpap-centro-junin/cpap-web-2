<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BolsaTrabajo;
use Illuminate\Http\Request;

class SolicitudOfertaController extends Controller
{
    /**
     * Listado tipo bandeja de entrada de solicitudes de ofertas laborales.
     */
    public function index()
    {
        $solicitudes = BolsaTrabajo::solicitudes()
            ->latest()
            ->paginate(10);

        return view('admin.solicitudes.index', compact('solicitudes'));
    }

    /**
     * Detalle de una solicitud. Marca como revisada al abrir.
     */
    public function show(BolsaTrabajo $solicitud)
    {
        if (! $solicitud->revisado) {
            $solicitud->update(['revisado' => true]);
        }

        return view('admin.solicitudes.show', compact('solicitud'));
    }

    /**
     * Aprobar solicitud: activa la oferta y establece fecha de publicación.
     */
    public function aprobar(BolsaTrabajo $solicitud)
    {
        $solicitud->update([
            'activo'            => true,
            'revisado'          => true,
            'fecha_publicacion' => now(),
        ]);

        return redirect()
            ->route('admin.solicitudes.index')
            ->with('success', 'Solicitud aprobada. La oferta ya es visible en el sitio web.');
    }

    /**
     * Rechazar y eliminar la solicitud.
     */
    public function rechazar(BolsaTrabajo $solicitud)
    {
        $solicitud->delete();

        return redirect()
            ->route('admin.solicitudes.index')
            ->with('success', 'Solicitud rechazada y eliminada.');
    }
}
