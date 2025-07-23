@extends('layouts.app')

@section('content')
<h2>Edit Inventory Item</h2>

@if ($errors->any())
    <div style="color: red;">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.inventory.update', $item->id) }}">
    @csrf
    @method('PUT')
    <label>Product Name:</label><br>
    <input type="text" name="product_name" value="{{ old('product_name', $item->product_name) }}"><br><br>

    <label>SKU:</label><br>
    <input type="text" name="sku" value="{{ old('sku', $item->sku) }}"><br><br>

    <label>Quantity:</label><br>
    <input type="number" name="quantity" value="{{ old('quantity', $item->quantity) }}"><br><br>

    <label>Price:</label><br>
    <input type="text" name="price" value="{{ old('price', $item->price) }}"><br><br>

    <label>Description:</label><br>
    <textarea name="description">{{ old('description', $item->description) }}</textarea><br><br>

    <button type="submit">Update Item</button>
</form>

<a href="{{ route('admin.inventory.index') }}">Back to Inventory List</a>
@endsection
