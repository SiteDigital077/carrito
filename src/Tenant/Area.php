<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;


class Area extends Model{

use UsesTenantConnection;

protected $table = 'areas';
public $timestamps = false;

}