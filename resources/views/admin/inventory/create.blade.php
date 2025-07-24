@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">➕ Add New Inventory Item</h2>

    <form action="{{ route('admin.inventory.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <label for="product_name" class="col-sm-2 col-form-label fw-semibold">Product Name</label>
            <div class="col-sm-10">
                <select name="product_name" class="form-select" required>
                    <option value="">-- Select Product --</option>
                    <option value="Coffee Beans">Coffee Beans</option>
                    <option value="Espresso Machine">Espresso Machine</option>
                    <option value="Coffee Grinder">Coffee Grinder</option>
                    <option value="Cold Brew Bottles">Cold Brew Bottles</option>
                    <option value="Coffee Filters (Pack of 100)">Coffee Filters (Pack of 100)</option>
                    <option value="French Press">French Press</option>
                    <option value="Latte Cups (Set of 4)">Latte Cups (Set of 4)</option>
                    <option value="Organic Arabica Beans">Organic Arabica Beans</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <label for="sku" class="col-sm-2 col-form-label fw-semibold">SKU</label>
            <div class="col-sm-10">
                <select name="sku" class="form-select" required>
                    <option value="">-- Select SKU --</option>
                    <option value="COF123">COF123</option>
                    <option value="ESP456">ESP456</option>
                    <option value="GRD789">GRD789</option>
                    <option value="CLD001">CLD001</option>
                    <option value="FLT100">FLT100</option>
                    <option value="FRP456">FRP456</option>
                    <option value="CUP004">CUP004</option>
                    <option value="ARB789">ARB789</option>
                </select>
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
