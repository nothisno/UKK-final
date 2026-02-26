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
        // Update existing roles
        \DB::table('users')->where('role', 'admin')->update(['role' => 'admin']);
        \DB::table('users')->where('role', 'super_admin')->update(['role' => 'super_admin']);
        
        // Add new role 'petugas'
        // Note: This will be handled in the seeder or manually
        
        // Add stok column to peminjamen table
        if (!Schema::hasColumn('peminjamen', 'stok')) {
            Schema::table('peminjamen', function (Blueprint $table) {
                $table->integer('stok')->default(0)->after('alat_id')->comment('Jumlah stok yang dipinjam pada saat peminjaman');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            $table->dropColumn('stok');
        });
    }
};
