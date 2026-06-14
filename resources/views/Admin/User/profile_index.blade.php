@extends('Layouts.template-admin')

@section('title', 'Profile')

@section('breadcrumb')
    <div class="text-end">
        <ol class="breadcrumb m-0 py-0">
            <li class="breadcrumb-item">
                <a href="{{ route('dashboard.index') }}" class="text-primary text-decoration-none">Dashboard</a>
            </li>
            <li class="breadcrumb-item active text-muted">Profile</li>
        </ol>
    </div>
@endsection

@section('content')
    <style>
        /* --- HEADER & AVATAR STYLE --- */
        .profile-header-container {
            position: relative;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            overflow: hidden;
            /* Mencegah gambar tumpah di sudut */
        }

        .profile-cover-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .profile-avatar-wrapper {
            position: absolute;
            bottom: 10px;
            left: 40px;
        }

        .profile-avatar-img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            border: 6px solid #fff;
            object-fit: cover;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
            background-color: #fff;
            transition: transform 0.3s ease;
        }

        .profile-avatar-img:hover {
            transform: scale(1.05);
        }

        .profile-info-section {
            padding: 20px 20px 25px 200px;
            /* Jarak kiri ekstra untuk avatar */
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
        }

        /* --- SIDEBAR MENU STYLE --- */
        .settings-sidebar .nav-link {
            color: #6c757d;
            text-align: left;
            padding: 12px 20px;
            border-radius: 10px;
            margin-bottom: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .settings-sidebar .nav-link:hover {
            background-color: #f8f9fa;
            color: #1a42a1;
        }

        .settings-sidebar .nav-link.active {
            background-color: #1a42a1;
            color: #fff;
            box-shadow: 0 4px 10px rgba(26, 66, 161, 0.2);
        }

        .custom-card {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .custom-input {
            border-radius: 8px;
            padding: 10px 15px;
            border: 1px solid #dee2e6;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .custom-input:focus {
            border-color: #1a42a1;
            box-shadow: 0 0 0 0.25rem rgba(26, 66, 161, 0.1);
        }

        .btn-modern {
            border-radius: 8px;
            padding: 10px 24px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        @media (max-width: 768px) {
            .profile-avatar-wrapper {
                left: 50%;
                transform: translateX(-50%);
                bottom: 10px;
            }

            .profile-info-section {
                padding: 70px 15px 20px 15px;
                text-align: center;
                flex-direction: column;
            }

            .settings-sidebar {
                margin-bottom: 20px;
            }
        }
    </style>

    {{-- AREA NOTIFIKASI ALERT --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" id="alertSuccess"
            role="alert">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
                stroke-linecap="round" stroke-linejoin="round" class="me-2 text-success">
                <polyline points="9 11 12 14 22 4"></polyline>
                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
            </svg>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            setTimeout(function() {
                let alertElement = document.getElementById('alertSuccess');
                if (alertElement) {
                    new bootstrap.Alert(alertElement).close();
                }
            }, 3000);
        </script>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-3" id="alertError"
            role="alert">
            <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none"
                stroke-linecap="round" stroke-linejoin="round" class="me-2 text-danger">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
            </svg>
            <strong>Gagal!</strong> Periksa kembali inputan Anda:
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <script>
            setTimeout(function() {
                let alertElement = document.getElementById('alertError');
                if (alertElement) {
                    new bootstrap.Alert(alertElement).close();
                }
            }, 5000);
        </script>
    @endif

    <div class="container-fluid px-0 mt-3">

        {{-- AREA HEADER PROFILE --}}
        <div class="profile-header-container">
            <img src="https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-1.2.1&auto=format&fit=crop&w=1000&q=80"
                alt="Background" class="profile-cover-img">

            <div class="profile-avatar-wrapper">

                <img src="{{ Auth::user()->foto_profile ? asset('storage/' . Auth::user()->foto_profile) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->nama) . '&background=1a42a1&color=fff' }}"
                    alt="Foto Profil" class="profile-avatar-img">
            </div>

            <div class="profile-info-section">
                <div>
                    <h3 class="mb-1 fw-bold" style="color: #2b3445;">{{ Auth::user()->nama }}</h3>
                    <p class="mb-0 text-muted d-flex align-items-center justify-content-center justify-content-md-start">
                        <i class="mdi mdi--outline me-1"></i> {{ Auth::user()->role }}
                    </p>
                </div>
            </div>
        </div>

        {{-- AREA KONTEN SETTING --}}
        <div class="card custom-card border-0">
            <div class="card-body p-4 p-md-5">
                <h5 class="fw-bold mb-4" style="color: #2b3445;">Pengaturan Akun</h5>

                <div class="row">
                    <div class="col-md-3 settings-sidebar">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist">
                            <button class="nav-link active d-flex align-items-center" id="v-pills-profil-tab"
                                data-bs-toggle="pill" data-bs-target="#v-pills-profil" type="button" role="tab">
                                <i class="mdi mdi-account-outline fs-5 me-2"></i> Profil Info
                            </button>
                            <button class="nav-link d-flex align-items-center" id="v-pills-password-tab"
                                data-bs-toggle="pill" data-bs-target="#v-pills-password" type="button" role="tab">
                                <i class="mdi mdi-lock-outline fs-5 me-2"></i> Keamanan
                            </button>
                        </div>
                    </div>

                    <div class="col-md-9 ps-md-5">
                        <div class="tab-content" id="v-pills-tabContent">

                            <div class="tab-pane fade show active" id="v-pills-profil" role="tabpanel">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-12 mb-2">
                                            <label class="form-label text-secondary fw-semibold">Ubah Foto Profil</label>
                                            <input type="file" name="foto_profile" class="form-control custom-input"
                                                accept="image/jpeg,image/png,image/jpg">
                                            <small class="text-muted mt-1 d-block"><i
                                                    class="mdi mdi-information-outline"></i> Format yang diizinkan: JPG,
                                                PNG. Ukuran maksimal: 2MB.</small>
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label text-secondary fw-semibold">Nama Lengkap</label>
                                            <input type="text" name="nama" class="form-control custom-input"
                                                value="{{ Auth::user()->nama }}" placeholder="Masukkan nama lengkap Anda"
                                                required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label text-secondary fw-semibold">Username</label>
                                            <input type="text" name="username" class="form-control custom-input"
                                                value="{{ Auth::user()->username }}" placeholder="Contoh: user123"
                                                required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label text-secondary fw-semibold">Alamat Email</label>
                                            <input type="email" name="email"
                                                class="form-control custom-input bg-light"
                                                value="{{ Auth::user()->email }}" required>
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-2 border-top">
                                        <button type="submit" class="btn btn-primary btn-modern shadow-sm"
                                            style="background-color: #1a42a1; border: none;">
                                            <i class="mdi mdi-content-save-outline me-1"></i> Simpan Perubahan
                                        </button>
                                    </div>
                                </form>
                            </div>

                            {{-- TAB 2: FORM GANTI PASSWORD --}}
                            <div class="tab-pane fade" id="v-pills-password" role="tabpanel">
                                <form action="{{ route('profile.password') }}" method="POST">
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-9">
                                            <label class="form-label text-secondary fw-semibold">Password Saat Ini</label>
                                            <input type="password" name="old_password" class="form-control custom-input"
                                                placeholder="Masukkan password lama Anda" required>
                                        </div>

                                        <div class="col-md-9">
                                            <label class="form-label text-secondary fw-semibold">Password Baru</label>
                                            <input type="password" name="new_password" class="form-control custom-input"
                                                placeholder="Minimal 8 karakter" required>
                                        </div>

                                        <div class="col-md-9">
                                            <label class="form-label text-secondary fw-semibold">Konfirmasi Password
                                                Baru</label>
                                            <input type="password" name="new_password_confirmation"
                                                class="form-control custom-input" placeholder="Ulangi password baru Anda"
                                                required>
                                        </div>
                                    </div>
                                    <div class="mt-4 pt-2 border-top">
                                        <button type="submit" class="btn btn-warning btn-modern shadow-sm text-dark">
                                            <i class="mdi mdi-shield-check-outline me-1"></i> Perbarui Password
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
