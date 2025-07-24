@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">➕ Add New Inventory Item</h2>

    <form action="{{ route('admin.inventory.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <label for="product_name" class="col-sm-2 col-form-label fw-semibold">Product Name</label>
            <div class="col-sm-10">
                <input type="text" name="product_name" class="form-control" placeholder="Enter product name (e.g., Mubende Bourbon Arabica, Bugisu Blue Mountain, etc.)" required>
                <small class="form-text text-muted">Enter the full name of the coffee variety or product</small>
            </div>
        </div>

        <div class="row mb-3">
            <label for="sku" class="col-sm-2 col-form-label fw-semibold">SKU</label>
            <div class="col-sm-10">
                <input type="text" name="sku" class="form-control" placeholder="Enter unique SKU (e.g., MUB-001, BUG-002, KAS-003)" required>
                <small class="form-text text-muted">Use a unique identifier like region-number format</small>
            </div>
        </div>

        <div class="row mb-3">
            <label for="quantity" class="col-sm-2 col-form-label fw-semibold">Quantity</label>
            <div class="col-sm-10">
                <input type="number" name="quantity" class="form-control" min="0" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="price" class="col-sm-2 col-form-label fw-semibold">Price</label>
            <div class="col-sm-10">
                <input type="text" name="price" class="form-control" placeholder="UGX" required>
            </div>
        </div>

        <div class="row mb-4">
            <label for="description" class="col-sm-2 col-form-label fw-semibold">Description</label>
            <div class="col-sm-10">
                <textarea name="description" class="form-control" rows="3" placeholder="Optional notes..."></textarea>
            </div>
        </div>

        <div class="text-end">
            <a href="{{ route('admin.inventory.index') }}" class="btn btn-outline-secondary me-2">⬅ Back</a>
            <button type="submit" class="btn btn-coffee">☕ Add Item</button>
        </div>
    </form>
</div>

{{-- Style to match summary cards and buttons --}}
<style>
    .btn-coffee {
        background-color: #8b5e3c;
        color: white;
    }

    .btn-coffee:hover {
        background-color: #a9744f;
        color: white;
    }
</style>
@endsection
