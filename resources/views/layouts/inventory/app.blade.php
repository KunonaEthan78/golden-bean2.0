<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Golden Bean Coffee Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f3ef;
            color: #4b2e2b;
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
<body>
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
