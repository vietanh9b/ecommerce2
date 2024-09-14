<?php

use App\Http\Controllers\Admin\CatelogueController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CouponController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->as('admin.')->group(function(){

    Route::get('/',function(){
        return view('admin.dashboard');
    });
    Route::prefix('catelogues')->as('catelogues.')->group(function(){
        Route::get('index',        [CatelogueController::class,'index'])->name('index');
        Route::get('create',            [CatelogueController::class,'create'])->name('create');
        Route::post('store',            [CatelogueController::class,'store'])->name('store');
        Route::get('show/{id}',         [CatelogueController::class,'show'])->name('show');
        Route::get('{id}/edit',         [CatelogueController::class,'edit'])->name('edit');
        Route::put('{id}/update',       [CatelogueController::class,'update'])->name('update');
        // delete
        Route::delete('{id}/destroy',   [CatelogueController::class,'destroy'])->name('destroy');
        Route::get('trash',[CatelogueController::class,'trash'])->name('trash');
        Route::delete('{id}/force-delete',[CatelogueController::class,'forceDelete'])->name('force-delete');
        Route::get('{id}/restore',[CatelogueController::class,'restore'])->name('restore');
    });
    Route::resource('products',ProductController::class);
    Route::resource('coupons',CouponController::class);
});
