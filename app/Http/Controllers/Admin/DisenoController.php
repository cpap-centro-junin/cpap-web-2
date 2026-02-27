<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConfiguracionDiseno;
use Illuminate\Http\Request;

class DisenoController extends Controller
{
    /**
     * Mostrar el formulario de edición de diseño
     */
    public function edit()
    {
        $config = ConfiguracionDiseno::obtener();
        return view('admin.diseno.edit', compact('config'));
    }

    /**
     * Actualizar la configuración de diseño
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            // Colores principales
            'color_primary' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'color_primary_dark' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'color_primary_light' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'color_secondary' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'color_accent' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            
            // Colores de estado
            'color_success' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'color_warning' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'color_danger' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            
            // Colores de texto y fondo
            'color_dark' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'color_medium_gray' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'color_light_gray' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'color_light' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            
            // Backgrounds
            'bg_body' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'bg_section_alt' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            
            // Footer
            'footer_bg' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'footer_text' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            
            // Header/Navbar
            'navbar_bg' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'navbar_text' => 'required|string|size:7|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $config = ConfiguracionDiseno::obtener();
        $config->update($data);

        return redirect()->back()
            ->with('success', '✅ Diseño actualizado correctamente. Los cambios se verán reflejados en el sitio público.');
    }

    /**
     * Restaurar valores predeterminados
     */
    public function restaurar()
    {
        $config = ConfiguracionDiseno::obtener();
        $config->restaurarPredeterminados();

        return redirect()->back()
            ->with('success', '✅ Diseño restaurado a valores predeterminados correctamente.');
    }
}
