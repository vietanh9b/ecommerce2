<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'order_id', 'quantity', 'amount', 'price', 'status'];

    public function product_attr(){
        return $this->belongsTo(Attribute::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function getQtyByCart($productId, $order_id){
        return $this->where('product_id', $productId)->where('order_id', $order_id)->value('quantity');
    }
}
