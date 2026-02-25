<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('biblioteca', function (Blueprint $table) {
            $table->id();

            // Información básica
            $table->string('titulo');
            $table->string('autor');
            $table->string('tipo');          // libro, articulo, tesis, documento, revista, multimedia
            $table->string('area_tematica'); // cultural, social, arqueologia, linguistica, biologica
            $table->text('descripcion');
            $table->string('editorial')->nullable();
            $table->year('anio_publicacion')->nullable();
            $table->string('isbn_issn')->nullable();
            $table->unsignedInteger('paginas')->nullable();
            $table->string('idioma')->default('Español');

            // Archivos y enlaces
            $table->string('archivo_pdf')->nullable();      // Ruta al archivo PDF subido
            $table->string('imagen_portada')->nullable();    // Ruta a la imagen de portada
            $table->string('enlace_externo')->nullable();    // URL externa (repositorio, DOI, etc.)

            // Copyright y licencia
            $table->string('copyright_titular')->nullable(); // Titular de los derechos
            $table->year('copyright_anio')->nullable();      // Año del copyright
            $table->string('licencia_tipo');                 // copyright, creative_commons_by, cc_by_sa, cc_by_nc, cc_by_nc_sa, cc_by_nd, cc_by_nc_nd, dominio_publico, licencia_cpap
            $table->text('notas_legales')->nullable();       // Notas adicionales de uso/restricción
            $table->boolean('descarga_permitida')->default(false); // Si se permite descarga directa
            $table->boolean('solo_colegiados')->default(false);    // Acceso restringido a colegiados

            // Estado
            $table->boolean('activo')->default(true);
            $table->boolean('destacado')->default(false);
            $table->unsignedInteger('descargas_count')->default(0);
            $table->unsignedInteger('vistas_count')->default(0);

            $table->timestamps();

            // Índices
            $table->index('tipo');
            $table->index('area_tematica');
            $table->index('activo');
            $table->index('destacado');
            $table->index('licencia_tipo');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('biblioteca');
    }
};
