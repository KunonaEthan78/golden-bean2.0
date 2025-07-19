@extends('layouts.admin')

@section('content')
<div class="container py-4">
    <h2 class="text-center fw-bold text-dark mb-4">📋 All Orders – Admin Panel</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            ⬅ Back to Admin Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @forelse($orders as $order)
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <strong>📦 Order #{{ $order->id }}</strong> — UGX {{ number_format($order->total) }}
                </div>
                <small>📅 {{ $order->created_at->format('d M Y, h:i A') }}</small>
            </div>
            <div class="card-body">
                <p class="mb-2">
                    👤 <strong>Customer:</strong> {{ $order->user->name }}<br>
                    📍 <strong>Address:</strong> {{ $order->delivery_address }}
                </p>

                <ul class="list-group mb-3">
                    @foreach($order->items as $item)
                        <li class="list-group-item d-flex justify-content-between">
                            <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                            <span class="text-muted">UGX {{ number_format($item->price * $item->quantity) }}</span>
                        </li>
                    @endforeach
                </ul>

                <form method="POST" action="{{ route('admin.orders.updateStatus', $order->id) }}" class="d-flex align-items-center gap-2">
                    @csrf
                    <label for="status-{{ $order->id }}" class="form-label mb-0"><strong>Update Status:</strong></label>
                    <select id="status-{{ $order->id }}" name="status" class="form-select w-auto">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ $order->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                </form>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">No orders found.</div>
    @endforelse
</div>
@endsection
