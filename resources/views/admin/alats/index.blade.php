@extends('layouts.app')

@section('title', 'Daftar Alat')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="glass-card p-6 flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-white mb-2">Daftar Alat</h2>
            <p class="text-gray-400">Kelola data alat yang tersedia</p>
        </div>
        <a href="{{ route('admin.alats.create') }}" class="btn-primary">
            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0v6m0 0v6m0-6h6m-6 0h6"></path>
            </svg>
            Tambah Alat
        </a>
    </div>

    <!-- Search & Filter -->
    <div class="glass-card p-6">
        <form method="GET" action="{{ route('admin.alats.index') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-64">
                <input type="text" name="search" placeholder="Cari alat..." 
                       class="glass-input w-full px-4 py-3 rounded-lg text-white placeholder-gray-400"
                       value="{{ request('search') }}">
            </div>
            <div class="flex gap-4">
                <select name="kategori" class="glass-input px-4 py-3 rounded-lg text-white">
                    <option value="">Semua Kategori</option>
                    @foreach(\App\Models\Kategori::all() as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                <select name="kondisi" class="glass-input px-4 py-3 rounded-lg text-white">
                    <option value="">Semua Kondisi</option>
                    <option value="baik" {{ request('kondisi') == 'baik' ? 'selected' : '' }}>Baik</option>
                    <option value="rusak" {{ request('kondisi') == 'rusak' ? 'selected' : '' }}>Rusak</option>
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

    <!-- Alat Table -->
    <div class="glass-card p-10">
        @if($alats->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-900/50">
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-gray-900/80">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-gray-900/80">Nama Alat</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-gray-900/80">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-gray-900/80">Stok</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-gray-900/80">Kondisi</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-gray-900/80">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider bg-gray-900/80">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/30">
                        @forelse ($alats as $alat)
                            <tr class="hover:bg-white/10 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                    {{ $alat->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200 font-medium">
                                    {{ $alat->nama_alat }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                                    {{ $alat->kategori->nama_kategori }}
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
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.707 8.793l-5.5-5.5a1 1 0 00-.707-.293H3a1 1 0 00-1 1v12a1 1 0 001 1h14a1 1 0 001-1V9a1 1 0 00-.293-.707L18.707 8.793zM16 9h-3v3h3V9z"></path>
                                            </svg>
                                        </a>
                                        <!-- Icon Delete -->
                                        <form method="POST" action="{{ route('admin.alats.destroy', $alat->id) }}" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus alat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-400 hover:text-red-300 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-8 text-center text-gray-400">
                                    <svg class="w-12 h-12 mx-auto mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 00-2 2h-2M9 5a2 2 0 002 2h2a2 2 0 012-2v1a3 3 0 013-3h4a3 3 0 013 3v1a3 3 0 01-3 3H9z"></path>
                                    </svg>
                                    @if(request('search') || request('kategori') || request('kondisi'))
                                        <p class="text-lg font-medium">Alat tidak ditemukan</p>
                                        <p class="text-sm text-gray-500 mt-2">
                                            Tidak ada alat yang cocok dengan pencarian atau filter Anda. Mohon coba kata kunci atau filter lain.
                                        </p>
                                    @else
                                        <p class="text-lg font-medium">Belum ada data alat</p>
                                        <p class="text-sm text-gray-500 mt-2">Belum ada alat yang tersedia. Silakan tambah alat terlebih dahulu.</p>
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($alats->hasPages())
                <div class="mt-8 flex justify-center">
                    <div class="glass-card rounded-lg p-2 flex space-x-2">
                        {{ $alats->links() }}
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0V5a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 012-2v1a3 3 0 013-3h4a3 3 0 013 3v1a3 3 0 01-3 3H9z"></path>
                </svg>
                <h3 class="text-xl font-semibold text-white mb-2">Tidak Ada Alat</h3>
                <p class="text-gray-400 mb-6">Belum ada data alat. Silakan tambah alat terlebih dahulu.</p>
                <a href="{{ route('admin.alats.create') }}" class="btn-primary">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0v6m0 0v6m0-6h6m-6 0h6"></path>
                    </svg>
                    Tambah Alat Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
