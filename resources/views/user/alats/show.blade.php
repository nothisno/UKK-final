@extends('layouts.app')

@section('title', 'Detail Alat')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="glass-card p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('user.alats.index') }}" 
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
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Alat -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Informasi Alat</h3>

            <div class="space-y-4">
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
                    <span class="text-white">{{ $alat->stok }}</span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-gray-400 text-sm">Kondisi</span>
                    <span class="text-white">{{ ucfirst($alat->kondisi) }}</span>
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
            <a href="{{ route('user.alats.index') }}" 
               class="px-6 py-2 rounded-lg bg-gray-800/50 hover:bg-gray-700/50 text-white text-sm font-medium transition-all duration-200">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Katalog
            </a>
            
            @if($alat->stok > 0)
                <a href="{{ route('user.peminjaman.create') }}?alat_id={{ $alat->id }}" 
                   class="px-6 py-2 rounded-lg bg-blue-600/50 hover:bg-blue-500/50 text-white text-sm font-medium transition-all duration-200">
                    
                    Pinjam Alat Ini
                </a>
            @else
                <button disabled class="px-6 py-2 rounded-lg bg-gray-600/50 text-gray-400 text-sm font-medium cursor-not-allowed">
                    <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364l-5.864-5.864M12 21a3 3 0 11-6 0 3 3 0 016 0zm-6 0h6"></path>
                    </svg>
                    Tidak Tersedia
                </button>
            @endif
        </div>
    </div>
</div>
@endsection
