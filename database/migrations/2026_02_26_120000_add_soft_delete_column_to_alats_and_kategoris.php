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
        // Add soft_delete column to alats table
        if (!Schema::hasColumn('alats', 'soft_delete')) {
            Schema::table('alats', function (Blueprint $table) {
                $table->tinyInteger('soft_delete')->default(0)->comment('0 = active, 1 = deleted');
            });
        }

        // Add soft_delete column to kategoris table
        if (!Schema::hasColumn('kategoris', 'soft_delete')) {
            Schema::table('kategoris', function (Blueprint $table) {
                $table->tinyInteger('soft_delete')->default(0)->comment('0 = active, 1 = deleted');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alats', function (Blueprint $table) {
            $table->dropColumn('soft_delete');
        });

        Schema::table('kategoris', function (Blueprint $table) {
            $table->dropColumn('soft_delete');
        });
    }
};
