@extends('Layouts.template-admin')

@section('title', 'Data Material')

@section('breadcrumb')
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-primary">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">@yield('title')</li>
        </ol>
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" id="alertSuccess" role="alert">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
                stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
            <strong>Success!</strong>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <script>
            setTimeout(function() {
                let alertElement = document.getElementById('alertSuccess');
                if (alertElement) {
                    let bsAlert = new bootstrap.Alert(alertElement);
                    bsAlert.close();
                }
            }, 2000);
        </script>
    @endif
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Material</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahMaterial">
                <i class="mdi mdi-plus"></i>
                Tambah Material
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tableMaterial" class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Kode Material</th>
                            <th>Nama Material</th>
                            <th>Status</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($material as $get)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $get->kode_material }}</td>
                                <td>{{ $get->nama_material }}</td>

                                <td>
                                    @if (strtolower($get->status) == 'aktif')
                                        <span class="badge bg-success">Aktif</span>
                                    @else
                                        <span class="badge bg-secondary">Nonaktif</span>
                                    @endif
                                </td>

                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modaldetailMaterial{{ $get->id }}" title="Lihat Detail">

                                        <i class="mdi mdi-eye"></i>
                                    </button>

                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEditMaterial{{ $get->id }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalHapusMaterial{{ $get->id }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>

                            {{-- MODAL EDIT Material  --}}
                            <div class="modal fade" id="modalEditMaterial{{ $get->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Material</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('material.update', $get->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">

                                                <div class="row g-3">

                                                    <div class="col-md-12">
                                                        <label class="form-label">Kode Material</label>
                                                        <input type="text" class="form-control"
                                                            value="{{ $get->kode_material }}" readonly>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Nama Material</label>
                                                        <input type="text" class="form-control" name="nama_material"
                                                            value="{{ $get->nama_material }}">
                                                    </div>

                                                    <div class="col-md-12">
                                                        <label class="form-label">Status</label>
                                                        <select class="form-select" name="status">
                                                            <option value="aktif"
                                                                {{ strtolower($get->status) == 'aktif' ? 'selected' : '' }}>
                                                                Aktif</option>
                                                            <option value="nonaktif"
                                                                {{ strtolower($get->status) == 'nonaktif' ? 'selected' : '' }}>
                                                                Nonaktif</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-12 mb-3">
                                                        <label class="form-label">Deskripsi</label>
                                                        <textarea name="deskripsi" class="form-control" rows="4">{{ $get->deskripsi }}</textarea>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">
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

                            {{-- MODAL Detail Material --}}
                            <div class="modal fade" id="modaldetailMaterial{{ $get->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-info text-white">
                                            <h5 class="modal-title">
                                                <i class="mdi mdi-information-outline me-1"></i> Detail Material
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">

                                                <div class="col-md-12">
                                                    <label class="form-label fw-bold">Kode Material</label>
                                                    <input type="text" class="form-control bg-light"
                                                        value="{{ $get->kode_material }}" readonly>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label fw-bold">Nama Material</label>
                                                    <input type="text" class="form-control bg-light"
                                                        value="{{ $get->nama_material }}" readonly>
                                                </div>

                                                <div class="col-md-12">
                                                    <label class="form-label fw-bold">Status</label>
                                                    <input type="text" class="form-control bg-light text-capitalize"
                                                        value="{{ $get->status }}" readonly>
                                                </div>

                                                <div class="col-md-12 mb-2">
                                                    <label class="form-label fw-bold">Deskripsi</label>
                                                    <textarea class="form-control bg-light" rows="4" readonly>{{ $get->deskripsi }}</textarea>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Tutup
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- MODAL HAPUS Material --}}
                            <div class="modal fade" id="modalHapusMaterial{{ $get->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="{{ route('material.destroy', $get->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body text-center">
                                                <i class="mdi mdi-alert-circle text-danger" style="font-size:70px"></i>
                                                <h5 class="mt-3">Hapus Data Material?</h5>
                                                <p class="text-muted mb-0">Data <b>{{ $get->nama_material }}</b> yang
                                                    sudah
                                                    dihapus tidak dapat dikembalikan.</p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
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

    {{-- MODAL TAMBAH Material  --}}
    <div class="modal fade" id="modalTambahMaterial" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Material</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                {{-- Pastikan Route di bawah ini sesuai dengan nama route Anda --}}
                <form action="{{ route('material.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="alert alert-info">
                                Kode Material akan dibuat otomatis oleh sistem.
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Nama Material</label>
                                <input name="nama_material" type="text" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select" required>
                                    <option>Aktif</option>
                                    <option>Nonaktif</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control" rows="4"></textarea>
                            </div>


                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">
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

            $('#tableMaterial').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                language: {
                    search: "Cari :",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    infoEmpty: "Data tidak tersedia",
                    zeroRecords: "Data tidak ditemukan",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    }
                }
            });

        });
    </script>
@endsection
