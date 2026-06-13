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

    {{-- Statistik --}}
    <div class="row">

        <div class="col-md-4">
            <div class="card border-success">
                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Material Terbaik
                    </h6>

                    <h4 class="text-success">
                        Stainless Steel 304
                    </h4>

                    <span class="badge bg-success fs-6">
                        Nilai 0.7421
                    </span>

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
                        10
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

                    <span class="badge bg-success fs-6">
                        Ranking Selesai
                    </span>

                </div>
            </div>
        </div>

    </div>

    {{-- Hasil Ranking --}}
    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Hasil Ranking Material
            </h5>

            <button class="btn btn-danger">
                <i class="mdi mdi-file-pdf-box"></i>
                Cetak PDF
            </button>

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

                        <tr>
                            <td>
                                <span class="badge bg-success fs-6">
                                    #1
                                </span>
                            </td>
                            <td>MTR-001</td>
                            <td>Stainless Steel 304</td>
                            <td>0.7421</td>
                            <td>
                                <span class="badge bg-success">
                                    Sangat Direkomendasikan
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span class="badge bg-primary fs-6">
                                    #2
                                </span>
                            </td>
                            <td>MTR-002</td>
                            <td>Aluminium Alloy</td>
                            <td>0.6512</td>
                            <td>
                                <span class="badge bg-primary">
                                    Direkomendasikan
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <span class="badge bg-secondary fs-6">
                                    #3
                                </span>
                            </td>
                            <td>MTR-003</td>
                            <td>Carbon Steel</td>
                            <td>0.5384</td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    Cukup
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>MTR-004</td>
                            <td>Titanium Grade 2</td>
                            <td>0.4721</td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    Cukup
                                </span>
                            </td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>MTR-005</td>
                            <td>Copper C110</td>
                            <td>0.3518</td>
                            <td>
                                <span class="badge bg-danger">
                                    Kurang Direkomendasikan
                                </span>
                            </td>
                        </tr>

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
                data: [0.7421, 0.6512, 0.5384, 0.4721, 0.3518]
            }],
            xaxis: {
                categories: [
                    'MTR-001',
                    'MTR-002',
                    'MTR-003',
                    'MTR-004',
                    'MTR-005'
                ]
            }
        };

        new ApexCharts(
            document.querySelector("#chartRanking"),
            options
        ).render();
    </script>

@endsection
