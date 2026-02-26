<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Only Admin can manage alat
        if (!auth()->user()->canManageAlat() && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Hanya Admin yang dapat mengelola alat.');
        }

        $alats = Alat::with('kategori')->paginate(10);
        LogActivity::logActivity(auth()->id(), 'Melihat daftar alat');
        return view('admin.alats.index', compact('alats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alats.create', compact('kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Alat::create($request->all());
        LogActivity::logActivity(auth()->id(), 'Membuat alat baru: ' . $request->nama_alat);
        return redirect()->route('admin.alats.index')->with('success', 'Alat berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $alat = Alat::with('kategori')->findOrFail($id);
        return view('admin.alats.show', compact('alat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all();
        return view('admin.alats.edit', compact('alat', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alat = Alat::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'nama_alat' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
            'kondisi' => 'required|in:baik,rusak_ringan,rusak_berat',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $alat->update($request->all());
        LogActivity::logActivity(auth()->id(), 'Mengupdate alat: ' . $alat->nama_alat);
        return redirect()->route('admin.alats.index')->with('success', 'Alat berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alat = Alat::findOrFail($id);
        $namaAlat = $alat->nama_alat;

        $alat->delete();
        
        LogActivity::logActivity(auth()->id(), 'Menghapus alat: ' . $namaAlat);
        return redirect()->route('admin.alats.index')->with('success', 'Alat berhasil dihapus.');
    }
}
