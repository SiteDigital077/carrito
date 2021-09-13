<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;


class Cupon extends Model{

use UsesTenantConnection;

protected $table = 'cupones';
public $timestamps = false;

}