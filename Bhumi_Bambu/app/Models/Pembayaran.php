<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'pemesanan_id',
        'metode_pembayaran',
        'jumlah_bayar',
        'tanggal_bayar',
        'status'
    ];
    public function pemesanan(): BelongsTo
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }
}
