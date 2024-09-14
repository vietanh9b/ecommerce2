<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'amount',
        'type',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'discount_product');
    }

    public function isValid()
    {
        $now = now();
        return $this->start_date <= $now && (!$this->end_date || $this->end_date >= $now);
    }
}
