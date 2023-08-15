@extends('layouts.home')

@section('content')
    <section class="checkout" id="collection">
        <div class="container">
            <h2 class="section-title mb-5">Keranjang</h2>

            <form action="{{ route('home.checkout.store', $item->id) }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="card border-0 mb-5">
                            <div class="card-body">
                                <p class="mb-3 fs-5 text-dark fw-semibold">Alamat Pengiriman</p>
                                <div class="row mb-5">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="name">Nama Lengkap</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email">Email</label>
                                            <input type="text" class="form-control" value="{{ Auth::user()->email }}"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone_number">Nomor Telepon</label>
                                            <input type="text" class="form-control"
                                                value="{{ Auth::user()->phone_number }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="shipping_address">Alamat Tujuan</label>
                                            <textarea name="shipping_address" id="shipping_address" cols="30" rows="3" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <p class="mb-3 fs-5 text-dark fw-semibold">Pembayaran</p>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            @foreach ($banks as $bank)
                                                <div class="row align-items-center mb-3">
                                                    <div class="col-3">
                                                        @if ($bank->bank_name == 'Mandiri')
                                                            <img src="{{ url('assets/images/bank-logo/mandiri-logo.png') }}"
                                                                alt="Logo Bank Mandiri" class="w-75">
                                                        @elseif($bank->bank_name == 'BNI')
                                                            <img src="{{ url('assets/images/bank-logo/bni-logo.png') }}"
                                                                alt="Logo Bank BNI" class="w-75">
                                                        @elseif($bank->bank_name == 'BCA')
                                                            <img src="{{ url('assets/images/bank-logo/bca-logo.png') }}"
                                                                alt="Logo Bank BCA" class="w-75">
                                                        @elseif($bank->bank_name == 'BRI')
                                                            <img src="{{ url('assets/images/bank-logo/bri-logo.png') }}"
                                                                alt="Logo Bank BRI" class="w-75">
                                                        @elseif($bank->bank_name == 'DANA')
                                                            <img src="{{ url('assets/images/bank-logo/dana-logo.png') }}"
                                                                alt="Logo DANA" class="w-75">
                                                        @elseif($bank->bank_name == 'Gopay')
                                                            <img src="{{ url('assets/images/bank-logo/gopay-logo.png') }}"
                                                                alt="Logo Gopay" class="w-75">
                                                        @endif
                                                    </div>
                                                    <div class="col-9">
                                                        <p class="text-dark fw-semibold mb-1 fs-5">
                                                            {{ $bank->account_number }}
                                                        </p>
                                                        <p class="text-dark fw-semibold fs-7">An. {{ $bank->account_name }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="proof_of_payment">Upload Bukti Pembayaran</label>
                                            <input type="file" accept="image/*, application/pdf" name="proof_of_payment"
                                                id="proof_of_payment" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="bank_name">Pembayaran ke Bank mana?</label>
                                            <select name="bank_name" id="bank_name" class="form-control">
                                                @foreach ($banks as $bank)
                                                    <option value="{{ $bank->bank_name }}">{{ $bank->bank_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="notes">Catatan</label>
                                            <textarea name="notes" id="notes" cols="30" rows="2" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex align-items-center gap-2 text-danger">
                                            <i class='bx bx-error-circle'></i>
                                            <p class="mb-0">Ongkir ditanggung pembeli</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0">
                            <div class="card-body">
                                <h5 class="text-dark fw-semibold mb-3">Pesanan Anda</h5>
                                @foreach ($item->details as $detail)
                                    <div class="row mb-2">
                                        <div class="col-3">
                                            <img src="{{ url('storage/' . $detail->product->image) }}"
                                                style="width: 100%; height: 100%; object-fit: cover" class="rounded"
                                                alt="{{ $detail->product->name }}">
                                        </div>
                                        <div class="col-6">
                                            {{ $detail->product->name }}
                                            <br> <span class="fs-7 text-secondary">x{{ $detail->quantity }}</span>
                                        </div>
                                        <div class="col-3">Rp. {{ number_format($detail->price) }}</div>
                                    </div>
                                @endforeach
                                <hr style="border-style: dashed" class="mt-5">
                                <div class="d-flex align-items-center justify-content-between mb-3 fs-5">
                                    <p class="mb-0 text-secondary">Total</p>
                                    <p class="mb-0 text-dark fw-semibold">Rp. {{ number_format($item->total_amount) }}</p>
                                </div>
                                <button type="submit" class="btn btn-primary py-2 px-3 w-100 fw-bold">Checkout</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('addon-style')
    <style>
        @media screen and (max-width: 768px) {

            .w-25,
            .w-50 {
                width: 100% !important;
            }
        }
    </style>
@endpush
