<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            // Tambah kolom untuk bukti pembayaran
            $table->string('bukti_pembayaran')->nullable()->after('status_pembayaran');
            
            // Tambah kolom untuk nama bank dan pengirim
            $table->string('nama_bank')->nullable()->after('metode_pembayaran');
            $table->string('nama_pengirim')->nullable()->after('nama_bank');
            
            // Tambah kolom verifikasi admin
            $table->text('catatan_admin')->nullable()->after('bukti_pembayaran');
            $table->timestamp('waktu_verifikasi')->nullable()->after('catatan_admin');
            $table->unsignedBigInteger('verifikasi_oleh')->nullable()->after('waktu_verifikasi');
            
            // Foreign key untuk admin yang verifikasi
            $table->foreign('verifikasi_oleh')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign(['verifikasi_oleh']);
            $table->dropColumn([
                'bukti_pembayaran',
                'nama_bank',
                'nama_pengirim',
                'catatan_admin',
                'waktu_verifikasi',
                'verifikasi_oleh'
            ]);
        });
    }
};

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;


// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('pembayaran', function (Blueprint $table) {
//             $table->id();
//             $table->unsignedBigInteger('id_pemesanan')->nullable();
//             $table->foreign('id_pemesanan')->references('id')->on('pemesanan')->onDelete('cascade');
//             $table->date('tanggal_pembayaran');
//             $table->string('metode_pembayaran');
//             $table->integer('jumlah_bayar');
//             $table->string('status_pembayaran');
//             $table->timestamps();

//             $table->foreign('id_pemesanan')
//               ->references('id')
//               ->on('pemesanan')
//               ->onDelete('cascade');
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('pembayaran');
//     }
// };