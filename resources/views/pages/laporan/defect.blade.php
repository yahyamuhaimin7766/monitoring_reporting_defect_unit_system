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
    <h2>Data Defect</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nomor Mesin</th>
                <th>Nomor Sasis</th>
                <th>Type</th>
                <th>Varian</th>
                <th>Warna</th>
                <th>Problem</th>
                <th>Analisa</th>
                <th>Action</th>
                <th>Tanggal Pemasangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($defect as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{ $item->pemasangan->no_mesin }}</td>
                    <td>{{ $item->pemasangan->no_sasis }}</td>
                    <td>{{ $item->pemasangan->type }}</td>
                    <td>{{ $item->pemasangan->varian }}</td>
                    <td>{{ $item->pemasangan->warna }}</td>
                    <td>{{$item->problem}}</td>
                    <td>{{$item->analisa}}</td>
                    <td>{{ $actionOptions[$item->action] ?? 'Unknown' }}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
