@extends('layouts.app')

@section('title', 'Detail Pengembalian')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="glass-card p-6">
        <a href="{{ route('admin.pengembalian.index') }}" class="text-gray-400 hover:text-white text-sm mb-4 inline-block">&larr; Kembali</a>
        <h2 class="text-2xl font-bold text-white">Detail Pengembalian #{{ $pengembalian->id }}</h2>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Informasi Pengembalian</h3>
            <div class="space-y-3">
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Tanggal Dikembalikan</span>
                    <span class="text-white">{{ $pengembalian->tanggal_dikembalikan->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Kondisi</span>
                    <span class="text-white">{{ ucfirst(str_replace('_', ' ', $pengembalian->kondisi_setelah)) }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Denda Keterlambatan</span>
                    <span class="text-white">Rp {{ number_format($pengembalian->denda_keterlambatan ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Denda Kerusakan</span>
                    <span class="text-white">Rp {{ number_format($pengembalian->denda_kerusakan ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Total Denda</span>
                    <span class="text-white font-medium">Rp {{ number_format($pengembalian->total_denda ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-gray-400">Status Denda</span>
                    @if(($pengembalian->total_denda ?? 0) > 0)
                        @if($pengembalian->status_denda == 'belum_bayar')
                            <span class="text-red-400">Belum Bayar</span>
                        @elseif($pengembalian->status_denda == 'menunggu_konfirmasi')
                            <span class="text-yellow-400">Menunggu Konfirmasi</span>
                        @else
                            <span class="text-green-400">Sudah Bayar</span>
                        @endif
                    @else
                        <span class="text-green-400">Tidak Ada Denda</span>
                    @endif
                </div>
                @if($pengembalian->catatan)
                <div class="pt-3">
                    <span class="text-gray-400 text-sm block mb-1">Catatan</span>
                    <p class="text-white">{{ $pengembalian->catatan }}</p>
                </div>
                @endif
            </div>
        </div>

        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Informasi Peminjaman</h3>
            <div class="space-y-3">
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Peminjam</span>
                    <span class="text-white">{{ $pengembalian->peminjaman->user->name }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Alat</span>
                    <span class="text-white">{{ $pengembalian->peminjaman->alat->nama_alat }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Tanggal Pinjam</span>
                    <span class="text-white">{{ $pengembalian->peminjaman->tanggal_pinjam->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-gray-400">Tanggal Kembali (jadwal)</span>
                    <span class="text-white">{{ $pengembalian->peminjaman->tanggal_kembali->format('d M Y') }}</span>
                </div>
            </div>

            @if(($pengembalian->total_denda ?? 0) > 0 && $pengembalian->status_denda == 'menunggu_konfirmasi')
            <form action="{{ route('admin.pengembalian.markDendaPaid', $pengembalian->id) }}" method="POST" class="mt-6">
                @csrf
                <button type="submit" class="w-full px-4 py-2 rounded-lg bg-green-600/50 hover:bg-green-500/50 text-white font-medium">
                    Tandai Denda Sudah Dibayar
                </button>
            </form>
            @endif
        </div>
    </div>
</div>
@endsection
