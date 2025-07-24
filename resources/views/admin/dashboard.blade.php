@extends('layouts.admin')

@section('content')
<h2 class="mb-4 text-center fw-bold text-dark">☕ Golden Bean Admin Dashboard</h2>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div class="d-flex gap-3">
        <a href="{{ route('admin.analytics') }}" class="btn btn-outline-dark">
            📊 View Full Analytics Dashboard
        </a>
        <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-info">
            📄 View Reports & Summary
        </a>
    </div>
    
</div>
<a href="{{ route('admin.export.product.sales') }}" class="btn btn-outline-secondary mt-3">
    📥 Export Product Sales CSV
</a>
<a href="{{ route('admin.export.orders.ml') }}" class="btn btn-outline-primary">
    🧠 Export Orders for ML
</a>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card text-bg-primary shadow">
            <div class="card-body">
                <h5 class="card-title">📦 Total Orders</h5>
                <p class="display-6 fw-bold">{{ $totalOrders }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-success shadow">
            <div class="card-body">
                <h5 class="card-title">💰 Total Revenue</h5>
                <p class="display-6 fw-bold">UGX{{ number_format($totalRevenue, 2) }}</p>
                
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-warning shadow">
            <div class="card-body">
                <h5 class="card-title">👥 Total Customers</h5>
                <p class="display-6 fw-bold">{{ $totalCustomers }}</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card text-bg-info shadow">
            <div class="card-body">
                <h6 class="card-title">📬 Pending Orders</h6>
                <p class="h4">{{ $pendingOrders }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-secondary shadow">
            <div class="card-body">
                <h6 class="card-title">🚚 Shipped Orders</h6>
                <p class="h4">{{ $shippedOrders }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-bg-dark shadow">
            <div class="card-body">
                <h6 class="card-title">📦 Delivered Orders</h6>
                <p class="h4">{{ $deliveredOrders }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h5 class="card-title">⚙ Quick Actions</h5>
        <div class="d-flex flex-wrap gap-3">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary">
                🛒 Manage Orders
            </a>
            
        </div>
    </div>
</div>
<a href="{{ route('admin.inventory.index') }}" class="btn btn-primary">
    Go to Inventory
</a>
@endsection
