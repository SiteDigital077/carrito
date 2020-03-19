<?php

namespace DigitalsiteSaaS\Carrito;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
	protected $table = 'categoriessd';
    public $timestamps = true;

		public function products(){
	return $this->hasMany('DigitalsiteSaaS\Carrito\Product');

	}
}
