@extends('layouts.app')
@section('title', 'Peminjaman')
@section('content')
<div class="space-y-6">
    <div class="glass-card p-6">
        <p class="text-gray-400">Edit tidak tersedia. Silakan batalkan dan ajukan ulang jika peminjaman masih pending.</p>
        <a href="{{ route('user.peminjaman.index') }}" class="text-blue-400 hover:underline mt-2 inline-block">Kembali ke Daftar</a>
    </div>
</div>
@endsection
