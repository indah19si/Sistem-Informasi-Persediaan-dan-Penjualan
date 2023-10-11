<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid black;
            text-align: center;
        }

        .d-flex {
            display: flex !important;
        }

        .justify-content-between {
            justify-content: space-around;
        }

        .w-100 {
            width: 100%
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
    <h2 class="text-center w-100">LAPORAN TRANSAKSI PENJUALAN <br> TOKO SYIFA </h2>
    <table style="width: 100% !important">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->trx_code }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <span>Rp.</span>
                            <span>
                                {{ number_format($item->total, 0, ',', '.') }}
                            </span>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
