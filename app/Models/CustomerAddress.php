<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $table = 'customer_address';

    const DEFAULT       = 1;
    const NOT_DEFAULT   = 0;
    const GENDER_MALE   = 1;
    const GENDER_FEMALE = 2;


    protected $fillable = [
        'user_id',
        'name',
        'gender',
        'phone_number',
        'email',
        'province',
        'district',
        'ward',
        'detail_address',
        'is_default',  
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    } 
   

    public function scopeUpdateOtherDefault($query, $id, $user_id) {
        $query->where('user_id', $user_id)->where('id', '!=', $id);
    }

}
