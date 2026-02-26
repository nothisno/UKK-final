@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="glass-card p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.kategoris.show', $kategori->id) }}" 
                   class="p-2 rounded-lg bg-gray-800/50 hover:bg-gray-700/50 transition-all duration-200">
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-white">Edit Kategori</h1>
                    <p class="text-gray-400 text-sm">Perbarui informasi kategori alat</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form -->
    <div class="glass-card p-6">
        <form method="POST" action="{{ route('admin.kategoris.update', $kategori->id) }}" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nama Kategori -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Nama Kategori</label>
                <input type="text" name="nama_kategori" required
                       value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                       placeholder="Masukkan nama kategori"
                       class="glass-input w-full px-4 py-3 rounded-lg text-white placeholder-gray-400">
                @error('nama_kategori')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                          placeholder="Masukkan deskripsi kategori (opsional)"
                          class="glass-input w-full px-4 py-3 rounded-lg text-white placeholder-gray-400">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info Singkat -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-400">
                <div>
                    <p>Dibuat: <span class="text-white font-medium">{{ $kategori->created_at->format('d M Y H:i') }}</span></p>
                </div>
                <div class="md:text-right">
                    <p>Terakhir diupdate: <span class="text-white font-medium">{{ $kategori->updated_at->format('d M Y H:i') }}</span></p>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.kategoris.show', $kategori->id) }}" 
                   class="px-6 py-2 rounded-lg bg-gray-800/50 hover:bg-gray-700/50 text-white text-sm font-medium transition-all duration-200">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 rounded-lg bg-blue-600/50 hover:bg-blue-500/50 text-white text-sm font-medium transition-all duration-200">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Update Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

