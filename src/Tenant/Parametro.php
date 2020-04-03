<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;


class Parametro extends Model{

use UsesTenantConnection;

protected $table = 'parametro';
public $timestamps = false;

}