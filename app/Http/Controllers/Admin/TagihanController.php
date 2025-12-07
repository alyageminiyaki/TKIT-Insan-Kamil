<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil filter tahun dan status dari request
        $tahunDipilih = $request->input('tahun', date('Y'));
        $statusDipilih = $request->input('status'); // Default null (tampilkan semua)

        // Definisikan daftar status yang valid untuk filter
        $daftarStatus = [
            'belum_lunas' => 'Belum Lunas',
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            'lunas' => 'Lunas',
            'ditolak' => 'Ditolak',
        ];

        // Query dasar tagihan dengan relasi
        $queryTagihan = Tagihan::with(['siswa.user', 'pembayaran'])
            ->where('tahun', $tahunDipilih);

        // Terapkan filter status JIKA status yang dipilih valid
        if ($statusDipilih && array_key_exists($statusDipilih, $daftarStatus)) {
            $queryTagihan->where('status', $statusDipilih);
        }

        // Ambil data dengan urutan dan pagination
        $tagihan = $queryTagihan->latest('bulan')->paginate(20); // Urutkan bulan terbaru dulu

        // Ambil daftar tahun unik untuk filter tahun
        $daftarTahun = Tagihan::select('tahun')->distinct()->orderBy('tahun', 'desc')->pluck('tahun');

        // Kirim semua data ke view
        return view('admin.tagihan.index', compact(
            'tagihan',
            'tahunDipilih',
            'daftarTahun',
            'statusDipilih', // Kirim status yang dipilih
            'daftarStatus' // Kirim daftar status untuk dropdown
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Tambahkan validasi untuk nominal
        $request->validate([
            'nominal' => 'required|numeric|min:0',
        ]);

        $bulan = date('m');
        $tahun = date('Y');
        $siswa = Siswa::where('status', 'aktif')->get();

        foreach ($siswa as $item) {
            $tagihanSudahAda = Tagihan::where('siswa_id', $item->id)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->exists();

            if (!$tagihanSudahAda) {
                Tagihan::create([
                    'siswa_id' => $item->id,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    // 2. Gunakan nominal dari request
                    'nominal' => $request->nominal,
                    'status' => 'belum_lunas',
                ]);
            }
        }

        return redirect()->route('admin.tagihan.index')
            ->with('success', 'Tagihan bulan ini dengan nominal Rp ' . number_format($request->nominal, 0, ',', '.') . ' berhasil di-generate.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function verifikasi(Tagihan $tagihan)
    {
        $tagihan->status = 'lunas';
        $tagihan->save();

        return redirect()->route('admin.tagihan.index')
            ->with('success', 'Tagihan berhasil diverifikasi dan status diubah menjadi Lunas.');
    }

    public function tolak(Tagihan $tagihan)
    {
        $tagihan->status = 'ditolak';
        $tagihan->save();

        return redirect()->route('admin.tagihan.index')
            ->with('success', 'Pembayaran ditolak dan status tagihan diubah menjadi Ditolak.');
    }
}
