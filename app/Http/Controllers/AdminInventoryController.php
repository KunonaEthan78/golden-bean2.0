<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;
use App\Exports\InventoryItemsExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminInventoryController extends Controller
{
    // Display list of inventory items with search & sorting
   public function index(Request $request)
{
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

    $totalProducts = InventoryItem::count();
    $totalStockValue = InventoryItem::sum(\DB::raw('price * quantity'));
    $lowStockCount = InventoryItem::where('quantity', '<', 10)->count();

    return view('admin.inventory.index', [
    'items' => $items,
    'totalProducts' => $totalProducts,
    'totalStockValue' => $totalStockValue,
    'lowStockCount' => $lowStockCount,
]);

}


    // Show form to create a new inventory item
    public function create()
    {
        return view('admin.inventory.create');
    }

    // Store new inventory item in database
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

    // Show form to edit existing inventory item
    public function edit($id)
    {
        $item = InventoryItem::findOrFail($id);
        return view('admin.inventory.edit', compact('item'));
    }

    // Update inventory item in database
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

    // Delete inventory item
    public function destroy($id)
    {
        $item = InventoryItem::findOrFail($id);
        $item->delete();

        return redirect()->route('admin.inventory.index')->with('success', 'Inventory item deleted.');
    }

    // Export inventory items to Excel
    public function export()
    {
        return Excel::download(new InventoryItemsExport, 'inventory.xlsx');
    }
}
