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

    <div class="card">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                Data Penilaian Material
            </h5>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPenilaian">

                <i class="mdi mdi-plus"></i>
                Input Nilai
            </button>
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table id="tablePenilaian" class="table table-bordered table-striped align-middle">

                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kode Material</th>
                            <th>Nama Material</th>
                            <th>Harga</th>
                            <th>Kekuatan</th>
                            <th>Ketahanan Korosi</th>
                            <th>Berat</th>
                            <th>Ketersediaan</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>MTR-001</td>
                            <td>Stainless Steel 304</td>
                            <td>4</td>
                            <td>5</td>
                            <td>5</td>
                            <td>3</td>
                            <td>4</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditPenilaian">
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalHapusPenilaian">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>MTR-002</td>
                            <td>Aluminium Alloy</td>
                            <td>5</td>
                            <td>4</td>
                            <td>3</td>
                            <td>5</td>
                            <td>5</td>
                            <td>
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

    {{-- Modal Tambah --}}
    <div class="modal fade" id="modalTambahPenilaian">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Input Penilaian Material
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                Material
                            </label>

                            <select class="form-select">
                                <option>Stainless Steel 304</option>
                                <option>Aluminium Alloy</option>
                                <option>Carbon Steel</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Harga</label>
                            <select class="form-select">
                                <option>Sangat Murah (5)</option>
                                <option>Murah (4)</option>
                                <option>Sedang (3)</option>
                                <option>Mahal (2)</option>
                                <option>Sangat Mahal (1)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Kekuatan Material
                            </label>
                            <select class="form-select">
                                <option>Sangat Kuat (5)</option>
                                <option>Kuat (4)</option>
                                <option>Sedang (3)</option>
                                <option>Lemah (2)</option>
                                <option>Sangat Lemah (1)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Ketahanan Korosi
                            </label>
                            <select class="form-select">
                                <option>Sangat Tinggi (5)</option>
                                <option>Tinggi (4)</option>
                                <option>Sedang (3)</option>
                                <option>Rendah (2)</option>
                                <option>Sangat Rendah (1)</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                Berat Material
                            </label>
                            <select class="form-select">
                                <option>Sangat Ringan (5)</option>
                                <option>Ringan (4)</option>
                                <option>Sedang (3)</option>
                                <option>Berat (2)</option>
                                <option>Sangat Berat (1)</option>
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label">
                                Ketersediaan
                            </label>
                            <select class="form-select">
                                <option>Sangat Banyak (5)</option>
                                <option>Banyak (4)</option>
                                <option>Sedang (3)</option>
                                <option>Sedikit (2)</option>
                                <option>Sangat Sedikit (1)</option>
                            </select>
                        </div>

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
    <div class="modal fade" id="modalEditPenilaian">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Edit Penilaian
                    </h5>
                </div>

                <div class="modal-body">
                    Data form edit di sini.
                </div>

            </div>
        </div>
    </div>

    {{-- Modal Hapus --}}
    <div class="modal fade" id="modalHapusPenilaian">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Hapus Penilaian
                    </h5>
                </div>

                <div class="modal-body">
                    Apakah yakin ingin menghapus data ini?
                </div>

                <div class="modal-footer">
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

