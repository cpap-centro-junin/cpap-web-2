<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->longText('imagen')->nullable()->change();
        });

        Schema::table('eventos', function (Blueprint $table) {
            $table->longText('imagen_portada')->nullable()->change();
        });

        Schema::table('directivos', function (Blueprint $table) {
            $table->longText('foto')->nullable()->change();
        });

        Schema::table('popup_anuncios', function (Blueprint $table) {
            $table->longText('imagen')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('noticias', function (Blueprint $table) {
            $table->string('imagen')->nullable()->change();
        });

        Schema::table('eventos', function (Blueprint $table) {
            $table->string('imagen_portada')->nullable()->change();
        });

        Schema::table('directivos', function (Blueprint $table) {
            $table->string('foto')->nullable()->change();
        });

        Schema::table('popup_anuncios', function (Blueprint $table) {
            $table->string('imagen')->nullable()->change();
        });
    }
};
