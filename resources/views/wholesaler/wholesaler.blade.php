@extends('layouts.wholesaler')

@section('content')
<div class="container py-4">
    <h2 class="text-center text-primary mb-4">📦 My Uploaded Products</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($products->isEmpty())
        <div class="alert alert-info text-center">No products uploaded yet.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Grade</th>
                    <th>Quantity</th>
                    <th>Price (UGX)</th>
                    <th>Uploaded At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                    <tr>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->grade }}</td>
                        <td>{{ $p->quantity }}</td>
                        <td>{{ number_format($p->price) }}</td>
                        <td>{{ $p->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('chat') }}" class="btn btn-outline-info me-2">
            <i class="fas fa-comments"></i> Chat & Messages
        </a>
        <a href="{{ route('admin.inventory.index') }}" class="btn btn-primary">
            Go to Inventory
        </a>
    </div>
</div>
@endsection
