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
        Schema::table('biblioteca', function (Blueprint $table) {
            // formato: fisico o digital (virtual)
            $table->string('formato', 20)->default('digital')->after('tipo');
            $table->index('formato');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('biblioteca', function (Blueprint $table) {
            $table->dropIndex(['formato']);
            $table->dropColumn('formato');
        });
    }
};
