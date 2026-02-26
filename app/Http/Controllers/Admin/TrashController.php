<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\LogActivity;
use Illuminate\Http\Request;

class TrashController extends Controller
{
    public function index()
    {
        $alats = Alat::onlyTrashed()->with('kategori')->get();
        $kategoris = Kategori::onlyTrashed()->get();

        LogActivity::logActivity(auth()->id(), 'Melihat data terhapus (soft delete)');

        return view('admin.trash.index', compact('alats', 'kategoris'));
    }

    public function restoreAlat($id)
    {
        $alat = Alat::onlyTrashed()->findOrFail($id);
        $alat->restore();

        LogActivity::logActivity(auth()->id(), 'Restore alat: ' . $alat->nama_alat);

        return redirect()->route('admin.trash.index')->with('success', 'Alat berhasil dikembalikan.');
    }

    public function restoreKategori($id)
    {
        $kategori = Kategori::onlyTrashed()->findOrFail($id);
        $kategori->restore();

        LogActivity::logActivity(auth()->id(), 'Restore kategori: ' . $kategori->nama_kategori);

        return redirect()->route('admin.trash.index')->with('success', 'Kategori berhasil dikembalikan.');
    }
}
