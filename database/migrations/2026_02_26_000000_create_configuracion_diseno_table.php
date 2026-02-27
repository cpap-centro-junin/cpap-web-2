<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('configuracion_diseno', function (Blueprint $table) {
            $table->id();
            
            // COLORES PRINCIPALES
            $table->string('color_primary', 7)->default('#8B1538');        // Granate
            $table->string('color_primary_dark', 7)->default('#6B0F2A');   // Granate oscuro
            $table->string('color_primary_light', 7)->default('#A02050');  // Granate claro
            $table->string('color_secondary', 7)->default('#C9A961');      // Dorado
            $table->string('color_accent', 7)->default('#D4AF37');         // Dorado brillante
            
            // COLORES DE ESTADO
            $table->string('color_success', 7)->default('#2e7d32');        // Verde
            $table->string('color_warning', 7)->default('#e65100');        // Naranja
            $table->string('color_danger', 7)->default('#d32f2f');         // Rojo
            
            // COLORES DE TEXTO Y FONDO
            $table->string('color_dark', 7)->default('#1a1a1a');           // Texto oscuro
            $table->string('color_medium_gray', 7)->default('#6C757D');    // Texto medio
            $table->string('color_light_gray', 7)->default('#F8F9FA');     // Fondo claro
            $table->string('color_light', 7)->default('#FFFFFF');          // Blanco
            
            // BACKGROUNDS
            $table->string('bg_body', 7)->default('#FFFFFF');              // Fondo del body
            $table->string('bg_section_alt', 7)->default('#F8F9FA');       // Fondo alternativo
            
            // FOOTER
            $table->string('footer_bg', 7)->default('#1a1a1a');            // Fondo footer
            $table->string('footer_text', 7)->default('#FFFFFF');          // Texto footer
            
            // HEADER/NAVBAR
            $table->string('navbar_bg', 7)->default('#FFFFFF');            // Fondo navbar
            $table->string('navbar_text', 7)->default('#1a1a1a');          // Texto navbar
            
            // CONFIGURACIÓN ACTIVA (solo habrá 1 registro)
            $table->boolean('activo')->default(true);
            
            $table->timestamps();
        });
        
        // Insertar configuración predeterminada
        DB::table('configuracion_diseno')->insert([
            'color_primary' => '#8B1538',
            'color_primary_dark' => '#6B0F2A',
            'color_primary_light' => '#A02050',
            'color_secondary' => '#C9A961',
            'color_accent' => '#D4AF37',
            'color_success' => '#2e7d32',
            'color_warning' => '#e65100',
            'color_danger' => '#d32f2f',
            'color_dark' => '#1a1a1a',
            'color_medium_gray' => '#6C757D',
            'color_light_gray' => '#F8F9FA',
            'color_light' => '#FFFFFF',
            'bg_body' => '#FFFFFF',
            'bg_section_alt' => '#F8F9FA',
            'footer_bg' => '#1a1a1a',
            'footer_text' => '#FFFFFF',
            'navbar_bg' => '#FFFFFF',
            'navbar_text' => '#1a1a1a',
            'activo' => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracion_diseno');
    }
};
