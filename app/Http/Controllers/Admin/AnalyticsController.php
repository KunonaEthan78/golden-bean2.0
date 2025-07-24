<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AnalyticsController extends Controller
{
    public function dashboard()
    {
        $sales = array_map('str_getcsv', file(storage_path('app/sales_data.csv')));
        $header = array_shift($sales);
        $salesData = array_map(function($row) use ($header) {
            return array_combine($header, $row);
        }, $sales);

        // Demand prediction
        $demandResponse = Http::post('http://127.0.0.1:5001/predict-demand', [
            'sales' => $salesData
        ]);
        $demand = $demandResponse->json();

        // Customer segmentation
        $segmentResponse = Http::post('http://127.0.0.1:5001/segment-customers', [
            'sales' => $salesData
        ]);
        $segments = $segmentResponse->json();

        return view('admin.analytics', compact('demand', 'segments'));
    }
}
