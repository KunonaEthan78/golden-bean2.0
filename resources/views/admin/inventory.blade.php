@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="fw-bold mb-4">☕ Coffee Inventory</h2>

    {{-- Search Form --}}
    <form method="GET" action="{{ route('admin.inventory') }}" class="mb-4 d-flex gap-2">
        <input type="text" name="search" placeholder="🔍 Search product or SKU" value="{{ request('search') }}" class="form-control" style="max-width: 300px;">
        <button type="submit" class="btn btn-coffee">Search</button>
        <a href="{{ route('admin.inventory') }}" class="btn btn-outline-secondary">Reset</a>
    </form>

    {{-- Inventory Table --}}
    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>SKU</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventoryItems as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ $item->sku }}</td>
                    <td @if($item->quantity < 10) class="text-danger fw-bold" @endif>{{ $item->quantity }}</td>
                    <td>UGX {{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->description ?? '-' }}</td>
                    <td>{{ $item->created_at->format('Y-m-d') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">No inventory items found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $inventoryItems->withQueryString()->links() }}
    </div>
</div>
@endsection
