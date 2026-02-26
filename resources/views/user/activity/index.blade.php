@extends('layouts.app')

@section('title', 'Activity')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="glass-card p-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-white mb-2">Activity</h2>
            <p class="text-gray-400">Riwayat aktivitas Anda di sistem</p>
        </div>
    </div>

    <!-- Activity List -->
    <div class="glass-card p-6">
        @if($activities->count() > 0)
            <div class="space-y-4">
                @foreach($activities as $activity)
                    <div class="flex justify-between items-start border-b border-glass-border pb-3 last:border-0 last:pb-0">
                        <div>
                            <p class="text-sm text-white">{{ $activity->aktivitas }}</p>
                            <p class="text-xs text-gray-400 mt-1">
                                {{ $activity->waktu->format('d M Y H:i') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $activities->links() }}
            </div>
        @else
            <div class="text-center py-10">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2v1a3 3 0 013-3h4a3 3 0 013 3v1a3 3 0 01-3 3H9z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-white mb-2">Belum ada aktivitas</h3>
                <p class="text-gray-400 text-sm">Aktivitas Anda akan muncul di sini ketika Anda mulai menggunakan sistem.</p>
            </div>
        @endif
    </div>
</div>
@endsection

