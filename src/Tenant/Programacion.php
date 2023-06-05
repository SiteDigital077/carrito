<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;


class Programacion extends Model{

use UsesTenantConnection;

protected $table = 'programacion';
public $timestamps = false;

}