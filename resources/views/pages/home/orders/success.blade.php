@extends('layouts.home')

@section('content')
    <section class="checkout" id="checkout">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="mb-5 text-center">
                                <i class='bx bx-check-circle text-success' style="font-size: 50px"></i>
                                <h4 class="text-dark fw-semibold mt-2">Terima kasih atas pesanan Anda</h4>
                                <p class="text-secondary mb-5">Pesanan Anda akan segera kami proses.</p>
                            </div>

                            <div class="mb-3">
                                <p class="mb-1 text-dark fw-semibold">Tanggal Transaksi</p>
                                <p class="mb-0 text-secondary">{{ $item->created_at->format('l, d F Y, h:i:s') }}</p>
                            </div>

                            <div class="mb-3">
                                <p class="mb-1 text-dark fw-semibold">Metode Transfer</p>
                                <p class="mb-0 text-secondary">Transfer via {{ $item->bank_name }}</p>
                            </div>

                            <div class="mb-3">
                                <p class="mb-1 text-dark fw-semibold">Pesanan Anda</p>
                                @foreach ($item->details as $detail)
                                    <div class="row mb-2">
                                        <div class="col-2">
                                            <img src="{{ url('storage/' . $detail->product->image) }}"
                                                style="width: 100%; height: 100%; object-fit: cover" class="rounded"
                                                alt="{{ $detail->product->name }}">
                                        </div>
                                        <div class="col-7">
                                            {{ $detail->product->name }}
                                            <br> <span class="fs-7 text-secondary">x{{ $detail->quantity }}</span>
                                        </div>
                                        <div class="col-3 fw-semibold text-end">Rp. {{ number_format($detail->price) }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <hr class="mb-3" style="border-style: dashed">

                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <p class="mb-0 text-dark">Grand Total</p>
                                <p class="mb-0 text-dark fs-5 fw-semibold">Rp. {{ number_format($item->total_amount) }}</p>
                            </div>

                            <a class="py-2 w-100 btn btn-primary" href="{{ route('home.produk') }}">Lanjutkan Berbelanja</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
