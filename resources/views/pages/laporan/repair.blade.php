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
    <h2>Data Repair</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>No. Refair</th>
                <th>No. Defect</th>
                <th>Nomor Mesin</th>
                <th>Nomor Sasis</th>
                <th>Type</th>
                <th>Varian</th>
                <th>Warna</th>
                <th>Defect</th>
                <th>Penyebab</th>
                <th>Solusi</th>
                <th>Tanggal Repair</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($repair as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>

                    <td>{{ $item->refair_number ?? 'NA' }}</td>
                    <td>{{ $item->defect->defect_number ?? 'NA' }}</td>
                    <td>{{ $item->defect->pemasangan->no_mesin ?? 'NA' }}</td>
                    <td>{{ $item->defect->pemasangan->no_sasis ?? 'NA' }}</td>
                    <td>{{ $item->defect->pemasangan->type ?? 'NA' }}</td>
                    <td>{{ $item->defect->pemasangan->varian ?? 'NA' }}</td>
                    <td>{{ $item->defect->pemasangan->warna ?? 'NA' }}</td>
                    <td>{{$item->defect->problem ?? 'NA'}}</td>
                    <td>{{$item->defect->analisa ?? 'NA'}}</td>
                    <td>{{$item->solusi}}</td>
                    <td>{{ $item->created_at->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
