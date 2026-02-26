<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengembalianController extends Controller
{
    public function index()
    {
        // Role-based access: Admin & Petugas can view, but only Petugas can manage
        if (!auth()->user()->isAdmin() && !auth()->user()->isPetugas() && !auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $pengembalian = Pengembalian::with(['peminjaman.user', 'peminjaman.alat' => function($query) {
            $query->withTrashed();
        }])
            ->orderBy('tanggal_dikembalikan', 'desc')
            ->paginate(10);

        $menungguKonfirmasiDenda = Pengembalian::with(['peminjaman.user', 'peminjaman.alat' => function($query) {
            $query->withTrashed();
        }])
            ->where('status_denda', 'menunggu_konfirmasi')
            ->where('total_denda', '>', 0)
            ->orderBy('updated_at', 'desc')
            ->get();

        $menungguVerifikasi = Peminjaman::with(['user', 'alat' => function($query) {
            $query->withTrashed();
        }])
            ->where('status', 'menunggu_konfirmasi_pengembalian')
            ->orderBy('updated_at', 'desc')
            ->get();

        LogActivity::logActivity(auth()->id(), 'Melihat daftar pengembalian');

        return view('admin.pengembalian.index', compact('pengembalian', 'menungguVerifikasi', 'menungguKonfirmasiDenda'));
    }

    public function create($peminjamanId = null)
    {
        if (!$peminjamanId) {
            return redirect()->route('admin.pengembalian.index');
        }

        $peminjaman = Peminjaman::with(['user', 'alat'])
            ->where('status', 'menunggu_konfirmasi_pengembalian')
            ->findOrFail($peminjamanId);

        return view('admin.pengembalian.create', compact('peminjaman'));
    }

    public function store(Request $request, $peminjamanId)
    {
        $peminjaman = Peminjaman::with(['alat', 'user'])->findOrFail($peminjamanId);

        if ($peminjaman->status !== 'menunggu_konfirmasi_pengembalian') {
            return redirect()->back()->with('error', 'Hanya dapat memverifikasi pengembalian yang diajukan user.');
        }

        $validator = Validator::make($request->all(), [
            'tanggal_dikembalikan' => 'required|date|after_or_equal:' . $peminjaman->tanggal_pinjam->format('Y-m-d'),
            'kondisi_setelah' => 'required|in:baik,rusak_ringan,rusak_berat',
            'denda_kerusakan' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $tanggalDikembalikan = \Carbon\Carbon::parse($request->tanggal_dikembalikan);
        $tanggalKembali = $peminjaman->tanggal_kembali;
        $hariTelat = max(0, (int) $tanggalKembali->diffInDays($tanggalDikembalikan, false));

        $dendaPerHari = config('peminjaman.denda_keterlambatan_per_hari', 10000);
        $dendaKeterlambatan = $hariTelat * $dendaPerHari;
        $dendaKerusakan = (float) $request->input('denda_kerusakan', 0);
        $totalDenda = $dendaKeterlambatan + $dendaKerusakan;

        Pengembalian::create([
            'peminjaman_id' => $peminjamanId,
            'tanggal_dikembalikan' => $request->tanggal_dikembalikan,
            'kondisi_setelah' => $request->kondisi_setelah,
            'denda' => $totalDenda,
            'denda_keterlambatan' => $dendaKeterlambatan,
            'denda_kerusakan' => $dendaKerusakan,
            'total_denda' => $totalDenda,
            'status_denda' => $totalDenda > 0 ? 'belum_bayar' : 'sudah_bayar',
            'catatan' => $request->input('catatan'),
        ]);

        $peminjaman->update(['status' => 'dikembalikan']);
        $peminjaman->alat->increment('stok');

        LogActivity::logActivity(auth()->id(), 'Memverifikasi pengembalian: ' . $peminjaman->alat->nama_alat . ' oleh ' . $peminjaman->user->name);

        return redirect()->route('admin.pengembalian.index')->with('success', 'Pengembalian berhasil diverifikasi. Stok alat telah bertambah.');
    }

    public function show($id)
    {
        $pengembalian = Pengembalian::with(['peminjaman.user', 'peminjaman.alat'])->findOrFail($id);

        return view('admin.pengembalian.show', compact('pengembalian'));
    }

    public function markDendaPaid($id)
    {
        $pengembalian = Pengembalian::with('peminjaman')->findOrFail($id);
        if ($pengembalian->status_denda === 'menunggu_konfirmasi') {
            return $this->confirmDendaPaid($id);
        }
        return redirect()->back()->with('error', 'Hanya dapat mengonfirmasi pembayaran yang telah diklaim user.');
    }

    public function confirmDendaPaid($id)
    {
        $pengembalian = Pengembalian::with('peminjaman')->findOrFail($id);

        if ($pengembalian->total_denda <= 0) {
            return redirect()->back()->with('error', 'Tidak ada denda yang perlu dibayar.');
        }

        if ($pengembalian->status_denda === 'sudah_bayar') {
            return redirect()->back()->with('success', 'Denda sudah dikonfirmasi sebelumnya.');
        }

        if ($pengembalian->status_denda !== 'menunggu_konfirmasi') {
            return redirect()->back()->with('error', 'User belum mengklaim telah membayar. Konfirmasi hanya untuk klaim yang menunggu verifikasi.');
        }

        $pengembalian->update(['status_denda' => 'sudah_bayar']);

        LogActivity::logActivity(auth()->id(), 'Mengonfirmasi pembayaran denda untuk pengembalian #' . $pengembalian->id);

        return redirect()->back()->with('success', 'Pembayaran denda berhasil dikonfirmasi. User dapat meminjam kembali.');
    }
}
