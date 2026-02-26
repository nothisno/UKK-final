@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <div class="glass-card p-6">
        <a href="{{ route('user.peminjaman.index') }}" class="text-gray-400 hover:text-white text-sm mb-4 inline-block">&larr; Kembali</a>
        <h2 class="text-2xl font-bold text-white mb-2">Ajukan Peminjaman</h2>
        <p class="text-gray-400 text-sm mb-6">Pilih alat, tanggal pinjam dan tanggal kembali</p>

        <form method="POST" action="{{ route('user.peminjaman.store') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Alat</label>
                <select name="alat_id" required class="glass-input w-full px-4 py-3 rounded-lg text-white">
                    <option value="">-- Pilih Alat --</option>
                    @foreach($alats as $alat)
                        <option value="{{ $alat->id }}" {{ ($selectedAlat && $selectedAlat->id == $alat->id) || old('alat_id') == $alat->id ? 'selected' : '' }}>
                            {{ $alat->nama_alat }} ({{ $alat->kategori->nama_kategori }}) - Stok: {{ $alat->stok }}
                        </option>
                    @endforeach
                </select>
                @error('alat_id')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" required value="{{ old('tanggal_pinjam', now()->format('Y-m-d')) }}"
                       min="{{ now()->format('Y-m-d') }}"
                       class="glass-input w-full px-4 py-3 rounded-lg text-white">
                @error('tanggal_pinjam')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Tanggal Kembali</label>
                <input type="date" name="tanggal_kembali" required value="{{ old('tanggal_kembali') }}"
                       class="glass-input w-full px-4 py-3 rounded-lg text-white">
                @error('tanggal_kembali')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Jumlah Stok</label>
                <input type="number" name="stok" required min="1" value="{{ old('stok', 1) }}"
                       class="glass-input w-full px-4 py-3 rounded-lg text-white"
                       placeholder="Masukkan jumlah yang ingin dipinjam">
                @error('stok')<p class="mt-1 text-sm text-red-400">{{ $message }}</p>@enderror
                <p class="mt-1 text-xs text-gray-400">Stok tersedia: <span id="stok-tersedia">{{ $selectedAlat->stok ?? 0 }}</span></p>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('user.peminjaman.index') }}" class="px-6 py-2 rounded-lg bg-gray-800/50 text-white">Batal</a>
                <button type="submit" class="px-6 py-2 rounded-lg bg-blue-600/50 hover:bg-blue-500/50 text-white font-medium">
                    Ajukan Peminjaman
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const alatSelect = document.querySelector('select[name="alat_id"]');
    const stokTersedia = document.getElementById('stok-tersedia');
    
    // Data stok alat
    const alatStok = {
        @foreach($alats as $alat)
        '{{ $alat->id }}': {{ $alat->stok }},
        @endforeach
    };
    
    alatSelect.addEventListener('change', function() {
        const selectedAlatId = this.value;
        if (selectedAlatId && alatStok[selectedAlatId] !== undefined) {
            stokTersedia.textContent = alatStok[selectedAlatId];
        } else {
            stokTersedia.textContent = '0';
        }
    });
    
    // Update stok saat halaman dimuat
    if (alatSelect.value && alatStok[alatSelect.value] !== undefined) {
        stokTersedia.textContent = alatStok[alatSelect.value];
    }
});
</script>
@endsection
