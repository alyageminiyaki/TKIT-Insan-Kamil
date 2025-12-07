<?php

// app/Models/Pembayaran.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    /**
     * Relasi ke Tagihan: Satu Pembayaran hanya dimiliki oleh satu Tagihan.
     */
    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }
}
