<?php

namespace DigitalsiteSaaS\Carrito\Tenant;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;


class Product extends Model

{
use UsesTenantConnection;
protected $table = 'products';
	public $timestamps = true;

	public function categories(){

		return $this->belongsTo('DigitalsiteSaaS\Carrito\Tenant\Category');
	}

	  	public function pages(){

		return $this->belongsTo('Page');
	}

}