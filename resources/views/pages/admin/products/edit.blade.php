@extends('layouts.admin')

@section('content')
    <section class="py-5">
        <div class="container">
            <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between mb-5">
                <h4 class="text-dark fw-semibold">Edit {{ $item->title }}</h4>
                <a href="{{ route('produk.index') }}" class="btn btn-light d-flex align-items-center gap-2">
                    <i class="bx bx-arrow-back"></i> Batal & Kembali
                </a>
            </div>

            <div class="card border-0">
                <div class="card-body">
                    <form action="{{ route('produk.update', $item->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="category_id">Pilih Kategori</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $item->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="name">Nama Produk</label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{ $item->name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="stock">Stok</label>
                                    <input type="number" name="stock" id="stock" class="form-control"
                                        value="{{ $item->stock }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="price">Harga</label>
                                    <input type="number" name="price" id="price" class="form-control"
                                        value="{{ $item->price }}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="image">Gambar</label>
                                    <input type="file" accept="image/*" name="image" id="image"
                                        class="form-control">
                                    <span class="text-secondary fs-7">Pilih gambar jika ingin menggantinya</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="description">Deskripsi</label>
                                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $item->description }}</textarea>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('addon-style')
    <link rel="stylesheet" href="{{ url('assets/vendors/summernote/summernote.min.css') }}">
@endpush

@push('addon-script')
    <script src="{{ url('assets/vendors/summernote/summernote.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote({
                height: 200
            });
        });
    </script>
@endpush
