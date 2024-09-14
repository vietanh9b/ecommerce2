<?php

use App\Http\Controllers\Admin\CatelogueController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use Illuminate\Support\Facades\Route;


Route::prefix('client')->as('client.')->group(function(){
    Route::get('/',[ClientProductController::class,'index']);
    Route::get('shop',[ClientProductController::class,'shop'])->name('shop');
    Route::get('detail/{id}',[ClientProductController::class,'detail'])->name('detail');
    Route::post('cart/add',[ClientProductController::class,'addToCart'])->name('cart.add');
    Route::get('cart/show/{id}',[ClientProductController::class,'showCart'])->name('cart.show');
});