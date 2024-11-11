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
        Schema::create('customer_address', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('is_default')->default(0);
            $table->string('name');
            $table->integer('phone_number');
            $table->string('email');
            $table->string('gender');
            $table->string('province')->nullable();
            $table->string('district')->nullable();
            $table->string('ward')->nullable();
            $table->string('detail_address');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_address');
    }
};
