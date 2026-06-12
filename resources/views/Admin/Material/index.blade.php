@extends('Layouts.template-admin')

@section('title', 'Data Material')

@section('breadcrumb')
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-primary">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Material</li>
        </ol>
    </div>
@endsection

@section('content')

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
                            <th>Kategori</th>
                            <th>Status</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>MTR-001</td>
                            <td>Stainless Steel 304</td>
                            <td>Logam</td>
                            <td>
                                <span class="badge bg-success">
                                    Aktif
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalEditMaterial">
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalHapusMaterial">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>MTR-002</td>
                            <td>Aluminium Alloy</td>
                            <td>Logam</td>
                            <td>
                                <span class="badge bg-success">
                                    Aktif
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm">
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>3</td>
                            <td>MTR-003</td>
                            <td>Carbon Steel</td>
                            <td>Logam</td>
                            <td>
                                <span class="badge bg-success">
                                    Aktif
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm">
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>4</td>
                            <td>MTR-004</td>
                            <td>Titanium Grade 2</td>
                            <td>Logam</td>
                            <td>
                                <span class="badge bg-secondary">
                                    Nonaktif
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm">
                                    <i class="mdi mdi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>5</td>
                            <td>MTR-005</td>
                            <td>Copper C110</td>
                            <td>Logam</td>
                            <td>
                                <span class="badge bg-success">
                                    Aktif
                                </span>
                            </td>
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

    {{-- Modal Tambah Material --}}
    <div class="modal fade" id="modalTambahMaterial" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Tambah Material
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Material</label>
                                <input type="text" class="form-control" placeholder="MTR-001">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Material</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <select class="form-select">
                                    <option>Logam</option>
                                    <option>Polimer</option>
                                    <option>Keramik</option>
                                    <option>Komposit</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select">
                                    <option>Aktif</option>
                                    <option>Nonaktif</option>
                                </select>
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

    {{--  Edit Material Modal  --}}
    <div class="modal fade" id="modalEditMaterial" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        Edit Material
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form>
                    <div class="modal-body">

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Material</label>
                                <input type="text" class="form-control" value="MTR-001">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Material</label>
                                <input type="text" class="form-control" value="Stainless Steel 304">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <select class="form-select">
                                    <option selected>Logam</option>
                                    <option>Polimer</option>
                                    <option>Keramik</option>
                                    <option>Komposit</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select">
                                    <option selected>Aktif</option>
                                    <option>Nonaktif</option>
                                </select>
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

    {{--  Hapus Material Modal  --}}
    <div class="modal fade" id="modalHapusMaterial" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title text-danger">
                        Hapus Material
                    </h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    <div class="text-center">

                        <i class="mdi mdi-delete-alert-outline text-danger" style="font-size:70px"></i>

                        <h5 class="mt-3">
                            Yakin ingin menghapus material ini?
                        </h5>

                        <p class="text-muted mb-0">
                            Data yang dihapus tidak dapat dikembalikan.
                        </p>

                    </div>

                </div>

                <div class="modal-footer">
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

            $('#tableMaterial').DataTable({
                responsive: true,
                pageLength: 10,
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ data",
                    info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                    paginate: {
                        previous: "Sebelumnya",
                        next: "Berikutnya"
                    }
                }
            });

        });
    </script>

@endsection
