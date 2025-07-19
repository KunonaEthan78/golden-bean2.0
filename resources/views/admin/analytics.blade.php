@extends('layouts.admin')

@section('content')
<h2 class="mb-4 text-center text-dark fw-bold">📊 Analytics Dashboard</h2>

<div class="mb-3 text-start">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark">
        ← Back to Dashboard
    </a>
</div>

<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-bg-primary shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Revenue</h5>
                <p class="display-6 fw-semibold">${{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-info shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Total Orders</h5>
                <p class="display-6 fw-semibold">{{ $totalOrders }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-warning shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Avg. Order Value</h5>
                <p class="display-6 fw-semibold">${{ number_format($avgOrderValue, 2) }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row mb-4">
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">📦 Orders by Status</h5>
                <canvas id="statusChart" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">🔥 Top Ordered Products</h5>
                <canvas id="productChart" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm mt-4">
    <div class="card-body">
        <h5 class="card-title">🕓 Recent Orders</h5>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($recentOrders ?? [] as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->name ?? 'N/A' }}</td>
                            <td><span class="badge bg-secondary text-capitalize">{{ $order->status }}</span></td>
                            <td>${{ number_format($order->total ?? $order->total_price, 2) }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No recent orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($ordersByStatus->keys()) !!},
            datasets: [{
                label: 'Orders',
                data: {!! json_encode($ordersByStatus->values()) !!},
                backgroundColor: '#4e73df'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: 'Order Status Overview' }
            },
            scales: { y: { beginAtZero: true } }
        }
    });

    const productCtx = document.getElementById('productChart').getContext('2d');
    new Chart(productCtx, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($topProducts->keys()) !!},
            datasets: [{
                label: 'Top Products',
                data: {!! json_encode($topProducts->values()) !!},
                backgroundColor: ['#36b9cc', '#f6c23e', '#1cc88a', '#e74a3b', '#858796']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                title: { display: true, text: 'Most Ordered Products' }
            }
        }
    });
   
</script>
@endsection
