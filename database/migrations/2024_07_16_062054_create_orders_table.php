<?php

use App\Models\ProductVariant;
use App\Models\User;
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
            //user_id chỉ để xác định là ai trên hệ thống 
            $table->foreignIdFor(User::class)->constrained();
            // product variant id
            $table->foreignIdFor(ProductVariant::class)->constrained();
            // lưu lại toàn bộ thông tin người đặt hàng
            $table->string('user_name');
            $table->string('user_email');
            $table->string('user_address');
            $table->string('user_phone');
            $table->string('user_note');

            $table->boolean('is_same_user')->default(true);
            // lưu lại toàn bộ thông tin người nhận hàng
            $table->string('ship_user_name')->nullable();
            $table->string('ship_user_email')->nullable();
            $table->string('ship_user_address')->nullable();
            $table->string('ship_user_phone')->nullable();
            $table->string('ship_user_note')->nullable();

            // quản lý
            $table->string('status_order')->default(\App\Models\Order::STATUS_ORDER_PENDING);
            $table->string('status_payment')->default(\App\Models\Order::STATUS_PAYMENT_UNPAID);

            $table->double('total_price', 15, 2);

            // $table->foreignIdFor('coupon_id');  

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
