@extends('layouts.app')

@section('title', 'Daftar Pengembalian')

@section('content')
<div class="space-y-6">
    <div class="glass-card p-6">
        <h2 class="text-2xl font-bold text-white mb-2">Daftar Pengembalian</h2>
        <p class="text-gray-400">Verifikasi pengembalian yang diajukan user</p>
    </div>

    @if($menungguVerifikasi->count() > 0)
    <div class="glass-card p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Menunggu Verifikasi</h3>
        <p class="text-gray-400 text-sm mb-4">User telah mengajukan pengembalian. Verifikasi kondisi alat, input denda jika ada.</p>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-900/50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Peminjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Alat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Tanggal Pinjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Tanggal Kembali</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/30">
                    @foreach($menungguVerifikasi as $pinjam)
                    <tr class="hover:bg-white/5">
                        <td class="px-6 py-4 text-sm text-gray-200">#{{ $pinjam->id }}</td>
                        <td class="px-6 py-4 text-sm text-white font-medium">{{ $pinjam->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-200">{{ $pinjam->alat->nama_alat }}</td>
                        <td class="px-6 py-4 text-sm text-gray-200">{{ $pinjam->tanggal_pinjam->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm text-gray-200">{{ $pinjam->tanggal_kembali->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.pengembalian.create.with', $pinjam->id) }}" class="px-3 py-1.5 rounded-lg bg-green-500/20 hover:bg-green-500/30 text-green-400 text-sm font-medium">Verifikasi</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    @if($menungguKonfirmasiDenda->count() > 0)
    <div class="glass-card p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Konfirmasi Pembayaran Denda</h3>
        <p class="text-gray-400 text-sm mb-4">User telah mengklaim telah membayar denda. Verifikasi dan konfirmasi.</p>
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-900/50">
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Peminjam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Alat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Total Denda</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700/30">
                    @foreach($menungguKonfirmasiDenda as $denda)
                    <tr class="hover:bg-white/5">
                        <td class="px-6 py-4 text-sm text-gray-200">#{{ $denda->id }}</td>
                        <td class="px-6 py-4 text-sm text-white font-medium">{{ $denda->peminjaman->user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-200">{{ $denda->peminjaman->alat?->nama_alat ?? 'Alat tidak ditemukan' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-200">Rp {{ number_format($denda->total_denda ?? 0, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
                                <form action="{{ route('admin.pengembalian.confirmDendaPaid', $denda->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-green-500/20 hover:bg-green-500/30 text-green-400 text-sm font-medium">Konfirmasi Pembayaran</button>
                                </form>
                                <a href="{{ route('admin.pengembalian.show', $denda->id) }}" class="text-blue-400 hover:text-blue-300 text-sm ml-2">Detail</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

    <div class="glass-card p-6">
        <h3 class="text-lg font-semibold text-white mb-4">Riwayat Pengembalian</h3>
        @if($pengembalian->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-900/50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Alat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Tanggal Dikembalikan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Kondisi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Total Denda</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Status Denda</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/30">
                        @foreach($pengembalian as $kembali)
                        <tr class="hover:bg-white/5">
                            <td class="px-6 py-4 text-sm text-gray-200">#{{ $kembali->id }}</td>
                            <td class="px-6 py-4 text-sm text-white font-medium">{{ $kembali->peminjaman->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-200">{{ $kembali->peminjaman->alat?->nama_alat ?? 'Alat tidak ditemukan' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-200">{{ $kembali->tanggal_dikembalikan->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm text-gray-200">{{ ucfirst(str_replace('_', ' ', $kembali->kondisi_setelah)) }}</td>
                            <td class="px-6 py-4 text-sm text-gray-200">Rp {{ number_format($kembali->total_denda ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if(($kembali->total_denda ?? 0) > 0)
                                    @if($kembali->status_denda == 'belum_bayar')
                                        <span class="status-badge status-rejected">Belum Bayar</span>
                                    @elseif($kembali->status_denda == 'menunggu_konfirmasi')
                                        <span class="status-badge bg-yellow-500/20 text-yellow-400">Menunggu Konfirmasi</span>
                                    @else
                                        <span class="status-badge status-approved">Sudah Bayar</span>
                                    @endif
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if(auth()->user()->isSuperAdmin() || auth()->user()->isAdmin())
                                    <a href="{{ route('admin.pengembalian.show', $kembali->id) }}" class="text-blue-400 hover:text-blue-300 text-sm">Detail</a>
                                    @if(($kembali->total_denda ?? 0) > 0 && $kembali->status_denda == 'menunggu_konfirmasi')
                                        <form action="{{ route('admin.pengembalian.confirmDendaPaid', $kembali->id) }}" method="POST" class="inline ml-2">
                                            @csrf
                                            <button type="submit" class="text-green-400 hover:text-green-300 text-sm font-medium">Konfirmasi Pembayaran</button>
                                        </form>
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $pengembalian->links() }}
        @else
            <p class="text-gray-400">Belum ada riwayat pengembalian.</p>
        @endif
    </div>
</div>
@endsection
