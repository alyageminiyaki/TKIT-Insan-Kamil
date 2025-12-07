<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // TAMBAHKAN BAGIAN INI:
    protected $fillable = [
        'siswa_id',
        'bulan',
        'tahun',
        'nominal',
        'status',
    ];

    /**
     * Relasi ke Siswa: Satu Tagihan hanya dimiliki oleh satu Siswa.
     */
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    /**
     * Relasi ke Pembayaran: Satu Tagihan hanya punya satu record pembayaran.
     */
    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}