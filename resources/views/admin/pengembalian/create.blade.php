@extends('layouts.app')

@section('title', 'Verifikasi Pengembalian')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="glass-card p-6">
        <a href="{{ route('admin.pengembalian.index') }}" class="text-gray-400 hover:text-white text-sm mb-4 inline-block">&larr; Kembali</a>
        <h2 class="text-2xl font-bold text-white mb-2">Verifikasi Pengembalian</h2>
        <p class="text-gray-400 text-sm mb-6">Periksa kondisi alat, isi tanggal dikembalikan, dan denda jika ada.</p>

        <div class="p-4 rounded-lg bg-gray-800/50 mb-6">
            <p class="text-white font-medium">Peminjaman #{{ $peminjaman->id }}</p>
            <p class="text-gray-400 text-sm">{{ $peminjaman->alat->nama_alat }} - {{ $peminjaman->user->name }}</p>
            <p class="text-gray-400 text-sm">Pinjam: {{ $peminjaman->tanggal_pinjam->format('d M Y') }} → Kembali: {{ $peminjaman->tanggal_kembali->format('d M Y') }}</p>
        </div>

        <form method="POST" action="{{ route('admin.pengembalian.store', $peminjaman->id) }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Tanggal Dikembalikan</label>
                <input type="date" name="tanggal_dikembalikan" required
                       value="{{ old('tanggal_dikembalikan', now()->format('Y-m-d')) }}"
                       min="{{ $peminjaman->tanggal_pinjam->format('Y-m-d') }}"
                       class="glass-input w-full px-4 py-3 rounded-lg text-white">
                @error('tanggal_dikembalikan')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Kondisi Alat Setelah Dikembalikan</label>
                <select name="kondisi_setelah" required class="glass-input w-full px-4 py-3 rounded-lg text-white">
                    <option value="">-- Pilih Kondisi --</option>
                    <option value="baik" {{ old('kondisi_setelah') == 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="rusak_ringan" {{ old('kondisi_setelah') == 'rusak_ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                    <option value="rusak_berat" {{ old('kondisi_setelah') == 'rusak_berat' ? 'selected' : '' }}>Rusak Berat</option>
                </select>
                @error('kondisi_setelah')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Denda Kerusakan (Rp) <span class="text-gray-500">— Opsional</span></label>
                <p class="text-gray-400 text-xs mb-2">Jika kondisi rusak, isi nominal denda kerusakan. Denda keterlambatan dihitung otomatis ({{ 'Rp ' . number_format(config('peminjaman.denda_keterlambatan_per_hari', 10000), 0, ',', '.') }}/hari jika terlambat).</p>
                <input type="number" name="denda_kerusakan" step="1" min="0" value="{{ old('denda_kerusakan', 0) }}"
                       placeholder="0"
                       class="glass-input w-full px-4 py-3 rounded-lg text-white">
                @error('denda_kerusakan')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Catatan (Opsional)</label>
                <textarea name="catatan" rows="3" placeholder="Catatan verifikasi..."
                          class="glass-input w-full px-4 py-3 rounded-lg text-white">{{ old('catatan') }}</textarea>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('admin.pengembalian.index') }}" class="px-6 py-2 rounded-lg bg-gray-800/50 text-white">Batal</a>
                <button type="submit" class="px-6 py-2 rounded-lg bg-green-600/50 hover:bg-green-500/50 text-white font-medium">
                    Verifikasi Pengembalian
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
