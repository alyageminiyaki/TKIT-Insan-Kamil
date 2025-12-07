<?php

namespace App\Exports;

use App\Models\Tagihan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Collection; // Import Collection
use Carbon\Carbon; // Import Carbon

class TagihanExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $tahun;

    // Constructor untuk menerima tahun
    public function __construct(int $tahun)
    {
        $this->tahun = $tahun;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Ambil data tagihan HANYA untuk tahun yang dipilih
        // Eager load relasi untuk efisiensi
        return Tagihan::with(['siswa', 'siswa.user', 'pembayaran'])
                      ->where('tahun', $this->tahun)
                      ->orderBy('siswa_id') // Urutkan berdasarkan siswa
                      ->orderBy('bulan') // Lalu urutkan berdasarkan bulan
                      ->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        // Definisikan judul kolom di Excel
        return [
            'Tahun',
            'Bulan',
            'NIS',
            'Nama Siswa',
            'Kelas',
            'Nama Wali Murid',
            'Nominal Tagihan',
            'Status Pembayaran',
            'Tanggal Bayar (jika ada)',
        ];
    }

    /**
     * @param mixed $tagihan
     * @return array
     */
    public function map($tagihan): array
    {
        // Ubah format status agar lebih mudah dibaca
        $status = match ($tagihan->status) {
            'lunas' => 'Lunas',
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            default => 'Belum Lunas',
        };

        // Format nama bulan
        $namaBulan = Carbon::create()->month((int)$tagihan->bulan)->format('F');

        // Ambil tanggal bayar jika ada, jika tidak kosongkan
        $tanggalBayar = $tagihan->pembayaran ? Carbon::parse($tagihan->pembayaran->tanggal_transfer)->format('d-m-Y') : '';

        // Definisikan data untuk setiap baris di Excel
        return [
            $tagihan->tahun,
            $namaBulan,
            $tagihan->siswa->nis ?? '', // Tambahkan ?? '' untuk jaga-jaga jika siswa terhapus
            $tagihan->siswa->nama_siswa ?? '',
            $tagihan->siswa->kelas ?? '',
            $tagihan->siswa->user->name ?? '', // Tambahkan ?? '' untuk jaga-jaga jika wali terhapus
            $tagihan->nominal,
            $status,
            $tanggalBayar,
        ];
    }
}