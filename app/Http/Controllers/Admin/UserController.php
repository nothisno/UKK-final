<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * Method ini menampilkan halaman daftar semua user dengan role 'user'
     * Admin dapat melihat, mengedit, dan menghapus user dari sini
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Mengambil semua user dengan role 'user' (bukan admin)
        // Menggunakan pagination 10 data per halaman untuk optimasi
        $users = User::where('role', 'user')->paginate(10);
        
        // Mencatat aktivitas admin melihat daftar user
        LogActivity::logActivity(auth()->id(), 'Melihat daftar user');
        
        // Mengembalikan view dengan data users
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * 
     * Method ini menampilkan form untuk membuat user baru
     * Form berisi: name, email, password, dan role selection
     * 
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * Method ini memproses pembuatan user baru
     * Melakukan validasi input sebelum menyimpan ke database
     * Password akan di-hash secara otomatis untuk keamanan
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        // Jika validasi gagal, kembali ke form dengan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Membuat user baru dengan password yang di-hash
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Mencatat aktivitas pembuatan user
        LogActivity::logActivity(auth()->id(), 'Membuat user baru: ' . $request->name);
        
        // Redirect ke halaman daftar user dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     * 
     * Method ini menampilkan detail user spesifik
     * Menampilkan informasi lengkap user termasuk peminjaman yang pernah dilakukan
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function show(string $id)
    {
        // Mencari user berdasarkan ID, jika tidak ada akan 404
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * Method ini menampilkan form edit user dengan data yang sudah ada
     * Admin dapat mengubah name, email, role, dan password (opsional)
     * 
     * @param string $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        // Mencari user yang akan diedit
        $user = User::findOrFail($id);

        // Hanya super admin yang boleh mengedit super admin
        if ($user->role === 'super_admin' && !auth()->user()->isSuperAdmin()) {
            abort(403);
        }
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * 
     * Method ini memproses update data user
     * Password hanya diupdate jika diisi, akan di-hash otomatis
     * Email harus unique kecuali untuk user yang sama
     * 
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        // Mencari user yang akan diupdate
        $user = User::findOrFail($id);

        if ($user->role === 'super_admin' && !auth()->user()->isSuperAdmin()) {
            abort(403);
        }
        
        // Validasi input update
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            // Role super_admin hanya boleh dibuat/diedit manual oleh super admin (tidak lewat form ini)
            'role' => 'required|in:admin,user',
        ]);

        // Jika validasi gagal, kembali ke form edit
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Update data user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Mencatat aktivitas update user
        LogActivity::logActivity(auth()->id(), 'Mengupdate user: ' . $user->name);
        
        // Redirect ke halaman daftar user dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * Method ini menghapus user dari database
     * Hanya user dengan role 'user' yang bisa dihapus (admin tidak bisa dihapus)
     * 
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        // Mencari user yang akan dihapus
        $user = User::findOrFail($id);
        $userName = $user->name;

        // Hanya super admin yang boleh menghapus user, dan tidak boleh menghapus super admin lain lewat panel ini
        if (!auth()->user()->isSuperAdmin() || $user->role === 'super_admin') {
            abort(403);
        }
        
        // Soft delete user
        $user->delete();
        
        // Mencatat aktivitas hapus user
        LogActivity::logActivity(auth()->id(), 'Menghapus user: ' . $userName);
        
        // Redirect ke halaman daftar user dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}
