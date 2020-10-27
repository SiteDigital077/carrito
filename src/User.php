<?php

namespace DigitalsiteSaaS\Carrito;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

	protected $table = 'users';

	protected $hidden = array('password', 'remember_token');

	public function orders(){
	return $this->hasMany('DigitalsiteSaaS\Carrito\Order');
	
}

}

