<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ url('assets/images/logo/logo.png') }}" type="image/x-icon">
    <title>{{ $title }} | Admin Ginan Aquatics</title>

    @include('components.styles')
</head>

<body class="bg-body-tertiary admin-page">

    <nav class="navbar navbar-expand-lg bg-dark py-3" data-bs-theme="dark">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center gap-2">
                <img src="{{ url('assets/images/logo/logo.png') }}" style="width: 40px" alt="Ginan Aquatics">
                <p class="mb-0 fw-bold text-uppercase fs-7">Administrator</p>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu"
                aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-2 gap-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin') ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}">
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#"
                            class="nav-link {{ request()->is('admin/kategori*') || request()->is('admin/produk*') ? 'active' : '' }} dropdown-toggle d-flex align-items-center gap-2"
                            role="button" data-bs-toggle="dropdown">
                            Produk
                        </a>
                        <ul class="dropdown-menu bg-white text-dark shadow-sm">
                            <li>
                                <a class="dropdown-item text-dark" href="{{ route('kategori.index') }}">
                                    Kategori
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item text-dark" href="{{ route('produk.index') }}">
                                    Produk
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/transaksi*') ? 'active' : '' }}"
                            href="{{ route('admin.transaksi') }}">
                            Transaksi
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/laporan*') ? 'active' : '' }}"
                            href="{{ route('admin.report') }}">
                            Laporan Penjualan
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/pelanggan*') ? 'active' : '' }}"
                            href="{{ route('admin.customers') }}">
                            Customer
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/user*') ? 'active' : '' }}"
                            href="{{ route('user.index') }}">
                            Admin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/bank*') ? 'active' : '' }}"
                            href="{{ route('bank.index') }}">
                            Bank
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link text-white dropdown-toggle d-flex align-items-center gap-2"
                            role="button" data-bs-toggle="dropdown">
                            Hai, {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu bg-white text-dark shadow-sm">
                            <li>
                                <a class="dropdown-item text-dark" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                                <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    @include('components.scripts')
    @stack('addon-script')
</body>

</html>
