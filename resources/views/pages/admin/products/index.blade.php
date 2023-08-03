@extends('layouts.admin')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-5">
                <h4 class="text-dark fw-semibold">List Produk</h4>
                <a href="{{ route('produk.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                    <i class="bx bx-plus"></i> Tambah Produk
                </a>
            </div>

            <div class="card border-0">
                <div class="card-body">
                    @if ($items->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="fs-7 text-uppercase">#</th>
                                        <th class="fs-7 text-uppercase">kategori</th>
                                        <th class="fs-7 text-uppercase">nama produk</th>
                                        <th class="fs-7 text-uppercase">stok</th>
                                        <th class="fs-7 text-uppercase">harga</th>
                                        <th class="fs-7 text-uppercase"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $key => $item)
                                        <tr style="vertical-align: middle">
                                            <td>{{ ++$key }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ number_format($item->stock) }}</td>
                                            <td>Rp. {{ number_format($item->price) }}</td>
                                            <td>
                                                <div class="d-flex align-items-center justify-content-end gap-2">
                                                    <a href="{{ route('produk.edit', $item->id) }}"
                                                        class="btn btn-sm btn-warning text-white d-flex align-items-center gap-2">
                                                        <i class='bx bx-edit'></i> Edit
                                                    </a>
                                                    <form action="{{ route('produk.destroy', $item->id) }}" method="post"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm d-flex align-items-center gap-2"
                                                            onclick="return confirm('Kamu yakin ingin menghapus data ini? Data yang berhubungan juga akan terhapus')">
                                                            <i class="bx bx-trash-alt"></i> Hapus
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="mb-0 text-danger text-center">Belum ada produk</p>
                    @endif
                </div>
            </div>
    </section>
@endsection
