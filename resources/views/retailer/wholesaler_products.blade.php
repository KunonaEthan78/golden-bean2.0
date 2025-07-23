@extends('layouts.retailer')

@section('content')
<div class="container py-5">
    <h2 class="text-center fw-bold text-primary mb-5">🛍 Wholesaler Coffee Products</h2>

    @if($products->isEmpty())
        <div class="alert alert-warning text-center">
            No products available from wholesalers at the moment.
        </div>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card shadow-sm w-100">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-success fw-bold">{{ $product->name }}</h5>
                            <p><strong>Grade:</strong> {{ $product->grade }}</p>
                            <p><strong>Quantity:</strong> {{ $product->quantity }}</p>
                            <p><strong>Price:</strong> UGX {{ number_format($product->price) }}</p>

                            {{-- ✅ Use correct route for wholesaler cart --}}
                            <form method="POST" action="{{ route('retailer.wholesaler.cart.add') }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-sm btn-primary mt-2 w-100">➕ Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>

                
            @endforeach
        </div>
    @endif
</div>
<a href="{{ route('retailer.dashboard') }}" class="btn btn-secondary mb-3">
    ← Back to Dashboard
</a>
@endsection
