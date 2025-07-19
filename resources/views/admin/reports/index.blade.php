
@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">📊 Order Reports & Analytics</h2>
    <div class="mb-3 text-start">
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark">
        ← Back to Dashboard
    </a>
</div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-uppercase text-muted">Total Orders</h5>
                    <h2 class="text-primary">{{ $totalOrders }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-success shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-uppercase text-muted">Delivered Orders</h5>
                    <h2 class="text-success">{{ $deliveredOrders }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                    <h5 class="card-title text-uppercase text-muted">Pending Orders</h5>
                    <h2 class="text-warning">{{ $pendingOrders }}</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-dark shadow-sm">
        <div class="card-body text-center">
            <h5 class="card-title text-uppercase text-muted">Total Revenue</h5>
            <h2 class="text-dark">UGX {{ number_format($totalRevenue) }}</h2>
        </div>
    </div>
</div>
@endsection
