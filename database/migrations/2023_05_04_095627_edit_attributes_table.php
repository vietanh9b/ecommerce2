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
        Schema::table('attributes', function (Blueprint $table) {
            $table->integer('stock')->default(1); 
            $table->float('price');
            $table->string('sku')->unique();
            $table->string('color');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');

            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attributes', function (Blueprint $table) {
            $table->dropColumn('product_id');
            $table->dropColumn('stock');
            $table->dropColumn('price');
            $table->dropColumn('sku');
            $table->dropColumn('color');
        });
    }
};
