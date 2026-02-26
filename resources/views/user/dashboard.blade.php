@extends('layouts.app')

@section('title', 'User Dashboard')

@section('content')
<div class="fade-in">
    <h1 class="text-3xl font-bold text-white mb-8">User Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Peminjaman</p>
                    <p class="text-2xl font-bold text-white">{{ App\Models\Peminjaman::where('user_id', auth()->id())->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-500 bg-opacity-20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Peminjaman Aktif</p>
                    <p class="text-2xl font-bold text-white">{{ App\Models\Peminjaman::where('user_id', auth()->id())->where('status', 'disetujui')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-500 bg-opacity-20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Alat Tersedia</p>
                    <p class="text-2xl font-bold text-white">{{ App\Models\Alat::where('stok', '>', 0)->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-500 bg-opacity-20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="glass-card rounded-lg p-6">
            <h2 class="text-xl font-semibold text-white mb-4">Peminjaman Saya</h2>
            <div class="space-y-3">
                @php
                    $myPeminjaman = App\Models\Peminjaman::with('alat')->where('user_id', auth()->id())->latest()->take(5)->get();
                @endphp
                @forelse($myPeminjaman as $peminjaman)
                    <div class="flex items-center justify-between p-3 rounded-lg bg-white bg-opacity-5">
                        <div>
                            <p class="text-white font-medium">{{ $peminjaman->alat->nama_alat }}</p>
                            <p class="text-gray-400 text-sm">{{ $peminjaman->tanggal_pinjam->format('d M Y') }}</p>
                        </div>
                        <span class="status-badge status-{{ $peminjaman->status }}">
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">Belum ada peminjaman</p>
                @endforelse
            </div>
            @if($myPeminjaman->count() > 0)
                <div class="mt-4">
                    <a href="{{ route('user.peminjaman.index') }}" class="glass-button inline-block px-4 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-20">
                        Lihat Semua
                    </a>
                </div>
            @endif
        </div>
        
        <div class="glass-card rounded-lg p-6">
            <h2 class="text-xl font-semibold text-white mb-4">Alat Tersedia</h2>
            <div class="space-y-3">
                @php
                    $availableAlats = App\Models\Alat::with('kategori')->where('stok', '>', 0)->take(5)->get();
                @endphp
                @forelse($availableAlats as $alat)
                    <div class="flex items-center justify-between p-3 rounded-lg bg-white bg-opacity-5">
                        <div>
                            <p class="text-white font-medium">{{ $alat->nama_alat }}</p>
                            <p class="text-gray-400 text-sm">{{ $alat->kategori->nama_kategori }} • Stok: {{ $alat->stok }}</p>
                        </div>
                        <a href="{{ route('user.alats.show', $alat->id) }}" class="glass-button px-3 py-1 rounded text-white text-sm hover:bg-white hover:bg-opacity-20">
                            Detail
                        </a>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">Tidak ada alat tersedia</p>
                @endforelse
            </div>
            @if($availableAlats->count() > 0)
                <div class="mt-4">
                    <a href="{{ route('user.alats.index') }}" class="glass-button inline-block px-4 py-2 rounded-lg text-white hover:bg-white hover:bg-opacity-20">
                        Lihat Semua
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
