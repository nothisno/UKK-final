@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="glass-card p-6">
        <a href="{{ route('admin.peminjaman.index') }}" class="text-gray-400 hover:text-white text-sm mb-4 inline-block">&larr; Kembali</a>
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-white">Detail Peminjaman #{{ $peminjaman->id }}</h2>
            @if($peminjaman->status == 'pending')
                <span class="status-badge status-pending">Pending</span>
            @elseif($peminjaman->status == 'disetujui')
                <span class="status-badge status-approved">Disetujui</span>
            @elseif($peminjaman->status == 'menunggu_konfirmasi_pengembalian')
                <span class="status-badge bg-yellow-500/20 text-yellow-400">Menunggu Verifikasi</span>
            @elseif($peminjaman->status == 'dikembalikan')
                <span class="status-badge status-returned">Dikembalikan</span>
            @else
                <span class="status-badge status-rejected">Ditolak</span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Informasi Peminjaman</h3>
            <div class="space-y-3">
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">User</span>
                    <span class="text-white">{{ $peminjaman->user->name }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Alat</span>
                    <span class="text-white">{{ $peminjaman->alat->nama_alat }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Tanggal Pinjam</span>
                    <span class="text-white">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-gray-400">Tanggal Kembali</span>
                    <span class="text-white">{{ $peminjaman->tanggal_kembali->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Aksi</h3>
            <div class="space-y-2">
                @if($peminjaman->status == 'pending')
                    <a href="{{ route('admin.peminjaman.approve', $peminjaman->id) }}" class="block w-full px-4 py-2 rounded-lg bg-green-600/50 hover:bg-green-500/50 text-white text-center font-medium">Setujui (Stok akan berkurang)</a>
                    <a href="{{ route('admin.peminjaman.reject', $peminjaman->id) }}" class="block w-full px-4 py-2 rounded-lg bg-red-600/50 hover:bg-red-500/50 text-white text-center font-medium">Tolak</a>
                @elseif($peminjaman->status == 'menunggu_konfirmasi_pengembalian')
                    <a href="{{ route('admin.pengembalian.create.with', $peminjaman->id) }}" class="block w-full px-4 py-2 rounded-lg bg-blue-600/50 hover:bg-blue-500/50 text-white text-center font-medium">Verifikasi Pengembalian</a>
                @else
                    <p class="text-gray-400 text-sm">Tidak ada aksi tersedia.</p>
                @endif
            </div>
        </div>
    </div>

    @if($peminjaman->pengembalian)
    <div class="glass-card p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Data Pengembalian</h3>
        <div class="grid grid-cols-2 gap-4">
            <div><span class="text-gray-400">Tanggal Dikembalikan:</span> {{ $peminjaman->pengembalian->tanggal_dikembalikan->format('d M Y') }}</div>
            <div><span class="text-gray-400">Kondisi:</span> {{ ucfirst(str_replace('_', ' ', $peminjaman->pengembalian->kondisi_setelah)) }}</div>
            <div><span class="text-gray-400">Denda:</span> Rp {{ number_format($peminjaman->pengembalian->total_denda ?? 0, 0, ',', '.') }}</div>
            <div><span class="text-gray-400">Status Denda:</span> {{ $peminjaman->pengembalian->status_denda == 'belum_bayar' ? 'Belum Bayar' : 'Sudah Bayar' }}</div>
        </div>
    </div>
    @endif
</div>
@endsection
