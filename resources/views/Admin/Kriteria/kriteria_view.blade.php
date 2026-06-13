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
                        @foreach ($kriteria as $get)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $get->kode }}</td>
                                <td>{{ $get->nama_kriteria }}</td>
                                <td>{{ (float) $get->bobot }}%</td>
                                <td>
                                    @if (strtolower($get->atribut) == 'benefit')
                                        <span class="badge bg-success">Benefit</span>
                                    @else
                                        <span class="badge bg-primary">Cost</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('sub-kriteria.index', ['kriteria_id' => $get->id]) }}"
                                        class="btn btn-info btn-sm" title="Sub Kriteria">
                                        <i class="mdi mdi-format-list-bulleted"></i>
                                    </a>

                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEditKriteria{{ $get->id }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalHapusKriteria{{ $get->id }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>

                            {{-- Modal Edit Kriteria --}}
                            <div class="modal fade" id="modalEditKriteria{{ $get->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Kriteria</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="{{ route('kriteria.update', $get->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Kode Kriteria</label>
                                                    <input type="text" name="kode" class="form-control"
                                                        value="{{ $get->kode }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Nama Kriteria</label>
                                                    <input type="text" name="nama_kriteria" class="form-control"
                                                        value="{{ $get->nama_kriteria }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Bobot</label>
                                                    <input type="number" step="0.01" name="bobot" class="form-control"
                                                        value="{{ $get->bobot }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Tipe (Atribut)</label>
                                                    <select class="form-select" name="atribut" required>
                                                        <option value="benefit"
                                                            {{ strtolower($get->atribut) == 'benefit' ? 'selected' : '' }}>
                                                            Benefit</option>
                                                        <option value="cost"
                                                            {{ strtolower($get->atribut) == 'cost' ? 'selected' : '' }}>
                                                            Cost</option>
                                                    </select>
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

                            {{-- Modal Hapus Kriteria  --}}
                            <div class="modal fade" id="modalHapusKriteria{{ $get->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="{{ route('kriteria.destroy', $get->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body text-center">
                                                <i class="mdi mdi-alert-circle text-danger" style="font-size:70px"></i>
                                                <h5 class="mt-3">Hapus Data Kriteria?</h5>
                                                <p class="text-muted mb-0">
                                                    Data Kriteria <b>{{ $get->kode }} - {{ $get->nama_kriteria }}</b>
                                                    yang sudah dihapus tidak dapat dikembalikan.
                                                </p>
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

    {{-- Tambah Kriteria Modal  --}}
    <div class="modal fade" id="modalTambahKriteria" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('kriteria.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Kode Kriteria</label>
                            <input type="text" name="kode" class="form-control" placeholder="Contoh : C1"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nama Kriteria</label>
                            <input type="text" name="nama_kriteria" class="form-control"
                                placeholder="Masukkan nama kriteria" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Bobot</label>
                            {{-- Menggunakan step="0.01" agar bisa menerima angka desimal (karena tipe datanya decimal(5,2)) --}}
                            <input type="number" step="0.01" name="bobot" class="form-control"
                                placeholder="Contoh: 35" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tipe (Atribut)</label>
                            <select class="form-select" name="atribut" required>
                                <option value="" selected disabled>Pilih Tipe</option>
                                <option value="benefit">Benefit</option>
                                <option value="cost">Cost</option>
                            </select>
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
