@extends('layouts.app')

@section('title', 'Katalog Alat')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="glass-card p-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-white mb-2">Katalog Alat</h2>
            <p class="text-gray-400">Jelajahi dan pinjam alat yang tersedia</p>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="glass-card p-6">
        <form method="GET" action="{{ route('user.alats.index') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-64">
                <input type="text" name="search" placeholder="Cari alat..." 
                       class="glass-input w-full px-4 py-3 rounded-lg text-white placeholder-gray-400"
                       value="{{ request('search') }}">
            </div>
            <div class="flex gap-2">
                <select name="kategori" class="glass-input px-4 py-3 rounded-lg text-white">
                    <option value="">Semua Kategori</option>
                    @foreach(App\Models\Kategori::all() as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn-secondary">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0m-6 6l6 6"></path>
                    </svg>
                    Cari
                </button>
            </div>
        </form>
    </div>

    <!-- Alat Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($alats as $alat)
            <div class="glass-card rounded-lg p-6 hover:scale-105 transition-transform duration-300">
                <div class="mb-4">
                    <div class="w-full h-32 rounded-lg bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                </div>
                
                <h3 class="text-lg font-semibold text-white mb-2">{{ $alat->nama_alat }}</h3>
                <p class="text-gray-400 text-sm mb-2">{{ $alat->kategori->nama_kategori }}</p>
                <p class="text-gray-300 text-sm mb-4 line-clamp-2">{{ $alat->deskripsi ?: 'Tidak ada deskripsi' }}</p>
                
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm {{ $alat->stok > 0 ? 'text-green-400' : 'text-red-400' }}">
                            Stok: {{ $alat->stok }}
                        </span>
                        <span class="status-badge status-{{ $alat->kondisi === 'baik' ? 'approved' : 'pending' }}">
                            {{ ucfirst($alat->kondisi) }}
                        </span>
                    </div>
                </div>
                
                <div class="flex space-x-2">
                    <a href="{{ route('user.alats.show', $alat->id) }}" class="glass-button flex-1 px-3 py-2 rounded-lg text-white text-center hover:bg-white hover:bg-opacity-20">
                        
                        Detail
                    </a>
                    @if($alat->stok > 0)
                        <a href="{{ route('user.peminjaman.create') }}?alat_id={{ $alat->id }}" class="glass-button flex-1 px-3 py-2 rounded-lg bg-green-500 bg-opacity-20 text-white text-center hover:bg-green-500 hover:bg-opacity-30">
                           
                            Pinjam
                        </a>
                    @else
                        <button disabled class="glass-button flex-1 px-3 py-2 rounded-lg bg-gray-500 bg-opacity-20 text-gray-400 text-center cursor-not-allowed">
                           
                            Tidak Tersedia
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 00-2 2h-2M9 5a2 2 0 002 2h2a2 2 0 012-2v1a3 3 0 013-3h4a3 3 0 013 3v1a3 3 0 01-3 3H9z"></path>
                </svg>
                @if(request('search') || request('kategori'))
                    <h3 class="text-xl font-semibold text-white mb-2">Alat tidak ditemukan</h3>
                    <p class="text-gray-400 mb-6">
                        Tidak ada alat yang cocok dengan pencarian atau filter Anda. Mohon coba kata kunci atau kategori lain.
                    </p>
                @else
                    <h3 class="text-xl font-semibold text-white mb-2">Tidak Ada Alat Tersedia</h3>
                    <p class="text-gray-400 mb-6">Tidak ada alat yang tersedia saat ini. Silakan coba lagi nanti.</p>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($alats->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="glass-card rounded-lg p-2 flex space-x-2">
                {{ $alats->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
