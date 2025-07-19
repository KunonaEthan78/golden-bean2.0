<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('total_price');
        $pendingOrders = Order::where('status', 'pending')->count();
        $shippedOrders = Order::where('status', 'shipped')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $totalCustomers = User::where('is_admin', false)->count();
        $totalProducts = Product::count();
       
        return view('admin.dashboard', compact(
            'totalOrders',
            'totalRevenue',
            'pendingOrders',
            'shippedOrders',
            'deliveredOrders',
            'totalCustomers',
            'totalProducts'

        ));
           
    }

    
    
    public function analytics()
{
    $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')
                           ->groupBy('status')
                           ->pluck('count', 'status');

    $totalRevenue = Order::sum('total');
    $totalOrders = Order::count();
    $avgOrderValue = $totalOrders > 0 ? round($totalRevenue / $totalOrders, 2) : 0;

    $topProducts = \DB::table('order_items')
                    ->join('products', 'order_items.product_id', '=', 'products.id')
                    ->select('products.name', \DB::raw('COUNT(*) as total'))
                    ->groupBy('products.name')
                    ->orderByDesc('total')
                    ->limit(5)
                    ->pluck('total', 'products.name');

    // ✅ Add this line to fix the error:
    $recentOrders = Order::with('user')->latest()->take(5)->get();

    return view('admin.analytics', compact(
        'ordersByStatus',
        'totalRevenue',
        'totalOrders',
        'avgOrderValue',
        'topProducts',
        'recentOrders'
    ));
       
}
    

}
