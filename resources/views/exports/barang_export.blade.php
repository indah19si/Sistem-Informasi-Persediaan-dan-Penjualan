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
    </style>
</head>

<body>
    <table style="width: 100% !important">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Satuan</th>
                <th>Stok</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->satuan }}</td>
                    <td>{{ $item->stok }}</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <span>Rp.</span>
                            <span>
                                {{ number_format($item->harga_beli, 0, ',', '.') }}
                            </span>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <span>Rp.</span>
                            <span>
                                {{ number_format($item->harga_jual, 0, ',', '.') }}
                            </span>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
