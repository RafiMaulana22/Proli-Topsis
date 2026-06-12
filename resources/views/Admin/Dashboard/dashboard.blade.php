@extends('Layouts.template-admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
@endsection

@section('content')

    {{-- Statistik --}}
    <div class="row">

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Total Material</h6>
                            <h2>{{ $totalMaterial }}</h2>
                        </div>
                        <i class="mdi mdi-package-variant fs-1 text-primary"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Total Kriteria</h6>
                            <h2>{{ $totalKriteria }}</h2>
                        </div>
                        <i class="mdi mdi-clipboard-list fs-1 text-success"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Total Penilaian</h6>
                            <h2>{{ $totalPenilaian }}</h2>
                        </div>
                        <i class="mdi mdi-file-document-edit fs-1 text-warning"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-3">
            <div class="card border-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Material Terbaik</h6>
                            <h5>{{ $materialTerbaik->kode_material ?? '-' }}</h5>
                            <small>
                                Nilai :
                                {{ number_format($materialTerbaik->nilai_preferensi ?? 0, 4) }}
                            </small>
                        </div>
                        <i class="mdi mdi-trophy fs-1 text-danger"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Informasi --}}
    <div class="row">
        <div class="col-12">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h4>Sistem Pendukung Keputusan Pemilihan Material Terbaik</h4>

                    <p class="mb-0">
                        Sistem ini menggunakan metode TOPSIS untuk menentukan
                        material terbaik berdasarkan kriteria yang telah ditentukan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Grafik dan Ranking --}}
    <div class="row">

        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5>Grafik Nilai Preferensi TOPSIS</h5>
                </div>

                <div class="card-body">
                    <div id="chartMaterial"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5>Distribusi Material</h5>
                </div>

                <div class="card-body">
                    <div id="chartDistribusi"></div>
                </div>
            </div>
        </div>

    </div>

    {{-- Ranking --}}
    <div class="row">
        <div class="col-12">

            <div class="card">
                <div class="card-header">
                    <h5>Top 10 Ranking Material</h5>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped">

                            <thead>
                                <tr>
                                    <th width="50">Rank</th>
                                    <th>Kode Material</th>
                                    <th>Nama Material</th>
                                    <th>Nilai Preferensi</th>
                                </tr>
                            </thead>

                            <tbody>

                                <tr>
                                    <td>1</td>
                                    <td>MTR-001</td>
                                    <td>Stainless Steel 304</td>
                                    <td>0.9821</td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>MTR-002</td>
                                    <td>Aluminium Alloy</td>
                                    <td>0.9543</td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>MTR-003</td>
                                    <td>Carbon Steel</td>
                                    <td>0.9231</td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>MTR-004</td>
                                    <td>Titanium Grade 2</td>
                                    <td>0.9012</td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td>MTR-005</td>
                                    <td>Copper C110</td>
                                    <td>0.8876</td>
                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection

@section('scripts')

    <script>
        var options = {
            chart: {
                type: 'bar',
                height: 350
            },
            series: [{
                name: 'Nilai',
                data: [0.98, 0.95, 0.92, 0.90, 0.88]
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
            document.querySelector("#chartMaterial"),
            options
        ).render();


        var pieOptions = {
            chart: {
                type: 'donut',
                height: 300
            },
            series: [35, 40, 25],
            labels: [
                'Sangat Baik',
                'Baik',
                'Cukup'
            ]
        };

        new ApexCharts(
            document.querySelector("#chartDistribusi"),
            pieOptions
        ).render();
    </script>

@endsection
