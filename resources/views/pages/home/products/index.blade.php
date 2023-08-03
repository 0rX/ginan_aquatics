@extends('layouts.home')

@section('content')
    <section class="collection-section" id="collection">
        <div class="container">
            <h2 class="section-title mb-5">Semua Koleksi Kami</h2>

            <div class="row">
                @foreach ($products as $item)
                    <div class="col-md-3">
                        @include('components.card-product')
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
