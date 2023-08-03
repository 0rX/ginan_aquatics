@extends('layouts.home')

@section('content')
    <section class="collection-section" id="collection">
        <div class="container">
            <h2 class="section-title mb-5">Produk Kategori {{ $category->name }}</h2>

            <div class="row">
                @foreach ($category->products as $item)
                    <div class="col-md-3">
                        @include('components.card-product')
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
