<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    // Nama tabel
    protected $table = 'pembayaran';

    // Field yang bisa diisi (mass assignment)
    protected $fillable = [
        'id_pemesanan',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'nama_bank',
        'nama_pengirim',
        'jumlah_bayar',
        'status_pembayaran',
        'bukti_pembayaran',
        'catatan_admin',
        'waktu_verifikasi',
        'verifikasi_oleh'
    ];

    // Casting tipe data
    protected $casts = [
        'tanggal_pembayaran' => 'date',
        'waktu_verifikasi' => 'datetime',
        'jumlah_bayar' => 'integer',
    ];

    /**
     * Relasi ke Pemesanan (opsional)
     */
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }

    /**
     * Relasi ke User (admin yang verifikasi) - opsional
     */
    public function verifikator()
    {
        return $this->belongsTo(User::class, 'verifikasi_oleh');
    }

    /**
     * Helper: Cek apakah pembayaran pending
     */
    public function isPending()
    {
        return in_array(strtolower($this->status_pembayaran), ['pending', 'menunggu', 'menunggu verifikasi']);
    }

    /**
     * Helper: Cek apakah pembayaran approved
     */
    public function isApproved()
    {
        return in_array(strtolower($this->status_pembayaran), ['approved', 'berhasil', 'success']);
    }

    /**
     * Helper: Cek apakah pembayaran rejected
     */
    public function isRejected()
    {
        return in_array(strtolower($this->status_pembayaran), ['rejected', 'dibatalkan', 'ditolak']);
    }

    /**
     * Helper: Get CSS class untuk badge status
     */
    public function getStatusBadgeClass()
    {
        if ($this->isPending()) return 'pending';
        if ($this->isApproved()) return 'success';
        if ($this->isRejected()) return 'cancel';
        return 'pending';
    }

    /**
     * Helper: Get label status dalam bahasa Indonesia
     */
    public function getStatusLabel()
    {
        if ($this->isPending()) return 'Menunggu Verifikasi';
        if ($this->isApproved()) return 'Berhasil';
        if ($this->isRejected()) return 'Dibatalkan';
        return ucfirst($this->status_pembayaran);
    }

    /**
     * Helper: Format rupiah
     */
    public function getFormattedAmount()
    {
        return 'Rp ' . number_format($this->jumlah_bayar, 0, ',', '.');
    }

    /**
     * Helper: Get tanggal formatted
     */
    public function getFormattedDate()
    {
        return $this->tanggal_pembayaran->format('d/m/Y');
    }
}
// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;

// class Pembayaran extends Model
// {
//     protected $table = 'pembayaran';

//     protected $fillable = [
//         'pemesanan_id',
//         'metode_pembayaran',
//         'jumlah_bayar',
//         'tanggal_bayar',
//         'status'
//     ];
//     public function pemesanan(): BelongsTo
//     {
//         return $this->belongsTo(Pemesanan::class, 'pemesanan_id');
//     }
// }
