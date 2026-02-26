<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\LogActivity;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        // Role-based access: Admin & Petugas can view
        if (!auth()->user()->isAdmin() && !auth()->user()->isPetugas() && !auth()->user()->isSuperAdmin()) {
            abort(403);
        }

        $query = Peminjaman::with(['user', 'alat' => function($query) {
            $query->withTrashed();
        }]);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"))
                  ->orWhereHas('alat', fn($a) => $a->where('nama_alat', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_pinjam', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_pinjam', '<=', $request->end_date);
        }

        $peminjaman = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        LogActivity::logActivity(auth()->id(), 'Melihat daftar peminjaman');

        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        return redirect()->route('admin.peminjaman.index');
    }

    public function store(Request $request)
    {
        return redirect()->route('admin.peminjaman.index');
    }

    public function show(string $id)
    {
        // Only Super Admin and Petugas can view detail
        if (!auth()->user()->isSuperAdmin() && !auth()->user()->isPetugas()) {
            abort(403, 'Hanya Super Admin dan Petugas yang dapat melihat detail peminjaman.');
        }

        $peminjaman = Peminjaman::with(['user', 'alat', 'pengembalian'])->findOrFail($id);

        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    public function edit(string $id)
    {
        return redirect()->route('admin.peminjaman.show', $id);
    }

    public function update(Request $request, string $id)
    {
        return redirect()->route('admin.peminjaman.show', $id);
    }

    public function destroy(string $id)
    {
        return redirect()->route('admin.peminjaman.index');
    }

    public function approve($id)
    {
        // Only Super Admin and Petugas can approve peminjaman
        if (!auth()->user()->canApprovePeminjaman()) {
            abort(403, 'Hanya Super Admin dan Petugas yang dapat menyetujui peminjaman.');
        }

        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya peminjaman pending yang dapat disetujui.');
        }

        $alat = $peminjaman->alat;
        if (!$alat || $alat->stok <= 0) {
            return redirect()->back()->with('error', 'Stok alat tidak mencukupi.');
        }

        // Check if requested stok is available
        if ($peminjaman->stok > $alat->stok) {
            return redirect()->back()->with('error', 'Stok yang diminta melebihi stok tersedia.');
        }

        // Reduce stok and approve peminjaman
        $alat->decrement('stok', $peminjaman->stok);
        $peminjaman->update(['status' => 'disetujui']);

        LogActivity::logActivity(auth()->id(), 'Menyetujui peminjaman: ' . $alat->nama_alat . ' (' . $peminjaman->stok . ' unit) oleh ' . $peminjaman->user->name);

        return redirect()->back()->with('success', 'Peminjaman disetujui. Stok alat telah berkurang.');
    }

    public function reject($id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        if ($peminjaman->status !== 'pending') {
            return redirect()->back()->with('error', 'Hanya peminjaman pending yang dapat ditolak.');
        }

        $peminjaman->update(['status' => 'ditolak']);

        LogActivity::logActivity(auth()->id(), 'Menolak peminjaman: ' . $peminjaman->alat->nama_alat . ' oleh ' . $peminjaman->user->name);

        return redirect()->back()->with('success', 'Peminjaman ditolak.');
    }
}
