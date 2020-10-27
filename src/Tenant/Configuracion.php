<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    use UsesTenantConnection;
	protected $table = 'configuracion';
    public $timestamps = false;

}
