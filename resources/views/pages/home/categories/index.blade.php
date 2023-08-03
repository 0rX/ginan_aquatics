@extends('layouts.home')

@section('content')
    <section class="collection-section" id="collection">
        <div class="container">
            <h2 class="section-title mb-5">Semua Kategori</h2>

            <div class="row">
                @foreach ($categories as $item)
                    <div class="col-md-4">
                        <a href="{{ route('home.kategori.show', $item->slug) }}"
                            class="card bg-white border-light mb-3 shadow-sm">
                            <div class="card-body">
                                <h5 class="text-dark mb-0">
                                    {{ $item->name }}
                                </h5>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
