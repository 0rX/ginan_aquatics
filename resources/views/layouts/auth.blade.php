<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ url('assets/images/logo/logo.png') }}" type="image/x-icon">
    <title>{{ $title }} - Ginan Marketplace</title>

    @include('components.styles')
</head>

<body class="bg-body-tertiary py-3">
    <div class="container">
        <div class="row align-items-center justify-content-center min-vh-100">
            <div class="col-md-5">
                <a href="{{ route('home') }}">
                    <img src="{{ url('assets/images/logo/logo.png') }}" alt="Arunika" style="width: 90px"
                        class="d-block mx-auto mb-5">
                </a>

                <div class="card bg-white border-0">
                    <div class="card-body p-4">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('components.scripts')
</body>

</html>
