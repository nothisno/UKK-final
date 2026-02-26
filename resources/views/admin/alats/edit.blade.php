@extends('layouts.app')

@section('title', 'Edit Alat')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="glass-card p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.alats.show', $alat->id) }}" 
                   class="p-2 rounded-lg bg-gray-800/50 hover:bg-gray-700/50 transition-all duration-200">
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-white">Edit Alat</h1>
                    <p class="text-gray-400 text-sm">Perbarui data alat yang ada</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="glass-card p-6">
        <form method="POST" action="{{ route('admin.alats.update', $alat->id) }}" 
              enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Nama Alat -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Nama Alat</label>
                <input type="text" name="nama_alat" required
                       value="{{ old('nama_alat', $alat->nama_alat) }}"
                       placeholder="Masukkan nama alat"
                       class="glass-input w-full px-4 py-3 rounded-lg text-white placeholder-gray-400">
                @error('nama_alat')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Kategori</label>
                <select name="kategori_id" required 
                        class="glass-input w-full px-4 py-3 rounded-lg text-white">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach(\App\Models\Kategori::all() as $kategori)
                        <option value="{{ $kategori->id }}" 
                                {{ old('kategori_id', $alat->kategori_id) == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Stok -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Stok</label>
                <input type="number" name="stok" required min="0"
                       value="{{ old('stok', $alat->stok) }}"
                       placeholder="Masukkan jumlah stok"
                       class="glass-input w-full px-4 py-3 rounded-lg text-white placeholder-gray-400">
                @error('stok')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kondisi -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Kondisi</label>
                <select name="kondisi" required 
                        class="glass-input w-full px-4 py-3 rounded-lg text-white">
                    <option value="">-- Pilih Kondisi --</option>
                    <option value="baik" {{ old('kondisi', $alat->kondisi) == 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="rusak" {{ old('kondisi', $alat->kondisi) == 'rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
                @error('kondisi')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4" 
                          placeholder="Masukkan deskripsi alat"
                          class="glass-input w-full px-4 py-3 rounded-lg text-white placeholder-gray-400">{{ old('deskripsi', $alat->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.alats.show', $alat->id) }}" 
                   class="px-6 py-2 rounded-lg bg-gray-800/50 hover:bg-gray-700/50 text-white text-sm font-medium transition-all duration-200">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 rounded-lg bg-blue-600/50 hover:bg-blue-500/50 text-white text-sm font-medium transition-all duration-200">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Alat
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
