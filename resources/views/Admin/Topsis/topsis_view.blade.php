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

    {{-- Tombol Proses --}}
    <div class="card">
        <div class="card-body text-center">

            <h4 class="mb-3">
                Perhitungan Metode TOPSIS
            </h4>

            <button class="btn btn-success btn-lg">
                <i class="mdi mdi-calculator"></i>
                Proses TOPSIS
            </button>

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
                            <th>C1</th>
                            <th>C2</th>
                            <th>C3</th>
                            <th>C4</th>
                            <th>C5</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>A1</td>
                            <td>4</td>
                            <td>5</td>
                            <td>5</td>
                            <td>3</td>
                            <td>4</td>
                        </tr>

                        <tr>
                            <td>A2</td>
                            <td>5</td>
                            <td>4</td>
                            <td>3</td>
                            <td>5</td>
                            <td>5</td>
                        </tr>

                        <tr>
                            <td>A3</td>
                            <td>3</td>
                            <td>4</td>
                            <td>4</td>
                            <td>4</td>
                            <td>3</td>
                        </tr>
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
                            <th>C1</th>
                            <th>C2</th>
                            <th>C3</th>
                            <th>C4</th>
                            <th>C5</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>A1</td>
                            <td>0.56</td>
                            <td>0.66</td>
                            <td>0.70</td>
                            <td>0.42</td>
                            <td>0.56</td>
                        </tr>

                        <tr>
                            <td>A2</td>
                            <td>0.70</td>
                            <td>0.53</td>
                            <td>0.42</td>
                            <td>0.70</td>
                            <td>0.70</td>
                        </tr>

                        <tr>
                            <td>A3</td>
                            <td>0.42</td>
                            <td>0.53</td>
                            <td>0.56</td>
                            <td>0.56</td>
                            <td>0.42</td>
                        </tr>
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
                            <th>C1</th>
                            <th>C2</th>
                            <th>C3</th>
                            <th>C4</th>
                            <th>C5</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>A1</td>
                            <td>0.196</td>
                            <td>0.165</td>
                            <td>0.140</td>
                            <td>0.042</td>
                            <td>0.056</td>
                        </tr>

                        <tr>
                            <td>A2</td>
                            <td>0.245</td>
                            <td>0.132</td>
                            <td>0.084</td>
                            <td>0.070</td>
                            <td>0.070</td>
                        </tr>

                        <tr>
                            <td>A3</td>
                            <td>0.147</td>
                            <td>0.132</td>
                            <td>0.112</td>
                            <td>0.056</td>
                            <td>0.042</td>
                        </tr>
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
                        <tr>
                            <td>C1</td>
                            <td>0.147</td>
                        </tr>
                        <tr>
                            <td>C2</td>
                            <td>0.165</td>
                        </tr>
                        <tr>
                            <td>C3</td>
                            <td>0.140</td>
                        </tr>
                        <tr>
                            <td>C4</td>
                            <td>0.042</td>
                        </tr>
                        <tr>
                            <td>C5</td>
                            <td>0.070</td>
                        </tr>
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
                        <tr>
                            <td>C1</td>
                            <td>0.245</td>
                        </tr>
                        <tr>
                            <td>C2</td>
                            <td>0.132</td>
                        </tr>
                        <tr>
                            <td>C3</td>
                            <td>0.084</td>
                        </tr>
                        <tr>
                            <td>C4</td>
                            <td>0.070</td>
                        </tr>
                        <tr>
                            <td>C5</td>
                            <td>0.042</td>
                        </tr>
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

                    <tr>
                        <td>
                            <span class="badge bg-success">1</span>
                        </td>
                        <td>A1</td>
                        <td>Stainless Steel 304</td>
                        <td>0.7421</td>
                    </tr>

                    <tr>
                        <td>
                            <span class="badge bg-primary">2</span>
                        </td>
                        <td>A2</td>
                        <td>Aluminium Alloy</td>
                        <td>0.6512</td>
                    </tr>

                    <tr>
                        <td>
                            <span class="badge bg-secondary">3</span>
                        </td>
                        <td>A3</td>
                        <td>Carbon Steel</td>
                        <td>0.5384</td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

@endsection
