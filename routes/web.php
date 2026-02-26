<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\AlatController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\Admin\PengembalianController;
use App\Http\Controllers\Admin\TrashController;
use App\Http\Controllers\User\AlatController as UserAlatController;
use App\Http\Controllers\User\PeminjamanController as UserPeminjamanController;
use App\Http\Controllers\User\ActivityController as UserActivityController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    if (auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isPetugas() || auth()->user()->isSuperAdmin())) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('users', UserController::class)->except(['destroy']);
    
    // Kategoris Routes
    Route::get('kategoris', [KategoriController::class, 'index'])->name('kategoris.index');
    Route::get('kategoris/create', [KategoriController::class, 'create'])->name('kategoris.create');
    Route::post('kategoris', [KategoriController::class, 'store'])->name('kategoris.store');
    Route::get('kategoris/{id}', [KategoriController::class, 'show'])->name('kategoris.show');
    Route::get('kategoris/{id}/edit', [KategoriController::class, 'edit'])->name('kategoris.edit');
    Route::put('kategoris/{id}', [KategoriController::class, 'update'])->name('kategoris.update');
    Route::delete('kategoris/{id}', [KategoriController::class, 'destroy'])->name('kategoris.destroy');

    Route::get('trash', [TrashController::class, 'index'])->name('trash.index');
    Route::post('trash/restore/alat/{id}', [TrashController::class, 'restoreAlat'])->name('trash.restore.alat');
    Route::post('trash/restore/kategori/{id}', [TrashController::class, 'restoreKategori'])->name('trash.restore.kategori');
    
    Route::resource('alats', AlatController::class);
    Route::resource('peminjaman', PeminjamanController::class)->except(['destroy', 'show']);
    
    // Detail peminjaman hanya untuk Super Admin dan Petugas
    Route::get('peminjaman/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
    
    Route::get('peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])->name('peminjaman.approve');
    Route::get('peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])->name('peminjaman.reject');
    
    Route::get('pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
    Route::get('pengembalian/create/{peminjamanId}', [PengembalianController::class, 'create'])->name('pengembalian.create.with');
    Route::post('pengembalian/{peminjamanId}', [PengembalianController::class, 'store'])->name('pengembalian.store');
    Route::get('pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::get('pengembalian/{id}', [PengembalianController::class, 'show'])->name('pengembalian.show');
    Route::post('pengembalian/{id}/mark-denda-paid', [PengembalianController::class, 'markDendaPaid'])->name('pengembalian.markDendaPaid');
    Route::post('pengembalian/{id}/confirm-denda-paid', [PengembalianController::class, 'confirmDendaPaid'])->name('pengembalian.confirmDendaPaid');

    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/peminjaman', [LaporanController::class, 'peminjaman'])->name('laporan.peminjaman');
    Route::get('laporan/pengembalian', [LaporanController::class, 'pengembalian'])->name('laporan.pengembalian');
    Route::get('laporan/activity', [LaporanController::class, 'activity'])->name('laporan.activity');
});

// User Routes
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', function () {
        return view('user.dashboard');
    })->name('dashboard');

    Route::resource('alats', UserAlatController::class);
    Route::resource('peminjaman', UserPeminjamanController::class);
    Route::post('peminjaman/{id}/request-return', [UserPeminjamanController::class, 'requestReturn'])->name('peminjaman.requestReturn');
    Route::post('pengembalian/{id}/claim-paid', [UserPeminjamanController::class, 'claimDendaPaid'])->name('pengembalian.claimPaid');

    // Activity log untuk user (hanya aktivitas dirinya sendiri)
    Route::get('activity', [UserActivityController::class, 'index'])->name('activity.index');
});

require __DIR__.'/auth.php';
