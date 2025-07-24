<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InventoryItem;

class CoffeeInventorySeeder extends Seeder
{
    public function run()
    {
        $ugandanCoffeeTypes = [
            [
                'product_name' => 'Uganda Bugisu AA',
                'sku' => 'UG-BUGISU-AA-001',
                'quantity' => 150,
                'price' => 25000,
                'description' => 'Premium Mount Elgon Arabica'
            ],
            [
                'product_name' => 'Rwenzori Mountains Arabica',
                'sku' => 'UG-RWENZ-ARB-002',
                'quantity' => 120,
                'price' => 28000,
                'description' => 'High Altitude Mountain Coffee'
            ],
            [
                'product_name' => 'Sipi Falls Coffee',
                'sku' => 'UG-SIPI-CF-003',
                'quantity' => 200,
                'price' => 22000,
                'description' => 'Waterfall Region Organic Beans'
            ],
            [
                'product_name' => 'Kapchorwa Highland Coffee',
                'sku' => 'UG-KAPCH-HC-004',
                'quantity' => 180,
                'price' => 26000,
                'description' => 'Eastern Highland Premium Arabica'
            ],
            [
                'product_name' => 'Mbale District Coffee',
                'sku' => 'UG-MBALE-DC-005',
                'quantity' => 160,
                'price' => 24000,
                'description' => 'Traditional Bugisu Regional Blend'
            ],
            [
                'product_name' => 'Robusta Mukono Beans',
                'sku' => 'UG-MUKON-ROB-006',
                'quantity' => 250,
                'price' => 18000,
                'description' => 'Central Uganda Strong Robusta'
            ],
            [
                'product_name' => 'Luwero Triangle Coffee',
                'sku' => 'UG-LUWER-TC-007',
                'quantity' => 140,
                'price' => 20000,
                'description' => 'Mid Altitude Regional Specialty'
            ],
            [
                'product_name' => 'Kasese Arabica Blend',
                'sku' => 'UG-KASES-AB-008',
                'quantity' => 110,
                'price' => 27000,
                'description' => 'Western Region Mountain Coffee'
            ],
            [
                'product_name' => 'Buvuma Island Coffee',
                'sku' => 'UG-BUVUM-IC-009',
                'quantity' => 90,
                'price' => 30000,
                'description' => 'Lake Victoria Island Specialty'
            ],
            [
                'product_name' => 'Nebbi Robusta Premium',
                'sku' => 'UG-NEBBI-RP-010',
                'quantity' => 220,
                'price' => 19000,
                'description' => 'Northern Region Bold Robusta'
            ],
            [
                'product_name' => 'Bushenyi Highland Arabica',
                'sku' => 'UG-BUSHE-HA-011',
                'quantity' => 130,
                'price' => 25500,
                'description' => 'Western Highland Premium Beans'
            ],
            [
                'product_name' => 'Masaka District Blend',
                'sku' => 'UG-MASAK-DB-012',
                'quantity' => 170,
                'price' => 21000,
                'description' => 'Central Region Mixed Variety'
            ],
            [
                'product_name' => 'Kibale Forest Coffee',
                'sku' => 'UG-KIBAL-FC-013',
                'quantity' => 85,
                'price' => 32000,
                'description' => 'Forest Shade Grown Arabica'
            ],
            [
                'product_name' => 'Tororo District Premium',
                'sku' => 'UG-TOROR-DP-014',
                'quantity' => 145,
                'price' => 23000,
                'description' => 'Eastern Border Regional Coffee'
            ],
            [
                'product_name' => 'Mbarara Robusta Select',
                'sku' => 'UG-MBAR-RS-015',
                'quantity' => 190,
                'price' => 17500,
                'description' => 'Southwestern Region Strong Robusta'
            ]
        ];

        foreach ($ugandanCoffeeTypes as $coffee) {
            InventoryItem::create($coffee);
        }

        echo "Added " . count($ugandanCoffeeTypes) . " Ugandan coffee varieties to inventory!\n";
    }
}
