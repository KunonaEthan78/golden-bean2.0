@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Production Analytics & Recommendations</h1>
    <h3>Predicted Demand (Next 3 Months)</h3>
    <ul>
        @foreach($demand['predicted_quantities'] as $i => $qty)
            <li>Month {{ $i+1 }}: {{ round($qty) }} units</li>
        @endforeach
    </ul>
    <h3>Customer Segments</h3>
    <table class="table">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Segment</th>
            </tr>
        </thead>
        <tbody>
            @foreach($segments as $seg)
                <tr>
                    <td>{{ $seg['user_id'] }}</td>
                    <td>{{ $seg['segment'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Personalization Recommendations</h3>
    <ul>
        <li>Segment 0: High-value customers – Offer loyalty rewards and exclusive deals.</li>
        <li>Segment 1: Occasional buyers – Send personalized offers to increase frequency.</li>
        <li>Segment 2: New/low spenders – Provide onboarding and educational content.</li>
    </ul>
</div>
@endsection
