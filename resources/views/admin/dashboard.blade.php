@extends('layouts.app')

@section('title', 'PinjamIn')

@section('content')
<div class="fade-in">
    <h1 class="text-3xl font-bold text-white mb-8">PinjamIn Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Users</p>
                    <p class="text-2xl font-bold text-white">{{ App\Models\User::where('role', 'user')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-blue-500 bg-opacity-20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Alat</p>
                    <p class="text-2xl font-bold text-white">{{ App\Models\Alat::count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-green-500 bg-opacity-20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Peminjaman Pending</p>
                    <p class="text-2xl font-bold text-white">{{ App\Models\Peminjaman::where('status', 'pending')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-yellow-500 bg-opacity-20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
        
        <div class="glass-card rounded-lg p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Peminjaman Aktif</p>
                    <p class="text-2xl font-bold text-white">{{ App\Models\Peminjaman::where('status', 'disetujui')->count() }}</p>
                </div>
                <div class="w-12 h-12 rounded-full bg-purple-500 bg-opacity-20 flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="glass-card rounded-lg p-6">
            <h2 class="text-xl font-semibold text-white mb-4">Peminjaman Terbaru</h2>
            <div class="space-y-3">
                @php
                    $recentPeminjaman = App\Models\Peminjaman::with(['user', 'alat'])->latest()->take(5)->get();
                @endphp
                @forelse($recentPeminjaman as $peminjaman)
                    <div class="flex items-center justify-between p-3 rounded-lg bg-white bg-opacity-5">
                        <div>
                            <p class="text-white font-medium">{{ $peminjaman->alat->nama_alat }}</p>
                            <p class="text-gray-400 text-sm">{{ $peminjaman->user->name }}</p>
                        </div>
                        <span class="status-badge status-{{ $peminjaman->status }}">
                            {{ ucfirst($peminjaman->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">Belum ada peminjaman</p>
                @endforelse
            </div>
        </div>
        
        <div class="glass-card rounded-lg p-6">
            <h2 class="text-xl font-semibold text-white mb-4">Activity Log</h2>
            <div class="space-y-3">
                @php
                    $recentActivities = App\Models\LogActivity::with('user')->latest()->take(5)->get();
                @endphp
                @forelse($recentActivities as $activity)
                    <div class="p-3 rounded-lg bg-white bg-opacity-5">
                        <p class="text-white text-sm">{{ $activity->aktivitas }}</p>
                        <p class="text-gray-400 text-xs">{{ $activity->user->name }} • {{ $activity->waktu->diffForHumans() }}</p>
                    </div>
                @empty
                    <p class="text-gray-400 text-center py-4">Belum ada aktivitas</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
