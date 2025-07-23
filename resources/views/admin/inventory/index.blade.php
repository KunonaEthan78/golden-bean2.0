@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Coffee Inventory</h2>
    <div>
        <a href="{{ route('admin.inventory.create') }}" class="btn btn-coffee me-2">+ Add New Item</a>
        <a href="{{ route('admin.inventory.export') }}" class="btn btn-secondary">⬇️ Export to Excel</a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form method="GET" action="{{ route('admin.inventory.index') }}" class="row g-2 mb-4">
    <div class="col-md-4">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search product or SKU">
    </div>
    <div class="col-md-3">
        <select name="sort_by" class="form-select">
            <option value="">Sort By</option>
            <option value="quantity" {{ request('sort_by') == 'quantity' ? 'selected' : '' }}>Quantity</option>
            <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Price</option>
            <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>Date</option>
        </select>
    </div>
    <div class="col-md-2">
        <select name="order" class="form-select">
            <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Asc</option>
            <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Desc</option>
        </select>
    </div>
    <div class="col-md-3">
        <button class="btn btn-coffee me-2" type="submit">Apply</button>
        <a href="{{ route('admin.inventory.index') }}" class="btn btn-outline-secondary">Reset</a>
    </div>
</form>

@if($items->isEmpty())
    <div class="alert alert-warning">No inventory items found.</div>
@else
<style>
    .summary-card {
        border-radius: 0.5rem;
        padding: 1.5rem;
        height: 100%;
        width: 100%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .bg-golden {
        background-color: #d4af37; /* Golden */
        color: #4b2e05;
    }

    .bg-coffee {
        background-color: #4b2e05; /* Coffee Brown */
        color: #fff5e1;
    }
</style>

<div class="container my-4">
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col d-flex">
            <div class="summary-card bg-golden text-center d-flex flex-column justify-content-center">
                <h5>Total Products</h5>
                <h3>{{ $totalProducts }}</h3>
            </div>
        </div>

        <div class="col d-flex">
            <div class="summary-card bg-coffee text-center d-flex flex-column justify-content-center">
                <h5>Total Stock Value</h5>
                <h3>UGX {{ number_format($totalStockValue, 2) }}</h3>
            </div>
        </div>

        <div class="col d-flex">
            <div class="summary-card bg-golden text-center d-flex flex-column justify-content-center">
                <h5>Low Stock Items</h5>
                <h3>{{ $lowStockCount }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-bordered align-middle text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product</th>
                <th>SKU</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Description</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->sku }}</td>
                <td class="{{ $item->quantity < 10 ? 'text-danger fw-bold' : '' }}">{{ $item->quantity }}</td>
                <td>UGX{{ number_format($item->price, 2) }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                <td>
                    <div class="d-flex justify-content-center gap-2">
                        <a href="{{ route('admin.inventory.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('admin.inventory.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Delete this item?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
