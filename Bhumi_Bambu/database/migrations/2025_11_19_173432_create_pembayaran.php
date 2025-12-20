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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pemesanan')->nullable();
            $table->foreign('id_pemesanan')->references('id')->on('pemesanan')->onDelete('cascade');
            $table->date('tanggal_pembayaran');
            $table->string('metode_pembayaran');
            $table->integer('jumlah_bayar');
            $table->string('status_pembayaran');
            $table->timestamps();

            $table->foreign('id_pemesanan')
              ->references('id')
              ->on('pemesanan')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};

// <?php

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
//              $table->unsignedBigInteger('pemesanan_id');
//              $table->string('metode_pembayaran');
//              $table->integer('jumlah_bayar');
//              $table->date('tanggal_bayar');
//              $table->string('status');
//             $table->timestamps();

//              $table->foreign('pemesanan_id')
//               ->references('id')
//               ->on('tb_pemesanan')
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