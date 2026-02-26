<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE peminjamen MODIFY COLUMN status ENUM('pending', 'disetujui', 'ditolak', 'dikembalikan', 'menunggu_konfirmasi_pengembalian') DEFAULT 'pending'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE peminjamen MODIFY COLUMN status ENUM('pending', 'disetujui', 'ditolak', 'dikembalikan') DEFAULT 'pending'");
    }
};
