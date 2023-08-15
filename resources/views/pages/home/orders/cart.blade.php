@extends('layouts.home')

@section('content')
    <section class="collection-section" id="collection">
        <div class="container">
            <h2 class="section-title mb-5">Keranjang</h2>

            <div class="table-responsive mb-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-uppercase fs-7">#</th>
                            <th class="text-uppercase fs-7">nama produk</th>
                            <th class="text-uppercase fs-7">harga</th>
                            <th class="text-uppercase fs-7">quantity</th>
                            <th class="text-uppercase fs-7">sub-total</th>
                            <th class="text-uppercase fs-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($item != null)
                            @foreach ($item->details as $cart)
                                <input type="hidden" id="stock{{ $cart->id }}" value="{{ $cart->product->stock }}">
                                <tr style="vertical-align: middle">
                                    <td>
                                        <img src="{{ url('storage/' . $cart->product->image) }}"
                                            alt="{{ $cart->product->name }}"
                                            style="width: 40px; height: 30px; object-fit: cover" class="rounded">
                                    </td>
                                    <td>
                                        <a href="{{ route('home.produk.detail', $cart->product->slug) }}"
                                            class="text-dark text-decoration-underline">
                                            {{ $cart->product->name }}
                                        </a>
                                    </td>
                                    <td>Rp. {{ number_format($cart->price) }}</td>
                                    <td>
                                        <form action="{{ route('home.keranjang.update', $cart->id) }}" method="post"
                                            class="d-flex flex-column flex-md-row align-items-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" id="quantity{{ $cart->id }}"
                                                class="form-control w-25" value="{{ $cart->quantity }}"
                                                onchange="checkInput({{ $cart->id }})">
                                            <button type="submit" class="btn btn-secondary btn-sm"
                                                id="btnUpdate{{ $cart->id }}">Update</button>
                                        </form>
                                        <span class="text-danger fs-7" id="errorText{{ $cart->id }}"></span>
                                    </td>
                                    <td>Rp. {{ number_format($cart->price * $cart->quantity) }}</td>
                                    <td>
                                        <form action="{{ route('home.keranjang.destroy', $cart->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger btn-sm d-flex align-items-center justify-content-center gap-2"
                                                onclick="return confirm('Are you sure to deleted this?')">
                                                <i class="bx bx-trash-alt"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="4">Total</td>
                                <th class="fs-5">Rp. {{ number_format($item->total_amount) }}</th>
                                <td>&nbsp;</td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="6">
                                    <p class="mb-0 text-center text-danger">Belum Ada Pesanan</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @if ($item != null)
                <div class="row justify-content-end">
                    <div class="col-md-3">
                        <a href="{{ route('home.checkout.index') }}" class="btn btn-primary py-3 px-5 fw-semibold w-100">
                            Checkout Sekarang
                        </a>
                    </div>
                </div>
            @endif
            <a href="{{ route('home.produk') }}" class="btn btn-light d-block mx-auto w-50 mt-5">Lanjutkan Berbelanja</a>
        </div>
    </section>
@endsection

@push('addon-style')
    <style>
        @media screen and (max-width: 768px) {
            .w-25 {
                width: 100% !important;
            }
        }
    </style>
@endpush

@push('addon-script')
    <script>
        function checkInput(number) {
            var inputNumber = parseInt(document.getElementById("quantity" + number).value);
            var btnUpdate = document.getElementById("btnUpdate" + number);
            var errorText = document.getElementById("errorText" + number);

            if (inputNumber > parseInt(document.getElementById("stock" + number).value)) {
                btnUpdate.disabled = true;
                errorText.textContent = "Input melebihi stok!";
            } else {
                btnUpdate.disabled = false;
                errorText.textContent = "";
            }
        }
    </script>
@endpush
