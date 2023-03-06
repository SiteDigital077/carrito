<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Tamano extends Model{
use UsesTenantConnection;


protected $table = 'comercio_tamanos';
public $timestamps = false;

}