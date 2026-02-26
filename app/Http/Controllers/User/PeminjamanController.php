<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;
use App\Models\Pengembalian;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $query = Peminjaman::with(['alat', 'pengembalian'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $peminjaman = $query->paginate(10)->withQueryString();

        $dendaBelumBayar = Pengembalian::with('peminjaman.alat')
            ->whereHas('peminjaman', fn($q) => $q->where('user_id', auth()->id()))
            ->where('status_denda', 'belum_bayar')
            ->where('total_denda', '>', 0)
            ->get();

        $dendaMenungguKonfirmasi = Pengembalian::with('peminjaman.alat')
            ->whereHas('peminjaman', fn($q) => $q->where('user_id', auth()->id()))
            ->where('status_denda', 'menunggu_konfirmasi')
            ->where('total_denda', '>', 0)
            ->get();

        LogActivity::logActivity(auth()->id(), 'Melihat daftar peminjaman saya');

        return view('user.peminjaman.index', compact('peminjaman', 'dendaBelumBayar', 'dendaMenungguKonfirmasi'));
    }

    public function create(Request $request)
    {
        $hasUnpaidFine = Pengembalian::whereIn('status_denda', ['belum_bayar', 'menunggu_konfirmasi'])
            ->whereHas('peminjaman', fn($q) => $q->where('user_id', auth()->id()))
            ->exists();

        if ($hasUnpaidFine) {
            return redirect()->route('user.peminjaman.index')
                ->with('error', 'Anda masih memiliki denda yang belum dibayar. Silakan bayar denda terlebih dahulu untuk dapat meminjam kembali.');
        }

        $alats = Alat::with('kategori')->where('stok', '>', 0)->get();
        $selectedAlat = $request->filled('alat_id')
            ? Alat::find($request->alat_id)
            : null;

        return view('user.peminjaman.create', compact('alats', 'selectedAlat'));
    }

    public function store(Request $request)
    {
        $hasUnpaidFine = Pengembalian::whereIn('status_denda', ['belum_bayar', 'menunggu_konfirmasi'])
            ->whereHas('peminjaman', fn($q) => $q->where('user_id', auth()->id()))
            ->exists();

        if ($hasUnpaidFine) {
            return redirect()->route('user.peminjaman.index')
                ->with('error', 'Anda masih memiliki denda yang belum dibayar.');
        }

        $validator = Validator::make($request->all(), [
            'alat_id' => 'required|exists:alats,id',
            'stok' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date|after_or_equal:today',
            'tanggal_kembali' => 'required|date|after:tanggal_pinjam',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $alat = Alat::findOrFail($request->alat_id);
        $requestedStok = $request->stok;
        
        if ($alat->stok <= 0) {
            return redirect()->back()->with('error', 'Alat tidak tersedia.');
        }
        
        if ($requestedStok > $alat->stok) {
            return redirect()->back()->with('error', 'Jumlah stok yang diminta melebihi stok tersedia. Stok tersedia: ' . $alat->stok);
        }

        Peminjaman::create([
            'user_id' => auth()->id(),
            'alat_id' => $request->alat_id,
            'stok' => $requestedStok,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'pending',
        ]);

        LogActivity::logActivity(auth()->id(), 'Mengajukan peminjaman: ' . $alat->nama_alat . ' (' . $requestedStok . ' unit)');

        return redirect()->route('user.peminjaman.index')->with('success', 'Pengajuan peminjaman berhasil dikirim. Menunggu persetujuan admin.');
    }

    public function show(string $id)
    {
        $peminjaman = Peminjaman::with(['alat', 'pengembalian'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('user.peminjaman.show', compact('peminjaman'));
    }

    public function edit(string $id)
    {
        return redirect()->route('user.peminjaman.show', $id);
    }

    public function update(Request $request, string $id)
    {
        return redirect()->route('user.peminjaman.show', $id);
    }

    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::where('user_id', auth()->id())
            ->where('status', 'pending')
            ->findOrFail($id);

        $peminjaman->delete();

        LogActivity::logActivity(auth()->id(), 'Membatalkan pengajuan peminjaman');

        return redirect()->route('user.peminjaman.index')->with('success', 'Pengajuan peminjaman dibatalkan.');
    }

    public function requestReturn(string $id)
    {
        $peminjaman = Peminjaman::where('user_id', auth()->id())
            ->where('status', 'disetujui')
            ->findOrFail($id);

        $peminjaman->update(['status' => 'menunggu_konfirmasi_pengembalian']);

        LogActivity::logActivity(auth()->id(), 'Mengajukan pengembalian: ' . $peminjaman->alat->nama_alat);

        return redirect()->route('user.peminjaman.index')->with('success', 'Pengembalian diajukan. Menunggu verifikasi admin.');
    }

    public function claimDendaPaid(string $id)
    {
        $pengembalian = Pengembalian::whereHas('peminjaman', fn($q) => $q->where('user_id', auth()->id()))
            ->where('status_denda', 'belum_bayar')
            ->findOrFail($id);

        $pengembalian->update(['status_denda' => 'menunggu_konfirmasi']);

        LogActivity::logActivity(auth()->id(), 'Mengklaim telah membayar denda - menunggu konfirmasi admin');

        return redirect()->back()->with('success', 'Klaim pembayaran denda berhasil dikirim. Menunggu konfirmasi admin.');
    }
}
