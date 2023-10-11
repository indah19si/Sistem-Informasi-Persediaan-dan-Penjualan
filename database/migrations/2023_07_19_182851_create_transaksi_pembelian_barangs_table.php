<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_pembelian_barangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_trx');
            $table->unsignedBigInteger('id_barang');
            $table->integer('jumlah');

            $table->foreign('id_trx')->references('id')->on('transaksi_pembelians');
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
        Schema::dropIfExists('transaksi_pembelian_barangs');
    }
};
