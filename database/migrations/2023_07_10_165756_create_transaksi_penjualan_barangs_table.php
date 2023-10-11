<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_penjualan_barangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_trx');
            $table->unsignedBigInteger('id_barang');
            $table->integer('jumlah');

            $table->foreign('id_trx')->references('id')->on('transaksi_penjualans');
            $table->foreign('id_barang')->references('id')->on('barang');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_penjualan_barangs');
    }
};
