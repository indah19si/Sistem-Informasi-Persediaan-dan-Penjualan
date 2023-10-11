SELECT
    id_trx,
    SUM(jumlah) as total_penjualan,
    YEAR(trxp.created_at) as tahun,
    MONTH(trxp.created_at) as bulan,
    DAY(trxp.created_at) as hari
FROM
    `transaksi_penjualan_barangs` trx
JOIN barang b ON
    b.id = trx.id_barang
JOIN transaksi_penjualans trxp ON
    trxp.id = trx.id_trx
GROUP BY
	tahun,
	bulan,
	hari,
    id_trx;

select `id_barang`, SUM(jumlah) as jumlah, `b`.`nama` 
from `transaksi_penjualan_barangs` 
inner join `barang` as `b` on `b`.`id` = `id_barang` 
inner join `transaksi_pembelians` as `trx` on `trx`.`id` = `id_trx` 
where `trx`.`created_at` BETWEEN '2023-07-01 00:00:00' AND '2023-07-31 23:59:59'
group by `id_barang`, `b`.`nama` 
order by `jumlah` desc
limit 10;

SELECT tpb.id_barang, SUM(tpb.jumlah) as jumlah, b.nama
FROM transaksi_penjualan_barangs tpb
JOIN barang b ON b.id = tpb.id_barang
JOIN transaksi_penjualans tp ON tp.id = tpb.id_trx
WHERE tp.created_at BETWEEN '2023-07-01 00:00:00' AND '2023-07-31 23:59:59'
GROUP BY tpb.id_barang
ORDER BY jumlah DESC
LIMIT 10;
