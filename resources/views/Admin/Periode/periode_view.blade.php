@extends('Layouts.template-admin')

@section('title', 'Data Periode')

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
            <h5 class="mb-0">Data Periode</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahPeriode">
                <i class="mdi mdi-plus"></i>
                Tambah Periode
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tablePeriode" class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Nama Periode</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status Penilaian</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($periode as $get)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $get->nama_periode }}</td>
                                <td>{{ $get->tanggal_mulai }}</td>
                                <td>{{ $get->tanggal_selesai }}</td>

                                <td>
                                    @if ($get->penilaians_count > 0)
                                        <span class="badge bg-success">
                                            Sudah Dinilai
                                        </span>
                                    @else
                                        <span class="badge bg-warning">
                                            Belum Dinilai
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEditPeriode{{ $get->id }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalHapusPeriode{{ $get->id }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>

                            {{-- MODAL EDIT PERIODE  --}}
                            <div class="modal fade" id="modalEditPeriode{{ $get->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Periode</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('periode.update', $get->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Periode</label>
                                                    <input name="nama_periode" type="text" class="form-control"
                                                        value="{{ $get->nama_periode }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Mulai</label>
                                                    <input name="tanggal_mulai" type="date" class="form-control"
                                                        value="{{ $get->tanggal_mulai }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Selesai</label>
                                                    <input name="tanggal_selesai" type="date" class="form-control"
                                                        value="{{ $get->tanggal_selesai }}">
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Status (Otomatis)</label>
                                                    <select name="status" class="form-select">
                                                        <option value="aktif"
                                                            {{ $get->tanggal_selesai >= date('Y-m-d') ? 'selected' : '' }}>
                                                            Aktif</option>
                                                        <option value="selesai"
                                                            {{ $get->tanggal_selesai < date('Y-m-d') ? 'selected' : '' }}>
                                                            Selesai</option>
                                                    </select>
                                                    <small class="text-muted">Status akan mengikuti tanggal selesai secara
                                                        otomatis, namun bisa diubah manual.</small>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-warning">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- MODAL HAPUS PERIODE --}}
                            <div class="modal fade" id="modalHapusPeriode{{ $get->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="{{ route('periode.destroy', $get->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body text-center">
                                                <i class="mdi mdi-alert-circle text-danger" style="font-size:70px"></i>
                                                <h5 class="mt-3">Hapus Data Periode?</h5>
                                                <p class="text-muted mb-0">Data <b>{{ $get->nama_periode }}</b> yang sudah
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

    {{-- MODAL TAMBAH PERIODE  --}}
    <div class="modal fade" id="modalTambahPeriode" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Periode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                {{-- Pastikan Route di bawah ini sesuai dengan nama route Anda --}}
                <form action="{{ route('periode.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Periode</label>
                            <input name="nama_periode" type="text" class="form-control"
                                placeholder="Contoh : Tahun 2023" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input name="tanggal_mulai" type="date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input name="tanggal_selesai" type="date" class="form-control" required>
                        </div>

                        {{-- Untuk Status pada Tambah Data, set otomatis Aktif secara default --}}
                        <input type="hidden" name="status" value="aktif">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script>
        $(document).ready(function() {

            $('#tablePeriode').DataTable({
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
