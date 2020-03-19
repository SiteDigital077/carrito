<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('cart/sesional', function() {
return Session::get('cart');
});


Route::bind('product', function ($slug) {
	return DigitalsiteSaaS\Carrito\Product::where('slug', $slug)->first();
});



Route::get('cart/detail', [

	'middleware' => 'comprador',
	'middleware' => 'auth',
	'as' => 'tienda-detail',
	'uses' => 'DigitalsiteSaaS\Carrito\Http\CartController@orderDetail'
	]);


Route::get('{$id}', [
	'middleware' => 'web',
	'as' => 'tienda-virtual',
	'uses' => 'DigitalsiteSaaS\Pagina\Http\WebController@paginas'
	]);

Route::post('{$id}', [
	'middleware' => 'web',
	'as' => 'tienda-virtual',
	'uses' => 'DigitalsiteSaaS\Pagina\Http\WebController@paginas'
	]);

Route::get('product/detail/{slug}', [
	'middleware' => 'web',
	'as' => 'product-detail',
	'uses' => 'DigitalsiteSaaS\Carrito\Http\StoreController@show'
	]);

Route::get('cart/show', [
	'middleware' => 'web',
	'as' => 'cart-show',
	'uses' => 'DigitalsiteSaaS\Carrito\Http\CartController@show'
	]);

Route::get('cart/add/{product}', [
	'middleware' => 'web',
	'as' => 'cart-add',
	'uses' => 'DigitalsiteSaaS\Carrito\Http\CartController@add'
	]);

Route::get('cart/addprice/{priceman}', [
	'middleware' => 'web',
	'as' => 'cart-addprice',
	'uses' => 'DigitalsiteSaaS\Carrito\Http\CartController@addprice'
	]);

Route::get('cart/update/{product}/{quantity?}', [
	'middleware' => 'web',
	'as' => 'cart-update',
	'uses' => 'DigitalsiteSaaS\Carrito\Http\CartController@update'
	]);

Route::get('cart/delete/{product}', [
	'middleware' => 'web',
	'as' => 'cart-delete',
	'uses' => 'DigitalsiteSaaS\Carrito\Http\CartController@delete'
	]);
Route::get('cart/trash', [
	'middleware' => 'web',
	'as' => 'cart-trash',
	'uses' => 'DigitalsiteSaaS\Carrito\Http\CartController@trash'
	]);
	

Route::get('cart/responseda', [
	'middleware' => 'web',
	'as' => 'cart-response',
	]);
	

Route::post('cart/response', array('uses' => 'DigitalsiteSaaS\Carrito\Http\CartController@response', 'middleware' => 'web'));

Route::post('cart/responseserver', array('uses' => 'DigitalsiteSaaS\Carrito\Http\CartController@responseserver', 'middleware' => 'web'));


	Route::post('cart/responseda', [
	'middleware' => 'web',
	'as' => 'cart/response',
	'uses' => 'DigitalsiteSaaS\Carrito\Http\CartController@response'

	]);


	Route::group(['middleware' => ['auths','administrador']], function (){

Route::get('/gestion/carrito/autores', function(){
    $autores = DB::table('autor')->get();  
    return View::make('carrito::admin.autores')->with('autores', $autores);
});

Route::get('/gestion/carrito/subcategorias/{id}', function($id){
    $subcategorias = DB::table('categoriessd')->where('categoriapro_id', '=', $id)->get();  
    return View::make('carrito::admin.subcategorias')->with('subcategorias', $subcategorias);
});

Route::get('/gestion/carrito/crear-subcategoria/{id}', function(){
 
    return View::make('carrito::admin.crear-subcategoria');
});






Route::post('gestion/carrito/editarcategoriaweb/{id}', 'DigitalsiteSaaS\Carrito\Http\CategoryController@editarcategoriaweb');
Route::post('gestion/carrito/editarcategoriawebproducto/{id}', 'DigitalsiteSaaS\Carrito\Http\CategoryController@editarcategoriawebproducto');
Route::get('gestion/carrito/configuracion', 'DigitalsiteSaaS\Carrito\Http\CategoryController@configuracion');
Route::get('gestion/carrito/categorias', 'DigitalsiteSaaS\Carrito\Http\CategoryController@show'); 
Route::get('gestion/carrito/createca', 'DigitalsiteSaaS\Carrito\Http\CategoryController@createca'); 
Route::get('gestion/carrito/terminos', 'DigitalsiteSaaS\Carrito\Http\CategoryController@terminos');
Route::post('gestion/carrito/createcategoria', 'DigitalsiteSaaS\Carrito\Http\CategoryController@createcategoria');
Route::post('gestion/carrito/createcategoriaproductos', 'DigitalsiteSaaS\Carrito\Http\CategoryController@createcategoriaproductos'); 
Route::post('gestion/carrito/creacionautor', 'DigitalsiteSaaS\Carrito\Http\CategoryController@creacionautor'); 
Route::get('gestion/carrito/editarcategoria/{id}', 'DigitalsiteSaaS\Carrito\Http\CategoryController@editarcategoria'); 
Route::get('gestion/carrito/editarcategoriaproducto/{id}', 'DigitalsiteSaaS\Carrito\Http\CategoryController@editarcategoriaproducto'); 
Route::resource('gestion/carrito/actualizar', 'DigitalsiteSaaS\Carrito\Http\CategoryController@actualizar'); 
Route::post('gestion/carrito/actualizarautor/{id}', 'DigitalsiteSaaS\Carrito\Http\CategoryController@actualizarautor'); 
Route::get('gestion/carrito/eliminar/{id}', 'DigitalsiteSaaS\Carrito\Http\CategoryController@eliminar');
Route::get('gestion/carrito/eliminarproducto/{id}', 'DigitalsiteSaaS\Carrito\Http\CategoryController@eliminarproducto');
Route::get('gestion/carrito/epayco', 'DigitalsiteSaaS\Carrito\Http\CategoryController@epayco');
Route::get('gestion/carrito/detalle/{id}', 'DigitalsiteSaaS\Carrito\Http\CategoryController@detalle');
Route::get('gestion/carrito/crear-autor', 'DigitalsiteSaaS\Carrito\Http\CategoryController@createautor');
Route::post('gestion/carrito/actuterminos', 'DigitalsiteSaaS\Carrito\Http\CategoryController@update');
Route::get('gestion/carrito/dashboard', 'DigitalsiteSaaS\Carrito\Http\CategoryController@dashboard');
Route::get('gestion/carrito/crearconfiguracion', 'DigitalsiteSaaS\Carrito\Http\CategoryController@crearconfiguracion');
Route::get('gestion/carrito/crearconfiguraciontienda', 'DigitalsiteSaaS\Carrito\Http\CategoryController@crearconfiguraciontienda');
Route::post('gestion/carrito/crearconfiguracionepayco', 'DigitalsiteSaaS\Carrito\Http\CategoryController@crearconfiguracionepayco');
Route::resource('gestion/carrito/crearconfiguracionplace', 'DigitalsiteSaaS\Carrito\Http\CategoryController@crearconfiguracionplace');
Route::get('gestion/autor/editar/{id}', 'DigitalsiteSaaS\Carrito\Http\CategoryController@autoreditar'); 

Route::get('gestion/autor/eliminar/{id}', 'DigitalsiteSaaS\Carrito\Http\CategoryController@autoreliminar');

Route::resource('gestion/productos', 'DigitalsiteSaaS\Carrito\Http\ProductoController'); 
Route::get('gestion/productos/digitales/{id}', 'DigitalsiteSaaS\Carrito\Http\ProductoController@digitales'); 
Route::get('gestion/productos/crear/{id}', 'DigitalsiteSaaS\Carrito\Http\ProductoController@crear'); 
Route::resource('gestion/productos/crearproducto', 'DigitalsiteSaaS\Carrito\Http\ProductoController@show'); 
Route::get('gestion/productos/editarproducto/{id}', 'DigitalsiteSaaS\Carrito\Http\ProductoController@editarproducto');
Route::post('gestion/productos/actualizar/{id}', 'DigitalsiteSaaS\Carrito\Http\ProductoController@actualizar'); 
Route::get('gestion/productos/eliminar/{id}', 'DigitalsiteSaaS\Carrito\Http\ProductoController@eliminar'); 



Route::resource('gestion/carrito', 'DigitalsiteSaaSCarrito\Http\UserController'); 





Route::resource('gestion/usuarios/ordenes', 'DigitalsiteSaaS\Carrito\Http\UserController@ordenes'); 
Route::resource('gestion/usuarios/editar', 'DigitalsiteSaaS\Carrito\Http\UserController@editar'); 
Route::resource('gestion/usuarios/actualizar', 'DigitalsiteSaaS\Carrito\Http\UserController@actualizar');
Route::resource('gestion/usuarios/eliminar', 'DigitalsiteSaaS\Carrito\Http\UserController@eliminar'); 
Route::resource('gestion/usuarios/pruebas', 'DigitalsiteSaaS\Carrito\Http\UserController@pruebas'); 



});
Route::post('gestion/usuarios/crear', 'DigitalsiteSaaS\Carrito\Http\UserController@crear'); 





Route::get('/memo/ajax-subcatweb',function(){

		$cat_id = Input::get('cat_id');
		$subcategories = DigitalsiteSaaS\Carrito\Departamento::where('pais_id', '=', $cat_id)->get();
		return Response::json($subcategories);
});

Route::get('/mema/ajax-subcatweb',function(){

        $cat_id = Input::get('cat_id');
        $subcategories = DigitalsiteSaaS\Carrito\Municipio::where('departamento_id', '=', $cat_id)->get();
        return Response::json($subcategories);
});


Route::get('/memaproducts/ajax-subcatweb',function(){

        $cat_id = Input::get('cat_id');
        $subcategories = DigitalsiteSaaS\Carrito\Category::where('categoriapro_id', '=', $cat_id)->get();
        return Response::json($subcategories);
});





Route::get('auto/suma',function(){


         $suma = DB::table('orders')
       ->select(DB::raw('SUM(shipping) AS total_orders'))
        ->get();


       dd($suma);

       $count = DB::table('orders')->count();
       dd($count);



       $data = DB::table("order_items")
    ->select(DB::raw("count(product_id) as count"))
    ->groupBy(DB::raw("product_id"))
    ->get();
	dd($data);



});

Route::any('gestion/costoenvio', 'DigitalsiteSaaS\Carrito\Http\CartController@costoenvio'); 

Route::group(['middleware' => ['comprador']], function (){
Route::post('placetopay/pagoweb', 'DigitalsiteSaaS\Carrito\Http\CartController@generaplace');
Route::get('placetopay/pagowebrequest/{id}', 'DigitalsiteSaaS\Carrito\Http\CartController@ejecutaplace');
Route::get('gestion/detalle/usuario', 'DigitalsiteSaaS\Carrito\Http\CartController@detalleuser');




});



Route::post('placetopay/placenotificacion', 'DigitalsiteSaaS\Carrito\Http\CartController@placenotificacion');
/*
Route::any('web/session', 'Digitalsite\Carrito\Http\CartController@actionIndex');
Route::any('web/session/filtro', 'Digitalsite\Carrito\Http\CartController@actionIndexweb');
Route::any('web/limpieza', 'Digitalsite\Carrito\Http\CartController@limpieza');
Route::any('web/limpiezaweb', 'Digitalsite\Carrito\Http\CartController@limpiezaweb');
*/

Route::get('validacion/email', function () {
          $user = DB::table('users')->where('email', Input::get('email'))->count();
    if($user > 0) {
        $isAvailable = FALSE;
    } else {
        $isAvailable = TRUE;
    }
    echo json_encode(
            array(
                'valid' => $isAvailable
            )); 

});




Route::get('carrito/pruebas/importExport', 'DigitalsiteSaaS\Carrito\Http\CartController@importExport');
Route::get('carrito/pruebas/downloadExcel/{type}', 'DigitalsiteSaaS\Carrito\Http\CartController@downloadExcel');
Route::post('carrito/pruebas/importExcel', 'DigitalsiteSaaS\Carrito\Http\CartController@importExcel');

Route::get('carrito/productos/importExport', 'DigitalsiteSaaS\Carrito\Http\CartController@importExportpro');
Route::get('carrito/productos/downloadExcel/{type}', 'DigitalsiteSaaS\Carrito\Http\CartController@downloadExcelpro');
Route::post('carrito/productos/importExcel', 'DigitalsiteSaaS\Carrito\Http\CartController@importExcelpro');


Route::get('carrito/municipios/importExport', 'DigitalsiteSaaS\Carrito\Http\CartController@importExportmun');
Route::get('carrito/municipios/downloadExcel/{type}', 'DigitalsiteSaaS\Carrito\Http\CartController@downloadExcelmun');
Route::post('carrito/municipios/importExcel', 'DigitalsiteSaaS\Carrito\Http\CartController@importExcelmun');





Route::get('gestion/usuarios/registrar', 'DigitalsiteSaaS\Carrito\Http\CartController@registrar'); 




