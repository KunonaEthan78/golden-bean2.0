<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompleteDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Clear existing data
        $this->clearExistingData();

        // Insert sample data
        $this->seedUsers();
        $this->seedPasswordResetTokens();
        $this->seedSessions();
        $this->seedProducts();
        $this->seedRetailerProducts();
        $this->seedWholesalerProducts();
        $this->seedCoffeeBatches();
        $this->seedOrders();
        $this->seedOrderItems();
        $this->seedWholesalerOrders();
        $this->seedWholesalerOrderItems();
        $this->seedVendorApplications();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('Complete sample data seeded successfully!');
    }

    private function clearExistingData()
    {
        DB::table('vendor_applications')->truncate();
        DB::table('wholesaler_order_items')->truncate();
        DB::table('wholesaler_orders')->truncate();
        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('coffee_batches')->truncate();
        DB::table('wholesaler_products')->truncate();
        DB::table('retailer_products')->truncate();
        DB::table('products')->truncate();
        DB::table('sessions')->truncate();
        DB::table('password_reset_tokens')->truncate();
        DB::table('users')->truncate();
    }

    private function seedUsers()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'is_admin' => 1,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'John Retailer',
                'email' => 'retailer1@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'retailer',
                'is_admin' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Mary Wholesaler',
                'email' => 'wholesaler1@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'wholesaler',
                'is_admin' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Alice Customer',
                'email' => 'customer1@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'is_admin' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Bob Cooperative',
                'email' => 'cooperative1@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'cooperative',
                'is_admin' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Sarah Retailer',
                'email' => 'retailer2@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'retailer',
                'is_admin' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Tom Customer',
                'email' => 'customer2@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'customer',
                'is_admin' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'name' => 'Jane Wholesaler',
                'email' => 'wholesaler2@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role' => 'wholesaler',
                'is_admin' => 0,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    private function seedPasswordResetTokens()
    {
        DB::table('password_reset_tokens')->insert([
            [
                'email' => 'admin@example.com',
                'token' => 'sample_token_123',
                'created_at' => now(),
            ],
            [
                'email' => 'retailer1@example.com',
                'token' => 'sample_token_456',
                'created_at' => now(),
            ],
        ]);
    }

    private function seedSessions()
    {
        DB::table('sessions')->insert([
            [
                'id' => 'session_1',
                'user_id' => 1,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'payload' => '{}',
                'last_activity' => time(),
            ],
            [
                'id' => 'session_2',
                'user_id' => 2,
                'ip_address' => '127.0.0.1',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
                'payload' => '{}',
                'last_activity' => time(),
            ],
        ]);
    }

    private function seedProducts()
    {
        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Premium Arabica Beans',
                'price' => 25.50,
                'quantity' => 100,
                'description' => 'High-quality Arabica coffee beans from Uganda highlands',
                'status' => 'available',
                'created_at' => '2025-01-10 08:00:00',
                'updated_at' => '2025-01-10 08:00:00',
            ],
            [
                'id' => 2,
                'name' => 'Robusta Coffee Beans',
                'price' => 18.75,
                'quantity' => 150,
                'description' => 'Strong and bold Robusta coffee beans',
                'status' => 'available',
                'created_at' => '2025-01-12 09:30:00',
                'updated_at' => '2025-01-12 09:30:00',
            ],
            [
                'id' => 3,
                'name' => 'Ground Coffee Mix',
                'price' => 22.00,
                'quantity' => 80,
                'description' => 'Pre-ground coffee mix perfect for retail',
                'status' => 'available',
                'created_at' => '2025-01-15 11:00:00',
                'updated_at' => '2025-01-15 11:00:00',
            ],
            [
                'id' => 4,
                'name' => 'Organic Coffee Blend',
                'price' => 28.00,
                'quantity' => 60,
                'description' => 'Certified organic coffee blend',
                'status' => 'available',
                'created_at' => '2025-01-18 14:30:00',
                'updated_at' => '2025-01-18 14:30:00',
            ],
        ]);
    }

    private function seedRetailerProducts()
    {
        DB::table('retailer_products')->insert([
            [
                'id' => 1,
                'retailer_id' => 2,
                'name' => 'Premium Arabica Retail Pack',
                'description' => 'High-quality Arabica coffee for retail customers',
                'price' => 30.00,
                'quantity' => 50,
                'grade' => 'AA',
                'created_at' => '2025-01-20 10:00:00',
                'updated_at' => '2025-01-20 10:00:00',
            ],
            [
                'id' => 2,
                'retailer_id' => 2,
                'name' => 'Robusta Coffee Pack',
                'description' => 'Strong coffee blend for everyday use',
                'price' => 20.00,
                'quantity' => 75,
                'grade' => 'A',
                'created_at' => '2025-01-22 11:15:00',
                'updated_at' => '2025-01-22 11:15:00',
            ],
            [
                'id' => 3,
                'retailer_id' => 6,
                'name' => 'Specialty Coffee Blend',
                'description' => 'Unique blend of Arabica and Robusta',
                'price' => 35.00,
                'quantity' => 40,
                'grade' => 'AAA',
                'created_at' => '2025-01-25 13:45:00',
                'updated_at' => '2025-01-25 13:45:00',
            ],
            [
                'id' => 4,
                'retailer_id' => 6,
                'name' => 'Instant Coffee Mix',
                'description' => 'Quick dissolving coffee for busy customers',
                'price' => 15.00,
                'quantity' => 100,
                'grade' => 'B',
                'created_at' => '2025-01-28 16:20:00',
                'updated_at' => '2025-01-28 16:20:00',
            ],
            [
                'id' => 5,
                'retailer_id' => 2,
                'name' => 'Export Quality Beans',
                'description' => 'Premium beans ready for export',
                'price' => 45.00,
                'quantity' => 30,
                'grade' => 'AAA',
                'created_at' => '2025-02-01 09:00:00',
                'updated_at' => '2025-02-01 09:00:00',
            ],
        ]);
    }

    private function seedWholesalerProducts()
    {
        DB::table('wholesaler_products')->insert([
            [
                'id' => 1,
                'name' => 'Bulk Arabica Beans',
                'grade' => 'AA',
                'quantity' => 500,
                'price' => 18.00,
                'wholesaler_id' => 3,
                'created_at' => '2025-01-15 08:30:00',
                'updated_at' => '2025-01-15 08:30:00',
            ],
            [
                'id' => 2,
                'name' => 'Bulk Robusta Beans',
                'grade' => 'A',
                'quantity' => 750,
                'price' => 12.50,
                'wholesaler_id' => 3,
                'created_at' => '2025-01-18 10:45:00',
                'updated_at' => '2025-01-18 10:45:00',
            ],
            [
                'id' => 3,
                'name' => 'Premium Export Grade',
                'grade' => 'AAA',
                'quantity' => 300,
                'price' => 25.00,
                'wholesaler_id' => 3,
                'created_at' => '2025-01-22 14:15:00',
                'updated_at' => '2025-01-22 14:15:00',
            ],
            [
                'id' => 4,
                'name' => 'Commercial Grade Coffee',
                'grade' => 'B',
                'quantity' => 1000,
                'price' => 8.00,
                'wholesaler_id' => 3,
                'created_at' => '2025-01-25 16:30:00',
                'updated_at' => '2025-01-25 16:30:00',
            ],
            [
                'id' => 5,
                'name' => 'Organic Certified Beans',
                'grade' => 'AA',
                'quantity' => 200,
                'price' => 22.00,
                'wholesaler_id' => 8,
                'created_at' => '2025-02-02 11:00:00',
                'updated_at' => '2025-02-02 11:00:00',
            ],
            [
                'id' => 6,
                'name' => 'Fair Trade Coffee',
                'grade' => 'A',
                'quantity' => 400,
                'price' => 15.00,
                'wholesaler_id' => 8,
                'created_at' => '2025-02-05 13:20:00',
                'updated_at' => '2025-02-05 13:20:00',
            ],
        ]);
    }

    private function seedCoffeeBatches()
    {
        DB::table('coffee_batches')->insert([
            [
                'id' => 1,
                'batch_name' => 'Harvest 2025-01 Arabica',
                'quantity' => 500.5,
                'quality_grade' => 'AA',
                'uploaded_by' => 5,
                'created_at' => '2025-01-10 07:00:00',
                'updated_at' => '2025-01-10 07:00:00',
            ],
            [
                'id' => 2,
                'batch_name' => 'Harvest 2025-02 Premium',
                'quantity' => 750.0,
                'quality_grade' => 'AAA',
                'uploaded_by' => 5,
                'created_at' => '2025-01-20 08:15:00',
                'updated_at' => '2025-01-20 08:15:00',
            ],
            [
                'id' => 3,
                'batch_name' => 'Harvest 2025-03 Robusta',
                'quantity' => 300.25,
                'quality_grade' => 'A',
                'uploaded_by' => 5,
                'created_at' => '2025-02-01 09:30:00',
                'updated_at' => '2025-02-01 09:30:00',
            ],
            [
                'id' => 4,
                'batch_name' => 'Organic Batch 001',
                'quantity' => 200.75,
                'quality_grade' => 'AA',
                'uploaded_by' => 5,
                'created_at' => '2025-02-10 10:45:00',
                'updated_at' => '2025-02-10 10:45:00',
            ],
        ]);
    }

    private function seedOrders()
    {
        DB::table('orders')->insert([
            [
                'id' => 1,
                'user_id' => 4,
                'status' => 'confirmed',
                'total' => 60.00,
                'delivery_address' => '123 Coffee Street, Kampala, Uganda',
                'total_price' => 60.00,
                'created_at' => '2025-01-15 10:30:00',
                'updated_at' => '2025-01-16 09:00:00',
            ],
            [
                'id' => 2,
                'user_id' => 7,
                'status' => 'pending',
                'total' => 35.00,
                'delivery_address' => '456 Bean Avenue, Entebbe, Uganda',
                'total_price' => 35.00,
                'created_at' => '2025-02-20 14:15:00',
                'updated_at' => '2025-02-20 14:15:00',
            ],
            [
                'id' => 3,
                'user_id' => 4,
                'status' => 'delivered',
                'total' => 90.00,
                'delivery_address' => '789 Roast Road, Jinja, Uganda',
                'total_price' => 90.00,
                'created_at' => '2025-03-10 09:45:00',
                'updated_at' => '2025-03-12 16:30:00',
            ],
            [
                'id' => 4,
                'user_id' => 7,
                'status' => 'confirmed',
                'total' => 70.00,
                'delivery_address' => '321 Brew Boulevard, Mbale, Uganda',
                'total_price' => 70.00,
                'created_at' => '2025-03-15 11:20:00',
                'updated_at' => '2025-03-16 10:00:00',
            ],
            [
                'id' => 5,
                'user_id' => 4,
                'status' => 'pending',
                'total' => 105.00,
                'delivery_address' => '654 Espresso Lane, Gulu, Uganda',
                'total_price' => 105.00,
                'created_at' => '2025-03-22 15:45:00',
                'updated_at' => '2025-03-22 15:45:00',
            ],
        ]);
    }

    private function seedOrderItems()
    {
        DB::table('order_items')->insert([
            [
                'id' => 1,
                'order_id' => 1,
                'product_id' => 1,
                'quantity' => 2,
                'price' => 30.00,
                'created_at' => '2025-01-15 10:30:00',
                'updated_at' => '2025-01-15 10:30:00',
            ],
            [
                'id' => 2,
                'order_id' => 1,
                'product_id' => 2,
                'quantity' => 1,
                'price' => 20.00,
                'created_at' => '2025-01-15 10:30:00',
                'updated_at' => '2025-01-15 10:30:00',
            ],
            [
                'id' => 3,
                'order_id' => 2,
                'product_id' => 3,
                'quantity' => 1,
                'price' => 35.00,
                'created_at' => '2025-02-20 14:15:00',
                'updated_at' => '2025-02-20 14:15:00',
            ],
            [
                'id' => 4,
                'order_id' => 3,
                'product_id' => 1,
                'quantity' => 3,
                'price' => 90.00,
                'created_at' => '2025-03-10 09:45:00',
                'updated_at' => '2025-03-10 09:45:00',
            ],
            [
                'id' => 5,
                'order_id' => 4,
                'product_id' => 2,
                'quantity' => 2,
                'price' => 40.00,
                'created_at' => '2025-03-15 11:20:00',
                'updated_at' => '2025-03-15 11:20:00',
            ],
            [
                'id' => 6,
                'order_id' => 4,
                'product_id' => 3,
                'quantity' => 1,
                'price' => 35.00,
                'created_at' => '2025-03-15 11:20:00',
                'updated_at' => '2025-03-15 11:20:00',
            ],
            [
                'id' => 7,
                'order_id' => 5,
                'product_id' => 1,
                'quantity' => 3,
                'price' => 75.00,
                'created_at' => '2025-03-22 15:45:00',
                'updated_at' => '2025-03-22 15:45:00',
            ],
            [
                'id' => 8,
                'order_id' => 5,
                'product_id' => 4,
                'quantity' => 1,
                'price' => 28.00,
                'created_at' => '2025-03-22 15:45:00',
                'updated_at' => '2025-03-22 15:45:00',
            ],
        ]);
    }

    private function seedWholesalerOrders()
    {
        DB::table('wholesaler_orders')->insert([
            [
                'id' => 1,
                'retailer_id' => 2,
                'delivery_address' => '100 Retailer Plaza, Kampala, Uganda',
                'total' => 540.00,
                'status' => 'confirmed',
                'created_at' => '2025-01-25 11:00:00',
                'updated_at' => '2025-01-26 08:30:00',
            ],
            [
                'id' => 2,
                'retailer_id' => 6,
                'delivery_address' => '200 Shop Center, Mbale, Uganda',
                'total' => 375.00,
                'status' => 'pending',
                'created_at' => '2025-02-15 16:30:00',
                'updated_at' => '2025-02-15 16:30:00',
            ],
            [
                'id' => 3,
                'retailer_id' => 2,
                'delivery_address' => '300 Market Street, Entebbe, Uganda',
                'total' => 750.00,
                'status' => 'delivered',
                'created_at' => '2025-03-05 12:15:00',
                'updated_at' => '2025-03-08 14:20:00',
            ],
            [
                'id' => 4,
                'retailer_id' => 6,
                'delivery_address' => '400 Trade Center, Jinja, Uganda',
                'total' => 320.00,
                'status' => 'confirmed',
                'created_at' => '2025-03-18 09:45:00',
                'updated_at' => '2025-03-19 11:00:00',
            ],
        ]);
    }

    private function seedWholesalerOrderItems()
    {
        DB::table('wholesaler_order_items')->insert([
            [
                'id' => 1,
                'wholesaler_order_id' => 1,
                'wholesaler_product_id' => 1,
                'quantity' => 30,
                'price' => 540.00,
                'created_at' => '2025-01-25 11:00:00',
                'updated_at' => '2025-01-25 11:00:00',
            ],
            [
                'id' => 2,
                'wholesaler_order_id' => 2,
                'wholesaler_product_id' => 2,
                'quantity' => 30,
                'price' => 375.00,
                'created_at' => '2025-02-15 16:30:00',
                'updated_at' => '2025-02-15 16:30:00',
            ],
            [
                'id' => 3,
                'wholesaler_order_id' => 3,
                'wholesaler_product_id' => 3,
                'quantity' => 30,
                'price' => 750.00,
                'created_at' => '2025-03-05 12:15:00',
                'updated_at' => '2025-03-05 12:15:00',
            ],
            [
                'id' => 4,
                'wholesaler_order_id' => 4,
                'wholesaler_product_id' => 4,
                'quantity' => 40,
                'price' => 320.00,
                'created_at' => '2025-03-18 09:45:00',
                'updated_at' => '2025-03-18 09:45:00',
            ],
            [
                'id' => 5,
                'wholesaler_order_id' => 1,
                'wholesaler_product_id' => 2,
                'quantity' => 10,
                'price' => 125.00,
                'created_at' => '2025-01-25 11:00:00',
                'updated_at' => '2025-01-25 11:00:00',
            ],
        ]);
    }

    private function seedVendorApplications()
    {
        DB::table('vendor_applications')->insert([
            [
                'id' => 1,
                'user_id' => 2,
                'role' => 'retailer',
                'financial_score' => '85',
                'reputation' => 'Excellent',
                'regulatory_proof' => 'documents/retailer1_proof.pdf',
                'created_at' => '2025-01-10 09:00:00',
                'updated_at' => '2025-01-10 09:00:00',
            ],
            [
                'id' => 2,
                'user_id' => 3,
                'role' => 'wholesaler',
                'financial_score' => '92',
                'reputation' => 'Outstanding',
                'regulatory_proof' => 'documents/wholesaler1_proof.pdf',
                'created_at' => '2025-01-12 10:30:00',
                'updated_at' => '2025-01-12 10:30:00',
            ],
            [
                'id' => 3,
                'user_id' => 6,
                'role' => 'retailer',
                'financial_score' => '78',
                'reputation' => 'Good',
                'regulatory_proof' => 'documents/retailer2_proof.pdf',
                'created_at' => '2025-01-20 14:15:00',
                'updated_at' => '2025-01-20 14:15:00',
            ],
            [
                'id' => 4,
                'user_id' => 8,
                'role' => 'wholesaler',
                'financial_score' => '88',
                'reputation' => 'Very Good',
                'regulatory_proof' => 'documents/wholesaler2_proof.pdf',
                'created_at' => '2025-02-01 11:45:00',
                'updated_at' => '2025-02-01 11:45:00',
            ],
        ]);
    }
}
