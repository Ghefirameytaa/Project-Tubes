<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    
    protected $fillable = [
        'pemesanan_id',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'nama_bank',
        'nama_pengirim',
        'jumlah_bayar',
        'status_pembayaran',
        'bukti_pembayaran',
        'catatan_admin',
        'waktu_verifikasi',
        'verifikasi_oleh',
    ];

    protected $casts = [
        'tanggal_pembayaran' => 'date',
        'waktu_verifikasi' => 'datetime',
    ];

    /**
     * Relasi ke Pemesanan
     */
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
    }

    /**
     * Get status badge class for display
     * 
     * @return string
     */
    public function getStatusBadgeClass()
    {
        return match($this->status_pembayaran) {
            'Pending' => 'pending',
            'Berhasil' => 'success',
            'Dibatalkan' => 'cancel',
            default => 'pending',
        };
    }

    /**
     * Get status label for display
     * 
     * @return string
     */
    public function getStatusLabel()
    {
        return match($this->status_pembayaran) {
            'Pending' => 'Menunggu Verifikasi',
            'Berhasil' => 'Berhasil',
            'Dibatalkan' => 'Dibatalkan',
            default => $this->status_pembayaran,
        };
    }
}