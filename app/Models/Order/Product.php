<?php


namespace App\Models\Order;


use App\Models\Model;

class Product extends Model
{
    protected $table = 'order_products';

    protected $fillable = [
        'order_id',
        'product_id',
        'amount',
    ];
}
