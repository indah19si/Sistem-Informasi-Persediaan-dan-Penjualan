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
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('nama');
            $table->float('harga_beli');
            $table->float('harga_jual');
            $table->integer('stok');
            $table->unsignedBigInteger('id_supplier');
            $table->unsignedBigInteger('id_satuan');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('id_supplier')->references('id')->on('suppliers');
            $table->foreign('id_satuan')->references('id')->on('satuans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
};
