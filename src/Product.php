<?php

namespace DigitalsiteSaaS\Carrito;

use Illuminate\Database\Eloquent\Model;


class Product extends Model

{

protected $table = 'products';
	public $timestamps = true;

	public function categories(){

		return $this->belongsTo('DigitalsiteSaaS\Carrito\Category');
	}

	  	public function pages(){

		return $this->belongsTo('Page');
	}

}