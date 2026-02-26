@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="glass-card p-6">
        <a href="{{ route('user.peminjaman.index') }}" class="text-gray-400 hover:text-white text-sm mb-4 inline-block">&larr; Kembali</a>
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
                    <span class="text-gray-400">Alat</span>
                    <span class="text-white">{{ $peminjaman->alat->nama_alat }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Tanggal Pinjam</span>
                    <span class="text-white">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Tanggal Kembali</span>
                    <span class="text-white">{{ $peminjaman->tanggal_kembali->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        @if($peminjaman->pengembalian)
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Data Pengembalian</h3>
            <div class="space-y-3">
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Tanggal Dikembalikan</span>
                    <span class="text-white">{{ $peminjaman->pengembalian->tanggal_dikembalikan->format('d M Y') }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Kondisi</span>
                    <span class="text-white">{{ ucfirst(str_replace('_', ' ', $peminjaman->pengembalian->kondisi_setelah)) }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-gray-700/50">
                    <span class="text-gray-400">Total Denda</span>
                    <span class="text-white">Rp {{ number_format($peminjaman->pengembalian->total_denda ?? 0, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-gray-400">Status Denda</span>
                    @if(($peminjaman->pengembalian->total_denda ?? 0) > 0)
                        @if($peminjaman->pengembalian->status_denda == 'belum_bayar')
                            <span class="text-red-400">Belum Bayar</span>
                        @elseif($peminjaman->pengembalian->status_denda == 'menunggu_konfirmasi')
                            <span class="text-yellow-400">Menunggu Konfirmasi Admin</span>
                        @else
                            <span class="text-green-400">Sudah Bayar</span>
                        @endif
                    @else
                        <span class="text-green-400">Tidak Ada Denda</span>
                    @endif
                </div>
                @if(($peminjaman->pengembalian->total_denda ?? 0) > 0 && $peminjaman->pengembalian->status_denda == 'belum_bayar')
                <form action="{{ route('user.pengembalian.claimPaid', $peminjaman->pengembalian->id) }}" method="POST" class="mt-4" onsubmit="return confirm('Konfirmasi bahwa Anda telah membayar denda ini?')">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg bg-green-600/50 hover:bg-green-500/50 text-white text-sm font-medium">Telah Membayar</button>
                </form>
                @endif
            </div>
        </div>
        @endif
    </div>

    <div class="glass-card p-6">
        <div class="flex justify-between items-center">
            @if($peminjaman->status == 'disetujui')
                <form action="{{ route('user.peminjaman.requestReturn', $peminjaman->id) }}" method="POST" onsubmit="return confirm('Yakin ingin mengembalikan alat ini?')">
                    @csrf
                    <button type="submit" class="px-6 py-2 rounded-lg bg-green-600/50 hover:bg-green-500/50 text-white font-medium">Kembalikan Alat</button>
                </form>
            @else
                <div></div>
            @endif
            @if($peminjaman->status == 'pending')
                <form action="{{ route('user.peminjaman.destroy', $peminjaman->id) }}" method="POST" onsubmit="return confirm('Batalkan pengajuan?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-2 rounded-lg bg-red-600/50 hover:bg-red-500/50 text-white">Batalkan Pengajuan</button>
                </form>
            @else
                <a href="{{ route('user.peminjaman.index') }}" class="px-6 py-2 rounded-lg bg-gray-800/50 text-white">Kembali</a>
            @endif
        </div>
    </div>
</div>
@endsection
