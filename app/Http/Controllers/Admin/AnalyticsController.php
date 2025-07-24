<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class AnalyticsController extends Controller
{
    public function dashboard()
    {
        // Get data from database instead of CSV file
        $orders = Order::with(['items', 'user'])->get();
        
        // Convert to array format for ML service
        $salesData = [];
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $salesData[] = [
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'order_date' => $order->created_at->format('Y-m-d H:i:s'),
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ];
            }
        }

        // Default values if no data or ML service unavailable
        $demand = [
            'future_months' => [30, 60, 90],
            'predicted_quantities' => [100, 120, 95]
        ];
        
        $segments = [
            ['user_id' => 4, 'segment' => 0],
            ['user_id' => 7, 'segment' => 1],
            ['user_id' => 2, 'segment' => 2],
        ];

        // Try to call ML service if available and we have data
        if (!empty($salesData)) {
            try {
                // Demand prediction
                $demandResponse = Http::timeout(10)->post('http://127.0.0.1:5001/predict-demand', [
                    'sales' => $salesData
                ]);
                
                if ($demandResponse->successful()) {
                    $demand = $demandResponse->json();
                }

                // Customer segmentation
                $segmentResponse = Http::timeout(10)->post('http://127.0.0.1:5001/segment-customers', [
                    'sales' => $salesData
                ]);
                
                if ($segmentResponse->successful()) {
                    $segments = $segmentResponse->json();
                }
            } catch (\Exception $e) {
                // ML service not available, use default data
                \Log::info('ML service not available: ' . $e->getMessage());
            }
        }

        return view('admin.analytics', compact('demand', 'segments'));
    }
}
