@extends('layouts.app')

@section('title', 'Peminjaman Saya')

@section('content')
<div class="space-y-6">
    <div class="glass-card p-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-white mb-2">Peminjaman Saya</h2>
            <p class="text-gray-400">Daftar pengajuan peminjaman alat</p>
        </div>
        <a href="{{ route('user.peminjaman.create') }}" class="btn-primary">
            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0v6"></path>
            </svg>
            Ajukan Peminjaman
        </a>
    </div>

    @if($dendaBelumBayar->count() > 0 || $dendaMenungguKonfirmasi->count() > 0)
    <div class="glass-card p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Denda Saya</h3>
        <div class="space-y-3">
            @foreach($dendaBelumBayar as $denda)
            <div class="flex items-center justify-between py-3 border-b border-gray-700/50">
                <div>
                    <p class="text-white font-medium">{{ $denda->peminjaman->alat->nama_alat }}</p>
                    <p class="text-gray-400 text-sm">Rp {{ number_format($denda->total_denda ?? 0, 0, ',', '.') }} — Belum dibayar</p>
                </div>
                <form action="{{ route('user.pengembalian.claimPaid', $denda->id) }}" method="POST" onsubmit="return confirm('Konfirmasi bahwa Anda telah membayar denda ini?')">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-lg bg-green-600/50 hover:bg-green-500/50 text-white text-sm font-medium">Telah Membayar</button>
                </form>
            </div>
            @endforeach
            @foreach($dendaMenungguKonfirmasi as $denda)
            <div class="flex items-center justify-between py-3 border-b border-gray-700/50">
                <div>
                    <p class="text-white font-medium">{{ $denda->peminjaman->alat->nama_alat }}</p>
                    <p class="text-yellow-400 text-sm">Rp {{ number_format($denda->total_denda ?? 0, 0, ',', '.') }} — Menunggu konfirmasi admin</p>
                </div>
                <span class="px-3 py-1 rounded-lg bg-yellow-500/20 text-yellow-400 text-sm">Menunggu</span>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <div class="glass-card p-6">
        <form method="GET" action="{{ route('user.peminjaman.index') }}" class="flex flex-wrap gap-4">
            <select name="status" class="glass-input px-4 py-3 rounded-lg text-white">
                <option value="">Semua Status</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                <option value="menunggu_konfirmasi_pengembalian" {{ request('status') == 'menunggu_konfirmasi_pengembalian' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
            <button type="submit" class="btn-secondary">Filter</button>
        </form>
    </div>

    <div class="glass-card p-6">
        @if($peminjaman->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-900/50">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Alat</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Tanggal Pinjam</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Tanggal Kembali</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/30">
                        @foreach($peminjaman as $pinjam)
                            <tr class="hover:bg-white/5">
                                <td class="px-6 py-4 text-sm text-gray-200">#{{ $pinjam->id }}</td>
                                <td class="px-6 py-4 text-sm text-white font-medium">{{ $pinjam->alat->nama_alat }}</td>
                                <td class="px-6 py-4 text-sm text-gray-200">{{ $pinjam->tanggal_pinjam->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-200">{{ $pinjam->tanggal_kembali->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    @if($pinjam->status == 'pending')
                                        <span class="status-badge status-pending">Pending</span>
                                    @elseif($pinjam->status == 'disetujui')
                                        <span class="status-badge status-approved">Disetujui</span>
                                    @elseif($pinjam->status == 'menunggu_konfirmasi_pengembalian')
                                        <span class="status-badge bg-yellow-500/20 text-yellow-400">Menunggu Verifikasi</span>
                                    @elseif($pinjam->status == 'dikembalikan')
                                        <span class="status-badge status-returned">Dikembalikan</span>
                                    @else
                                        <span class="status-badge status-rejected">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('user.peminjaman.show', $pinjam->id) }}" class="text-blue-400 hover:text-blue-300">Detail</a>
                                        @if($pinjam->status == 'pending')
                                            <form action="{{ route('user.peminjaman.destroy', $pinjam->id) }}" method="POST" class="inline" onsubmit="return confirm('Batalkan pengajuan?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-400 hover:text-red-300 text-sm">Batal</button>
                                            </form>
                                        @endif
                                        @if($pinjam->status == 'disetujui')
                                            <form action="{{ route('user.peminjaman.requestReturn', $pinjam->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin mengembalikan alat ini?')">
                                                @csrf
                                                <button type="submit" class="text-green-400 hover:text-green-300 text-sm font-medium">Kembalikan</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $peminjaman->links() }}
        @else
            <div class="text-center py-12">
                <p class="text-gray-400 mb-4">Belum ada peminjaman.</p>
                <a href="{{ route('user.peminjaman.create') }}" class="btn-primary">Ajukan Peminjaman</a>
            </div>
        @endif
    </div>
</div>
@endsection
