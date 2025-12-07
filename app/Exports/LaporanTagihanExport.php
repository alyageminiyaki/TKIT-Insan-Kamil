<?php

namespace App\Exports;

use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class LaporanTagihanExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $tanggalMulai;
    protected $tanggalSelesai;
    protected $status;

    // Constructor untuk menerima filter
    public function __construct($tanggalMulai, $tanggalSelesai, $status)
    {
        $this->tanggalMulai = $tanggalMulai;
        $this->tanggalSelesai = $tanggalSelesai;
        $this->status = $status;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Tagihan::with(['siswa.user', 'pembayaran'])
                        ->whereBetween('created_at', [$this->tanggalMulai . ' 00:00:00', $this->tanggalSelesai . ' 23:59:59']);

        if ($this->status && in_array($this->status, ['lunas', 'belum_lunas', 'menunggu_verifikasi'])) {
            $query->where('status', $this->status);
        }

        return $query->orderBy('created_at', 'asc')->get(); // Urutkan tanggal terlama dulu
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Tahun',
            'Bulan',
            'NIS',
            'Nama Siswa',
            'Kelas',
            'Nama Wali Murid',
            'Nominal Tagihan',
            'Status Pembayaran',
            'Tanggal Bayar',
            'Tanggal Tagihan Dibuat', // Tambah kolom tanggal tagihan
        ];
    }

    /**
     * @param mixed $tagihan
     * @return array
     */
    public function map($tagihan): array
    {
        $status = match ($tagihan->status) {
            'lunas' => 'Lunas',
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            default => 'Belum Lunas',
        };
        $namaBulan = Carbon::create()->month((int)$tagihan->bulan)->format('F');
        $tanggalBayar = $tagihan->pembayaran ? Carbon::parse($tagihan->pembayaran->tanggal_transfer)->format('d-m-Y') : '';
        $tanggalTagihan = Carbon::parse($tagihan->created_at)->format('d-m-Y'); // Format tanggal tagihan

        return [
            $tagihan->tahun,
            $namaBulan,
            $tagihan->siswa->nis ?? '',
            $tagihan->siswa->nama_siswa ?? '',
            $tagihan->siswa->kelas ?? '',
            $tagihan->siswa->user->name ?? '',
            $tagihan->nominal,
            $status,
            $tanggalBayar,
            $tanggalTagihan, // Tambah data tanggal tagihan
        ];
    }
}