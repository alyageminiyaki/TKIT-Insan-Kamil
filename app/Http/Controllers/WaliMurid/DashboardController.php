<?php

namespace App\Http\Controllers\WaliMurid;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\Tagihan;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil satu anak utama (misal anak pertama yang tertaut ke akun)
        $siswaUtama = Siswa::where('user_id', $user->id)
            ->orderBy('nama_siswa')
            ->first();

        // Hitung total tagihan lunas untuk anak utama (jika ada)
        $totalTagihanLunas = 0;

        if ($siswaUtama) {
            $totalTagihanLunas = Tagihan::where('siswa_id', $siswaUtama->id)
                ->where('status', 'lunas')
                ->sum('nominal');
        }

        return view('walimurid.dashboard', compact('siswaUtama', 'totalTagihanLunas'));
    }
}
