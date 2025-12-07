<?php

namespace App\Http\Controllers\WaliMurid;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class TagihanController extends Controller
{
    /**
     * Menampilkan daftar tagihan milik anak dari wali murid yang login.
     */
    public function index(Request $request) // Tambahkan Request
    {
        // Ambil ID semua siswa milik wali murid yang login
        $idSiswa = Auth::user()->siswas()->pluck('id');

        // Ambil status dari request, default null (tampilkan semua)
        $statusDipilih = $request->input('status');

        // Definisikan daftar status yang valid untuk filter
        $daftarStatus = [
            'belum_lunas' => 'Belum Lunas',
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            'lunas' => 'Lunas',
            'ditolak' => 'Ditolak',
        ];

        // Query dasar tagihan untuk anak-anak wali murid
        $queryTagihan = Tagihan::whereIn('siswa_id', $idSiswa)
            ->with('siswa') // Ambil data siswanya
            ->orderBy('tahun', 'desc') // Urutkan berdasarkan tahun terbaru
            ->orderBy('bulan', 'desc'); // Lalu urutkan berdasarkan bulan terbaru

        // Terapkan filter status JIKA status yang dipilih valid
        if ($statusDipilih && array_key_exists($statusDipilih, $daftarStatus)) {
            $queryTagihan->where('status', $statusDipilih);
        }

        // Ambil semua data, tidak pakai paginate
        $tagihan = $queryTagihan->get();

        // Kirim data ke view
        return view('walimurid.tagihan.index', compact('tagihan', 'statusDipilih', 'daftarStatus'));
    }

    /**
     * Menampilkan halaman form untuk melakukan pembayaran.
     */
    public function show(Tagihan $tagihan) // <-- PERBAIKAN DI SINI
    {
        // Keamanan: Pastikan wali murid hanya bisa mengakses tagihan anaknya
        abort_if($tagihan->siswa->user_id !== Auth::id(), 403);

        return view('walimurid.tagihan.show', compact('tagihan'));
    }

    /**
     * Memproses upload bukti pembayaran.
     */
    public function update(Request $request, Tagihan $tagihan) // <-- PERBAIKAN DI SINI
    {
        // Keamanan: Pastikan wali murid hanya bisa mengubah tagihan anaknya
        abort_if($tagihan->siswa->user_id !== Auth::id(), 403);

        // Pastikan status tagihan memungkinkan untuk upload bukti
        abort_if(!in_array($tagihan->status, ['belum_lunas', 'ditolak']), 403, 'Tagihan ini tidak dapat diupload bukti pembayaran.');

        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Simpan file gambar
        $path = $request->file('bukti_pembayaran')->store('bukti-pembayaran', 'public');

        // Handle upload ulang jika sudah ada pembayaran
        if ($tagihan->pembayaran) {
            // Hapus file lama jika ada
            if ($tagihan->pembayaran->struk_bukti && Storage::disk('public')->exists($tagihan->pembayaran->struk_bukti)) {
                Storage::disk('public')->delete($tagihan->pembayaran->struk_bukti);
            }
            // Update pembayaran yang ada
            $tagihan->pembayaran->tanggal_transfer = now();
            $tagihan->pembayaran->struk_bukti = $path;
            $tagihan->pembayaran->save();
        } else {
            // Buat record pembayaran baru
            $pembayaran = new Pembayaran();
            $pembayaran->tagihan_id = $tagihan->id;
            $pembayaran->tanggal_transfer = now();
            $pembayaran->struk_bukti = $path;
            $pembayaran->save();
        }

        // Update status tagihan
        $tagihan->status = 'menunggu_verifikasi';
        $tagihan->save();

        $message = $tagihan->pembayaran ?
            'Bukti pembayaran berhasil diupload ulang, mohon tunggu verifikasi dari admin.' :
            'Bukti pembayaran berhasil diupload, mohon tunggu verifikasi dari admin.';

        return redirect()->route('walimurid.tagihan.index')
            ->with('success', $message);
    }

    /**
     * Generate dan download kuitansi PDF.
     */
    public function downloadKuitansi(Tagihan $tagihan)
    {
        // Keamanan: Pastikan wali murid hanya bisa download kuitansi anaknya
        abort_if($tagihan->siswa->user_id !== Auth::id(), 403);
        // Pastikan tagihan sudah lunas
        abort_if($tagihan->status !== 'lunas', 403, 'Kuitansi hanya tersedia untuk tagihan yang sudah lunas.');

        // Load view kuitansi dengan data tagihan (termasuk relasi pembayaran)
        $pdf = Pdf::loadView('walimurid.tagihan.kuitansi', ['tagihan' => $tagihan->load('pembayaran')]);

        // Buat nama file PDF
        $namaFile = 'kuitansi-' . $tagihan->siswa->nama_siswa . '-' . $tagihan->bulan . '-' . $tagihan->tahun . '.pdf';

        // Download file PDF
        return $pdf->download($namaFile);

        // Jika ingin ditampilkan di browser tanpa download, gunakan:
        // return $pdf->stream($namaFile); 
    }
}
