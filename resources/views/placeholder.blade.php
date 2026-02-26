@extends('layouts.app')

@section('title', $title ?? 'Halaman')

@section('content')
<div class="space-y-6">
    <div class="glass-card p-12 text-center">
        <svg class="w-24 h-24 mx-auto mb-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
        </svg>
        <h2 class="text-2xl font-bold text-white mb-2">{{ $title ?? 'Halaman' }}</h2>
        <p class="text-gray-400">{{ $message ?? 'Sistem sedang dalam pengembangan.' }}</p>
    </div>
</div>
@endsection
