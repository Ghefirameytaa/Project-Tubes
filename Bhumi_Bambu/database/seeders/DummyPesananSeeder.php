<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DummyPesananSeeder extends Seeder
{
    public function run(): void
    {
        // ====== PELANGGAN (WAJIB: nama_pelanggan + email) ======
        if (DB::table('pelanggan')->count() == 0) {
            DB::table('pelanggan')->insert([
                [
                    'nama_pelanggan' => 'Farah Rizki',
                    'email' => 'farah@example.com',
                    'password' => 1234,
                    'no_hp'=> '098888888888',
                    'alamat' => 'jalan jalan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_pelanggan' => 'Abimanyu',
                    'email' => 'abimanyu@example.com',
                    'password' => 1234,
                    'no_hp'=> '098888888888',
                    'alamat' => 'jalan jalan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_pelanggan' => 'Jaehyun Jung',
                    'email' => 'jaehyun@example.com',
                    'password' => 1234,
                    'no_hp'=> '098888888888',
                    'alamat' => 'jalan jalan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        // Ambil id pelanggan yang ada
        $p1 = DB::table('pelanggan')->orderBy('id')->value('id');
        $p2 = DB::table('pelanggan')->orderBy('id')->skip(1)->value('id') ?? $p1;
        $p3 = DB::table('pelanggan')->orderBy('id')->skip(2)->value('id') ?? $p1;

        // ====== PAKET LAYANAN ======
        // Kalau tabel paket_layanan punya kolom wajib lain selain nama_paket,
        // nanti akan error dan kita tambahin juga.
        if (DB::table('paket_layanan')->count() == 0) {
            DB::table('paket_layanan')->insert([
                [
                    'nama_paket' => 'Paket Bambu Area',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_paket' => 'Paket Bhumi Area',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_paket' => 'Paket Edukasi',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        $k1 = DB::table('paket_layanan')->orderBy('id')->value('id');
        $k2 = DB::table('paket_layanan')->orderBy('id')->skip(1)->value('id') ?? $k1;
        $k3 = DB::table('paket_layanan')->orderBy('id')->skip(2)->value('id') ?? $k1;

        // ====== PROMO (opsional) ======
        // Kalau tabel promo ada dan kosong, isi.
        if (DB::getSchemaBuilder()->hasTable('promo') && DB::table('promo')->count() == 0) {
            DB::table('promo')->insert([
                [
                    'id_admin' => 1,
                    'nama_promo' => 'DISKON 10%',
                    'deskripsi' => 'aaa promooo',
                    'tanggal_mulai' => now()->subDays(1)->toDateString(),
                    'tanggal_selesai' => now()->addDays(8)->toDateString(),
                    'diskon' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_admin' => 1,
                    'nama_promo' => 'PROMO AKHIR TAHUN',
                    'deskripsi' => 'aaa promooo',
                    'tanggal_mulai' => now()->subDays(2)->toDateString(),
                    'tanggal_selesai' => now()->addDays(7)->toDateString(),
                    'diskon' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        $promo1 = null;
        $promo2 = null;
        if (DB::getSchemaBuilder()->hasTable('promo') && DB::table('promo')->count() > 0) {
            $promo1 = DB::table('promo')->orderBy('id')->value('id');
            $promo2 = DB::table('promo')->orderBy('id')->skip(1)->value('id') ?? $promo1;
        }

        // ====== PESANAN ======
        if (DB::table('pesanan')->count() == 0) {
            DB::table('pesanan')->insert([
                [
                    'id_pelanggan' => $p1,
                    'id_paket' => $k1,
                    'id_promo' => $promo1,
                    'tanggal_pesanan' => now()->toDateString(),
                    'total_harga' => 300000,
                    'status_pesanan' => 'Berhasil',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_pelanggan' => $p2,
                    'id_paket' => $k2,
                    'id_promo' => null,
                    'tanggal_pesanan' => now()->addDays(3)->toDateString(),
                    'total_harga' => 400000,
                    'status_pesanan' => 'Menunggu',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_pelanggan' => $p3,
                    'id_paket' => $k3,
                    'id_promo' => $promo2,
                    'tanggal_pesanan' => now()->addDays(7)->toDateString(),
                    'total_harga' => 500000,
                    'status_pesanan' => 'Dibatalkan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}