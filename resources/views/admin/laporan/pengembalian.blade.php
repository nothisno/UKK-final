@extends('layouts.app')

@section('title', 'Laporan Pengembalian')

@section('content')
<div class="space-y-6">
    <div class="glass-card p-6 flex justify-between items-center">
        <div>
            <a href="{{ route('admin.laporan.index') }}" class="text-gray-400 hover:text-white text-sm mb-2 inline-block no-print">&larr; Kembali</a>
            <h2 class="text-2xl font-bold text-white">Laporan Pengembalian</h2>
        </div>
        <button type="button" onclick="window.print()" class="px-4 py-2 rounded-lg bg-blue-500/20 hover:bg-blue-500/30 text-blue-400 font-medium no-print">
            Cetak
        </button>
    </div>

    <div class="glass-card p-6 no-print">
        <form method="GET" action="{{ route('admin.laporan.pengembalian') }}" class="flex flex-wrap gap-4">
            <div>
                <label class="block text-sm text-gray-400 mb-1">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $startDate ?? '' }}" class="glass-input px-4 py-3 rounded-lg text-white">
            </div>
            <div>
                <label class="block text-sm text-gray-400 mb-1">Tanggal Selesai</label>
                <input type="date" name="end_date" value="{{ $endDate ?? '' }}" class="glass-input px-4 py-3 rounded-lg text-white">
            </div>
            <div class="flex items-end">
                <button type="submit" class="btn-secondary">Filter</button>
            </div>
        </form>
    </div>

    <div class="glass-card p-6 print-report">
        <div class="print-header hidden print:block text-center border-b-2 border-gray-800 pb-4 mb-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">LAPORAN PENGEMBALIAN ALAT</h1>
            <p class="text-sm text-gray-600">Sistem Peminjaman Alat - PinjamIn</p>
            @if($startDate || $endDate)
                <p class="text-sm text-gray-600 mt-2">Periode: {{ $startDate ? \Carbon\Carbon::parse($startDate)->format('d F Y') : '-' }} s/d {{ $endDate ? \Carbon\Carbon::parse($endDate)->format('d F Y') : '-' }}</p>
            @endif
            <p class="text-xs text-gray-500 mt-3">Dicetak: {{ now()->format('d F Y H:i') }}</p>
        </div>

        @if($pengembalian->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full print-table">
                    <thead>
                        <tr class="border-b-2 border-gray-800 bg-gray-100">
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">Peminjam</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">Alat</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">Tgl Dikembalikan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">Kondisi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">Total Denda</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-900 uppercase tracking-wider">Status Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pengembalian as $i => $kembali)
                        <tr class="border-b border-gray-300 {{ $i % 2 == 0 ? 'bg-gray-50' : '' }} hover:bg-gray-100 transition-colors">
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $i + 1 }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $kembali->peminjaman->user->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $kembali->peminjaman->alat?->nama_alat ?? 'Alat tidak ditemukan' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $kembali->tanggal_dikembalikan->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-sm">
                                @switch($kembali->kondisi_setelah)
                                    @case('baik')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Baik</span>
                                        @break
                                    @case('rusak_ringan')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Rusak Ringan</span>
                                        @break
                                    @case('rusak_berat')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Rusak Berat</span>
                                        @break
                                    @default
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">{{ ucfirst(str_replace('_', ' ', $kembali->kondisi_setelah)) }}</span>
                                @endswitch
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-gray-900">Rp {{ number_format($kembali->total_denda ?? 0, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 text-sm">
                                @if(($kembali->total_denda ?? 0) > 0)
                                    @if($kembali->status_denda == 'belum_bayar')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Belum Bayar</span>
                                    @elseif($kembali->status_denda == 'menunggu_konfirmasi')
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Menunggu Konfirmasi</span>
                                    @else
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Sudah Bayar</span>
                                    @endif
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6 pt-4 border-t-2 border-gray-300 bg-gray-50 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-semibold text-gray-700">Total Pengembalian:</span>
                    <span class="text-lg font-bold text-gray-900">{{ $pengembalian->count() }}</span>
                </div>
            </div>
        @else
            <p class="text-center text-gray-600 py-12">Tidak ada data pengembalian untuk periode yang dipilih.</p>
        @endif
    </div>
</div>
<style>
@media print {
    .no-print { display: none !important; }
    body { background: #fff !important; color: #000 !important; }
    .print-report { background: #fff !important; border: 1px solid #ddd !important; padding: 24px !important; }
    .print-header { display: block !important; }
    .print-header.hidden { display: block !important; }
    .print-table th, .print-table td { color: #000 !important; }
    aside, header, .flex.justify-between { display: none !important; }
    main { padding: 0 !important; }
    .print-table { font-size: 11px; }
}
@media screen {
    .print-header { display: none; }
}
</style>
@endsection
