<div class="card mb-3 border-0">
    <a href="{{ route('home.produk.detail', $item->slug) }}">
        <img src="{{ url('storage/' . $item->image) }}" alt="" class="card-img-top">
    </a>
    <div class="card-body p-3">
        <h5 class="text-dark mb-0">{{ $item->name }}</h5>
        <p class="text-dark mb-0">Rp. {{ number_format($item->price) }}</p>
    </div>
</div>
