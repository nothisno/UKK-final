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
        if (!Schema::hasColumn('alats', 'deleted_at')) {
            Schema::table('alats', function (Blueprint $table) {
                $table->softDeletes();
            });
        }

        if (!Schema::hasColumn('kategoris', 'deleted_at')) {
            Schema::table('kategoris', function (Blueprint $table) {
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alats', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('kategoris', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
