@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Header -->
    <div class="glass-card p-6">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.kategoris.index') }}" 
                   class="p-2 rounded-lg bg-gray-800/50 hover:bg-gray-700/50 transition-all duration-200">
                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-white">Detail Kategori</h1>
                    <p class="text-gray-400 text-sm">Informasi lengkap data kategori</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Informasi Kategori -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Informasi Kategori</h3>

            <div class="space-y-4">
                <div class="flex justify-between items-center py-3 border-b border-gray-700/50">
                    <span class="text-gray-400 text-sm">ID Kategori</span>
                    <span class="text-white font-medium">#{{ $kategori->id }}</span>
                </div>
                <div class="flex justify-between items-center py-3 border-b border-gray-700/50">
                    <span class="text-gray-400 text-sm">Nama Kategori</span>
                    <span class="text-white font-medium">{{ $kategori->nama_kategori }}</span>
                </div>
                <div class="flex justify-between items-center py-3">
                    <span class="text-gray-400 text-sm">Jumlah Alat</span>
                    <span class="text-white font-medium">{{ $kategori->alats ? $kategori->alats->count() : 0 }} alat</span>
                </div>
            </div>
        </div>

        <!-- Deskripsi -->
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Deskripsi</h3>

            <div class="space-y-4">
                <div class="py-3">
                    <p class="text-gray-300 leading-relaxed">{{ $kategori->deskripsi ?: 'Tidak ada deskripsi tersedia.' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Daftar Alat dalam Kategori -->
    <div class="glass-card p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-white">Alat dalam Kategori Ini</h3>
            <a href="{{ route('admin.alats.create') }}?kategori_id={{ $kategori->id }}" 
               class="btn-primary">
                
                Tambah Alat
            </a>
        </div>

        @if($kategori->alats && $kategori->alats->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-900/50">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-gray-900/80">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-gray-900/80">Nama Alat</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-gray-900/80">Stok</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-gray-900/80">Kondisi</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-gray-900/80">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-gray-900/80">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/30">
                        @foreach($kategori->alats as $alat)
                            <tr class="hover:bg-white/10 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                    {{ $alat->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200 font-medium">
                                    {{ $alat->nama_alat }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                    <span class="{{ $alat->stok > 0 ? 'text-green-400' : 'text-red-400' }}">
                                        {{ $alat->stok }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                    @if($alat->kondisi == 'baik')
                                        <span class="status-badge status-approved">Baik</span>
                                    @else
                                        <span class="status-badge status-rejected">Rusak</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                    @if($alat->stok > 0)
                                        <span class="status-badge status-approved">Tersedia</span>
                                    @else
                                        <span class="status-badge status-rejected">Tidak Tersedia</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                    <div class="flex space-x-2">
                                        <!-- Icon Detail -->
                                        <a href="{{ route('admin.alats.show', $alat->id) }}" 
                                           class="text-blue-400 hover:text-blue-300 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <rect x="3" y="4" width="18" height="12" rx="2" ry="2" stroke-width="2"></rect>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                                      d="M8 20h8M12 16v4"></path>
                                            </svg>
                                        </a>
                                        <!-- Icon Edit -->
                                        <a href="{{ route('admin.alats.edit', $alat->id) }}" 
                                           class="text-green-400 hover:text-green-300 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5h-1.793a1 1 0 01-.793-.207l-5.5-5.5a1 1 0 01-.207-.793H12z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.707 8.793l-5.5-5.5a1 1 0 00-.707-.293H3a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V9a1 1 0 00-.293-.707L18.707 8.793zM16 9h-3V3h3V9z"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0V5a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 012-2v1a3 3 0 013-3h4a3 3 0 013 3v1a3 3 0 01-3 3H9z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-white mb-2">Belum Ada Alat</h3>
                <p class="text-gray-400 mb-6">Belum ada alat dalam kategori ini. Silakan tambah alat terlebih dahulu.</p>
                <a href="{{ route('admin.alats.create') }}?kategori_id={{ $kategori->id }}" class="btn-primary">
                   
                    Tambah Alat Pertama
                </a>
            </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="glass-card p-6">
        <h3 class="text-lg font-semibold text-white mb-6">Aksi Cepat</h3>
        
        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.kategoris.index') }}" 
               class="px-6 py-2 rounded-lg bg-gray-800/50 hover:bg-gray-700/50 text-white text-sm font-medium transition-all duration-200">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Kembali ke Daftar
            </a>
            
            <a href="{{ route('admin.kategoris.edit', $kategori->id) }}" 
               class="px-6 py-2 rounded-lg bg-green-600/50 hover:bg-green-500/50 text-white text-sm font-medium transition-all duration-200">
                <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5h-1.793a1 1 0 01-.793-.207l-5.5-5.5a1 1 0 01-.207-.793H12z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.707 8.793l-5.5-5.5a1 1 0 00-.707-.293H3a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V9a1 1 0 00-.293-.707L18.707 8.793zM16 9h-3V3h3V9z"></path>
                </svg>
                Edit Kategori
            </a>
        </div>
    </div>

    
            
            <div class="flex justify-end">
                <form method="POST" action="{{ route('admin.kategoris.destroy', $kategori->id) }}" 
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="px-6 py-2 rounded-lg bg-red-600/50 hover:bg-red-500/50 text-white text-sm font-medium transition-all duration-200">
                        <svg class="w-4 h-4 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                        Hapus Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
