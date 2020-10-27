<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;


class Pais extends Model

{
use UsesTenantConnection;
protected $table = 'paises';
	public $timestamps = true;



}