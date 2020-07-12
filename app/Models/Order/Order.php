<?php


namespace App\Models\Order;


use App\Models\Model;

class Order extends Model
{
    protected $fillable = [
        'user_uid',
        'comments',
        'order_address_id',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
