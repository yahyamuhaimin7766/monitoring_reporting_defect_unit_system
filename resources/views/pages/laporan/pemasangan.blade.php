<!DOCTYPE html>
<html>
<head>
    <title>Cetak Pemasangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data Pemasangan</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nomor Mesin</th>
                <th>Nomor Sasis</th>
                <th>Type</th>
                <th>Varian</th>
                <th>Warna</th>
                <th>Tanggal Pemasangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemasangan as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $item->no_mesin }}</td>
                    <td>{{ $item->no_sasis }}</td>
                    <td>{{ $item->type }}</td>
                    <td>{{ $item->varian }}</td>
                    <td>{{ $item->warna }}</td>
                    <td>{{ $item->tanggal->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
