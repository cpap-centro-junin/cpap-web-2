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
        Schema::create('verificaciones_log', function (Blueprint $table) {
            $table->id();

            // Código verificado
            $table->string('codigo_verificacion', 100);

            // Información de quien verificó
            $table->string('ip_address', 45);
            $table->text('user_agent')->nullable();

            // Resultado
            $table->enum('resultado', ['exitoso', 'codigo_invalido', 'documento_inactivo']);

            $table->timestamp('created_at')->useCurrent();

            // Índices
            $table->index('codigo_verificacion', 'idx_codigo');
            $table->index('ip_address', 'idx_ip');
            $table->index('created_at', 'idx_fecha');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verificaciones_log');
    }
};
