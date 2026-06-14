<!DOCTYPE html>
<html>

<head>
    <title>Cetak Laporan</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }
    </style>
</head>

<body onload="window.print()">

    <h2 align="center">
        LAPORAN HASIL RANKING TOPSIS
    </h2>

    <p>
        Periode : {{ $periode->nama_periode }}
    </p>

    <table>

        <thead>
            <tr>
                <th>Ranking</th>
                <th>Kode</th>
                <th>Material</th>
                <th>Nilai</th>
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
