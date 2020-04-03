<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model{
use UsesTenantConnection;


protected $table = 'autor';
public $timestamps = false;

}