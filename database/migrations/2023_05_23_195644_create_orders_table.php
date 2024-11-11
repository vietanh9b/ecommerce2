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
            $table->string('order_number')->unique();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->float('sub_total');
            $table->float('coupon')->nullable();
            $table->float('total_amount');
            $table->integer('quantity');
            $table->enum('payment_method',['cod','transfer'])->default('cod');
            $table->enum('payment_status',['paid','unpaid'])->default('unpaid');
            $table->enum('status',['new','process','delivered','cancel'])->default('new');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('detail-address');
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
