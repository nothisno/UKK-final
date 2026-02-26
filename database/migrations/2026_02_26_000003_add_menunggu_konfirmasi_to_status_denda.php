<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE pengembalian MODIFY COLUMN status_denda ENUM('belum_bayar', 'menunggu_konfirmasi', 'sudah_bayar') DEFAULT 'sudah_bayar'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE pengembalian MODIFY COLUMN status_denda ENUM('belum_bayar', 'sudah_bayar') DEFAULT 'sudah_bayar'");
    }
};
