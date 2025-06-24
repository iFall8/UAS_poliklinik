<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Poliklinik | Dashboard</title>

        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">

            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </nav>
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <a href="#" class="brand-link">
                    <span class="brand-text font-weight-light">Poliklinik BK</span>
                </a>

                <div class="sidebar">
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="info">
                            @php
                                // Cek guard mana yang aktif dan ambil nama dari kolom yang benar
                                $namaPengguna = '';
                                if (Auth::guard('web')->check()) {
                                    // Untuk Admin, gunakan kolom 'name'
                                    $namaPengguna = Auth::guard('web')->user()->name;
                                } elseif (Auth::guard('dokter')->check()) {
                                    // Untuk Dokter, gunakan kolom 'nama'
                                    $namaPengguna = Auth::guard('dokter')->user()->nama;
                                } elseif (Auth::guard('pasien')->check()) {
                                    // Untuk Pasien, gunakan kolom 'nama'
                                    $namaPengguna = Auth::guard('pasien')->user()->nama;
                                }
                            @endphp
                            <a href="#" class="d-block">{{ $namaPengguna ?? 'Pengguna Tidak Dikenal' }}</a>
                        </div>
                    </div>

                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            @if(Auth::guard('web')->check())
                                <li class="nav-item">
                                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.poli.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-hospital"></i>
                                        <p>Poli</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.dokter.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-user-md"></i>
                                        <p>Dokter</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.obat.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-pills"></i>
                                        <p>Obat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.pasien.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-users"></i>
                                        <p>Pasien</p>
                                    </a>
                                </li>
                            @elseif(Auth::guard('dokter')->check())
                                <li class="nav-item">
                                    <a href="{{ route('dokter.dashboard') }}" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dokter.jadwal.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-calendar-alt"></i><p>Jadwal Periksa</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dokter.periksa.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-stethoscope"></i><p>Periksa Pasien</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dokter.riwayat.pasien') }}" class="nav-link">
                                        <i class="nav-icon fas fa-book-medical"></i><p>Riwayat Pasien</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('dokter.profil.edit') }}" class="nav-link">
                                        <i class="nav-icon fas fa-user-edit"></i><p>Profil Saya</p>
                                    </a>
                                </li>
                            @elseif(Auth::guard('pasien')->check())
                                <li class="nav-item">
                                    <a href="{{ route('pasien.dashboard') }}" class="nav-link">
                                        <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pasien.poli.index') }}" class="nav-link">
                                        <i class="nav-icon fas fa-hospital-user"></i><p>Daftar Poli</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('pasien.riwayat') }}" class="nav-link">
                                        <i class="nav-icon fas fa-history"></i><p>Riwayat Pendaftaran</p>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            </aside>

            <div class="content-wrapper">
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </section>
                </div>
            <footer class="main-footer">
                <strong>Copyright &copy; 2025 <a href="#">Poliklinik BK</a>.</strong> All rights reserved.
            </footer>

        </div>
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.full.min.js"></script>

    @stack('scripts')
    </body>
</html>