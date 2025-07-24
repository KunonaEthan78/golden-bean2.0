<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'Golden Bean Coffee') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f5f3ef;
            color: #4b2e2b;
            font-family: 'Figtree', sans-serif;
        }

        .navbar {
            background-color: #6f4e37;
        }

        .navbar-brand,
        .nav-link,
        .btn,
        table {
            color: #fff !important;
        }

        .card {
            background-color: #fffaf5;
        }

        .btn-coffee {
            background-color: #8b5e3c;
            color: white;
        }

        .btn-coffee:hover {
            background-color: #a9744f;
        }

        table th {
            background-color: #d2b48c;
        }

        table td {
            background-color: #fff;
            color: #3e2723;
        }
    </style>
</head>
<body class="font-sans antialiased">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2" style="height: 40px;" />
                <span class="fw-bold text-white">{{ config('app.name', 'Golden Bean Coffee') }}</span>
            </a>

            @auth
                <div class="dropdown ms-auto">
                    <button class="btn btn-sm text-white dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </nav>

    <!-- Optional page header -->
    @isset($header)
        <header class="bg-white shadow-sm">
            <div class="container py-4">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Main content -->
    <main class="container py-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    yield('content')

@yield('scripts')

</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@