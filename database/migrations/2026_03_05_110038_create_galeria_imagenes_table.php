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
        Schema::create('galeria_imagenes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->text('descripcion')->nullable();
            $table->string('imagen');
            $table->string('categoria', 100)->nullable();
            $table->date('fecha')->nullable();
            $table->boolean('destacado')->default(false);
            $table->boolean('activo')->default(true);
            $table->integer('orden')->default(0);
            $table->timestamps();

            $table->index(['activo', 'destacado']);
            $table->index('categoria');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeria_imagenes');
    }
};
