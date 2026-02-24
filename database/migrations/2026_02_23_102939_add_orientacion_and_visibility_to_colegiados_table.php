<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('colegiados', function (Blueprint $table) {
            // Nuevo campo: Orientación profesional
            $table->string('orientacion', 150)->nullable()->after('especialidad')
                ->comment('Orientación o enfoque de especialización');

            // Visibilidad del perfil completo en el directorio público
            $table->boolean('perfil_oculto')->default(false)->after('estado')
                ->comment('Si es true, el perfil no aparece en el directorio público');

            // Control de visibilidad por campo (admin siempre los ve)
            $table->boolean('ocultar_email')->default(false)->after('perfil_oculto');
            $table->boolean('ocultar_telefono')->default(false)->after('ocultar_email');
            $table->boolean('ocultar_descripcion')->default(false)->after('ocultar_telefono');
        });

        // Actualizar FULLTEXT para incluir orientacion (solo MySQL)
        if (DB::getDriverName() === 'mysql') {
            try {
                DB::statement('ALTER TABLE colegiados DROP INDEX idx_busqueda');
                DB::statement('ALTER TABLE colegiados ADD FULLTEXT INDEX idx_busqueda (nombres, apellidos, especialidad, orientacion)');
            } catch (\Exception $e) {
                // Silenciar si el índice no existe o falla en algún entorno
            }
        }
    }

    public function down(): void
    {
        Schema::table('colegiados', function (Blueprint $table) {
            $table->dropColumn([
                'orientacion',
                'perfil_oculto',
                'ocultar_email',
                'ocultar_telefono',
                'ocultar_descripcion',
            ]);
        });

        // Restaurar FULLTEXT original
        if (DB::getDriverName() === 'mysql') {
            try {
                DB::statement('ALTER TABLE colegiados DROP INDEX idx_busqueda');
                DB::statement('ALTER TABLE colegiados ADD FULLTEXT INDEX idx_busqueda (nombres, apellidos, especialidad)');
            } catch (\Exception $e) {
                //
            }
        }
    }
};
