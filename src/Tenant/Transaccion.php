<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;


class Transaccion extends Model{

use UsesTenantConnection;

protected $table = 'transaccion';
public $timestamps = true;

}