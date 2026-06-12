<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <div class="logo-box">

                <a href="{{ route('dashboard.index') }}" class="logo logo-light text-center">

                    <span class="logo-sm">
                        <i class="mdi mdi-home-city text-white fs-3"></i>
                    </span>

                    <span class="logo-lg text-white fw-bold fs-4">
                        PROLI
                    </span>

                </a>

                <a href="{{ route('dashboard.index') }}" class="logo logo-dark text-center">

                    <span class="logo-sm">
                        <i class="mdi mdi-home-city text-primary fs-3"></i>
                    </span>

                    <span class="logo-lg text-dark fw-bold fs-4">
                        PROLI
                    </span>

                </a>

            </div>

            <ul id="side-menu">

                <li class="menu-title">Menu Utama</li>

                <li>
                    <a href="{{ route('dashboard.index') }}" class="tp-link">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:home-2-bold-duotone"></iconify-icon>
                        </span>
                        <span> Dashboard </span>
                    </a>
                </li>

                <li class="menu-title mt-2">Data Master</li>

                <li>
                    <a class='tp-link' href='{{ route('periode.index') }}'>
                        <span class="nav-icon">
                            <iconify-icon icon="solar:calendar-bold-duotone"></iconify-icon>
                        </span>
                        <span> Periode </span>
                    </a>
                </li>

                <li>
                    <a class='tp-link' href='{{ route('material.index') }}'>
                        <span class="nav-icon">
                            <iconify-icon icon="solar:box-bold-duotone"></iconify-icon>
                        </span>
                        <span> Material </span>
                    </a>
                </li>

                <li>
                    <a class='tp-link' href='{{ route('kriteria.index') }}'>
                        <span class="nav-icon">
                            <iconify-icon icon="solar:checklist-bold-duotone"></iconify-icon>
                        </span>
                        <span> Kriteria </span>
                    </a>
                </li>

                <li class="menu-title">Penilaian</li>

                <li>
                    <a href="{{ route('penilaian.index') }}" class="tp-link">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:clipboard-text-bold-duotone"></iconify-icon>
                        </span>
                        <span> Penilaian Material </span>
                    </a>
                </li>

                <li class="menu-title mt-2">Topsis</li>

                <li>
                    <a href="{{ route('topsis.index') }}" class="tp-link">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:calculator-bold-duotone"></iconify-icon>
                        </span>
                        <span> Perhitungan Topsis </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('hasil.index') }}" class="tp-link">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:ranking-bold-duotone"></iconify-icon>
                        </span>
                        <span> Hasil Ranking </span>
                    </a>
                </li>

                <li class="menu-title mt-2">Laporan</li>

                <li>
                    <a href="{{ route('laporan.index') }}" class="tp-link">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:file-text-bold-duotone"></iconify-icon>
                        </span>
                        <span> Laporan </span>
                    </a>
                </li>

                <li class="menu-title mt-2">Pengguna</li>

                <li>
                    <a href="{{ route('user.index') }}" class="tp-link">
                        <span class="nav-icon">
                            <iconify-icon icon="solar:users-group-rounded-bold-duotone"></iconify-icon>
                        </span>
                        <span> Managemen User </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
</div>
