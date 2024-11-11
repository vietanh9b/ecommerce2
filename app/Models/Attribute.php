<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['sku','price','stock','color','product_id','photo'];

    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function carts()
    {
        return $this->hasMany(Cart::class,'product_id');
    }
    

    public function getPrice()
    {
        $originalPrice = $this->price ?? 0;
        return $originalPrice;
    }
    
    public function getSku($productId){
        return $this->where('id', $productId)->value('sku');
    }

    
}
