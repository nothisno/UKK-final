@extends('layouts.app')

@section('title', 'Laporan')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="glass-card p-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-white mb-2">Laporan</h2>
            <p class="text-gray-400">Lihat dan analisis data peminjaman dan pengembalian</p>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="glass-card p-6 text-center">
            <div class="text-3xl font-bold text-blue-400 mb-2">{{ \App\Models\Peminjaman::count() }}</div>
            <div class="text-sm text-gray-400">Total Peminjaman</div>
        </div>
        
        <div class="glass-card p-6 text-center">
            <div class="text-3xl font-bold text-green-400 mb-2">{{ \App\Models\Pengembalian::count() }}</div>
            <div class="text-sm text-gray-400">Total Pengembalian</div>
        </div>
        
        <div class="glass-card p-6 text-center">
            <div class="text-3xl font-bold text-yellow-400 mb-2">{{ \App\Models\Alat::count() }}</div>
            <div class="text-sm text-gray-400">Total Alat</div>
        </div>
        
        <div class="glass-card p-6 text-center">
            <div class="text-3xl font-bold text-purple-400 mb-2">{{ \App\Models\Kategori::count() }}</div>
            <div class="text-sm text-gray-400">Total Kategori</div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="glass-card p-6">
        <h3 class="text-lg font-semibold text-white mb-6">Laporan Detail</h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <a href="{{ route('admin.laporan.peminjaman') }}" 
               class="glass-card p-6 block hover:bg-white/10 transition-all duration-200">
                <div class="flex items-center space-x-4">
                    <div class="p-3 rounded-lg bg-blue-600/20">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 6h6m2-5a7 7 0 11-14 0 7 7 0 0114 0m-6 6l6 6"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-white mb-2">Laporan Peminjaman</h4>
                        <p class="text-gray-400 text-sm">Lihat semua data peminjaman alat</p>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('admin.laporan.pengembalian') }}" 
               class="glass-card p-6 block hover:bg-white/10 transition-all duration-200">
                <div class="flex items-center space-x-4">
                    <div class="p-3 rounded-lg bg-green-600/20">
                        <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l6m-6 6h6m2-5a7 7 0 11-14 0 7 7 0 0114 0m-6 6l6 6"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-white mb-2">Laporan Pengembalian</h4>
                        <p class="text-gray-400 text-sm">Lihat semua data pengembalian alat</p>
                    </div>
                </div>
            </a>
            
            <a href="{{ route('admin.laporan.activity') }}" 
               class="glass-card p-6 block hover:bg-white/10 transition-all duration-200">
                <div class="flex items-center space-x-4">
                    <div class="p-3 rounded-lg bg-purple-600/20">
                        <svg class="w-8 h-8 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m0 0l3-3m-3 3h14a3 3 0 013-3 3v1a3 3 0 01-3 3H9z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold text-white mb-2">Log Activity</h4>
                        <p class="text-gray-400 text-sm">Lihat log aktivitas sistem</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

@endsection
