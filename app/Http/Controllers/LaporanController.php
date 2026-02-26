<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\LogActivity;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan.index');
    }

    public function peminjaman(Request $request)
    {
        // Only Petugas can print reports
        if (!auth()->user()->canPrintReports() && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Hanya Petugas yang dapat mencetak laporan.');
        }

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Peminjaman::with(['user', 'alat' => function($query) {
            $query->withTrashed();
        }]);
        if ($startDate) $query->whereDate('tanggal_pinjam', '>=', $startDate);
        if ($endDate) $query->whereDate('tanggal_pinjam', '<=', $endDate);

        $peminjaman = $query->orderBy('tanggal_pinjam', 'desc')->get();
        LogActivity::logActivity(auth()->id(), 'Mencetak laporan peminjaman');

        return view('admin.laporan.peminjaman', compact('peminjaman', 'startDate', 'endDate'));
    }

    public function pengembalian(Request $request)
    {
        // Only Petugas can print reports
        if (!auth()->user()->canPrintReports() && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Hanya Petugas yang dapat mencetak laporan.');
        }

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Pengembalian::with(['peminjaman.user', 'peminjaman.alat' => function($query) {
            $query->withTrashed();
        }]);
        if ($startDate) $query->whereDate('tanggal_dikembalikan', '>=', $startDate);
        if ($endDate) $query->whereDate('tanggal_dikembalikan', '<=', $endDate);

        $pengembalian = $query->orderBy('tanggal_dikembalikan', 'desc')->get();
        LogActivity::logActivity(auth()->id(), 'Mencetak laporan pengembalian');

        return view('admin.laporan.pengembalian', compact('pengembalian', 'startDate', 'endDate'));
    }

    public function activity(Request $request)
    {
        // Only Super Admin and Admin can view log activity
        if (!auth()->user()->isSuperAdmin() && !auth()->user()->isAdmin()) {
            abort(403, 'Hanya Super Admin dan Admin yang dapat melihat log activity.');
        }

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = LogActivity::with('user');
        $currentUser = auth()->user();

        // Filter sesuai role
        if ($currentUser?->isSuperAdmin()) {
            // Super admin: lihat semua aktivitas
        } elseif ($currentUser?->isAdmin()) {
            // Admin: lihat aktivitas admin + user, tidak termasuk super admin
            $query->whereHas('user', function ($q) {
                $q->whereIn('role', ['admin', 'user', 'petugas']);
            });
        }

        if ($startDate) {
            $query->whereDate('waktu', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('waktu', '<=', $endDate);
        }

        $activities = $query->orderBy('waktu', 'desc')->get();

        LogActivity::logActivity(auth()->id(), 'Melihat laporan log activity');

        return view('admin.laporan.activity', compact('activities', 'startDate', 'endDate'));
    }
}
