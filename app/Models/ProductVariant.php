<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_id',
        'product_size_id',
        'product_color_id',
        'quantity',
        'image'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function color()
    {
        return $this->belongsTo(ProductColor::class, 'product_color_id');
    }

    public function size()
    {
        return $this->belongsTo(ProductSize::class, 'product_size_id');
    }
    
}
