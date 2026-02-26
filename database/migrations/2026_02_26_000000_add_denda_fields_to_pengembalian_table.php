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
        Schema::table('pengembalian', function (Blueprint $table) {
            $table->decimal('denda_keterlambatan', 10, 2)->nullable()->after('denda');
            $table->decimal('denda_kerusakan', 10, 2)->nullable()->after('denda_keterlambatan');
            $table->decimal('total_denda', 10, 2)->nullable()->after('denda_kerusakan');
            $table->enum('status_denda', ['belum_bayar', 'sudah_bayar'])->default('sudah_bayar')->after('total_denda');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengembalian', function (Blueprint $table) {
            $table->dropColumn(['denda_keterlambatan', 'denda_kerusakan', 'total_denda', 'status_denda']);
        });
    }
};

