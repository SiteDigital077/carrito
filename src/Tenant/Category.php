<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use UsesTenantConnection;
	protected $table = 'categoriessd';
    public $timestamps = true;

		public function products(){
	return $this->hasMany('DigitalsiteSaaS\Carrito\Tenant\Product');

	}
}
