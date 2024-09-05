<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('merchant_id');
            $table->unsignedBigInteger('food_id');
            $table->string('order_number')->unique();
            $table->string('qty');
            $table->decimal('total_price', 10, 2);
            $table->string('status')->nullable();
            $table->timestamp('delivery_date')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
