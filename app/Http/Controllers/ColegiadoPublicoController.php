<?php

namespace App\Http\Controllers;

use App\Models\Colegiado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ColegiadoPublicoController extends Controller
{
    /**
     * Buscador público de colegiados
     * Ruta: GET /colegiados
     */
    public function index(Request $request)
    {
        // Solo columnas necesarias para las cards → no carga descripcion, cv_path, etc.
        $query = Colegiado::select('id', 'codigo_cpap', 'nombres', 'apellidos', 'foto', 'especialidad', 'estado');

        // Búsqueda por DNI, código CPAP o nombres (FULLTEXT + CONCAT)
        if ($request->filled('buscar')) {
            $query->buscar($request->buscar);
        }

        // Filtro por estado
        if ($request->filled('estado') && in_array($request->estado, ['activo', 'inactivo'])) {
            $query->where('estado', $request->estado);
        }

        // Solo mostrar resultados si hay búsqueda o filtro activo
        $colegiados = ($request->filled('buscar') || $request->filled('estado'))
            ? $query->orderBy('apellidos')->paginate(12)->withQueryString()
            : null;

        return view('colegiados.index', [
            'colegiados' => $colegiados,
            'buscar'     => $request->buscar,
            'estado'     => $request->estado,
        ]);
    }

    /**
     * Perfil público del colegiado
     * Ruta: GET /colegiados/{colegiado}
     */
    public function show(Colegiado $colegiado)
    {
        $habilitacion = $colegiado->habilitaciones()->first();

        return view('colegiados.show', compact('colegiado', 'habilitacion'));
    }

    /**
     * Descarga pública del CV del colegiado (solo si está activo)
     * Ruta: GET /colegiados/{colegiado}/cv
     */
    public function descargarCV(Colegiado $colegiado)
    {
        if (!$colegiado->cv_path || !Storage::exists($colegiado->cv_path)) {
            abort(404, 'CV no disponible');
        }

        $nombre = 'CV_' . $colegiado->codigo_cpap . '.pdf';

        return response()->file(Storage::path($colegiado->cv_path), [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $nombre . '"',
        ]);
    }
}
