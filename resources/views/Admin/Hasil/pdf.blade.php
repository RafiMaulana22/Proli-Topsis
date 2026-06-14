<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        h2,
        h4 {
            text-align: center;
            margin: 0;
        }
    </style>
</head>

<body>

    <h2>
        LAPORAN HASIL RANKING TOPSIS
    </h2>

    <h4>
        {{ $periode->nama_periode ?? '-' }}
    </h4>

    <br>

    <table>

        <thead>

            <tr>
                <th>Ranking</th>
                <th>Kode Material</th>
                <th>Nama Material</th>
                <th>Nilai Preferensi</th>
                <th>Rekomendasi</th>
            </tr>

        </thead>

        <tbody>

            @foreach ($hasil as $item)
                <tr>

                    <td>
                        {{ $item->ranking }}
                    </td>

                    <td>
                        {{ $item->material->kode_material }}
                    </td>

                    <td>
                        {{ $item->material->nama_material }}
                    </td>

                    <td>
                        {{ number_format($item->nilai_preferensi, 4) }}
                    </td>

                    <td>

                        @if ($item->ranking == 1)
                            Sangat Direkomendasikan
                        @elseif($item->ranking <= 3)
                            Direkomendasikan
                        @elseif($item->ranking <= 5)
                            Cukup
                        @else
                            Kurang Direkomendasikan
                        @endif

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>

    <br><br>

    <table style="border:0;">
        <tr>
            <td style="border:0; text-align:right;">
                Dicetak tanggal :
                {{ now()->format('d-m-Y') }}
            </td>
        </tr>
    </table>

</body>

</html>
