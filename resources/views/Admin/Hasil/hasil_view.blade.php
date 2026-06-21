@extends('Layouts.template-admin')

@section('title', 'Hasil Ranking')

@section('breadcrumb')
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-primary">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active">
                Hasil Ranking
            </li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card mb-3">
        <div class="card-body">

            <form method="GET">

                <div class="row">

                    <div class="col-md-4">

                        <label class="form-label">
                            Periode
                        </label>

                        <select name="periode_id" class="form-select" onchange="this.form.submit()">

                            <option value="">
                                Pilih Periode
                            </option>

                            @foreach ($periode as $item)
                                <option value="{{ $item->id }}"
                                    {{ request('periode_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->nama_periode }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                </div>

            </form>

        </div>
    </div>

    {{-- Statistik --}}
    <div class="row">

        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Material Terbaik
                    </h6>

                    @if ($terbaik)
                        <h4 class="text-success">
                            {{ $terbaik->material->nama_material }}
                        </h4>

                        <span class="badge bg-success fs-6">
                            Nilai {{ number_format($terbaik->nilai_preferensi, 4) }}
                        </span>
                    @else
                        <h5>
                            Belum Ada Data
                        </h5>
                    @endif

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-primary">
                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Total Material
                    </h6>

                    <h3>
                        {{ $hasil->count() }}
                    </h3>

                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-warning">
                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Status
                    </h6>

                    @if ($hasil->count())
                        <span class="badge bg-success fs-6">
                            Ranking Selesai
                        </span>
                    @else
                        <span class="badge bg-danger fs-6">
                            Belum Diproses
                        </span>
                    @endif

                </div>
            </div>
        </div>

    </div>

    @if (!request('periode_id'))
        <div class="alert alert-warning">

            Silakan pilih periode terlebih dahulu untuk melihat hasil ranking.

        </div>
    @elseif($hasil->isEmpty())
        <div class="alert alert-danger">

            Data ranking untuk periode ini belum tersedia.
            Silakan lakukan proses TOPSIS terlebih dahulu.

        </div>
    @endif

    {{-- Hasil Ranking --}}
    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Hasil Ranking Material
            </h5>

            @if (request('periode_id') && $hasil->count() > 0)
                <a href="{{ route('hasil.pdf', ['periode_id' => request('periode_id')]) }}" class="btn btn-danger"
                    target="_blank">

                    <i class="mdi mdi-file-pdf-box"></i>
                    Cetak PDF
                </a>
            @else
                <button class="btn btn-danger" disabled>

                    <i class="mdi mdi-file-pdf-box"></i>
                    Cetak PDF

                </button>
            @endif

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table id="tableRanking" class="table table-bordered table-striped align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="80">Ranking</th>
                            <th>Kode Material</th>
                            <th>Nama Material</th>
                            <th>Nilai Preferensi</th>
                            <th>Rekomendasi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($hasil as $item)
                            <tr>

                                <td data-order="{{ $item->ranking }}">

                                    @if ($item->ranking == 1)
                                        <span class="badge bg-success fs-6">#1</span>
                                    @elseif($item->ranking == 2)
                                        <span class="badge bg-primary fs-6">#2</span>
                                    @elseif($item->ranking == 3)
                                        <span class="badge bg-secondary fs-6">#3</span>
                                    @else
                                        {{ $item->ranking }}
                                    @endif

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
                                        <span class="badge bg-success">
                                            Sangat Direkomendasikan
                                        </span>
                                    @elseif($item->ranking <= 3)
                                        <span class="badge bg-primary">
                                            Direkomendasikan
                                        </span>
                                    @elseif($item->ranking <= 5)
                                        <span class="badge bg-warning text-dark">
                                            Cukup
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            Kurang Direkomendasikan
                                        </span>
                                    @endif

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- Grafik Ranking --}}
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">
                Grafik Nilai Preferensi
            </h5>
        </div>

        <div class="card-body">
            <div id="chartRanking"></div>
        </div>

    </div>

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {

            $('#tableRanking').DataTable({
                responsive: true,
                pageLength: 10,
                order: [
                    [0, 'asc']
                ]
            });

        });

        var options = {
            chart: {
                type: 'bar',
                height: 350
            },

            series: [{
                name: 'Nilai Preferensi',
                data: [
                    @foreach ($hasil as $item)
                        {{ $item->nilai_preferensi }},
                    @endforeach
                ]
            }],

            xaxis: {
                categories: [
                    @foreach ($hasil as $item)
                        "{{ $item->material->kode_material }}",
                    @endforeach
                ]
            }
        };

        new ApexCharts(
            document.querySelector("#chartRanking"),
            options
        ).render();
    </script>

@endsection
