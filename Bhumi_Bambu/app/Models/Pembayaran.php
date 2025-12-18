<?php

namespace App\Models;

use App\Models\Pemesanan;
use Illuminate\Databae\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'id_pemesanan',
        'metode_pembayaran',
        'jumlah_pembayaran',
        'tanggal_pembayaran',
        'status_pembayaran',
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }
}
