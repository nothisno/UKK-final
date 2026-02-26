@extends('layouts.app')

@section('title', 'Manajemen Peminjaman')

@section('content')
<div class="space-y-6">
    <div class="glass-card p-6">
        <h2 class="text-2xl font-bold text-white mb-2">Manajemen Peminjaman</h2>
        <p class="text-gray-400">Daftar pengajuan peminjaman dari user</p>
    </div>

    <div class="glass-card p-6 no-print">
        <form method="GET" action="{{ route('admin.peminjaman.index') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[180px]">
                <label class="block text-sm text-gray-400 mb-1">Cari (nama/user, alat)</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." class="glass-input w-full px-4 py-3 rounded-lg text-white">
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-1">Status</label>
                <select name="status" class="glass-input px-4 py-3 rounded-lg text-white">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                    <option value="menunggu_konfirmasi_pengembalian" {{ request('status') == 'menunggu_konfirmasi_pengembalian' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                    <option value="dikembalikan" {{ request('status') == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}" class="glass-input px-4 py-3 rounded-lg text-white">
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-1">Tanggal Selesai</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}" class="glass-input px-4 py-3 rounded-lg text-white">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="btn-secondary">Filter</button>
                <a href="{{ route('admin.peminjaman.index') }}" class="px-4 py-3 rounded-lg border border-gray-500 text-gray-400 hover:bg-white/5">Reset</a>
            </div>
        </form>
    </div>

    <div class="glass-card p-6">
        @if($peminjaman->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-900/50">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">User</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Alat</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase">Stok</th>
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
                                <td class="px-6 py-4 text-sm text-white font-medium">{{ $pinjam->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-200">{{ $pinjam->alat?->nama_alat ?? 'Alat tidak ditemukan' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-200">{{ $pinjam->stok ?? 1 }}</td>
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
                                        @if(auth()->user()->isSuperAdmin() || auth()->user()->isPetugas())
                                            <a href="{{ route('admin.peminjaman.show', $pinjam->id) }}" class="text-blue-400 hover:text-blue-300 text-sm">Detail</a>
                                        @endif
                                        @if((auth()->user()->isSuperAdmin() || auth()->user()->isPetugas()) && $pinjam->status == 'pending' && auth()->user()->canApprovePeminjaman())
                                            <a href="{{ route('admin.peminjaman.approve', $pinjam->id) }}" class="text-green-400 hover:text-green-300 text-sm font-medium">Setujui</a>
                                            <a href="{{ route('admin.peminjaman.reject', $pinjam->id) }}" class="text-red-400 hover:text-red-300 text-sm font-medium">Tolak</a>
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
                <p class="text-gray-400">Belum ada pengajuan peminjaman.</p>
            </div>
        @endif
    </div>
</div>
@endsection
