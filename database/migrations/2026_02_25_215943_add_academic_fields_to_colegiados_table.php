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
        Schema::table('colegiados', function (Blueprint $table) {
            // Nuevos campos académicos y de experiencia
            $table->string('grado_academico', 100)->nullable()->after('especialidad')
                ->comment('Licenciado, Magíster, Doctor, etc.');
            
            $table->text('especializacion_detalle')->nullable()->after('grado_academico')
                ->comment('Detalle ampliado de la especialización');
            
            $table->text('diplomados')->nullable()->after('especializacion_detalle')
                ->comment('Lista de diplomados obtenidos');
            
            $table->integer('experiencia_anos')->nullable()->after('diplomados')
                ->comment('Años de experiencia profesional');
            
            $table->enum('experiencia_sector', ['publica', 'privada', 'mixta'])->nullable()->after('experiencia_anos')
                ->comment('Sector de experiencia: pública, privada o mixta');
            
            // Campos de visibilidad para los nuevos campos
            $table->boolean('ocultar_grado_academico')->default(false)->after('ocultar_cv');
            $table->boolean('ocultar_especializacion_detalle')->default(false)->after('ocultar_grado_academico');
            $table->boolean('ocultar_diplomados')->default(false)->after('ocultar_especializacion_detalle');
            $table->boolean('ocultar_experiencia')->default(false)->after('ocultar_diplomados')
                ->comment('Oculta años y sector de experiencia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('colegiados', function (Blueprint $table) {
            $table->dropColumn([
                'grado_academico',
                'especializacion_detalle',
                'diplomados',
                'experiencia_anos',
                'experiencia_sector',
                'ocultar_grado_academico',
                'ocultar_especializacion_detalle',
                'ocultar_diplomados',
                'ocultar_experiencia',
            ]);
        });
    }
};
