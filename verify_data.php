<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🎉 VERIFIKASI DATA SAMPLE 🎉" . PHP_EOL;
echo "================================" . PHP_EOL;
echo PHP_EOL;

// Users
echo "👥 USERS:" . PHP_EOL;
$users = \App\Models\User::orderBy('role', 'desc')->get();
echo "Total Users: " . $users->count() . PHP_EOL;
foreach ($users as $user) {
    $role = $user->role === 'admin' ? '👑' : '👤';
    echo "  {$role} {$user->name} ({$user->email})" . PHP_EOL;
}

echo PHP_EOL;

// Categories
echo "📁 CATEGORIES:" . PHP_EOL;
$categories = \App\Models\Kategori::all();
echo "Total Categories: " . $categories->count() . PHP_EOL;
foreach ($categories as $category) {
    echo "  📂 {$category->nama_kategori}" . PHP_EOL;
}

echo PHP_EOL;

// Tools by Category
echo "🔧 TOOLS BY CATEGORY:" . PHP_EOL;
$alats = \App\Models\Alat::with('kategori')->get();
echo "Total Tools: " . $alats->count() . PHP_EOL;

$grouped = $alats->groupBy('kategori.nama_kategori');
foreach ($grouped as $categoryName => $tools) {
    echo "  📂 {$categoryName} ({$tools->count()} items):" . PHP_EOL;
    foreach ($tools as $tool) {
        $status = $tool->stok > 0 ? '✅' : '❌';
        echo "    {$status} {$tool->nama_alat} (Stok: {$tool->stok}, {$tool->kondisi})" . PHP_EOL;
    }
}

echo PHP_EOL;

// Peminjaman
echo "📋 PEMINJAMAN:" . PHP_EOL;
$peminjaman = \App\Models\Peminjaman::with(['user', 'alat'])->get();
echo "Total Peminjaman: " . $peminjaman->count() . PHP_EOL;

foreach ($peminjaman as $pinjam) {
    $status = match($pinjam->status) {
        'pending' => '⏳',
        'disetujui' => '✅',
        'dikembalikan' => '🔄',
        'ditolak' => '❌',
        default => '❓'
    };
    echo "  {$status} {$pinjam->user->name} meminjam {$pinjam->alat->nama_alat}" . PHP_EOL;
    echo "     📅 {$pinjam->tanggal_pinjam->format('d M Y')} - {$pinjam->tanggal_kembali->format('d M Y')}" . PHP_EOL;
}

echo PHP_EOL;

// Pengembalian
echo "🔄 PENGEMBALIAN:" . PHP_EOL;
$pengembalian = \Illuminate\Support\Facades\DB::table('pengembalian')->get();
echo "Total Pengembalian: " . $pengembalian->count() . PHP_EOL;

foreach ($pengembalian as $kembali) {
    $pinjam = \App\Models\Peminjaman::find($kembali->peminjaman_id);
    if ($pinjam) {
        echo "  ✅ {$pinjam->user->name} mengembalikan {$pinjam->alat->nama_alat}" . PHP_EOL;
        echo "     📅 {$kembali->tanggal_dikembalikan} (Kondisi: {$kembali->kondisi_setelah})" . PHP_EOL;
    }
}

echo PHP_EOL;
echo "================================" . PHP_EOL;
echo "🚀 Semua data sample siap digunakan!" . PHP_EOL;
echo "📱 Login di: http://127.0.0.1:8000/login" . PHP_EOL;
