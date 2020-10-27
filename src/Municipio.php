<?php

namespace DigitalsiteSaaS\Carrito;

use Illuminate\Database\Eloquent\Model;


class Municipio extends Model

{

protected $table = 'municipios';
	public $timestamps = true;

public function departamento()
{
	return $this->belongsTo(Departamento::class, 'departamento_id');
}


}