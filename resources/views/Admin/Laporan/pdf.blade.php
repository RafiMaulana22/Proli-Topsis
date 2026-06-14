<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan TOPSIS</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
        }
    </style>
</head>

<body>

    <h2>Laporan Hasil Ranking TOPSIS</h2>

    <p>
        Periode :
        <strong>{{ $periode->nama_periode }}</strong>
    </p>

    <table>

        <thead>
            <tr>
                <th>Ranking</th>
                <th>Kode Material</th>
                <th>Nama Material</th>
                <th>Nilai Preferensi</th>
            </tr>
        </thead>

        <tbody>

            @foreach ($hasil as $item)
                <tr>
                    <td>{{ $item->ranking }}</td>
                    <td>{{ $item->material->kode_material }}</td>
                    <td>{{ $item->material->nama_material }}</td>
                    <td>{{ number_format($item->nilai_preferensi, 4) }}</td>
                </tr>
            @endforeach

        </tbody>

    </table>

</body>

</html>
