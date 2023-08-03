@php $title = 'Masuk' @endphp

@extends('layouts.auth')

@section('content')
    <h3 class="mb-4 text-center fw-bold text-tertiary">Masuk</h3>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" placeholder="Alamat Email"
                class="form-control shadow-none @error('email') is-invalid @enderror" autocomplete="email" required
                autofocus>

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Password"
                class="form-control shadow-none @error('password') is-invalid @enderror" autocomplete="password" required>

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary fw-semibold py-2 px-4 w-100 mb-2">
            Login
        </button>
        <p class="mb-0 text-center">Belum Memiliki Akun? <a href="{{ route('register') }}">Daftar</a></p>
    </form>
@endsection
