@extends('Layouts.template-admin')

@section('title', 'Kriteria')

@section('breadcrumb')
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-primary">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Kriteria</li>
        </ol>
    </div>
@endsection

@section('content')

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data Kriteria</h5>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahKriteria">
                <i class="mdi mdi-plus"></i>
                Tambah Kriteria
            </button>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table id="tableKriteria" class="table table-bordered table-striped align-middle">

                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Kode</th>
                            <th>Nama Kriteria</th>
                            <th>Bobot</th>
                            <th>Tipe</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>C1</td>
                            <td>Harga</td>
                            <td>35%</td>
                            <td>
                                <span class="badge bg-danger">Cost</span>
                            </td>
                            <td>
                                <a href="{{ route('sub-kriteria.index') }}" class="btn btn-info btn-sm"
                                    title="Sub Kriteria">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </a>

                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditKriteria">
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalHapusKriteria">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>C2</td>
                            <td>Kekuatan Material</td>
                            <td>25%</td>
                            <td>
                                <span class="badge bg-success">Benefit</span>
                            </td>
                            <td>
                                <a href="{{ route('sub-kriteria.index') }}" class="btn btn-info btn-sm"
                                    title="Sub Kriteria">
                                    <i class="mdi mdi-format-list-bulleted"></i>
                                </a>

                                <button class="btn btn-warning btn-sm">
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{--  Tambah Kriteria Modal  --}}
    <div class="modal fade" id="modalTambahKriteria" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Kode Kriteria</label>
                        <input type="text" class="form-control" placeholder="Contoh : C1">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Kriteria</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama kriteria">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bobot (%)</label>
                        <input type="number" class="form-control" placeholder="0 - 100">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipe</label>
                        <select class="form-select">
                            <option>Benefit</option>
                            <option>Cost</option>
                        </select>
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

    {{--  Edit Kriteria Modal  --}}
    <div class="modal fade" id="modalEditKriteria" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edit Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label">Kode Kriteria</label>
                        <input type="text" class="form-control" value="C1">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Kriteria</label>
                        <input type="text" class="form-control" value="Harga">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Bobot (%)</label>
                        <input type="number" class="form-control" value="35">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tipe</label>
                        <select class="form-select">
                            <option selected>Cost</option>
                            <option>Benefit</option>
                        </select>
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

    {{--  Hapus Kriteria Modal  --}}
    <div class="modal fade" id="modalHapusKriteria" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body text-center">

                    <i class="mdi mdi-alert-circle text-danger" style="font-size:70px"></i>

                    <h5 class="mt-3">
                        Hapus Data Kriteria?
                    </h5>

                    <p class="text-muted mb-0">
                        Data yang sudah dihapus tidak dapat dikembalikan.
                    </p>

                </div>

                <div class="modal-footer justify-content-center">

                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button class="btn btn-danger">
                        Ya, Hapus
                    </button>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {

            $('#tableKriteria').DataTable({
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
