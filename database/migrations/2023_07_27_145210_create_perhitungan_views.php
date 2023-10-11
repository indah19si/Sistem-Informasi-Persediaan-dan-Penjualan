<?php

use Illuminate\Support\Facades\DB;
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
        DB::statement(
            "CREATE OR REPLACE VIEW perhitungan_views AS " .
                "SELECT
                    trx_pjb.id_barang,
                    MAX(trx_pjb.jumlah) AS penjualan_maksimal,
                    SUM(trx_pjb.jumlah) AS kebutuhan_setahun,
                    COUNT(trx_pjb.id) AS total_transaksi,
                    YEAR(trx.created_at) AS tahun_transaksi
                FROM
                    transaksi_penjualan_barangs trx_pjb
                INNER JOIN barang b ON b.id = trx_pjb.id_barang
                INNER JOIN transaksi_penjualans trx ON trx.id = trx_pjb.id_trx
                GROUP BY
                    trx_pjb.id_barang,
                    YEAR(trx.created_at)"
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW perhitungan_views");
    }
};
