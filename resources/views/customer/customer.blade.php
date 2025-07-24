@extends('layouts.customer')

@section('content')
<div class="text-center">
    <h2 class="text-success mb-4">👋 Welcome to the Golden Bean Customer Portal</h2>
    <p class="lead">Browse coffee products, manage your cart, and track your orders seamlessly.</p>

    <div class="mt-4 d-flex justify-content-center gap-4 flex-wrap">
        <a href="{{ route('customer.products') }}" class="btn btn-outline-primary btn-lg">
            <i class="fas fa-mug-hot"></i> Browse Products
        </a>
        <a href="{{ route('customer.cart') }}" class="btn btn-outline-success btn-lg">
            <i class="fas fa-shopping-cart"></i> View Cart
        </a>
        <a href="{{ route('customer.orders.index') }}" class="btn btn-outline-dark btn-lg">
            <i class="fas fa-box"></i> Order History
        </a>
        <a href="{{ route('chat') }}" class="btn btn-outline-info btn-lg">
            <i class="fas fa-comments"></i> Chat & Support
        </a>
    </div>
</div>
@endsection
