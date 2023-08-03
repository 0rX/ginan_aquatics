@extends('layouts.admin')

@section('content')
    <section class="py-5">
        <div class="container">
            <h4 class="text-dark fw-semibold mb-5">Transaksi</h4>

            <div class="card border-0">
                <div class="card-body">
                    @if ($items->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="fw-semibold text-uppercase fs-7">
                                    <tr>
                                        <th>tanggal pemesanan</th>
                                        <th>kode pemesanan</th>
                                        <th>produk</th>
                                        <th>data pemesan</th>
                                        <th>total harga</th>
                                        <th>status</th>
                                        <th>aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr style="vertical-align: middle">
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}
                                            </td>
                                            <td>#PESANAN000{{ $item->id }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <button class="btn btn-light d-flex align-items-center gap-2"
                                                        type="button" data-bs-toggle="modal"
                                                        data-bs-target="#detailModal{{ $item->id }}">
                                                        <i class="bx bx-file"></i> Lihat Produk
                                                    </button>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <button class="btn btn-light d-flex align-items-center gap-2"
                                                        type="button" data-bs-toggle="modal"
                                                        data-bs-target="#detailPemesan{{ $item->id }}">
                                                        <i class="bx bx-file"></i> Lihat Pemesan
                                                    </button>
                                                </div>
                                            </td>
                                            <td>Rp. {{ number_format($item->total_amount) }}</td>
                                            <td>
                                                @if ($item->status == 'in_progress')
                                                    <span class="badge bg-warning py-2 d-flex align-items-center gap-2"
                                                        style="width: max-content">
                                                        <i class='bx bx-package'></i> Proses
                                                    </span>
                                                @elseif($item->status == 'on_delivery')
                                                    <span class="badge bg-info py-2 d-flex align-items-center gap-2"
                                                        style="width: max-content">
                                                        <i class='bx bx-car'></i> Dikirim
                                                    </span>
                                                @elseif($item->status == 'success')
                                                    <span class="badge bg-success py-2 d-flex align-items-center gap-2"
                                                        style="width: max-content">
                                                        <i class='bx bx-check'></i> Sukses / Diterima
                                                    </span>
                                                @elseif($item->status == 'cancelled')
                                                    <span class="badge bg-danger py-2 d-flex align-items-center gap-2"
                                                        style="width: max-content">
                                                        <i class='bx bx-error-circle'></i> Dibatalkan
                                                    </span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    @if ($item->status == 'success')
                                                        <p class="mb-0 text-success fw-semibold">Sukses</p>
                                                    @elseif ($item->status == 'cancelled')
                                                        <p class="mb-0 text-danger fw-semibold">Dibatalkan</p>
                                                    @else
                                                        <div class="dropdown">
                                                            <button class="btn btn-light btn-sm dropdown-toggle"
                                                                type="button" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                Ubah Status
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    <form
                                                                        action="{{ route('admin.transaksi.update', $item->id) }}"
                                                                        class="d-inline" method="post">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="status"
                                                                            value="in_progress">
                                                                        <button type="submit" class="dropdown-item">
                                                                            Di Proses
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('admin.transaksi.update', $item->id) }}"
                                                                        class="d-inline" method="post">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="status"
                                                                            value="on_delivery">
                                                                        <button type="submit" class="dropdown-item">
                                                                            Dikirim
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('admin.transaksi.update', $item->id) }}"
                                                                        class="d-inline" method="post">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <input type="hidden" name="status"
                                                                            value="cancelled">
                                                                        <button type="submit" class="dropdown-item">
                                                                            Dibatalkan
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="detailModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="detailModalLabel">Detail Produk
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @foreach ($item->details as $detail)
                                                            <div class="row mb-1">
                                                                <div class="col-5">Produk</div>
                                                                <div class="col-7 fw-semibold">:
                                                                    {{ $detail->product->name }}</div>
                                                            </div>
                                                            <div class="row mb-1">
                                                                <div class="col-5">Quantity</div>
                                                                <div class="col-7 fw-semibold">:
                                                                    {{ number_format($detail->quantity) }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-1">
                                                                <div class="col-5">Harga</div>
                                                                <div class="col-7 fw-semibold">: Rp.
                                                                    {{ number_format($detail->price) }}
                                                                </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <div class="col-5">Sub Total</div>
                                                                <div class="col-7 fw-semibold">: Rp.
                                                                    {{ number_format($detail->price * $detail->quantity) }}
                                                                </div>
                                                            </div>

                                                            <hr class="mb-3">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="detailPemesan{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="detailPemesanLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="detailPemesanLabel">
                                                            Detail Pemesan
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row mb-1">
                                                            <div class="col-5">Nama Pemesan</div>
                                                            <div class="col-7 fw-semibold">:
                                                                {{ $item->customer->name }}</div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-5">Alamat</div>
                                                            <div class="col-7 fw-semibold">:
                                                                {{ $item->shipping_address }}</div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-5">Nomor Telepon</div>
                                                            <div class="col-7 fw-semibold">:
                                                                {{ $item->customer->phone_number }}</div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-5">Alamat Email</div>
                                                            <div class="col-7 fw-semibold">:
                                                                {{ $item->customer->email }}</div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-5">Transfer Pembayaran</div>
                                                            <div class="col-7 fw-semibold">:
                                                                {{ $item->bank_name }}</div>
                                                        </div>
                                                        <div class="row mb-1">
                                                            <div class="col-5">Bukti Pembayaran</div>
                                                            <div class="col-7 fw-semibold">:
                                                                <img src="{{ url('storage/' . $item->proof_of_payment) }}"
                                                                    class="w-50" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mb-0 text-danger text-center">Belum ada transaksi</p>
                    @endif
                </div>
            </div>
    </section>
@endsection
