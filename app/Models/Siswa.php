<?php

// app/Models/Siswa.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // TAMBAHKAN INI
    protected $fillable = [
        'user_id',
        'nis',
        'nama_siswa',
        'kelas',
        'status',
    ];

    /**
     * Relasi ke User: Satu Siswa hanya dimiliki oleh satu User (wali murid).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke Tagihan: Satu Siswa bisa punya banyak tagihan.
     */
    public function tagihans()
    {
        return $this->hasMany(Tagihan::class);
    }
}
