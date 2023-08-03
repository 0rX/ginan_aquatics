@extends('layouts.home')

@section('content')
    <section class="header-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <img src="{{ url('assets/images/logo/logo.png') }}" alt="Ginan Marketplace" class="d-block mx-auto mb-4"
                        style="width: 200px">

                    <h1 class="header-title text-center text-dark fw-bold mb-2">
                        Selamat Datang di Ginan Marketplace
                    </h1>
                    <p class="mb-4 text-secondary text-center">
                        - YOUR PREMIUM CHANNA SHOP -
                    </p>
                    <a href="#collection" class="btn btn-dark px-3 py-2 d-block mx-auto" style="width: max-content">
                        Lihat Koleksi
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="collection-section" id="collection">
        <div class="container">
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-5">
                <h3 class="section-title mb-0">Koleksi Kami</h3>
                <a href="{{ route('home.produk') }}" class="btn btn-light px-3">Lihat Semua</a>
            </div>

            <div class="row">
                @foreach ($products as $item)
                    <div class="col-md-3">
                        @include('components.card-product')
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="superiority-section bg-primary">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="mx-auto rounded-circle bg-white d-flex align-items-center justify-content-center mb-3"
                        style="width: 80px; height: 80px">
                        <img src="{{ url('assets/images/tag.png') }}" class="w-50" alt="">
                    </div>

                    <h4 class="text-white text-center">Harga Termurah</h4>
                </div>
                <div class="col-md-4">
                    <div class="mx-auto rounded-circle bg-white d-flex align-items-center justify-content-center mb-3"
                        style="width: 80px; height: 80px">
                        <img src="{{ url('assets/images/stopwatch.png') }}" class="w-50" alt="">
                    </div>

                    <h4 class="text-white text-center">Pengiriman Cepat</h4>
                </div>
                <div class="col-md-4">
                    <div class="mx-auto rounded-circle bg-white d-flex align-items-center justify-content-center mb-3"
                        style="width: 80px; height: 80px">
                        <img src="{{ url('assets/images/choice.png') }}" class="w-50" alt="">
                    </div>

                    <h4 class="text-white text-center">Banyak Pilihan</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white">
        <div class="container">
            <h3 class="section-title text-center mb-5">Review Customer</h3>

            <div id="testimoniCarousel" class="carousel carousel-dark slide">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <img src="{{ url('assets/images/apin.jpg') }}"
                                    style="width: 65px; height: 65px; object-fit: cover" alt=""
                                    class="rounded-circle mx-auto d-block mb-3">
                                <p class="mb-0 text-center text-dark fw-semibold">Alfin Imam Abidin</p>
                                <p class="mb-3 text-center text-secondary fs-7">Pecinta Ikan Channa</p>
                                <p class="mb-0 text-center text-secondary">
                                    Alhamdulillah ikan mendarat dengan selamat, ikan sehat semua dan sangat berkualitas, ngga bakalan bosen buat belanja lagi.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <img src="{{ url('assets/images/dado.jpg') }}"
                                    style="width: 65px; height: 65px; object-fit: cover" alt=""
                                    class="rounded-circle mx-auto d-block mb-3">
                                <p class="mb-0 text-center text-dark fw-semibold">Fernando Adi Pradana</p>
                                <p class="mb-3 text-center text-secondary fs-7">Pecinta Ikan Hias</p>
                                <p class="mb-0 text-center text-secondary">
                                    Terimakasih Ginan Aquatic !!! Ikan sehat sentosa dan tiba dengan selamat, kali ini terpuaskan respon admin juga ramah walaupun saya terlalu banyak minta.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row justify-content-center">
                            <div class="col-md-5">
                                <img src="{{ url('assets/images/rizkol.jpg') }}"
                                    style="width: 65px; height: 65px; object-fit: cover" alt=""
                                    class="rounded-circle mx-auto d-block mb-3">
                                <p class="mb-0 text-center text-dark fw-semibold">Rizkol Khalwani</p>
                                <p class="mb-3 text-center text-secondary fs-7">Pecinta Ikan Hias</p>
                                <p class="mb-0 text-center text-secondary">
                                    Alhamdulillah akhirnya paket sudah sampai selamat sampai tujuan packing rapih sangat aman pengiriman cepat kurir juga ramah.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#testimoniCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#testimoniCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>
@endsection
