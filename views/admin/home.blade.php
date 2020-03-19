@extends ('LayoutsSD.TemaSD')

@section('ContenidoSite-01')
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-3 ecomerce1">
 <a href="/gestion/carrito/categorias"><p><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>  Categorias y productos</p></a>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-3 ecomerce2">
		<a href="/gestion/usuarios"><p><span class="glyphicon glyphicon-user" aria-hidden="true"></span>  Usuarios</p></a>
</div>
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-3 ecomerce3">
	<a href="/gestion/carrito/epayco"><p><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span>  Ordenes</p></a>
</div>

<div class="container">
<a href="/gestion/carrito/configuracion">	Configuración </a>
</div>

@stop