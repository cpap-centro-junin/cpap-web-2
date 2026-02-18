<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('directivos', function (Blueprint $table) {
            $table->id();
            $table->string('cargo');
            $table->string('nombre');
            $table->string('especialidad')->nullable();
            $table->string('foto')->nullable();
            $table->string('periodo')->default('2024-2026');
            $table->integer('orden')->default(0);
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('directivos');
    }
};
