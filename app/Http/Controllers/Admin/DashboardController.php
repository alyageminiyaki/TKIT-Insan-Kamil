<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Tagihan;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Data Total
        $jumlahSiswa = Siswa::where('status', 'aktif')->count();
        $jumlahWaliMurid = User::where('role', 'walimurid')->count();

        // Data Tagihan Bulan Ini
        $bulanIni = Carbon::now()->month;
        $tahunIni = Carbon::now()->year;

        $tagihanLunasBulanIni = Tagihan::where('bulan', $bulanIni)
            ->where('tahun', $tahunIni)
            ->where('status', 'lunas')
            ->count();

        $tagihanBelumLunasBulanIni = Tagihan::where('bulan', $bulanIni)
            ->where('tahun', $tahunIni)
            ->where('status', 'belum_lunas')
            ->count();

        // Menunggu verifikasi: tampilkan agregat untuk tahun berjalan (tanpa filter bulan)
        $tagihanMenungguVerifikasi = Tagihan::where('tahun', $tahunIni)
            ->where('status', 'menunggu_verifikasi')
            ->count();

        // **PERUBAHAN:** Hitung Total Uang Masuk (Lunas) Tahun Ini
        $totalUangMasuk = Tagihan::where('tahun', $tahunIni)
            ->where('status', 'lunas')
            ->sum('nominal'); // Jumlahkan kolom nominal

        // dd($jumlahSiswa, $jumlahWaliMurid, $totalUangMasuk, $tagihanLunasBulanIni, $tagihanBelumLunasBulanIni, $tagihanMenungguVerifikasi); 

        return view('admin.dashboard', compact(
            'jumlahSiswa',
            'jumlahWaliMurid',
            'totalUangMasuk',
            'tagihanLunasBulanIni',
            'tagihanBelumLunasBulanIni',
            'tagihanMenungguVerifikasi'
        ));
    }
}
