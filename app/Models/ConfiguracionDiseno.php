<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionDiseno extends Model
{
    use HasFactory;

    protected $table = 'configuracion_diseno';

    protected $fillable = [
        // Colores principales
        'color_primary',
        'color_primary_dark',
        'color_primary_light',
        'color_secondary',
        'color_accent',
        
        // Colores de estado
        'color_success',
        'color_warning',
        'color_danger',
        
        // Colores de texto y fondo
        'color_dark',
        'color_medium_gray',
        'color_light_gray',
        'color_light',
        
        // Backgrounds
        'bg_body',
        'bg_section_alt',
        
        // Footer
        'footer_bg',
        'footer_text',
        
        // Header/Navbar
        'navbar_bg',
        'navbar_text',
        
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Obtener la configuración activa (singleton)
     */
    public static function obtener()
    {
        $config = self::where('activo', true)->first();
        
        // Si no existe, crear con valores predeterminados
        if (!$config) {
            $config = self::create(self::valoresPredeterminados());
        }
        
        return $config;
    }

    /**
     * Restaurar valores predeterminados
     */
    public function restaurarPredeterminados()
    {
        $this->update(self::valoresPredeterminados());
    }

    /**
     * Valores predeterminados del diseño CPAP
     */
    public static function valoresPredeterminados(): array
    {
        return [
            // Colores principales
            'color_primary' => '#8B1538',
            'color_primary_dark' => '#6B0F2A',
            'color_primary_light' => '#A02050',
            'color_secondary' => '#C9A961',
            'color_accent' => '#D4AF37',
            
            // Colores de estado
            'color_success' => '#2e7d32',
            'color_warning' => '#e65100',
            'color_danger' => '#d32f2f',
            
            // Colores de texto y fondo
            'color_dark' => '#1a1a1a',
            'color_medium_gray' => '#6C757D',
            'color_light_gray' => '#F8F9FA',
            'color_light' => '#FFFFFF',
            
            // Backgrounds
            'bg_body' => '#FFFFFF',
            'bg_section_alt' => '#F8F9FA',
            
            // Footer
            'footer_bg' => '#1a1a1a',
            'footer_text' => '#FFFFFF',
            
            // Header/Navbar
            'navbar_bg' => '#FFFFFF',
            'navbar_text' => '#1a1a1a',
            
            'activo' => true,
        ];
    }

    /**
     * Generar CSS en línea con las variables personalizadas
     */
    public function generarCSSVariables(): string
    {
        return ":root {
    /* Colores Principales */
    --primary: {$this->color_primary};
    --primary-dark: {$this->color_primary_dark};
    --primary-light: {$this->color_primary_light};
    --secondary: {$this->color_secondary};
    --accent: {$this->color_accent};
    
    /* Colores de Estado */
    --success: {$this->color_success};
    --warning: {$this->color_warning};
    --danger: {$this->color_danger};
    
    /* Colores de Texto y Fondo */
    --dark: {$this->color_dark};
    --medium-gray: {$this->color_medium_gray};
    --light-gray: {$this->color_light_gray};
    --light: {$this->color_light};
    
    /* Backgrounds */
    --bg-body: {$this->bg_body};
    --bg-section-alt: {$this->bg_section_alt};
    
    /* Footer */
    --footer-bg: {$this->footer_bg};
    --footer-text: {$this->footer_text};
    
    /* Navbar */
    --navbar-bg: {$this->navbar_bg};
    --navbar-text: {$this->navbar_text};
}";
    }
}
