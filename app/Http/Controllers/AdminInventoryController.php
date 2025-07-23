<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;
use App\Exports\InventoryItemsExport;
use Maatwebsite\Excel\Facades\Excel;



class AdminInventoryController extends Controller
{
    public function index(Request $request)
{
    // Your existing query for items with search & sorting
    $query = InventoryItem::query();

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where('product_name', 'like', "%{$search}%")
              ->orWhere('sku', 'like', "%{$search}%");
    }

    if ($request->filled('sort_by')) {
        $order = $request->input('order', 'asc');
        $query->orderBy($request->input('sort_by'), $order);
    } else {
        $query->orderBy('created_at', 'desc');
    }

    $items = $query->paginate(10);

    // Dashboard summary calculations
    $totalProducts = InventoryItem::count();

    // Calculate total stock value (sum of price * quantity)
    $totalStockValue = InventoryItem::sum(\DB::raw('price * quantity'));

    // Count items with low stock (quantity less than 10)
    $lowStockCount = InventoryItem::where('quantity', '<', 10)->count();

    return view('admin.inventory.index', compact(
        'items', 'totalProducts',  'totalStockValue', 'lowStockCount'
    ));
}



    public function create()
    {
        return view('admin.inventory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:inventory_items,sku',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        InventoryItem::create($validated);

        return redirect()->route('admin.inventory.index')->with('success', 'Inventory item created.');
    }

    public function edit($id)
    {
        $item = InventoryItem::findOrFail($id);
        return view('admin.inventory.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = InventoryItem::findOrFail($id);

        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:inventory_items,sku,' . $item->id,
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $item->update($validated);

        return redirect()->route('admin.inventory.index')->with('success', 'Inventory item updated.');
    }

    public function destroy($id)
    {
        $item = InventoryItem::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.inventory.index')->with('success', 'Inventory item deleted.');
    }
    public function export()
{
    return Excel::download(new InventoryItemsExport, 'inventory.xlsx');
}
}
