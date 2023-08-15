@extends('layouts.admin')

@section('content')
    <section class="py-5">
        <div class="container">
            <h1 class="text-dark fw-semibold">Selamat Datang Kembali, {{ Auth::user()->name }}</h1>

            <div class="row mt-5">
                <div class="col-6 col-md-3">
                    <div class="card bg-white border-light mb-3">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <i class="bx bx-dollar text-dark fs-1"></i>

                                <div>
                                    <h4 class="text-dark fw-semibold mb-0">Rp. {{ number_format($total_income) }}</h4>
                                    <p class="text-secondary mb-0">Pendapatan Bulan Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card bg-white border-light mb-3">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <i class="bx bx-chart text-dark fs-1"></i>

                                <div>
                                    <h4 class="text-dark fw-semibold mb-0">{{ number_format($success_count) }}</h4>
                                    <p class="text-secondary mb-0">Penjualan Bulan Ini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card bg-white border-light mb-3">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <i class="bx bx-user-pin text-dark fs-1"></i>

                                <div>
                                    <h4 class="text-dark fw-semibold mb-0">{{ number_format($total_customers) }}</h4>
                                    <p class="text-secondary mb-0">Pelanggan Terdaftar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="card bg-white border-light mb-3">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex flex-column flex-md-row gap-2">
                                <i class="bx bx-box text-dark fs-1"></i>

                                <div>
                                    <h4 class="text-dark fw-semibold mb-0">{{ number_format($total_products) }}</h4>
                                    <p class="text-secondary mb-0">Produk</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
