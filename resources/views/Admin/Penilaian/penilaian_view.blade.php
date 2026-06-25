@extends('Layouts.template-admin')

@section('title', 'Penilaian Material')

@section('breadcrumb')
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-primary">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item active">
                Penilaian Material
            </li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="card mb-3">
        <div class="card-body">

            <form method="GET" action="{{ route('penilaian.index') }}">

                <div class="row align-items-end">

                    <div class="col-md-4">
                        <label class="form-label">Periode Penilaian</label>

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

    {{-- Alert Session --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle me-2"></i>
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle me-2"></i>
            {{ session('error') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert me-2"></i>
            {{ session('warning') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('info'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            <i class="mdi mdi-information me-2"></i>
            {{ session('info') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <strong>
                Terdapat kesalahan:
            </strong>

            <ul class="mb-0 mt-2">

                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach

            </ul>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

        </div>
    @endif

    @if (!request('periode_id'))
        <div class="alert alert-warning">
            Silakan pilih periode terlebih dahulu untuk melihat atau melakukan penilaian material.
        </div>
    @endif

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                Data Penilaian Material
            </h5>

            @if (request('periode_id'))
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPenilaian">

                    <i class="mdi mdi-plus"></i>
                    Input Nilai
                </button>
            @else
                <button class="btn btn-secondary" disabled>
                    <i class="mdi mdi-lock"></i>
                    Pilih Periode Terlebih Dahulu
                </button>
            @endif
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table id="tablePenilaian" class="table table-bordered table-striped align-middle">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Periode</th>
                            <th>Kode Material</th>
                            <th>Nama Material</th>

                            @foreach ($kriteria as $item)
                                <th>{{ $item->nama_kriteria }}</th>
                            @endforeach

                            <th width="120">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($penilaian as $item)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    {{ $item->periode->nama_periode }}
                                </td>

                                <td>
                                    {{ $item->material->kode_material }}
                                </td>

                                <td>
                                    {{ $item->material->nama_material }}
                                </td>

                                @foreach ($kriteria as $krit)
                                    @php
                                        $detail = $item->detailPenilaians->where('kriteria_id', $krit->id)->first();
                                    @endphp

                                    <td>
                                        {{ $detail->nilai ?? '-' }}
                                    </td>
                                @endforeach

                                <td>

                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEditPenilaian{{ $item->id }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalHapusPenilaian{{ $item->id }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>

                                </td>

                            </tr>

                            {{--  Modal Edit Penilaian  --}}
                            <div class="modal fade" id="modalEditPenilaian{{ $item->id }}" tabindex="-1">

                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <form action="{{ route('penilaian.update', $item->id) }}" method="POST">

                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="periode_id" value="{{ request('periode_id') }}">

                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Edit Penilaian
                                                </h5>

                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <div class="modal-body">

                                                <div class="row">

                                                    <div class="col-md-12 mb-3">

                                                        <label class="form-label">
                                                            Material
                                                        </label>

                                                        <select name="material_id" class="form-select" required>

                                                            @foreach ($material as $mat)
                                                                <option value="{{ $mat->id }}"
                                                                    {{ $item->material_id == $mat->id ? 'selected' : '' }}>

                                                                    {{ $mat->kode_material }}
                                                                    -
                                                                    {{ $mat->nama_material }}

                                                                </option>
                                                            @endforeach

                                                        </select>

                                                    </div>

                                                    @foreach ($kriteria as $krit)
                                                        @php
                                                            $detail = $item->detailPenilaians
                                                                ->where('kriteria_id', $krit->id)
                                                                ->first();
                                                        @endphp

                                                        <div class="col-md-6 mb-3">

                                                            <label class="form-label">
                                                                {{ $krit->nama_kriteria }}
                                                            </label>

                                                            <select name="nilai[{{ $krit->id }}]" class="form-select"
                                                                required>

                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <option value="{{ $i }}"
                                                                        {{ ($detail->nilai ?? 0) == $i ? 'selected' : '' }}>

                                                                        {{ $i }}

                                                                    </option>
                                                                @endfor

                                                            </select>

                                                        </div>
                                                    @endforeach

                                                </div>

                                            </div>

                                            <div class="modal-footer">

                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>

                                                <button type="submit" class="btn btn-warning">
                                                    Update
                                                </button>

                                            </div>

                                        </form>

                                    </div>
                                </div>
                            </div>

                            {{--  Modal Hapus Penilaian  --}}
                            <div class="modal fade" id="modalHapusPenilaian{{ $item->id }}" tabindex="-1">

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content">

                                        <form action="{{ route('penilaian.destroy', $item->id) }}" method="POST">

                                            @csrf
                                            @method('DELETE')

                                            <div class="modal-header bg-danger text-white">

                                                <h5 class="modal-title">
                                                    Konfirmasi Hapus
                                                </h5>

                                                <button type="button" class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>

                                            </div>

                                            <div class="modal-body text-center">

                                                <i class="mdi mdi-alert-circle text-danger" style="font-size:70px"></i>

                                                <h5 class="mt-3">
                                                    Hapus Data Penilaian?
                                                </h5>

                                                <p>

                                                    Material

                                                    <b>
                                                        {{ $item->material->nama_material }}
                                                    </b>

                                                    akan dihapus beserta seluruh nilai kriterianya.

                                                </p>

                                            </div>

                                            <div class="modal-footer justify-content-center">

                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    Batal
                                                </button>

                                                <button type="submit" class="btn btn-danger">
                                                    Ya, Hapus
                                                </button>

                                            </div>

                                        </form>

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="modalTambahPenilaian">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <form action="{{ route('penilaian.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">
                            Input Penilaian Material
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="row">

                            <input type="hidden" name="periode_id" value="{{ request('periode_id') }}">

                            <div class="col-md-6 mb-3">

                                <label class="form-label">
                                    Material
                                </label>

                                <select name="material_id" class="form-select" required>

                                    <option value="">
                                        Pilih Material
                                    </option>

                                    @foreach ($material as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->kode_material }}
                                            -
                                            {{ $item->nama_material }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            @foreach ($kriteria as $item)
                                <div class="col-md-6 mb-3">

                                    <label class="form-label">
                                        {{ $item->nama_kriteria }}
                                    </label>

                                    <select name="nilai[{{ $item->id }}]" class="form-select" required>

                                        <option value="">
                                            Pilih Nilai
                                        </option>

                                        @for ($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">
                                                {{ $i }}
                                            </option>
                                        @endfor

                                    </select>

                                </div>
                            @endforeach

                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>

                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {

            $('#tablePenilaian').DataTable({
                responsive: true,
                pageLength: 10,
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
