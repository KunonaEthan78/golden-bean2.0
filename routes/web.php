<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ✅ Admin + General Controllers
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\ExportController;

// ✅ Retailer Controllers (CORRECT NAMESPACE)
use App\Http\Controllers\Retailer\RetailerProductController;
use App\Http\Controllers\Retailer\CartController as RetailerCartController;
use App\Http\Controllers\Retailer\WholesalerCartController;
use App\Http\Controllers\Retailer\RetailerWholesalerOrderController;

// ✅ Wholesaler Controllers
use App\Http\Controllers\Wholesaler\WholesalerProductController;
use App\Http\Controllers\Wholesaler\WholesalerOrderController;
use App\Http\Controllers\Wholesaler\WholesalerProductBrowseController;

// ✅ Cooperative Controllers
use App\Http\Controllers\CoffeeBatchController;

// ✅ Customer Controllers
use App\Http\Controllers\Customer\ProductController as CustomerProductController;
use App\Http\Controllers\Customer\CartController as CustomerCartController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;

use App\Models\WholesalerProduct;







use App\Http\Controllers\AdminInventoryController;


Route::prefix('admin-inventory')->group(function () {
    Route::get('/', [AdminInventoryController::class, 'index'])->name('admin.inventory.index');
    Route::get('/create', [AdminInventoryController::class, 'create'])->name('admin.inventory.create');
    Route::post('/', [AdminInventoryController::class, 'store'])->name('admin.inventory.store');
    Route::get('/{id}/edit', [AdminInventoryController::class, 'edit'])->name('admin.inventory.edit');
    Route::put('/{id}', [AdminInventoryController::class, 'update'])->name('admin.inventory.update');
    Route::delete('/{id}', [AdminInventoryController::class, 'destroy'])->name('admin.inventory.destroy');
});


Route::get('/admin-inventory', function () {
    $harvestBatches = HarvestBatch::all(); // fetch all harvest batches from DB
    return view('admin.inventory', compact('harvestBatches'));
})->name('admin.inventory');

Route::get('/admin-inventory', [AdminInventoryController::class, 'index'])->name('admin.inventory');






// Cooperative dashboard route


// Optional: General dashboard (if you still want it)
Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');

// Profile routes accessible without login (consider securing later)
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/security', [ProfileController::class, 'security'])->name('profile.security');
Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Harvest Batch resource routes open to all
Route::resource('harvest-batches', HarvestBatchController::class);

// Farm profiles accessible by anyone
Route::get('/farms/{farm}', [FarmController::class, 'show'])->name('farms.show');

// Coffee grade view accessible by anyone
Route::get('/grades/{grade}', [CoffeeGradeController::class, 'show'])->name('grades.show');


Route::prefix('admin-inventory')->controller(AdminInventoryController::class)->name('admin.inventory.')->group(function () {
    Route::get('/', 'index')->name('index'); // admin.inventory.index
    Route::get('/create', 'create')->name('create'); // admin.inventory.create
    Route::post('/', 'store')->name('store'); // admin.inventory.store
    Route::get('/{id}/edit', 'edit')->name('edit'); // admin.inventory.edit
    Route::put('/{id}', 'update')->name('update'); // admin.inventory.update
    Route::delete('/{id}', 'destroy')->name('destroy'); // admin.inventory.destroy
});
Route::get('/admin-inventory/export', [AdminInventoryController::class, 'export'])->name('admin.inventory.export');

use App\Http\Controllers\VendorApplicationController;
use App\Livewire\Chat;


Route::get('/', function () {
    return view('welcome');
});


// ✅ RETAILER ROUTES
Route::middleware(['auth'])->prefix('retailer')->name('retailer.')->group(function () {
    Route::get('/', fn() => view('retailer.retailer'))->name('dashboard');

    // Retailer Products
    Route::get('/products', [RetailerProductController::class, 'index'])->name('products');
    Route::get('/products/create', [RetailerProductController::class, 'create'])->name('products.create');
    Route::post('/products', [RetailerProductController::class, 'store'])->name('products.store');

    // Browse wholesaler products
    Route::get('/wholesaler-products', [WholesalerProductBrowseController::class, 'showWholesalerProducts'])->name('wholesaler.products');

    // Retailer Cart
    Route::get('/cart', [RetailerCartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [RetailerCartController::class, 'add'])->name('cart.add');
    Route::post('/cart/increase/{id}', [RetailerCartController::class, 'increase'])->name('cart.increase');
    Route::post('/cart/decrease/{id}', [RetailerCartController::class, 'decrease'])->name('cart.decrease');
    Route::delete('/cart/remove/{id}', [RetailerCartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [RetailerCartController::class, 'clear'])->name('cart.clear');

    // Wholesaler Cart (Retailer)
    Route::get('/wholesaler-cart', [WholesalerCartController::class, 'index'])->name('wholesaler.cart');
    Route::post('/wholesaler-cart/add', [WholesalerCartController::class, 'add'])->name('wholesaler.cart.add');
    Route::delete('/wholesaler-cart/remove/{id}', [WholesalerCartController::class, 'remove'])->name('wholesaler.cart.remove');
    Route::post('/wholesaler-cart/clear', [WholesalerCartController::class, 'clear'])->name('wholesaler.cart.clear');
    Route::get('/wholesaler-cart/checkout', [RetailerWholesalerOrderController::class, 'create'])->name('wholesaler.checkout');
    Route::post('/wholesaler-cart/checkout', [RetailerWholesalerOrderController::class, 'store'])->name('wholesaler.checkout.store');
    Route::get('/wholesaler-orders', [RetailerWholesalerOrderController::class, 'index'])->name('wholesaler.orders');
    Route::get('/wholesaler-orders/{order}/invoice', [RetailerWholesalerOrderController::class, 'generateInvoice'])->name('wholesaler.invoice');
});


// ✅ RETAILER → CUSTOMER ORDER ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
    Route::get('/checkout', [OrderController::class, 'create'])->name('orders.checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}/invoice', [OrderController::class, 'generateInvoice'])->name('orders.invoice');
});


// ✅ COOPERATIVE ROUTES
Route::middleware(['auth'])->prefix('cooperative')->name('cooperative.')->group(function () {
    Route::get('/', fn() => view('cooperative.cooperative'))->name('dashboard');

    Route::prefix('batches')->name('batches.')->group(function () {
        Route::get('/', [CoffeeBatchController::class, 'index'])->name('index');
        Route::get('/create', [CoffeeBatchController::class, 'create'])->name('create');
        Route::post('/', [CoffeeBatchController::class, 'store'])->name('store');
    });
});


// ✅ WHOLESALER ROUTES
Route::middleware(['auth'])->prefix('wholesaler')->name('wholesaler.')->group(function () {
    Route::get('/', function () {
        $products = WholesalerProduct::where('wholesaler_id', Auth::id())->latest()->get();
        return view('wholesaler.wholesaler', compact('products'));
    })->name('dashboard');

    Route::get('/orders', [WholesalerOrderController::class, 'index'])->name('orders.index');
    Route::get('/products', [WholesalerProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [WholesalerProductController::class, 'create'])->name('products.create');
    Route::post('/products', [WholesalerProductController::class, 'store'])->name('products.store');
    Route::post('/orders/{order}/status', [WholesalerOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});


// ✅ ADMIN ROUTES
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    Route::get('/reports', [ReportsController::class, 'index'])->name('reports.index');

    

});Route::get('/admin/export/orders-ml', [App\Http\Controllers\AdminOrderController::class, 'exportOrdersForML'])->name('admin.export.orders.ml');


Route::get('/admin/export/products-sales', [App\Http\Controllers\AdminOrderController::class, 'exportProductSales'])->name('admin.export.product.sales');

Route::get('/admin/export-orders', [ExportController::class, 'exportOrderData'])->name('admin.export.orders');


    Route::get('/admin/analytics', [AdminDashboardController::class, 'analytics'])->name('admin.analytics');

Route::middleware(['auth', 'admin'])->get('/admin/analytics', [AnalyticsController::class, 'dashboard'])->name('admin.analytics');

// ✅ CUSTOMER ROUTES
Route::middleware(['auth'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/', fn() => view('customer.customer'))->name('dashboard');

    Route::get('/products', [CustomerProductController::class, 'index'])->name('products');

    

    Route::post('/customer/cart/add', [App\Http\Controllers\Customer\CartController::class, 'add'])->name('customer.cart.add');

    Route::get('/cart', [CustomerCartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CustomerCartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CustomerCartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CustomerCartController::class, 'clear'])->name('cart.clear');

    Route::get('/checkout', [CustomerOrderController::class, 'create'])->name('checkout');
    Route::post('/checkout', [CustomerOrderController::class, 'store'])->name('checkout.store');
    Route::get('/orders', [CustomerOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}/invoice', [CustomerOrderController::class, 'generateInvoice'])->name('orders.invoice');
});


// ✅ ROLE-BASED REDIRECT AFTER LOGIN
Route::get('/redirect-after-login', function () {
    $user = Auth::user();

    if ($user->is_admin) return redirect()->route('admin.dashboard');
    if ($user->role === 'retailer') return redirect()->route('retailer.dashboard');
    if ($user->role === 'cooperative') return redirect()->route('cooperative.dashboard');
    if ($user->role === 'wholesaler') return redirect()->route('wholesaler.dashboard');
    if ($user->role === 'customer') return redirect()->route('customer.dashboard');

    return redirect()->route('dashboard');
})->middleware('auth');


// ✅ GENERAL DASHBOARD & PROFILE
Route::get('/dashboard', fn() => view('dashboard'))->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

// ✅ VENDOR APPLICATION ROUTES
Route::middleware(['auth'])->group(function () {
    Route::get('/vendor-application', [VendorApplicationController::class, 'showForm'])->name('vendor.application');
    Route::post('/vendor-application', [VendorApplicationController::class, 'submit']);
});

// ✅ LIVEWIRE CHAT
Route::middleware(['auth'])->get('/chat', Chat::class)->name('chat');


require __DIR__.'/auth.php';
