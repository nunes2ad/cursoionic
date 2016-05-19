<?php

namespace CodeDelivery\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'product_id',
        'order_id',
        'price',
        'qtd'
    ];

    public function items(){
        return $this->hasMany(Order::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
