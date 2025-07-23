@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Inventory Items</h1>

    <form method="GET" action="{{ route('admin.inventory') }}">
        <input type="text" name="search" placeholder="Search product or SKU" value="{{ request('search') }}">
        <button type="submit">Search</button>
    </form>

    <table border="1" cellpadding="8" cellspacing="0" style="width:100%; margin-top:20px;">
        <thead>
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
                <td>{{ $item->quantity }}</td>
                <td>UGX{{ number_format($item->price, 2) }}</td>
                <td>{{ $item->description }}</td>
                <td>{{ $item->created_at->format('Y-m-d') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7">No inventory items found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    

    <div style="margin-top: 20px;">
        {{ $inventoryItems->withQueryString()->links() }}
    </div>
</div>

@endsection
