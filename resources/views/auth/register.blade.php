@php $title = 'Daftar' @endphp

@extends('layouts.auth')

@section('content')
    <h3 class="mb-4 text-center fw-bold text-tertiary">Daftar</h3>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name">Nama</label>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email">Alamat Email</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="email">

            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>Email telah digunakan</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone_number">Nomor Telepon</label>
            <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror"
                name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">

            @error('phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>Nomor telepon telah digunakan</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">

            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>
                        {{ $message == 'The password field confirmation does not match.' ? 'Password tidak sama dengan konfirmasi password' : 'Jumlah password harus 8 keatas' }}
                    </strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password-confirm">Konfirmasi Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary fw-semibold py-2 px-4 w-100 mb-2">
            Daftar
        </button>
        <p class="text-center mb-0">Telah Memiliki Akun? <a href="{{ route('login') }}">Masuk</a></p>

    </form>
@endsection
