<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cooperative | Golden Bean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    @yield('head')
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(135deg, #5a7247, #8b5a2b);">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Golden Bean Cooperative</a>
            <div>
                <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        @yield('content')
    </main>

    {{-- Floating Chat Button --}}
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1050;">
        <a href="{{ route('chat') }}" class="btn btn-success rounded-circle shadow-lg" 
           style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;"
           title="Open Chat">
            <i class="fas fa-comments fa-lg text-white"></i>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
