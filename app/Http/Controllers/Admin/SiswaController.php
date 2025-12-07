<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Siswa;
use Illuminate\Validation\Rule;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request) // Tambahkan Request $request
    {
        // Ambil nilai filter kelas dari request, defaultnya null (tampilkan semua)
        $kelasDipilih = $request->input('kelas');

        // Definisikan daftar kelas yang ada
        $daftarKelas = ['A1', 'A2', 'A3', 'A4', 'B1', 'B2', 'B3', 'B4', 'B5', 'B6']; // Sesuaikan jika perlu

        // Query dasar untuk mengambil siswa dengan relasi user (wali murid)
        $querySiswa = Siswa::with('user')->latest();

        // Terapkan filter kelas jika ada yang dipilih
        if ($kelasDipilih) {
            $querySiswa->where('kelas', $kelasDipilih);
        }

        // Ambil data siswa dengan pagination
        $siswa = $querySiswa->paginate(10);

        // Ambil data wali murid untuk modal tambah/edit (tetap diperlukan)
        $waliMurid = User::where('role', 'walimurid')->get();

        // Kirim semua data yang dibutuhkan ke view
        return view('admin.siswa.index', compact(
            'siswa', 
            'waliMurid', 
            'daftarKelas', 
            'kelasDipilih' 
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data wali murid untuk ditampilkan di form dropdown
        $waliMurid = User::where('role', 'walimurid')->get();
        return view('admin.siswa.create', compact('waliMurid'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis',
            'kelas' => 'required|string',
            // Validasi username_wali
            'username_wali' => [
                'required',
                'string',
                // Pastikan username ada di tabel users, rolenya walimurid
                Rule::exists('users', 'username')->where(function ($query) {
                    return $query->where('role', 'walimurid');
                }),
            ],
        ]);

        // Cari user_id berdasarkan username_wali yang valid
        $wali = User::where('username', $validatedData['username_wali'])->first();

        // Buat data siswa dengan user_id yang ditemukan
        Siswa::create([
            'nama_siswa' => $validatedData['nama_siswa'],
            'nis' => $validatedData['nis'],
            'kelas' => $validatedData['kelas'],
            'user_id' => $wali->id, // Gunakan ID wali murid yang ditemukan
        ]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $siswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $siswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Siswa $siswa)
    {
        $validatedData = $request->validate([
            'nama_siswa' => 'required|string|max:255',
            'nis' => 'required|string|unique:siswas,nis,' . $siswa->id,
            'kelas' => 'required|string',
            // Validasi username_wali
            'username_wali' => [
                'required',
                'string',
                Rule::exists('users', 'username')->where(function ($query) {
                    return $query->where('role', 'walimurid');
                }),
            ],
        ]);

        // Cari user_id berdasarkan username_wali yang valid
        $wali = User::where('username', $validatedData['username_wali'])->first();

        // Update data siswa dengan user_id yang ditemukan
        $siswa->update([
            'nama_siswa' => $validatedData['nama_siswa'],
            'nis' => $validatedData['nis'],
            'kelas' => $validatedData['kelas'],
            'user_id' => $wali->id, // Gunakan ID wali murid yang ditemukan
        ]);

        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        // Hapus data
        $siswa->delete();

        // Arahkan kembali dengan pesan sukses
        return redirect()->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }
}
