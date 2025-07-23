<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryItem extends Model
{
    protected $fillable = [
        'product_name',
        'sku',
        'quantity',
        'price',
        'description',
    ];
}
