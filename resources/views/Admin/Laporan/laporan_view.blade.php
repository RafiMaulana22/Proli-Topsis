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

        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Total Material
                    </h6>

                    <h3>{{ $totalMaterial }}</h3>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Total Kriteria
                    </h6>

                    <h3>{{ $totalKriteria }}</h3>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Total Penilaian
                    </h6>

                    <h3>{{ $totalPenilaian }}</h3>

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-danger">
                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Material Terbaik
                    </h6>

                    <h5>
                        {{ $materialTerbaik?->material?->nama_material ?? '-' }}
                    </h5>

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

                <button class="btn btn-success" disabled>
                    <i class="mdi mdi-file-excel"></i>
                    Export Excel
                </button>

                <button class="btn btn-danger" disabled>
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

                        @forelse ($hasil as $item)
                            <tr>

                                <td>

                                    @if ($item->ranking == 1)
                                        <span class="badge bg-success">
                                            {{ $item->ranking }}
                                        </span>
                                    @elseif ($item->ranking == 2)
                                        <span class="badge bg-primary">
                                            {{ $item->ranking }}
                                        </span>
                                    @elseif ($item->ranking == 3)
                                        <span class="badge bg-warning text-dark">
                                            {{ $item->ranking }}
                                        </span>
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
                                    @elseif ($item->ranking <= 3)
                                        <span class="badge bg-primary">
                                            Direkomendasikan
                                        </span>
                                    @elseif ($item->ranking <= 5)
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

                        @empty

                            <tr>
                                <td colspan="5" class="text-center">
                                    Belum ada hasil TOPSIS
                                </td>
                            </tr>
                        @endforelse

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
