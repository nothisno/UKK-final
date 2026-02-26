@extends('layouts.app')

@section('title', 'Detail User')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- User Info Card -->
    <div class="glass-card p-8 mb-6">
        <div class="flex items-start justify-between">
            <div class="flex items-center">
                <div class="w-20 h-20 rounded-full bg-gradient-to-r from-blue-500 to-purple-600 flex items-center justify-center text-white text-2xl font-bold mr-6">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-white mb-2">{{ $user->name }}</h2>
                    <p class="text-gray-400 mb-1">{{ $user->email }}</p>
                    <div class="flex items-center space-x-4">
                        @if($user->role === 'admin')
                            <span class="status-badge status-approved">Admin</span>
                        @else
                            <span class="status-badge status-pending">User</span>
                        @endif
                        <span class="text-gray-400 text-sm">
                            Terdaftar: {{ $user->created_at->format('d M Y H:i') }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-secondary">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit
                </a>
            </div>
        </div>
    </div>

    <!-- User Activity -->
    <div class="glass-card p-6">
        <h3 class="text-xl font-bold text-white mb-6">Aktivitas User</h3>
        
        @if($user->logActivities->count() > 0)
            <div class="space-y-4">
                @foreach($user->logActivities()->latest()->take(10)->get() as $activity)
                    <div class="flex items-start space-x-4 p-4 rounded-lg bg-glass-white/50">
                        <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="text-white font-medium">{{ $activity->aktivitas }}</p>
                            <p class="text-gray-400 text-sm">{{ $activity->waktu->format('d M Y H:i:s') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-400">Belum ada aktivitas yang tercatat untuk user ini.</p>
            </div>
        @endif
    </div>

    <!-- Back Button -->
    <div class="mt-6">
        <a href="{{ route('admin.users.index') }}" class="btn-secondary">
            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar User
        </a>
    </div>
</div>
@endsection
