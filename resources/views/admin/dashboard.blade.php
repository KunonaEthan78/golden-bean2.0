@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-0 text-coffee-dark">
                        <i class="fas fa-coffee text-warning"></i> 
                        Golden Bean Admin Dashboard
                    </h1>
                    <p class="text-muted mb-0">Welcome back! Here's what's happening in your coffee business.</p>
                </div>
                <div class="text-end">
                    <small class="text-muted">Last updated: {{ now()->format('M d, Y H:i') }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar-md rounded-circle bg-primary-subtle d-flex align-items-center justify-content-center">
                                <i class="fas fa-shopping-cart text-primary fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Orders</h6>
                            <h4 class="mb-0">{{ $totalOrders }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar-md rounded-circle bg-success-subtle d-flex align-items-center justify-content-center">
                                <i class="fas fa-dollar-sign text-success fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Revenue</h6>
                            <h4 class="mb-0">UGX {{ number_format($totalRevenue, 0) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar-md rounded-circle bg-warning-subtle d-flex align-items-center justify-content-center">
                                <i class="fas fa-users text-warning fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Total Customers</h6>
                            <h4 class="mb-0">{{ $totalCustomers }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="avatar-md rounded-circle bg-info-subtle d-flex align-items-center justify-content-center">
                                <i class="fas fa-clock text-info fs-4"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0 text-muted">Pending Orders</h6>
                            <h4 class="mb-0">{{ $pendingOrders }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Status Overview -->
    <div class="row g-4 mb-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar text-primary"></i> Order Status Overview
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-4">
                            <div class="border-end">
                                <h4 class="text-warning mb-1">{{ $pendingOrders }}</h4>
                                <p class="text-muted mb-0">Pending</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border-end">
                                <h4 class="text-info mb-1">{{ $shippedOrders }}</h4>
                                <p class="text-muted mb-0">Shipped</p>
                            </div>
                        </div>
                        <div class="col-4">
                            <h4 class="text-success mb-1">{{ $deliveredOrders }}</h4>
                            <p class="text-muted mb-0">Delivered</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie text-success"></i> Quick Stats
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Completion Rate</span>
                        <span class="fw-bold">{{ $totalOrders > 0 ? round(($deliveredOrders / $totalOrders) * 100, 1) : 0 }}%</span>
                    </div>
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: {{ $totalOrders > 0 ? ($deliveredOrders / $totalOrders) * 100 : 0 }}%"></div>
                    </div>
                    <small class="text-muted">Based on delivered orders</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Management Actions -->
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-cogs text-primary"></i> Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-6">
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-shopping-cart me-2"></i>
                                Manage Orders
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.inventory.index') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-boxes me-2"></i>
                                Inventory
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.analytics') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-chart-line me-2"></i>
                                Analytics
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('admin.reports.index') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-file-alt me-2"></i>
                                Reports
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="{{ route('chat') }}" class="btn btn-outline-dark w-100">
                                <i class="fas fa-comments me-2"></i>
                                Chat & Messages
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-transparent border-bottom">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-download text-secondary"></i> Data Export
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <a href="{{ route('admin.export.product.sales') }}" class="btn btn-outline-secondary w-100">
                                <i class="fas fa-file-csv me-2"></i>
                                Export Product Sales (CSV)
                            </a>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('admin.export.orders.ml') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-brain me-2"></i>
                                Export Orders for ML Analysis
                            </a>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('admin.export.orders') }}" class="btn btn-outline-dark w-100">
                                <i class="fas fa-file-export me-2"></i>
                                Export All Order Data
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-md {
    width: 3rem;
    height: 3rem;
}

.bg-primary-subtle {
    background-color: rgba(13, 110, 253, 0.1) !important;
}

.bg-success-subtle {
    background-color: rgba(25, 135, 84, 0.1) !important;
}

.bg-warning-subtle {
    background-color: rgba(255, 193, 7, 0.1) !important;
}

.bg-info-subtle {
    background-color: rgba(13, 202, 240, 0.1) !important;
}

.text-coffee-dark {
    color: #4B371C;
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.btn {
    transition: all 0.2s ease-in-out;
}

.btn:hover {
    transform: translateY(-1px);
}
</style>
@endsection
