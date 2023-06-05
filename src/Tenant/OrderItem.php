<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
	use UsesTenantConnection;
     protected $table = 'order_items';

    protected $fillable = ['price', 'quantity', 'product_id', 'order_id', 'user_id','fechad'];

    public $timestamps = false;
}

