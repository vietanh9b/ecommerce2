<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',  // Thêm user_id vào đây
        'product_variant_id',
        'quantity'
    ];
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function productVariant()
{
    return $this->belongsTo(ProductVariant::class, 'product_variant_id');
}
    // public function product()
    // {
    //     return $this->productVariant->product; // Giả sử có mối quan hệ từ ProductVariant đến Product
    // }
}
