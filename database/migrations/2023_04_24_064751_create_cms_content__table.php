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
        Schema::create('cms_contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->integer('status')->default(1);
            $table->text('content');
            $table->text('custom_html')->nullable('true');
            $table->text('additional_css')->nullable('true');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cms_contents', function (Blueprint $table) {
            Schema::dropIfExists('cms_contents');
        });
    }
};
