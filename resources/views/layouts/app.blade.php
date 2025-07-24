<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Golden Bean Coffee') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Bootstrap CSS CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom Styles --}}
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

    {{-- Scripts loaded by Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Alpine.js --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="font-sans antialiased">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand text-white fw-bold" href="#">☕ Golden Bean Coffee</a>
        </div>
    </nav>

    <div class="container py-4">
        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
