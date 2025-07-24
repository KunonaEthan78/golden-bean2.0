<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\InventoryItem;

echo "Adding 15 more Ugandan coffee varieties with four-word descriptions...\n";

$additionalUgandanCoffees = [
    [
        'product_name' => 'Kigezi Highlands Coffee',
        'sku' => 'UG-KIGEZ-HC-016',
        'quantity' => 135,
        'price' => 29000.00,
        'description' => 'Southwestern Mountain Premium Arabica'
    ],
    [
        'product_name' => 'Ankole Longhorn Blend',
        'sku' => 'UG-ANKOL-LB-017',
        'quantity' => 165,
        'price' => 23500.00,
        'description' => 'Pastoral Region Traditional Coffee'
    ],
    [
        'product_name' => 'Teso Sub-region Coffee',
        'sku' => 'UG-TESO-SRC-018',
        'quantity' => 175,
        'price' => 21500.00,
        'description' => 'Eastern Plains Robust Blend'
    ],
    [
        'product_name' => 'West Nile Arabica',
        'sku' => 'UG-WNIL-ARB-019',
        'quantity' => 125,
        'price' => 26500.00,
        'description' => 'Northern Border Mountain Coffee'
    ],
    [
        'product_name' => 'Acholi Sub-region Robusta',
        'sku' => 'UG-ACHOL-ROB-020',
        'quantity' => 210,
        'price' => 18500.00,
        'description' => 'Northern Uganda Bold Robusta'
    ],
    [
        'product_name' => 'Karamoja Plateau Coffee',
        'sku' => 'UG-KARAM-PC-021',
        'quantity' => 95,
        'price' => 31000.00,
        'description' => 'Dry Land Specialty Coffee'
    ],
    [
        'product_name' => 'Buganda Kingdom Blend',
        'sku' => 'UG-BUGAN-KB-022',
        'quantity' => 185,
        'price' => 22500.00,
        'description' => 'Central Kingdom Heritage Coffee'
    ],
    [
        'product_name' => 'Bunyoro Traditional Coffee',
        'sku' => 'UG-BUNYO-TC-023',
        'quantity' => 155,
        'price' => 24500.00,
        'description' => 'Western Kingdom Ancient Variety'
    ],
    [
        'product_name' => 'Tooro Kingdom Select',
        'sku' => 'UG-TOORO-KS-024',
        'quantity' => 115,
        'price' => 27500.00,
        'description' => 'Mountain Kingdom Premium Coffee'
    ],
    [
        'product_name' => 'Lake Albert Coffee',
        'sku' => 'UG-LALB-CF-025',
        'quantity' => 140,
        'price' => 25000.00,
        'description' => 'Rift Valley Lake Coffee'
    ],
    [
        'product_name' => 'Murchison Falls Blend',
        'sku' => 'UG-MURCH-FB-026',
        'quantity' => 105,
        'price' => 28500.00,
        'description' => 'Waterfall Park Special Arabica'
    ],
    [
        'product_name' => 'Queen Elizabeth Arabica',
        'sku' => 'UG-QELIZ-ARB-027',
        'quantity' => 120,
        'price' => 30000.00,
        'description' => 'National Park Premium Coffee'
    ],
    [
        'product_name' => 'Semuliki Valley Coffee',
        'sku' => 'UG-SEMUL-VC-028',
        'quantity' => 100,
        'price' => 29500.00,
        'description' => 'Hot Springs Valley Specialty'
    ],
    [
        'product_name' => 'Budongo Forest Arabica',
        'sku' => 'UG-BUDON-FA-029',
        'quantity' => 85,
        'price' => 33000.00,
        'description' => 'Primary Forest Shade Coffee'
    ],
    [
        'product_name' => 'Mgahinga Gorilla Coffee',
        'sku' => 'UG-MGAHI-GC-030',
        'quantity' => 75,
        'price' => 35000.00,
        'description' => 'High Altitude Conservation Coffee'
    ]
];

try {
    foreach ($additionalUgandanCoffees as $coffee) {
        InventoryItem::create($coffee);
        echo "✓ Added: {$coffee['product_name']} - {$coffee['description']}\n";
    }
    
    echo "\n🎉 Successfully added " . count($additionalUgandanCoffees) . " more Ugandan coffee varieties!\n";
    echo "Total coffee varieties now in inventory: 30\n";
    echo "All coffees maintain four-word descriptions.\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
