<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Retailer | Coffee SCM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">
        <div class="container">
            <a class="navbar-brand" href="#">☕ Retailer Panel</a>
            <div class="ms-auto">
                <span class="text-light me-3">{{ Auth::user()->name ?? 'Retailer' }}</span>
                <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-light"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">

        {{-- ✅ Navigation Links for Wholesaler Interaction --}}
        <div class="mb-4">
            <div class="btn-group" role="group" aria-label="Wholesaler navigation">
                <a class="btn btn-outline-primary" href="{{ route('retailer.wholesaler.products') }}">🛍 Browse Wholesaler Products</a>
                <a class="btn btn-outline-success" href="{{ route('retailer.wholesaler.cart') }}">🛒 View Wholesaler Cart</a>
                <a class="btn btn-outline-info" href="{{ route('retailer.wholesaler.orders') }}">📦 View Wholesaler Orders</a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Render the actual content from child view --}}
        @yield('content')
    </div>

    {{-- Floating Chat Button --}}
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <a href="{{ route('chat') }}" class="btn btn-info rounded-circle shadow-lg" 
           style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;"
           title="Open Chat">
            <i class="fas fa-comments fa-lg text-white"></i>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
