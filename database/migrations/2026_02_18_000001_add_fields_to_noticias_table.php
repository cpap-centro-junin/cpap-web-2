<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->text('resumen')->nullable()->after('contenido');
            $table->string('autor')->default('Redacción CPAP')->after('resumen');
            $table->string('categoria')->default('Institucional')->after('autor');
            $table->boolean('destacado')->default(false)->after('activo');
        });
    }

    public function down(): void
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->dropColumn(['resumen', 'autor', 'categoria', 'destacado']);
        });
    }
};
