<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Models\Order;

class AdminOrderController extends Controller
{
    // View all orders in the admin dashboard
    public function index()
    {
        $orders = Order::with('user', 'items.product')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Update order status (pending, shipped, delivered)
    public function updateStatus(Order $order, Request $request)
    {
        $request->validate([
            'status' => 'required|string|in:pending,shipped,delivered',
        ]);

        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Order status updated.');
    }

    // ✅ Export product sales for machine learning
    public function exportProductSales()
    {
        $products = DB::table('order_items')
        ->join('products', 'order_items.product_id', '=', 'products.id')
        ->select(
            'products.id as product_id',
            'products.name as product_name',
            DB::raw('SUM(order_items.quantity) as quantity_sold'),
            DB::raw('SUM(order_items.quantity * order_items.price) as total_revenue'),
            DB::raw('MIN(order_items.created_at) as first_sold'),
            DB::raw('MAX(order_items.created_at) as last_sold')
        )
        ->groupBy('products.id', 'products.name')
        ->get();

    $csv = "product_id,product_name,quantity_sold,total_revenue,first_sold,last_sold\n";

    

    foreach ($products as $product) {
        $csv .= "{$product->product_id},\"{$product->product_name}\",{$product->quantity_sold},{$product->total_revenue},{$product->first_sold},{$product->last_sold}\n";
    }
    return Response::make($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename=product_sales.csv',

    ]);
        

    }

    public function exportOrdersForML()
{
    $orders = Order::select('id', 'total', 'status', 'created_at')->get();

    $csv = "id,total,status,created_at\n";

    foreach ($orders as $order) {
        $csv .= "{$order->id},{$order->total},{$order->status},{$order->created_at}\n";
    }

    return \Response::make($csv, 200, [
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename=orders_ml.csv',

    ]);
        
}
    
}
