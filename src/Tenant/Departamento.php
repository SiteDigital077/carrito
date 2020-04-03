<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;


class Departamento extends Model

{
use UsesTenantConnection;
protected $table = 'departamentos';
	public $timestamps = true;



}