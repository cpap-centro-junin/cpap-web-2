<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('directivos', function (Blueprint $table) {
            if (Schema::hasColumn('directivos', 'especialidad')) {
                $table->dropColumn('especialidad');
            }
        });
    }

    public function down(): void
    {
        Schema::table('directivos', function (Blueprint $table) {
            $table->string('especialidad')->nullable()->after('nombre');
        });
    }
};
