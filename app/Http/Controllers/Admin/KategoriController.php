<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Only Admin can manage kategori
        if (!auth()->user()->canManageKategori() && !auth()->user()->isSuperAdmin()) {
            abort(403, 'Hanya Admin yang dapat mengelola kategori.');
        }

        $kategoris = Kategori::paginate(10);
        LogActivity::logActivity(auth()->id(), 'Melihat daftar kategori');
        return view('admin.kategoris.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategoris.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255|unique:kategoris',
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Kategori::create($request->all());
        LogActivity::logActivity(auth()->id(), 'Membuat kategori baru: ' . $request->nama_kategori);
        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategoris.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('admin.kategoris.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kategori = Kategori::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $id,
            'deskripsi' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kategori->update($request->all());
        LogActivity::logActivity(auth()->id(), 'Mengupdate kategori: ' . $kategori->nama_kategori);
        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        $namaKategori = $kategori->nama_kategori;
        
        $kategori->delete();
        
        LogActivity::logActivity(auth()->id(), 'Menghapus kategori: ' . $namaKategori);
        return redirect()->route('admin.kategoris.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
