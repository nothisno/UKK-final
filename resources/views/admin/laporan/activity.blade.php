@extends('layouts.app')

@section('title', 'Log Activity')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="glass-card p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.laporan.index') }}" 
                   class="p-2 rounded-lg bg-gray-800/50 hover:bg-gray-700/50 transition-all duration-200">
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-white">Log Activity</h1>
                    <p class="text-gray-400 text-sm">
                        @if(auth()->user()->isSuperAdmin())
                            Semua aktivitas sistem
                        @elseif(auth()->user()->isAdmin())
                            Aktivitas admin dan user (tidak termasuk Super Admin)
                        @else
                            Aktivitas Anda
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="glass-card p-6">
        <form method="GET" action="{{ route('admin.laporan.activity') }}" class="flex flex-wrap gap-4">
            <div>
                <label class="block text-sm text-gray-400 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" 
                       value="{{ $startDate ?? '' }}"
                       class="glass-input px-4 py-3 rounded-lg text-white">
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-1">Tanggal Selesai</label>
                <input type="date" name="end_date" 
                       value="{{ $endDate ?? '' }}"
                       class="glass-input px-4 py-3 rounded-lg text-white">
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="btn-secondary">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0m-6 6l6 6"></path>
                    </svg>
                    Filter
                </button>
                <a href="{{ route('admin.laporan.activity') }}" class="px-4 py-3 rounded-lg bg-gray-800/50 hover:bg-gray-700/50 text-white text-sm font-medium">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Activity Table -->
    <div class="glass-card p-6">
        @if($activities->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-900/50">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider bg-gray-900/80">No</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider bg-gray-900/80">User</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider bg-gray-900/80">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider bg-gray-900/80">Aktivitas</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-400 uppercase tracking-wider bg-gray-900/80">Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/30">
                        @foreach($activities as $activity)
                            <tr class="hover:bg-white/5 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-300">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-medium">
                                    {{ $activity->user?->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    @if($activity->user?->role === 'super_admin')
                                        <span class="status-badge bg-purple-500/20 text-purple-400">Super Admin</span>
                                    @elseif($activity->user?->role === 'admin')
                                        <span class="status-badge status-approved">Admin</span>
                                    @else
                                        <span class="status-badge status-pending">User</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-300">
                                    {{ $activity->aktivitas }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                    {{ $activity->waktu?->format('d M Y H:i') ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
                <h3 class="text-lg font-semibold text-white mb-2">Tidak Ada Aktivitas</h3>
                <p class="text-gray-400 text-sm">Belum ada log aktivitas untuk periode yang dipilih.</p>
            </div>
        @endif
    </div>
</div>
@endsection
