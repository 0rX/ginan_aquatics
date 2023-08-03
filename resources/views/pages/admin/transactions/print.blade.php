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
    <style>
        @media print {
            @page {
                margin: 0;
            }

            body {
                margin: 1.6cm;
            }
        }

        tr {
            font-size: 12px !important;
        }

        tr th {
            font-size: 10px !important;
        }
    </style>
</head>

<body>

    <div class="container-fluid py-5">
        <h4 class="text-center fw-semibold mb-5">{{ $title }}</h4>
        @if ($items->count() > 0)
            <table class="table table-bordered">
                <thead class="fw-semibold text-uppercase fs-7">
                    <tr>
                        <th>tanggal pemesanan</th>
                        <th>kode pemesanan</th>
                        <th>nama pemesan</th>
                        <th>alamat pengiriman</th>
                        <th>total harga</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr style="vertical-align: middle">
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}
                            </td>
                            <td>#PESANAN000{{ $item->id }}</td>
                            <td>{{ $item->customer->name }}</td>
                            <td>{{ $item->shipping_address }}</td>
                            <td>Rp. {{ number_format($item->total_amount) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="fw-semibold">Total</td>
                        <td class="fw-semibold fs-7">Rp. {{ number_format($items->sum('total_amount')) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        @else
            <p class="mb-0 text-danger text-center">Belum ada transaksi</p>
        @endif
    </div>

    <script>
        window.print()
    </script>
</body>

</html>
