@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">✏️ Edit Inventory Item</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Validation Error(s):</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.inventory.update', $item->id) }}">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <label for="product_name" class="col-sm-2 col-form-label fw-semibold">Product Name</label>
            <div class="col-sm-10">
                <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $item->product_name) }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="sku" class="col-sm-2 col-form-label fw-semibold">SKU</label>
            <div class="col-sm-10">
                <input type="text" name="sku" class="form-control" value="{{ old('sku', $item->sku) }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="quantity" class="col-sm-2 col-form-label fw-semibold">Quantity</label>
            <div class="col-sm-10">
                <input type="number" name="quantity" class="form-control" value="{{ old('quantity', $item->quantity) }}" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="price" class="col-sm-2 col-form-label fw-semibold">Price</label>
            <div class="col-sm-10">
                <input type="text" name="price" class="form-control" value="{{ old('price', $item->price) }}" required>
            </div>
        </div>

        <div class="row mb-4">
            <label for="description" class="col-sm-2 col-form-label fw-semibold">Description</label>
            <div class="col-sm-10">
                <textarea name="description" class="form-control" rows="3">{{ old('description', $item->description) }}</textarea>
            </div>
        </div>

        <div class="text-end">
            <a href="{{ route('admin.inventory.index') }}" class="btn btn-outline-secondary me-2">⬅ Cancel</a>
            <button type="submit" class="btn btn-coffee">💾 Update Item</button>
        </div>
    </form>
</div>

{{-- Match your existing button theme --}}
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
