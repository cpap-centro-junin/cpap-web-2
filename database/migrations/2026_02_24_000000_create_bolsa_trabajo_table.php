<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bolsa_trabajo', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->string('empresa');
            $table->string('ubicacion');
            $table->string('tipo');          // fulltime, parttime, freelance, consultoria
            $table->string('area');          // investigacion, docencia, consultoria, gestion
            $table->text('descripcion');
            $table->string('salario')->nullable();
            $table->string('enlace_postulacion')->nullable();
            $table->string('nombre_contacto')->nullable();
            $table->string('email_contacto')->nullable();
            $table->date('fecha_publicacion');
            $table->date('fecha_vencimiento')->nullable();
            $table->boolean('activo')->default(true);
            $table->boolean('revisado')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bolsa_trabajo');
    }
};
