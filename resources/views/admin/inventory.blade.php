@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">☕ Coffee Inventory</h2>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('admin.inventory') }}" class="mb-4 d-flex gap-2">
        <input type="text" name="search" placeholder="🔍 Search product or SKU" value="{{ request('search') }}" class="form-control" style="max-width: 300px;">
        <button type="submit" class="btn btn-coffee">Search</button>
        <a href="{{ route('admin.inventory') }}" class="btn btn-outline-secondary">Reset</a>
    </form>

    {{-- Summary Cards --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text fs-4">{{ $inventoryItems->total() }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h5 class="card-title">Total Stock Value</h5>
                    <p class="card-text fs-4">UGX {{ number_format($inventoryItems->sum('quantity') * $inventoryItems->avg('price'), 2) }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger">
                <div class="card-body">
                    <h5 class="card-title">Low Stock Items</h5>
                    <p class="card-text fs-4">{{ $inventoryItems->where('quantity', '<', 10)->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Inventory Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventoryItems as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->sku }}</td>
                    <td @if($item->quantity < 10) class="text-danger fw-bold" @endif>{{ $item->quantity }}</td>
                    <td>UGX {{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->description ?? '-' }}</td>
                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No inventory items found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $inventoryItems->withQueryString()->links() }}
    </div>

    {{-- Charts --}}
    <canvas id="stockLevelsChart" width="400" height="200" class="my-4"></canvas>
    <canvas id="salesStockChart" width="400" height="200" class="my-4"></canvas>
    <canvas id="categoryChart" width="400" height="200" class="my-4"></canvas>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Stock Levels Over Time
    const ctxStock = document.getElementById('stockLevelsChart').getContext('2d');
    new Chart(ctxStock, {
        type: 'line',
        data: {
            labels: {!! json_encode($dates) !!},
            datasets: [{
                label: 'Stock Levels',
                data: {!! json_encode($quantities) !!},
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                tension: 0.3,
                fill: true
            }]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    // Sales vs Stock
    const ctxSales = document.getElementById('salesStockChart').getContext('2d');
    new Chart(ctxSales, {
        type: 'bar',
        data: {
            labels: {!! json_encode($productNames) !!},
            datasets: [
                {
                    label: 'Stock',
                    data: {!! json_encode($stockData) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                },
                {
                    label: 'Sales',
                    data: {!! json_encode($salesData) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.7)'
                }
            ]
        },
        options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    // Category Breakdown
    const ctxCat = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctxCat, {
        type: 'pie',
        data: {
            labels: {!! json_encode($categories) !!},
            datasets: [{
                data: {!! json_encode($categoryCounts) !!},
                backgroundColor: ['#4BC0C0', '#FF6384', '#FFCE56', '#36A2EB']
            }]
        },
        options: { responsive: true }
    });
</script>
@endsection
