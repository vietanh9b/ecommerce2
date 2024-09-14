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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name'); 
            $table->string('code')->unique(); 
            $table->decimal('amount', 8, 2); // Số tiền hoặc phần trăm giảm giá
            $table->enum('type', ['fixed', 'percent']); // Loại giảm giá: cố định hoặc phần trăm
            $table->date('start_date'); // Ngày bắt đầu
            $table->date('end_date')->nullable(); // Ngày kết thúc (nếu có)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
