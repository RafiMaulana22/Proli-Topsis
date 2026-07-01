@extends('Layouts.template-admin')

@section('title', 'User Management')

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

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" id="alertError" role="alert">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
                stroke-linecap="round" stroke-linejoin="round" class="me-2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            <strong>Gagal!</strong> Terdapat kesalahan pada input Anda:
            <ul class="mb-0 mt-1">
                {{-- Melakukan perulangan untuk menampilkan semua daftar error --}}
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <script>
            // Mengatur waktu delay 4000 milidetik (4 detik) agar user sempat membaca error
            setTimeout(function() {
                let alertElement = document.getElementById('alertError');
                if (alertElement) {
                    let bsAlert = new bootstrap.Alert(alertElement);
                    bsAlert.close();
                }
            }, 4000);
        </script>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Data User</h5>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
                <i class="mdi mdi-plus"></i>
                Tambah User
            </button>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="tableUser" class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">No</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($user as $get)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $get->nama }}</td>
                                <td>{{ $get->username }}</td>
                                <td>{{ $get->email }}</td>
                                <td>
                                    @if ($get->role == 'super_admin')
                                        <span class="badge bg-danger">Super Admin</span>
                                    @else
                                        <span class="badge bg-primary">Admin</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalEditUser{{ $get->id }}">
                                        <i class="mdi mdi-pencil"></i>
                                    </button>

                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalHapusUser{{ $get->id }}">
                                        <i class="mdi mdi-delete"></i>
                                    </button>
                                </td>
                            </tr>

                            {{-- MODAL EDIT USER --}}
                            <div class="modal fade" id="modalEditUser{{ $get->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit User Management</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <form action="{{ route('user.update', $get->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label class="form-label">Nama</label>
                                                    <input name="nama" type="text" class="form-control"
                                                        value="{{ $get->nama }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Username</label>
                                                    <input name="username" type="text" class="form-control"
                                                        value="{{ $get->username }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input name="email" type="email" class="form-control"
                                                        value="{{ $get->email }}" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <input name="password" type="password" class="form-control"
                                                        placeholder="Kosongkan jika tidak ingin diubah">
                                                    <small class="text-muted">Isi hanya jika ingin mengganti password
                                                        lama.</small>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Role</label>
                                                    <select name="role" class="form-select" required>
                                                        <option value="admin"
                                                            {{ $get->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="super_admin"
                                                            {{ $get->role == 'super_admin' ? 'selected' : '' }}>Super Admin
                                                        </option>
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

                            {{-- MODAL HAPUS USER --}}
                            <div class="modal fade" id="modalHapusUser{{ $get->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal"></button>
                                        </div>

                                        <form action="{{ route('user.destroy', $get->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body text-center">
                                                <i class="mdi mdi-alert-circle text-danger" style="font-size:70px"></i>
                                                <h5 class="mt-3">Hapus Data User?</h5>
                                                <p class="text-muted mb-0">Data <b>{{ $get->nama }}</b> yang sudah
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

    {{-- MODAL TAMBAH USER --}}
    <div class="modal fade" id="modalTambahUser" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah User Management</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input name="nama" type="text" class="form-control" placeholder="Contoh: Budi Santoso"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input name="username" type="text" class="form-control" placeholder="Contoh: budi123"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input name="email" type="email" class="form-control"
                                placeholder="Contoh: budi@gmail.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input name="password" type="password" class="form-control" placeholder="Masukkan password"
                                required>
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
            $('#tableUser').DataTable({
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
