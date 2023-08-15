<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ url('assets/images/logo/logo.png') }}" type="image/x-icon">
    <title>{{ $title }} - Ginan Marketplace</title>

    @include('components.styles')
</head>

<body class="bg-body-tertiary">
    <nav class="navbar navbar-expand-lg py-3 bg-white">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center gap-2">
                <img src="{{ url('assets/images/logo/logo.png') }}" style="width: 40px" alt="Ginan Aquatic">
                <p class="mb-0 fw-bold text-uppercase fs-7">Ginan Aquatics</p>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-0 me-md-5 gap-3">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('home') }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('produk*') ? 'active' : '' }}" aria-current="page"
                            href="{{ route('home.produk') }}">
                            Produk
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Kategori
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($categories as $category)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('home.kategori.show', $category->slug) }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-center mb-2 gap-3 mb-lg-0">
                    @auth
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                                role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu bg-white text-dark shadow-sm">
                                @if (Auth::user()->roles == 'admin')
                                    <li>
                                        <a class="dropdown-item text-dark" href="{{ route('admin.dashboard') }}">
                                            Dashboard
                                        </a>
                                    </li>
                                @elseif(Auth::user()->roles == 'customer')
                                    <li>
                                        <a class="dropdown-item text-dark" href="{{ route('home.keranjang.index') }}">
                                            Keranjang
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-dark" href="{{ route('home.my-orders') }}">
                                            Pesanan Saya
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a class="dropdown-item text-dark" type="button" data-bs-toggle="modal"
                                        data-bs-target="#changeProfile" href="#">
                                        Profil Saya
                                    </a>
                                </li>
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
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-dark px-4">Daftar</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="py-5 bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('home') }}">
                        <img src="{{ url('assets/images/logo/logo.png') }}" style="width: 140px" alt="">
                    </a>
                </div>
                <div class="col-md-3">
                    <h5 class="text-white mb-3">Featured Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white">Home</a></li>
                        <li><a href="{{ route('home.produk') }}" class="text-white">Produk</a></li>
                        <li><a href="{{ route('home.kategori') }}" class="text-white">Kategori</a></li>
                        <li><a href="{{ route('register') }}" class="text-white">Daftar Baru</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="text-white mb-3">Follow Our Social Media</h5>
                    <div class="d-flex align-items-center gap-2">
                        <a href="https://vm.tiktok.com/ZSLxon3ju/"
                            class="btn btn-sm btn-light d-flex align-items-center justify-content-center"
                            style="width: 34px; height: 34px"><i class="bx bxl-tiktok"></i></a>
                        <a href="https://instagram.com/ginanaquatics?igshid=NjIwNzIyMDk2Mg"
                            class="btn btn-sm btn-light d-flex align-items-center justify-content-center"
                            style="width: 34px; height: 34px"><i class="bx bxl-instagram"></i></a>
                        <a href="https://www.facebook.com/gantangginanjar"
                            class="btn btn-sm btn-light d-flex align-items-center justify-content-center"
                            style="width: 34px; height: 34px"><i class="bx bxl-facebook"></i></a>
                        <a href="https://youtube.com/@GinanAquatic"
                            class="btn btn-sm btn-light d-flex align-items-center justify-content-center"
                            style="width: 34px; height: 34px"><i class="bx bxl-youtube"></i></a>
                        <a href="https://wa.me/6285600071007"
                            class="btn btn-sm btn-light d-flex align-items-center justify-content-center"
                            style="width: 34px; height: 34px"><i class="bx bxl-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <p class="text-center text-light mt-5">Copyright &copy; 2023 Ginan Aquatics</p>
        </div>
    </footer>

    @auth
        <div class="modal fade" id="changeProfile" tabindex="-1" aria-labelledby="changeProfileLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="changeProfileLabel">Ganti Profil</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('home.change-profile') }}" method="post">
                        @csrf

                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ Auth::user()->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">Alamat Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ Auth::user()->email }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone_number">Nomor Telepon</label>
                                <input type="number" name="phone_number" id="phone_number" class="form-control"
                                    value="{{ Auth::user()->phone_number }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password</label>
                                <input type="password" minlength="8" name="password" id="password"
                                    class="form-control">
                                <span class="text-secondary fs-7">Tulis password jika ingin menggantinya</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth

    @include('components.scripts')
</body>

</html>
