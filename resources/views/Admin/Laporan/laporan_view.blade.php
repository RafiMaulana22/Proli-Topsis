@extends('Layouts.template-admin')

@section('title', 'Laporan')

@section('breadcrumb')
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-primary">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active">
                Laporan
            </li>
        </ol>
    </div>
@endsection

@section('content')

    {{-- Filter --}}
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">
                Filter Laporan
            </h5>
        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        Periode Awal
                    </label>

                    <input type="date" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">
                        Periode Akhir
                    </label>

                    <input type="date" class="form-control">
                </div>

                <div class="col-md-4 mb-3 d-flex align-items-end">
                    <button class="btn btn-primary w-100">
                        <i class="mdi mdi-magnify"></i>
                        Tampilkan
                    </button>
                </div>

            </div>

        </div>

    </div>

    {{-- Statistik --}}
    <div class="row">

        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Total Material
                    </h6>

                    <h3>10</h3>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Total Kriteria
                    </h6>

                    <h3>5</h3>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Total Penilaian
                    </h6>

                    <h3>50</h3>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-danger">
                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Material Terbaik
                    </h6>

                    <h5>Stainless Steel 304</h5>

                </div>
            </div>
        </div>

    </div>

    {{-- Data Ranking --}}
    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <h5 class="mb-0">
                Laporan Hasil Ranking TOPSIS
            </h5>

            <div>

                <button class="btn btn-success">
                    <i class="mdi mdi-file-excel"></i>
                    Export Excel
                </button>

                <button class="btn btn-danger">
                    <i class="mdi mdi-file-pdf-box"></i>
                    Export PDF
                </button>

                <button class="btn btn-primary">
                    <i class="mdi mdi-printer"></i>
                    Print
                </button>

            </div>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table id="tableLaporan" class="table table-bordered table-striped align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="80">Ranking</th>
                            <th>Kode Material</th>
                            <th>Nama Material</th>
                            <th>Nilai Preferensi</th>
                            <th>Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
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
                            <td>2</td>
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
                            <td>3</td>
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

@endsection

@section('scripts')

    <script>
        $(document).ready(function() {

            $('#tableLaporan').DataTable({
                responsive: true,
                pageLength: 10,
                order: [
                    [0, 'asc']
                ],
                language: {
                    search: "Cari :",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    }
                }
            });

        });
    </script>

@endsection
