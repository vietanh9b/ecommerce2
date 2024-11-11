<?php

namespace App\Models;

use App\Http\Controllers\CategoryController;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductAttribute;

class Product extends Model
{
    use SoftDeletes;
    const ENTITY = 'product';
    const DEFAULT_PER_PAGE = 9;

    const PRICE_TYPE_PRODUCT_DETAIL = 'detail';
    const PRICE_TYPE_PRODUCT_LIST = 'list';
    const IS_ACTIVE = 'active';
    protected $primaryKey = "id"; // default it look for id


    protected $fillable = [
        'title',
        'slug',
        'summary',
        'description',
        'category_id',
        'discount',
        'status',
        'photo',
        'deleted_at'
    ];
 
    
    public function category()
    {
      return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function attributes()
    {
      return $this->hasMany(Attribute::class,'product_id','id');
    }
    
    
}
