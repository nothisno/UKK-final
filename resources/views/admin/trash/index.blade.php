@extends('layouts.app')

@section('title', 'Data Terhapus')

@section('content')
<div class="space-y-6">
    <div class="glass-card p-6">
        <h2 class="text-2xl font-bold text-white mb-2">Data Terhapus (Soft Delete)</h2>
        <p class="text-gray-400">Daftar alat dan kategori yang telah dihapus. Anda dapat mengembalikan data ke daftar aktif.</p>
    </div>

    @if($alats->count() > 0 || $kategoris->count() > 0)
        @if($alats->count() > 0)
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Alat Terhapus</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-900/50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Nama Alat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Dihapus Pada</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/30">
                        @foreach($alats as $alat)
                        <tr class="hover:bg-white/5">
                            <td class="px-6 py-4 text-sm text-gray-200">#{{ $alat->id }}</td>
                            <td class="px-6 py-4 text-sm text-white font-medium">{{ $alat->nama_alat }}</td>
                            <td class="px-6 py-4 text-sm text-gray-200">{{ $alat->kategori?->nama_kategori ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-200">{{ $alat->deleted_at?->format('d M Y H:i') ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.trash.restore.alat', $alat->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-green-500/20 hover:bg-green-500/30 text-green-400 text-sm font-medium">Kembalikan</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        @if($kategoris->count() > 0)
        <div class="glass-card p-6">
            <h3 class="text-lg font-semibold text-white mb-4">Kategori Terhapus</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-900/50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Nama Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Dihapus Pada</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/30">
                        @foreach($kategoris as $kategori)
                        <tr class="hover:bg-white/5">
                            <td class="px-6 py-4 text-sm text-gray-200">#{{ $kategori->id }}</td>
                            <td class="px-6 py-4 text-sm text-white font-medium">{{ $kategori->nama_kategori }}</td>
                            <td class="px-6 py-4 text-sm text-gray-200">{{ $kategori->deleted_at?->format('d M Y H:i') ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.trash.restore.kategori', $kategori->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="px-3 py-1.5 rounded-lg bg-green-500/20 hover:bg-green-500/30 text-green-400 text-sm font-medium">Kembalikan</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    @else
        <div class="glass-card p-12 text-center">
            <svg class="w-16 h-16 mx-auto mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            <p class="text-gray-400 text-lg">Tidak ada data terhapus.</p>
        </div>
    @endif
</div>
@endsection
