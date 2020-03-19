<?php

namespace DigitalsiteSaaS\Carrito;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['descripcion', 'subtotal', 'shipping', 'codigo', 'estado', 'user_id', 'cantidad', 'fecha', 'nombre', 'apellido', 'empresa', 'direccion', 'ciudad', 'documento', 'cos_envio', 'iva_ord', 'codigo_apr', 'medio', 'mensaje', 'tipo', 'preciodescuento', 'departamento', 'informacion', 'email', 'inmueble', 'telefono'];

    public function users(){

		return $this->belongsTo('DigitalsiteSaaS\Carrito\Uuario');
	}


}