@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="glass-card p-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-white mb-2">Manajemen Kategori</h2>
            <p class="text-gray-400">Kelola kategori alat</p>
        </div>
        <a href="{{ route('admin.kategoris.create') }}" class="btn-primary">
            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Tambah Kategori
        </a>
    </div>

    <!-- Kategori Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($kategoris as $kategori)
            <div class="glass-card p-6 hover:scale-105 transition-transform duration-300">
                <div class="flex items-start justify-between mb-4">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-purple-500 to-pink-600 flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.kategoris.edit', $kategori->id) }}" 
                           class="text-yellow-400 hover:text-yellow-300 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </a>
                        <form method="POST" action="{{ route('admin.kategoris.destroy', $kategori->id) }}" 
                              class="inline" 
                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-400 hover:text-red-300 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-white mb-2">{{ $kategori->nama_kategori }}</h3>
                <p class="text-gray-400 text-sm mb-4">{{ $kategori->deskripsi }}</p>
                <div class="flex items-center justify-between">
                    <span class="text-gray-400 text-sm">
                        {{ $kategori->alats ? $kategori->alats->count() : 0 }} alat
                    </span>
                    <a href="{{ route('admin.kategoris.show', $kategori->id) }}" 
                       class="text-blue-400 hover:text-blue-300 text-sm font-medium transition-colors">
                        Lihat Detail →
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full glass-card p-12 text-center">
                <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <p class="text-lg font-medium text-white mb-2">Belum ada kategori</p>
                <p class="text-gray-400 mb-6">Mulai dengan menambahkan kategori pertama</p>
                <a href="{{ route('admin.kategoris.create') }}" class="btn-primary">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Kategori
                </a>
            </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($kategoris->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="glass-card rounded-lg p-2 flex space-x-2">
                {{ $kategoris->links() }}
            </div>
        </div>
    @endif
</div>
@endsection
