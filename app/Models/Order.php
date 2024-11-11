<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS_NEW = 'new';
    const STATUS_PROCESS = 'process';
    const STATUS_DELIVERY = 'delivered';
    const STATUS_CANCEL = 'cancel';
    const ORDER_RECEIPT = 1;

    const LIST_ORDER_STATUS = [
        self::STATUS_NEW,
        self::STATUS_PROCESS,
        self::STATUS_DELIVERY,
        self::STATUS_CANCEL
    ];


    protected $fillable = [
        'user_id',
        'order_number',
        'sub_total',
        'quantity',
        'status',
        'total_amount',
        'name',
        'detail_address',
        'phone',
        'email',
        'payment_method',
        'payment_status',
        'gender',
        'remark',
        'delivery_date'
    ];


    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function cart_info()
    {
            return $this->hasMany('App\Models\Cart', 'order_id', 'id');
    }

    public function getOrderListByUser($user_id){
        return $this->where('user_id', $user_id)->orderBy('id', 'DESC')->get();
    }

}
