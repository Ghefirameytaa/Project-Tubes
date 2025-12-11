<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Promo::create([
            'id_admin' => 1,
            'nama_promo' => 'BhumiBhumi',
            'deskripsi' => 'Diskon 10% untuk semua paket layanan Bhumi Bambu.',
            'tanggal_mulai' => '2024-07-01',
            'tanggal_selesai' => '2024-07-31',
            'diskon' => 10,
        ]);

        \App\Models\Promo::create([
            'id_admin' => 2,
            'nama_promo' => 'BambuFest',
            'deskripsi' => 'Diskon 15% untuk pemesanan paket layanan selama festival BambuFest.',
            'tanggal_mulai' => '2024-08-10',
            'tanggal_selesai' => '2024-08-20',
            'diskon' => 15,
        ]);
    }
}
