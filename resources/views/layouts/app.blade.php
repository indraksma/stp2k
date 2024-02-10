<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />

    <link rel="icon" type="image" href="{{ asset('favicon.png') }}">

    <!-- Title -->
    <title>@yield('title', 'SIPOIN SMKN 1 Bawang') | {{ config('app.name', 'SIPOIN SMKN 1 Bawang') }}</title>

    <!-- Fontawesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" rel="stylesheet">

    <!-- Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">

    <!-- AdminLTE -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/css/adminlte.min.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.0/dist/cdn.min.js"></script>

    @stack('headscript')

    <!-- Livewire -->
    <livewire:styles />
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="nav-link" data-widget="pushmenu">
                        <i class="fas fa-bars"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    {{-- <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a> --}}
                    <a href="{{ route('logout') }}" class="nav-link">Logout</a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ asset('logo.png') }}" class="brand-image">
                <span class="brand-text">{{ config('app.name', 'SIPOIN') }}</span>
            </a>
            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('profile-user.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <p class="mb-0 text-white">{{ Auth::user()->name }}</p>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Main Menu -->
                        <li class="nav-item">
                            <a href="{{ route('home') }}"
                                class="{{ request()->routeIs(['home']) ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fas fa-warehouse"></i>
                                <p>Home</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('datapelanggaran') }}"
                                class="{{ request()->routeIs('datapelanggaran') ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fas fa-user-times"></i>
                                <p>Data Pelanggaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kodepelanggaran') }}"
                                class="{{ request()->routeIs('kodepelanggaran') ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Kode Pelanggaran</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('siswa') }}"
                                class="{{ request()->routeIs('siswa') ? 'nav-link active' : 'nav-link' }}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Data Siswa</p>
                            </a>
                        </li>
                        @if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('kesiswaan'))
                            <li class="nav-item">
                                <a href="{{ route('penguranganpoin') }}"
                                    class="{{ request()->routeIs('penguranganpoin') ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-minus"></i>
                                    <p>Pengurangan Poin</p>
                                </a>
                            </li>
                        @endif
                        @if (Auth::user()->hasRole('admin'))
                            <li
                                class="{{ request()->routeIs(['users', 'ta', 'jurusan', 'kelas', 'pelanggaran', 'kenaikankelas']) ? 'nav-item has-treeview menu-open' : 'nav-item' }}">
                                <a href="#"
                                    class="{{ request()->routeIs(['users', 'ta', 'jurusan', 'kelas', 'pelanggaran', 'kenaikankelas']) ? 'nav-link active' : 'nav-link' }}">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <p>Setting <i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('users') }}"
                                            class="{{ request()->routeIs('users') ? 'nav-link active' : 'nav-link' }}">
                                            <i class="nav-icon fas fa-users"></i>
                                            <p>Users</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('ta') }}"
                                            class="{{ request()->routeIs('ta') ? 'nav-link active' : 'nav-link' }}">
                                            <i class="nav-icon fas fa-calendar-alt"></i>
                                            <p>Tahun Ajaran</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('jurusan') }}"
                                            class="{{ request()->routeIs('jurusan') ? 'nav-link active' : 'nav-link' }}">
                                            <i class="nav-icon fas fa-school"></i>
                                            <p>Jurusan</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('kelas') }}"
                                            class="{{ request()->routeIs('kelas') ? 'nav-link active' : 'nav-link' }}">
                                            <i class="nav-icon fas fa-house-user"></i>
                                            <p>Kelas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('pelanggaran') }}"
                                            class="{{ request()->routeIs('pelanggaran') ? 'nav-link active' : 'nav-link' }}">
                                            <i class="nav-icon fas fa-book"></i>
                                            <p>Pelanggaran</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('kenaikankelas') }}"
                                            class="{{ request()->routeIs('kenaikankelas') ? 'nav-link active' : 'nav-link' }}">
                                            <i class="nav-icon fas fa-graduation-cap"></i>
                                            <p>Kenaikan Kelas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </aside>
        <main role="main">
            <section class="content-wrapper">
                <div class="content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="mb-2 text-dark">@yield('title')</h1>
                            </div>
                            <div class="col-md-6">
                                @yield('titlebutton')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <aside class="control-sidebar control-sidebar-dark d-none">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </aside>
        <footer class="main-footer">
            <strong>Copyright &copy; 2024. Kesiswaan SMKN 1 Bawang.</strong>
            <div class="float-right d-none d-sm-inline">
                <small>Built with <i class="fas fa-heart text-pink"></i> <a
                        href="https://instagram.com/indrakus_">Indra Kusuma</a></small>
            </div>
        </footer>
    </div>
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <!-- AdminLTE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"></script>

    <!-- Livewire -->
    <livewire:scripts />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
    <!-- Alert -->
    <script src="{{ asset('vendor/livewire-alert/livewire-alert.js') }}"></script>
    <x-livewire-alert::flash />

    @stack('scripts')
</body>

</html>
