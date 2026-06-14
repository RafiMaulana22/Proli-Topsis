@extends('Layouts.template-admin')

@section('title', 'Proses TOPSIS')

@section('breadcrumb')
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-primary">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active">
                Proses TOPSIS
            </li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="card mb-3">
        <div class="card-body">

            <div class="row align-items-end">

                <div class="col-md-6">

                    <form method="GET">

                        <label class="form-label">
                            Periode Penilaian
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

                    </form>

                </div>

                <div class="col-md-6 text-end">

                    <form action="{{ route('topsis.proses') }}" method="POST">

                        @csrf

                        <input type="hidden" name="periode_id" value="{{ request('periode_id') }}">

                        <button class="btn btn-success" {{ request('periode_id') ? '' : 'disabled' }}>

                            <i class="mdi mdi-calculator"></i>
                            Proses TOPSIS

                        </button>

                    </form>

                </div>

            </div>

        </div>
    </div>

    <div class="row mb-3">

        <div class="col-md-4">

            <div class="card border-primary">

                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Total Alternatif
                    </h6>

                    <h3>
                        {{ $penilaian->count() }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-success">

                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Total Kriteria
                    </h6>

                    <h3>
                        {{ $kriteria->count() }}
                    </h3>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="card border-warning">

                <div class="card-body text-center">

                    <h6 class="text-muted">
                        Hasil Ranking
                    </h6>

                    <h3>
                        {{ $hasil->count() }}
                    </h3>

                </div>

            </div>

        </div>

    </div>

    {{-- Matriks Keputusan --}}
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">1. Matriks Keputusan</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered text-center">

                    <thead class="table-light">
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($kriteria as $item)
                                <th>{{ $item->kode }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($penilaian as $item)
                            <tr>

                                <td>
                                    {{ $item->material->kode_material }}
                                </td>

                                @foreach ($kriteria as $krit)
                                    @php
                                        $detail = $item->detailPenilaians->where('kriteria_id', $krit->id)->first();
                                    @endphp

                                    <td>
                                        {{ $detail->nilai ?? 0 }}
                                    </td>
                                @endforeach

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    </div>

    {{-- Matriks Normalisasi --}}
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">2. Matriks Normalisasi</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered text-center">

                    <thead class="table-light">
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($kriteria as $item)
                                <th>{{ $item->kode }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($penilaian as $item)
                            <tr>

                                <td>
                                    {{ $item->material->kode_material }}
                                </td>

                                @foreach ($kriteria as $krit)
                                    <td>
                                        {{ number_format($normalisasi[$item->id][$krit->id] ?? 0, 4) }}
                                    </td>
                                @endforeach

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    </div>

    {{-- Matriks Terbobot --}}
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">3. Matriks Normalisasi Terbobot</h5>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered text-center">

                    <thead class="table-light">
                        <tr>
                            <th>Alternatif</th>
                            @foreach ($kriteria as $item)
                                <th>{{ $item->kode }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($penilaian as $item)
                            <tr>

                                <td>
                                    {{ $item->material->kode_material }}
                                </td>

                                @foreach ($kriteria as $krit)
                                    <td>
                                        {{ number_format($terbobot[$item->id][$krit->id] ?? 0, 4) }}
                                    </td>
                                @endforeach

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>
    </div>

    {{-- Solusi Ideal --}}
    <div class="row">

        <div class="col-md-6">

            <div class="card border-success">
                <div class="card-header bg-success text-white">
                    Solusi Ideal Positif (A+)
                </div>

                <div class="card-body">

                    <table class="table table-bordered">
                        <tbody>
                            @foreach ($kriteria as $item)
                                <tr>
                                    <td>{{ $item->kode }}</td>
                                    <td>
                                        {{ number_format($aplus[$item->id] ?? 0, 4) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="card border-danger">
                <div class="card-header bg-danger text-white">
                    Solusi Ideal Negatif (A-)
                </div>

                <div class="card-body">

                    <table class="table table-bordered">
                        <tbody>
                            @foreach ($kriteria as $item)
                                <tr>
                                    <td>{{ $item->kode }}</td>
                                    <td>
                                        {{ number_format($amin[$item->id] ?? 0, 4) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>

    {{-- Nilai Preferensi --}}
    <div class="card">

        <div class="card-header">
            <h5 class="mb-0">
                5. Nilai Preferensi dan Ranking
            </h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped">

                <thead class="table-light">
                    <tr>
                        <th>Ranking</th>
                        <th>Alternatif</th>
                        <th>Material</th>
                        <th>Nilai Preferensi</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($hasil as $item)
                        <tr>

                            <td>
                                <span class="badge bg-success">
                                    {{ $item->ranking }}
                                </span>
                            </td>

                            <td>
                                A{{ $loop->iteration }}
                            </td>

                            <td>
                                {{ $item->material->nama_material }}
                            </td>

                            <td>
                                {{ number_format($item->nilai_preferensi, 4) }}
                            </td>

                        </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

@endsection
