<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class DummyPesananSeeder extends Seeder
{
    private function ensureAdminId(): int
    {
        if (!Schema::hasTable('users')) {
            return 1;
        }

        $existing = DB::table('users')->orderBy('id')->value('id');
        if ($existing) {
            return (int) $existing;
        }

        $cols = Schema::getColumnListing('users');
        $data = [];

        if (in_array('email', $cols)) $data['email'] = 'admin@example.com';
        if (in_array('password', $cols)) $data['password'] = Hash::make('password');

        if (in_array('name', $cols)) $data['name'] = 'Admin';
        if (in_array('nama', $cols)) $data['nama'] = 'Admin';
        if (in_array('username', $cols)) $data['username'] = 'admin';
        if (in_array('nama_user', $cols)) $data['nama_user'] = 'Admin';
        if (in_array('no_hp', $cols)) $data['no_hp'] = '081234567890';
        if (in_array('alamat', $cols)) $data['alamat'] = 'Default';

        if (in_array('role', $cols)) $data['role'] = 'admin';
        if (in_array('level', $cols)) $data['level'] = 'admin';
        if (in_array('is_admin', $cols)) $data['is_admin'] = 1;

        if (in_array('created_at', $cols)) $data['created_at'] = now();
        if (in_array('updated_at', $cols)) $data['updated_at'] = now();

        DB::table('users')->insert($data);

        return (int) DB::table('users')->orderBy('id')->value('id');
    }

    private function paketPayload(int $adminId, string $nama, string $kategori, int $harga): array
    {
        $data = [
            'id_admin' => $adminId,
            'nama_paket' => $nama,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (Schema::hasColumn('paket_layanan', 'kategori_paket')) $data['kategori_paket'] = $kategori;
        if (Schema::hasColumn('paket_layanan', 'deskripsi')) $data['deskripsi'] = 'Paket layanan untuk acara.';
        if (Schema::hasColumn('paket_layanan', 'harga_paket')) $data['harga_paket'] = $harga;
        if (Schema::hasColumn('paket_layanan', 'durasi')) $data['durasi'] = '1 Hari';
        if (Schema::hasColumn('paket_layanan', 'status_paket')) $data['status_paket'] = 'Aktif';
        if (Schema::hasColumn('paket_layanan', 'detail_venue')) $data['detail_venue'] = 'Detail venue default';
        if (Schema::hasColumn('paket_layanan', 'gambar_venue')) $data['gambar_venue'] = 'default.jpg';

        return $data;
    }

    public function run(): void
    {
        $adminId = $this->ensureAdminId();

        if (Schema::hasTable('pelanggan') && DB::table('pelanggan')->count() == 0) {
            DB::table('pelanggan')->insert([
                [
                    'nama_pelanggan' => 'Farah Rizki',
                    'email' => 'farah@example.com',
                    'password' => 1234,
                    'no_hp' => '098888888888',
                    'alamat' => 'jalan jalan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_pelanggan' => 'Abimanyu',
                    'email' => 'abimanyu@example.com',
                    'password' => 1234,
                    'no_hp' => '098888888888',
                    'alamat' => 'jalan jalan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'nama_pelanggan' => 'Jaehyun Jung',
                    'email' => 'jaehyun@example.com',
                    'password' => 1234,
                    'no_hp' => '098888888888',
                    'alamat' => 'jalan jalan',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        $p1 = Schema::hasTable('pelanggan') ? DB::table('pelanggan')->orderBy('id')->value('id') : null;
        $p2 = Schema::hasTable('pelanggan') ? (DB::table('pelanggan')->orderBy('id')->skip(1)->value('id') ?? $p1) : null;
        $p3 = Schema::hasTable('pelanggan') ? (DB::table('pelanggan')->orderBy('id')->skip(2)->value('id') ?? $p1) : null;

        if (Schema::hasTable('paket_layanan') && DB::table('paket_layanan')->count() == 0) {
            DB::table('paket_layanan')->insert([
                $this->paketPayload($adminId, 'Paket Bambu Area', 'Bambu Area', 300000),
                $this->paketPayload($adminId, 'Paket Bhumi Area', 'Bhumi Area', 400000),
                $this->paketPayload($adminId, 'Paket Edukasi', 'Outdoor', 500000),
            ]);
        }

        $k1 = Schema::hasTable('paket_layanan') ? DB::table('paket_layanan')->orderBy('id')->value('id') : null;
        $k2 = Schema::hasTable('paket_layanan') ? (DB::table('paket_layanan')->orderBy('id')->skip(1)->value('id') ?? $k1) : null;
        $k3 = Schema::hasTable('paket_layanan') ? (DB::table('paket_layanan')->orderBy('id')->skip(2)->value('id') ?? $k1) : null;

        $promo1 = null;
        $promo2 = null;

        if (Schema::hasTable('promo')) {
            if (DB::table('promo')->count() == 0) {
                $promoRow1 = [
                    'id_admin' => $adminId,
                    'nama_promo' => 'DISKON 10%',
                    'deskripsi' => 'aaa promooo',
                    'tanggal_mulai' => now()->subDays(1)->toDateString(),
                    'tanggal_selesai' => now()->addDays(8)->toDateString(),
                    'diskon' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $promoRow2 = [
                    'id_admin' => $adminId,
                    'nama_promo' => 'PROMO AKHIR TAHUN',
                    'deskripsi' => 'aaa promooo',
                    'tanggal_mulai' => now()->subDays(2)->toDateString(),
                    'tanggal_selesai' => now()->addDays(7)->toDateString(),
                    'diskon' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                if (Schema::hasColumn('promo', 'id_paket')) {
                    $promoRow1['id_paket'] = $k1;
                    $promoRow2['id_paket'] = $k2;
                }

                DB::table('promo')->insert([$promoRow1, $promoRow2]);
            }

            $promo1 = DB::table('promo')->orderBy('id')->value('id');
            $promo2 = DB::table('promo')->orderBy('id')->skip(1)->value('id') ?? $promo1;
        }

        if (Schema::hasTable('pesanan') && DB::table('pesanan')->count() == 0) {
            $row1 = [
                'id_pelanggan' => $p1,
                'id_paket' => $k1,
                'id_promo' => $promo1,
                'tanggal_pesanan' => now()->toDateString(),
                'total_harga' => 300000,
                'status_pesanan' => 'Berhasil',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $row2 = [
                'id_pelanggan' => $p2,
                'id_paket' => $k2,
                'id_promo' => null,
                'tanggal_pesanan' => now()->addDays(3)->toDateString(),
                'total_harga' => 400000,
                'status_pesanan' => 'Menunggu',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            $row3 = [
                'id_pelanggan' => $p3,
                'id_paket' => $k3,
                'id_promo' => $promo2,
                'tanggal_pesanan' => now()->addDays(7)->toDateString(),
                'total_harga' => 500000,
                'status_pesanan' => 'Dibatalkan',
                'created_at' => now(),
                'updated_at' => now(),
            ];

            if (Schema::hasColumn('pesanan', 'nama_pemesan')) {
                $row1['nama_pemesan'] = 'Farah Rizki';
                $row2['nama_pemesan'] = 'Abimanyu';
                $row3['nama_pemesan'] = 'Jaehyun Jung';
            }

            DB::table('pesanan')->insert([$row1, $row2, $row3]);
        }
    }
}
