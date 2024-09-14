<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected static function boot()
    {
        parent::boot();

        // Thiết lập cascade delete
        static::deleting(function ($product) {
            $product->variants()->delete();
        });
    }
    
    protected $fillable=[
        'catelogue_id',
        'name',
        'slug',
        'sku',
        'img_thumbnail',
        'price_regular',
        'price_sale',
        'description',
        'content',
        'material',
        'user_manual',
        'views',
        'is_active',
        'is_hot_deal',
        'is_good_deal',
        'is_new',
        'is_show_home',
    ];
    protected $casts=[
        'is_active'=>'boolean',
        'is_hot_deal'=>'boolean',
        'is_good_deal'=>'boolean',
        'is_new'=>'boolean',
        'is_show_home'=>'boolean',
    ];
    public function catelogue(){
        return $this->belongsTo(Catelogue::class);
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
