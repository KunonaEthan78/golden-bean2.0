@extends('layouts.retailer')

@section('content')
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">📦 Your Orders from Wholesalers</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">You haven’t placed any orders from wholesalers yet.</div>
    @else
        @foreach($orders as $order)
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-light">
                    <strong>Order #{{ $order->id }}</strong> — 
                    <span class="badge bg-secondary text-uppercase">{{ $order->status }}</span><br>
                    
                    <small class="text-muted">Placed on: {{ $order->created_at->format('d M Y H:i') }}</small>

                    <a href="{{ route('retailer.wholesaler.invoice', $order->id) }}" class="btn btn-sm btn-outline-secondary">🧾 Download Invoice</a>

                </div>
                <div class="card-body">
                    <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                    <p><strong>Total:</strong> UGX {{ number_format($order->total) }}</p>
                    
                    <h6>Items:</h6>
                    <ul class="list-group">
                        @foreach($order->items as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $item->product->name }} ({{ $item->product->grade }}) 
                                <span>Qty: {{ $item->quantity }} × UGX {{ number_format($item->price) }}</span>
                            </li>
                            
                        @endforeach
                    </ul>
                </div>
            </div>
            
        @endforeach
    @endif
</div>
<a href="{{ route('retailer.dashboard') }}" class="btn btn-secondary mb-3">
    ← Back to Dashboard
</a>
@endsection
