@extends('layouts.app')

@section('title', 'Laporan Peminjaman')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="glass-card p-6 flex justify-between items-center shadow-lg">
        <div>
            <a href="{{ route('admin.laporan.index') }}" class="text-gray-200 hover:text-white text-sm mb-2 inline-block no-print">&larr; Kembali</a>
            <h2 class="text-2xl font-bold text-white">Laporan Peminjaman</h2>
        </div>
        <button type="button" onclick="window.print()" class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium no-print transition-all duration-200">
            Cetak
        </button>
    </div>

    {{-- Filter --}}
    <div class="glass-card p-6 no-print shadow-lg">
        <form method="GET" action="{{ route('admin.laporan.peminjaman') }}" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-sm text-gray-200 mb-1 font-medium">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $startDate ?? '' }}" class="glass-input px-4 py-3 rounded-lg text-white bg-gray-800 border border-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm text-gray-200 mb-1 font-medium">Tanggal Selesai</label>
                <input type="date" name="end_date" value="{{ $endDate ?? '' }}" class="glass-input px-4 py-3 rounded-lg text-white bg-gray-800 border border-gray-700 focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <button type="submit" class="px-6 py-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-medium transition-all duration-200">
                    Filter
                </button>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="glass-card p-6 print-report shadow-lg">
        <div class="print-header hidden print:block text-center border-b-2 border-gray-800 pb-4 mb-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">LAPORAN PEMINJAMAN ALAT</h1>
            <p class="text-sm text-gray-600">Sistem Peminjaman Alat - PinjamIn</p>
            @if($startDate || $endDate)
                <p class="text-sm text-gray-600 mt-2">Periode: {{ $startDate ? \Carbon\Carbon::parse($startDate)->format('d F Y') : '-' }} s/d {{ $endDate ? \Carbon\Carbon::parse($endDate)->format('d F Y') : '-' }}</p>
            @endif
            <p class="text-xs text-gray-500 mt-3">Dicetak: {{ now()->format('d F Y H:i') }}</p>
        </div>

        @if($peminjaman->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full print-table border-collapse">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Alat</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Tgl Pinjam</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Tgl Kembali</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peminjaman as $i => $pinjam)
                        <tr class="border-b border-gray-700 {{ $i % 2 == 0 ? 'bg-gray-800' : 'bg-gray-900' }} hover:bg-gray-700 transition-colors duration-150">
                            <td class="px-4 py-3 text-sm text-gray-200">{{ $i + 1 }}</td>
                            <td class="px-4 py-3 text-sm text-gray-200">{{ $pinjam->user->name }}</td>
                            <td class="px-4 py-3 text-sm text-gray-200">{{ $pinjam->alat->nama_alat }}</td>
                            <td class="px-4 py-3 text-sm text-gray-200">{{ $pinjam->tanggal_pinjam->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-200">{{ $pinjam->tanggal_kembali->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-sm text-gray-200">{{ ucfirst(str_replace('_', ' ', $pinjam->status)) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-6 pt-4 border-t border-gray-700 text-sm text-gray-200">
                Total: {{ $peminjaman->count() }} peminjaman
            </div>
        @else
            <p class="text-center text-gray-400 py-12">Tidak ada data peminjaman untuk periode yang dipilih.</p>
        @endif
    </div>
</div>

{{-- Custom Styles --}}
<style>
/* Glass Card */
.glass-card {
    background: rgba(30, 30, 30, 0.5);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.1);
}

/* Input Styles */
.glass-input {
    background: rgba(40,40,40,0.6);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.2);
}

/* Table */
.print-table th, .print-table td {
    border: 1px solid #444;
}

/* Print Styles */
@media print {
    .no-print { display: none !important; }
    body { background: #fff !important; color: #000 !important; font-family: Arial, sans-serif; }
    .print-report { background: #fff !important; border: 1px solid #ddd !important; padding: 24px !important; }
    .print-header { display: block !important; }
    .print-header.hidden { display: block !important; }
    .print-table th, .print-table td { color: #000 !important; border: 1px solid #000 !important; }
    aside, header, .flex.justify-between { display: none !important; }
    main { padding: 0 !important; }
    .print-table { font-size: 11px; border-collapse: collapse; }
}

@media screen {
    .print-header { display: none; }
}
</style>
@endsection