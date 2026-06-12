@extends('Layouts.template-admin')

@section('title', 'Data Sub Kriteria')

@section('breadcrumb')
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-primary">
                    Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('kriteria.index') }}" class="text-primary">
                    Kriteria
                </a>
            </li>
            <li class="breadcrumb-item active">
                Data Sub Kriteria
            </li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">

            <div>
                <h5 class="mb-0">Data Sub Kriteria</h5>
                <small class="text-muted">
                    Kriteria : Harga (C1)
                </small>
            </div>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahSubKriteria">

                <i class="mdi mdi-plus"></i>
                Tambah Sub Kriteria
            </button>

        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table id="tableSubKriteria" class="table table-bordered table-striped align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Kriteria</th>
                            <th>Nama Sub Kriteria</th>
                            <th width="120">Nilai</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>Harga</td>
                            <td>Sangat Murah</td>
                            <td>5</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditSubKriteria">
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalHapusSubKriteria">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Harga</td>
                            <td>Murah</td>
                            <td>4</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditSubKriteria">
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalHapusSubKriteria">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>Harga</td>
                            <td>Sedang</td>
                            <td>3</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditSubKriteria">
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalHapusSubKriteria">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>Harga</td>
                            <td>Mahal</td>
                            <td>2</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditSubKriteria">
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalHapusSubKriteria">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>Harga</td>
                            <td>Sangat Mahal</td>
                            <td>1</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditSubKriteria">
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalHapusSubKriteria">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{-- Modal Tambah --}}
    <div class="modal fade" id="modalTambahSubKriteria">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Tambah Sub Kriteria</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">
                            Nama Sub Kriteria
                        </label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Nilai
                        </label>
                        <input type="number" class="form-control">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-primary">
                        Simpan
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modalEditSubKriteria">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Edit Sub Kriteria</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">
                            Nama Sub Kriteria
                        </label>
                        <input type="text" class="form-control" value="Murah">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Nilai
                        </label>
                        <input type="number" class="form-control" value="4">
                    </div>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-warning">
                        Update
                    </button>
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal fade" id="modalHapusSubKriteria">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5>Konfirmasi Hapus</h5>
                </div>

                <div class="modal-body text-center">

                    <i class="mdi mdi-delete-alert text-danger" style="font-size:70px"></i>

                    <h5>Hapus Sub Kriteria?</h5>

                    <p class="text-muted">
                        Data yang dihapus tidak dapat dikembalikan.
                    </p>

                </div>

                <div class="modal-footer justify-content-center">

                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-danger">
                        Hapus
                    </button>

                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {

            $('#tableSubKriteria').DataTable({
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
