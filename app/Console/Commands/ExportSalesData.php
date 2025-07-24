<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ExportSalesData extends Command
{
    protected $signature = 'export:sales-data';
    protected $description = 'Export sales and customer data for ML';

    public function handle()
    {
        $orders = Order::with(['items', 'user'])->get();
        $rows = [];
        foreach ($orders as $order) {
            foreach ($order->items as $item) {
                $rows[] = [
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'order_date' => $order->created_at,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                ];
            }
        }
        $csv = fopen(storage_path('app/sales_data.csv'), 'w');
        fputcsv($csv, ['order_id', 'user_id', 'order_date', 'product_id', 'quantity', 'price']);
        foreach ($rows as $row) {
            fputcsv($csv, $row);
        }
        fclose($csv);
        $this->info('Sales data exported to storage/app/sales_data.csv');
    }
}
