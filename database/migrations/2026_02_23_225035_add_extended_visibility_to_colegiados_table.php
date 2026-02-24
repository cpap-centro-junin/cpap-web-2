<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('colegiados', function (Blueprint $table) {
            $table->boolean('ocultar_especialidad')      ->default(false)->after('ocultar_descripcion');
            $table->boolean('ocultar_orientacion')       ->default(false)->after('ocultar_especialidad');
            $table->boolean('ocultar_universidad')       ->default(false)->after('ocultar_orientacion');
            $table->boolean('ocultar_anio_graduacion')   ->default(false)->after('ocultar_universidad');
            $table->boolean('ocultar_fecha_colegiatura') ->default(false)->after('ocultar_anio_graduacion');
            $table->boolean('ocultar_foto')              ->default(false)->after('ocultar_fecha_colegiatura');
            $table->boolean('ocultar_cv')                ->default(false)->after('ocultar_foto');
        });
    }

    public function down(): void
    {
        Schema::table('colegiados', function (Blueprint $table) {
            $table->dropColumn([
                'ocultar_especialidad',
                'ocultar_orientacion',
                'ocultar_universidad',
                'ocultar_anio_graduacion',
                'ocultar_fecha_colegiatura',
                'ocultar_foto',
                'ocultar_cv',
            ]);
        });
    }
};
