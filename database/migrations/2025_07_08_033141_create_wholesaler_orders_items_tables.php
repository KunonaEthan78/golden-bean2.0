<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wholesaler_order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('wholesaler_order_id');
            $table->unsignedBigInteger('wholesaler_product_id');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
    
            // Foreign keys
            $table->foreign('wholesaler_order_id')
                  ->references('id')->on('wholesaler_orders')
                  ->onDelete('cascade');
    
            $table->foreign('wholesaler_product_id')
                  ->references('id')->on('wholesaler_products')
                  ->onDelete('cascade');
    

        });
    }

   public function down(): void
   {
    Schema::dropIfExists('wholesaler_order_items');
    

   }


   
};
