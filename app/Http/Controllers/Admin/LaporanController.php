<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Carbon\Carbon; // Import Carbon
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanTagihanExport; // Gunakan Export class yang baru


class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari request
        $tanggalMulai = $request->input('tanggal_mulai', Carbon::now()->startOfMonth()->toDateString()); // Default awal bulan ini
        $tanggalSelesai = $request->input('tanggal_selesai', Carbon::now()->endOfMonth()->toDateString()); // Default akhir bulan ini
        $status = $request->input('status'); // Default null (semua status)

        // Query dasar
        $query = Tagihan::with(['siswa.user', 'pembayaran'])
            ->whereBetween('created_at', [$tanggalMulai . ' 00:00:00', $tanggalSelesai . ' 23:59:59']); // Filter rentang tanggal dibuatnya tagihan

        // Terapkan filter status jika dipilih
        if ($status && in_array($status, ['lunas', 'belum_lunas', 'menunggu_verifikasi'])) {
            $query->where('status', $status);
        }

        // Ambil data
        $laporanTagihan = $query->latest()->paginate(20);

        // Data untuk dropdown status
        $daftarStatus = [
            'belum_lunas' => 'Belum Lunas',
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            'lunas' => 'Lunas',
        ];

        // Kirim data ke view
        return view('admin.laporan.index', compact(
            'laporanTagihan',
            'tanggalMulai',
            'tanggalSelesai',
            'status',
            'daftarStatus',
            'request' // <-- Tambahkan ini
        ));
    }

    /**
     * Menangani permintaan ekspor data laporan tagihan ke Excel.
     */
    public function exportExcel(Request $request)
    {
        // Ambil filter dari request, gunakan default jika tidak ada
        $tanggalMulai = $request->input('tanggal_mulai', Carbon::now()->startOfMonth()->toDateString());
        $tanggalSelesai = $request->input('tanggal_selesai', Carbon::now()->endOfMonth()->toDateString());
        $status = $request->input('status');

        // Nama file Excel
        $namaFile = 'laporan_tagihan_' . $tanggalMulai . '_sd_' . $tanggalSelesai . ($status ? '_'.$status : '') . '.xlsx';

        // Panggil class Export dengan filter
        return Excel::download(new LaporanTagihanExport($tanggalMulai, $tanggalSelesai, $status), $namaFile);
    }
}
