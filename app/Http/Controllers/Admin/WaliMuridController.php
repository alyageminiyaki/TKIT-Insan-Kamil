<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // <-- Import Hash
use Illuminate\Validation\Rules; // <-- Import Rules
use Illuminate\Validation\Rule;

class WaliMuridController extends Controller
{
    /**
     * Menampilkan daftar wali murid (Contoh implementasi index)
     */
    public function index()
    {
        $waliMurid = User::where('role', 'walimurid')->latest()->paginate(10);
        return view('admin.walimurid.index', compact('waliMurid'));
    }

    /**
     * Menampilkan form untuk menambah wali murid baru.
     */
    public function create()
    {
        return view('admin.walimurid.create');
    }

    /**
     * Menyimpan data wali murid baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class], // Pastikan username unik
            'password' => ['required', 'confirmed', Rules\Password::min(1)], // Minimal 1 karakter & butuh konfirmasi
        ]);

        // 2. Buat User Baru
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash password!
            'role' => 'walimurid', // Set role otomatis
        ]);

        // 3. Redirect kembali ke halaman daftar wali murid
        return redirect()->route('admin.walimurid.index')
            ->with('success', 'Akun Wali Murid berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data wali murid.
     */
    public function edit(User $walimurid) // Gunakan Route Model Binding
    {
        // Pastikan hanya user dengan role walimurid yang bisa diedit di sini
        abort_if($walimurid->role !== 'walimurid', 404);
        return view('admin.walimurid.edit', compact('walimurid'));
    }

    /**
     * Memperbarui data wali murid di database.
     */
    public function update(Request $request, User $walimurid)
    {
        // Pastikan hanya user dengan role walimurid yang bisa diupdate
        abort_if($walimurid->role !== 'walimurid', 404);

        // 1. Validasi Input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Pastikan username unik, tapi abaikan user yang sedang diedit
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($walimurid->id)],
            // Password bersifat opsional saat edit
            'password' => ['nullable', 'confirmed', Rules\Password::min(1)],
        ]);

        // 2. Update data dasar
        $walimurid->name = $request->name;
        $walimurid->username = $request->username;

        // 3. Update password HANYA JIKA diisi
        if ($request->filled('password')) {
            $walimurid->password = Hash::make($request->password);
        }

        // 4. Simpan perubahan
        $walimurid->save();

        // 5. Redirect kembali ke halaman daftar
        return redirect()->route('admin.walimurid.index')
            ->with('success', 'Data Wali Murid berhasil diperbarui.');
    }

    public function destroy(User $walimurid)
    {
         // Pastikan hanya user dengan role walimurid yang bisa dihapus
        abort_if($walimurid->role !== 'walimurid', 404);

        // Hapus user
        $walimurid->delete();

        // Redirect kembali ke halaman daftar
        return redirect()->route('admin.walimurid.index')
                         ->with('success', 'Data Wali Murid berhasil dihapus.');
    }
}
