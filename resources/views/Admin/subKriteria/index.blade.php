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
                    {{-- Logika untuk menampilkan filter nama kriteria di header --}}
                    @if (request()->has('kriteria_id'))
                        Kriteria :
                        {{ $kriteria->where('id', request('kriteria_id'))->first()->nama_kriteria ?? 'Tidak Diketahui' }}
                    @else
                        Semua Kriteria
                    @endif
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
                        @foreach ($subkriteria as $get)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                {{-- Memanggil relasi kriteria untuk menampilkan namanya --}}
                                <td>{{ $get->kriteria->nama_kriteria }}</td>
                                <td>{{ $get->nama_sub_kriteria }}</td>
                                <td>{{ $get->nilai }}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEditSubKriteria{{ $get->id }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalHapusSubKriteria{{ $get->id }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>

                            {{-- Modal Edit (Di dalam Foreach) --}}
                            <div class="modal fade" id="modalEditSubKriteria{{ $get->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Sub Kriteria</h5>
                                            <button class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="{{ route('sub-kriteria.update', $get->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label class="form-label">Kriteria Induk</label>
                                                    <select name="kriteria_id" class="form-select" required>
                                                        @foreach ($kriteria as $k)
                                                            <option value="{{ $k->id }}"
                                                                {{ $get->kriteria_id == $k->id ? 'selected' : '' }}>
                                                                {{ $k->nama_kriteria }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Nama Sub Kriteria</label>
                                                    <input type="text" name="nama_sub_kriteria" class="form-control"
                                                        value="{{ $get->nama_sub_kriteria }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Nilai</label>
                                                    <input type="number" name="nilai" class="form-control"
                                                        value="{{ $get->nilai }}" required>
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

                            {{-- Modal Hapus (Di dalam Foreach) --}}
                            <div class="modal fade" id="modalHapusSubKriteria{{ $get->id }}">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="{{ route('sub-kriteria.destroy', $get->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body text-center">
                                                <i class="mdi mdi-delete-alert text-danger" style="font-size:70px"></i>
                                                <h5 class="mt-3">Hapus Sub Kriteria?</h5>
                                                <p class="text-muted">
                                                    Data <b>{{ $get->nama_sub_kriteria }}</b> yang dihapus tidak dapat
                                                    dikembalikan.
                                                </p>
                                            </div>

                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
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

    {{-- Modal Tambah (Di luar Foreach) --}}
    <div class="modal fade" id="modalTambahSubKriteria">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Sub Kriteria</h5>
                    <button class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('sub-kriteria.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Kriteria Induk</label>
                            <select name="kriteria_id" class="form-select" required>
                                <option value="" disabled {{ !request()->has('kriteria_id') ? 'selected' : '' }}>--
                                    Pilih Kriteria --</option>
                                @foreach ($kriteria as $k)
                                    <option value="{{ $k->id }}"
                                        {{ request('kriteria_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kriteria }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Sub Kriteria</label>
                            <input type="text" name="nama_sub_kriteria" class="form-control"
                                placeholder="Contoh: Sangat Murah" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nilai</label>
                            <input type="number" name="nilai" class="form-control" placeholder="Contoh: 5" required>
                        </div>
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
