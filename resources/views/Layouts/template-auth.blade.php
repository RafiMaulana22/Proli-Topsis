<!DOCTYPE html>
<html lang="en">
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <meta charset="utf-8" />
    @include('Components.title')

    <!-- App css -->
    <link href="{{ asset('') }}assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ asset('') }}assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <script src="{{ asset('') }}assets/js/head.js"></script>

</head>

<body>
    <!-- Begin page -->
    <div class="account-page">
        <div class="container-fluid p-0">
            <div class="row align-items-center g-0 px-3 py-3 vh-100">

                <div class="col-xl-5">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-0 p-0 p-lg-3">
                                        <div class="mb-0 border-0 p-md-4 p-lg-0">
                                            <div class="mb-3 p-0 text-center">
                                                <div class="text-center mb-4">

                                                    <i class="mdi mdi-home-city text-primary"
                                                        style="font-size:60px"></i>

                                                    <h4 class="mt-2 fw-bold">
                                                        PROLI
                                                    </h4>

                                                </div>
                                            </div>

                                            <div class="auth-title-section mb-4 text-center">

                                                <p class="text-muted fs-14 mb-0">
                                                    Sistem Pendukung Keputusan Prioritas
                                                    Pengadaan Material Bangunan Berbasis TOPSIS
                                                </p>
                                            </div>

                                            <div class="pt-0">
                                                @if (session('error'))
                                                    <div class="alert alert-danger">
                                                        {{ session('error') }}
                                                    </div>
                                                @endif
                                                <form action="{{ route('login.authenticate') }}" method="POST"
                                                    class="my-4">
                                                    @csrf
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">Username</label>

                                                        <input type="text"
                                                            class="form-control @error('username') is-invalid @enderror"
                                                            name="username" value="{{ old('username') }}"
                                                            placeholder="Masukkan Username">

                                                        @error('username')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-3">
                                                        <label for="password" class="form-label">Password</label>

                                                        <div class="input-group">
                                                            <input
                                                                class="form-control @error('password') is-invalid @enderror"
                                                                type="password" name="password" id="password"
                                                                placeholder="Masukkan Password">

                                                            <button class="btn btn-light border" type="button"
                                                                id="togglePassword">
                                                                <i class="mdi mdi-eye-outline" id="eyeIcon"></i>
                                                            </button>
                                                        </div>

                                                        @error('password')
                                                            <div class="invalid-feedback d-block">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group mb-0 row">
                                                        <div class="col-12">
                                                            <div class="d-grid">
                                                                <button type="submit"
                                                                    class="btn btn-primary fw-semibold">
                                                                    <i class="mdi mdi-login me-1"></i>
                                                                    Masuk Sistem
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-7 d-none d-xl-inline-block">
                    <div class="account-page-bg rounded-4">
                        <div class="text-center">
                            <div class="auth-image">
                                <img src="{{ asset('') }}assets/images/auth-images.svg" class="mx-auto img-fluid"
                                    alt="images">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- END wrapper -->

    <!-- Vendor -->
    <script src="{{ asset('') }}assets/libs/jquery/jquery.min.js"></script>

    <script src="{{ asset('') }}assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('') }}assets/libs/iconify-icon/iconify-icon.min.js"></script>
    <script src="{{ asset('') }}assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('') }}assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ asset('') }}assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="{{ asset('') }}assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="{{ asset('') }}assets/libs/feather-icons/feather.min.js"></script>

    <!-- App js-->
    <script src="{{ asset('') }}assets/js/app.js"></script>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function() {

            const type = passwordInput.getAttribute('type') === 'password' ?
                'text' :
                'password';

            passwordInput.setAttribute('type', type);

            eyeIcon.classList.toggle('mdi-eye-outline');
            eyeIcon.classList.toggle('mdi-eye-off-outline');

        });
    </script>

</body>

</html>
