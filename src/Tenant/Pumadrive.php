<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class pumadrive extends Model
{
	use UsesTenantConnection;
     protected $table = 'pumadrivers';

    protected $fillable = ['ruta', 'fecha'];

    public $timestamps = false;
}
