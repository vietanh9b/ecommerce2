<?php

use App\Models\Order;
use App\Models\ProductVariant;
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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained();
            $table->foreignIdFor(ProductVariant::class)->constrained();
            $table->unsignedInteger('quantity')->default(0);

            // sao lưu thông tin sản phẩm
            $table->string('name');
            $table->string('sku')->unique();
            $table->string('img_thumbnail')->nullable();
            $table->double('price_regular');
            $table->double('price_sale');

            // Sao lưu thông tin biến thể
            $table->string('variant_size_name');
            $table->string('variant_color_name');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
