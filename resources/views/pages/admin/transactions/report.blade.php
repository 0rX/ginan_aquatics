@extends('layouts.admin')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center mb-5">
                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-2">
                        <h4 class="text-dark fw-semibold mb-0">Laporan Penjualan</h4>
                        <a href="{{ route('admin.report.print', ['bulan' => 'all', 'tahun' => 'all']) }}"
                            class="btn btn-success d-flex align-items-center gap-2" target="_blank">
                            <i class="bx bx-printer"></i> Cetak Laporan
                        </a>
                    </div>
                </div>
                <div class="col-md-6">
                    <form class="row row-cols-lg-auto g-3 align-items-center justify-content-end mt-3 mt-md-0"
                        method="get" action="{{ route('admin.report.filter') }}">
                        <div class="col-12">
                            <label class="visually-hidden" for="bulan">Bulan</label>
                            <select class="form-select" id="bulan" name="bulan" required>
                                <option value="" selected>Pilih Bulan</option>
                                @foreach (['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $key => $bulan)
                                    <option value="{{ ++$key }}">{{ $bulan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="visually-hidden" for="tahun">Tahun</label>
                            <select class="form-select" id="tahun" name="tahun" required>
                                <option value="" selected>Pilih Tahun</option>
                                @php
                                    $years = [];
                                @endphp
                                @foreach ($items as $tanggal)
                                    @php
                                        $year = date('Y', strtotime($tanggal->created_at));
                                        if (!in_array($year, $years)) {
                                            $years[] = $year;
                                        }
                                    @endphp
                                @endforeach
                                @foreach ($years as $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>

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
                                    <tr>
                                        <td colspan="4" class="fw-semibold">Total</td>
                                        <td class="fw-semibold fs-5">Rp. {{ number_format($items->sum('total_amount')) }}
                                        </td>
                                    </tr>
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
