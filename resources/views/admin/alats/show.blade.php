@extends('layouts.app')

@section('title', 'Detail Alat')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="glass-card p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.alats.index') }}" 
                   class="p-2 rounded-lg bg-gray-800/50 hover:bg-gray-700/50 transition-all duration-200">
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-white">Detail Alat</h1>
                    <p class="text-gray-400 text-sm">Informasi lengkap data alat</p>
                </div>
            </div>

            <!-- Status Badge -->
            @if($alat->stok > 0)
                <span class="px-3 py-1 text-sm rounded-full bg-green-500/20 text-green-400 font-medium">
                    Tersedia
                </span>
            @else
                <span class="px-3 py-1 text-sm rounded-full bg-red-500/20 text-red-400 font-medium">
                    Tidak Tersedia
                </span>
            @endif
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Alat -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Informasi Alat</h3>

            <div class="space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-gray-700/50">
                    <span class="text-gray-400 text-sm">ID Alat</span>
                    <span class="text-white font-medium">#{{ $alat->id }}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-700/50">
                    <span class="text-gray-400 text-sm">Nama Alat</span>
                    <span class="text-white font-medium">{{ $alat->nama_alat }}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-700/50">
                    <span class="text-gray-400 text-sm">Kategori</span>
                    <span class="text-white">{{ $alat->kategori->nama_kategori }}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-700/50">
                    <span class="text-gray-400 text-sm">Stok Tersedia</span>
                    <span class="text-white font-medium">{{ $alat->stok }}</span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-gray-400 text-sm">Kondisi</span>
                    <span class="text-white font-medium">
                        @if($alat->kondisi == 'baik')
                            <span class="status-badge status-approved">Baik</span>
                        @else
                            <span class="status-badge status-rejected">Rusak</span>
                        @endif
                    </span>
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Deskripsi</h3>

            <div class="space-y-4">
                <div class="py-3">
                    <p class="text-gray-300 leading-relaxed">{{ $alat->deskripsi ?: 'Tidak ada deskripsi tersedia.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="glass-card p-6">
        <h3 class="text-lg font-semibold text-white mb-6">Aksi Cepat</h3>
        
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.alats.index') }}" 
               class="px-6 py-2 rounded-lg bg-gray-800/50 hover:bg-gray-700/50 text-white text-sm font-medium transition-all duration-200">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
            
            <a href="{{ route('admin.alats.edit', $alat->id) }}" 
               class="px-6 py-2 rounded-lg bg-green-600/50 hover:bg-green-500/50 text-white text-sm font-medium transition-all duration-200">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5h-1.793a1 1 0 01-.793-.207l-5.5-5.5a1 1 0 01-.207-.793H12z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.707 8.793l-5.5-5.5a1 1 0 00-.707-.293H3a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V9a1 1 0 00-.293-.707L18.707 8.793zM16 9h-3v3h3V9z"></path>
                </svg>
                Edit Alat
            </a>
        </div>
    </div>

    <!-- Additional Info -->
    <div class="glass-card p-6">
        <h3 class="text-lg font-semibold text-white mb-6">Informasi Tambahan</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-gray-700/50">
                    <span class="text-gray-400 text-sm">Dibuat</span>
                    <span class="text-white font-medium">{{ $alat->created_at->format('d M Y H:i') }}</span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-gray-400 text-sm">Terakhir Diupdate</span>
                    <span class="text-white font-medium">{{ $alat->updated_at->format('d M Y H:i') }}</span>
                </div>
            </div>
            
            <div class="flex justify-end">
                <form method="POST" action="{{ route('admin.alats.destroy', $alat->id) }}" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">
                    @csrf
                    <button type="submit" 
                            class="px-6 py-2 rounded-lg bg-red-600/50 hover:bg-red-500/50 text-white text-sm font-medium transition-all duration-200">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Alat
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
