@extends('layouts.retailer')

@section('content')
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">🛒 Wholesaler Cart</h2>

    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <div class="alert alert-info text-center">Your wholesaler cart is empty.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Grade</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $id => $item)
                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['grade'] }}</td>
                        <td>UGX {{ number_format($item['price']) }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>UGX {{ number_format($subtotal) }}</td>
                    </tr>
                @endforeach
                <tr class="fw-bold table-info">
                    <td colspan="4">Total</td>
                    <td>UGX {{ number_format($total) }}</td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-between">
            <form action="{{ route('retailer.wholesaler.cart.clear') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">🗑 Clear Cart</button>
            </form>

            <a href="{{ route('retailer.wholesaler.checkout') }}" class="btn btn-success">✅ Proceed to Checkout</a>
        </div>
    @endif
</div>
<a href="{{ route('retailer.dashboard') }}" class="btn btn-secondary mb-3">
    ← Back to Dashboard
</a>
@endsection
