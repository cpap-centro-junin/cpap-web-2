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
        Schema::create('colegiados', function (Blueprint $table) {
            $table->id();

            // Identificación única
            $table->string('codigo_cpap', 50)->unique()->comment('Ej: CPAP-2026-00001');
            $table->string('dni', 8)->unique();

            // Información personal
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('email', 100)->unique()->nullable();
            $table->string('telefono', 15)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('foto')->nullable()->comment('path: public/images/colegiados/{dni}.jpg');

            // Información profesional
            $table->string('especialidad', 150)->nullable();
            $table->string('universidad', 200)->nullable();
            $table->year('anio_graduacion')->nullable();
            $table->text('descripcion')->nullable()->comment('Breve descripción o bio profesional');

            // Archivos
            $table->string('cv_path')->nullable()->comment('path: storage/app/cv/{dni}.pdf');

            // Estado de habilitación
            $table->enum('estado', ['activo', 'inactivo'])->default('inactivo');

            // Fecha de colegiatura
            $table->date('fecha_colegiatura');

            $table->timestamps();

            // Índices para búsqueda rápida
            $table->index('dni', 'idx_dni');
            $table->index('codigo_cpap', 'idx_codigo');
            $table->index('estado', 'idx_estado');
            $table->index(['nombres', 'apellidos'], 'idx_nombres');
            $table->fullText(['nombres', 'apellidos', 'especialidad'], 'idx_busqueda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colegiados');
    }
};
