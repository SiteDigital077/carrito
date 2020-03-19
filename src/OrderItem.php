<?php

namespace DigitalsiteSaaS\Carrito;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
     protected $table = 'order_items';

    protected $fillable = ['price', 'quantity', 'product_id', 'order_id', 'user_id'];

    public $timestamps = false;
}

