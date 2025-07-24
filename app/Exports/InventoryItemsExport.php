<?php
namespace App\Exports;

use App\Models\InventoryItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Exports\InventoryItemsExport;

class InventoryItemsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return InventoryItem::select('id', 'product_name', 'sku', 'quantity', 'price', 'description', 'created_at')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Product Name', 'SKU', 'Quantity', 'Price', 'Description', 'Created At'];
    }
}
