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
        Schema::create('habilitaciones', function (Blueprint $table) {
            $table->id();

            // Relación con colegiado
            $table->foreignId('colegiado_id')->constrained('colegiados')->onDelete('cascade');

            // Código único para verificación (estilo Udemy)
            $table->string('codigo_verificacion', 100)->unique()->comment('UUID formato: HC-a3f4e8d9-4c2a-41f6-9b8e-3fa2c8d1e7f6');

            // Documento subido por admin
            $table->string('documento_path')->comment('path: storage/app/habilitaciones/{codigo_verificacion}.pdf');

            // QR generado automáticamente
            $table->string('qr_path')->comment('path: public/images/qr/{codigo_verificacion}.png');

            // Metadatos
            $table->foreignId('generado_por')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('fecha_subida')->useCurrent();

            // Estado del documento
            $table->boolean('activo')->default(true)->comment('false = revocado/anulado');

            $table->timestamps();

            // Índices
            $table->index('codigo_verificacion', 'idx_codigo');
            $table->index('colegiado_id', 'idx_colegiado');
            $table->index('activo', 'idx_activo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habilitaciones');
    }
};
