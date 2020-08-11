<?php

namespace DigitalsiteSaaS\Carrito\Http;

use Dnetix\Redirection\PlacetoPay;
use Session;
use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DigitalsiteSaaS\Carrito\Product;
use DigitalsiteSaaS\Carrito\Order;
use DigitalsiteSaaS\Carrito\Configuracion;
use DigitalsiteSaaS\Carrito\Pais;
use DigitalsiteSaaS\Carrito\OrderItem;
use DigitalsiteSaaS\Carrito\Municipio;
use DigitalsiteSaaS\Carrito\Category;
use DigitalsiteSaaS\Carrito\Transaccion;
use DigitalsiteSaaS\Carrito\Departamento;
use DigitalsiteSaaS\Pagina\Template;
use DigitalsiteSaaS\Pagina\Seo;
use App\User;
use DB;
use Input;
use Illuminate\Support\Facades\Auth;
use Excel;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\HostnameRepository;
use Hyn\Tenancy\Repositories\WebsiteRepository;
use Response;
use Redirect;
use GuzzleHttp;
use GuzzleHttp\Client;
use Carbon\Carbon;

class CartController extends Controller{
 

 protected $tenantName = null;


public function __construct()
{
if(!session()->has('cart')) session()->has('cart', array());
$hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
        if ($hostname){
            $fqdn = $hostname->fqdn;
            $this->tenantName = explode(".", $fqdn)[0];
        }

}

public function show()
{
    if(!$this->tenantName){
      $seo = Seo::where('id','=',1)->get(); 
$plantilla = \DigitalsiteSaaS\Pagina\Template::all();
    $menu = \DigitalsiteSaaS\Pagina\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
$cart = session()->get('cart');
$url = Configuracion::where('id', '=', 1)->get();
$iva = $this->iva();
$total = $this->total();
$subtotal = $this->subtotal();
$descuento = $this->descuento();
$plantillaes = Template::all();
$categoriapro = Category::all();
}else{
  $seo = \DigitalsiteSaaS\Pagina\Tenant\Seo::where('id','=',1)->get(); 
$plantilla = \DigitalsiteSaaS\Pagina\Tenant\Template::all();
    $menu = \DigitalsiteSaaS\Pagina\Tenant\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
$cart = session()->get('cart');
$url = \DigitalsiteSaaS\Carrito\Tenant\Configuracion::where('id', '=', 1)->get();
$iva = $this->iva();
$total = $this->total();
$subtotal = $this->subtotal();
$descuento = $this->descuento();
$plantillaes = \DigitalsiteSaaS\Pagina\Tenant\Template::all();
$categoriapro = \DigitalsiteSaaS\Carrito\Tenant\Category::all();
}
return view('carrito::cart', compact('cart', 'total', 'plantilla', 'menu', 'subtotal', 'iva', 'descuento', 'url', 'categoriapro', 'plantillaes', 'seo'));
}





public function add($id){

if(!$this->tenantName){  
$hola = Product::where('slug', $id)->get();
    }else{
    $hola = \DigitalsiteSaaS\Carrito\Tenant\Product::where('slug', $id)->get();
}
$product = json_decode($hola[0]);
    $cart =  session()->get('cart');
    $product->quantity = 1;
    $cart[$product->slug] = $product;
    session()->put('cart', $cart);
    return Redirect('/cart/show');
}


private function total()
{
$cart = session()->get('cart');
$total = 0;
if($cart == null){}
else{
foreach ($cart as $item) {
$total += $item->precioinivafin * $item->quantity;
}}

return $total;
}

private function subtotal()
{
$cart = session()->get('cart');
$subtotal = 0;
if($cart == null){}
else{
foreach($cart as $item){
$subtotal += $item->preciodescfin * $item->quantity;
}}

return $subtotal;
}


public function precioenvio()
{
if(!$this->tenantName){
$cart =  \DigitalsiteSaaS\Carrito\User::join('departamentos', 'departamentos.id', '=', 'users.ciudad')
             ->leftjoin('municipios', 'municipios.id', '=', 'users.region')
             ->where('users.id', '=' , Auth::user()->id)->get();
    }else{
    $cart =  \DigitalsiteSaaS\Carrito\Tenant\User::join('departamentos', 'departamentos.id', '=', 'users.ciudad')
             ->leftjoin('municipios', 'municipios.id', '=', 'users.region')
             ->where('users.id', '=' , Auth::user()->id)->get();
    }
$precioenvio = 0;

foreach($cart as $item){
if($item->region == 'undefined'){
$precioenvio += $item->p_departamento;
}
else{
$precioenvio += $item->p_municipio;
}
}

return $precioenvio;
}


public function costoenvio()
{

if($_POST)
    {
    Session::put('miSesionTexto', Input::get('costoenvio'));
    }

      return Redirect('/cart/detail');
}





private function descuento()
{
$cart = session()->get('cart');
$descuento = 0;
if($cart == null){}
else{
foreach($cart as $item){
$descuento += $item->precio * $item->descuento/100;
}}

return $descuento;
}


private function iva()
{
$cart = session()->get('cart');
$iva = 0;
if($cart == null){}

else{
foreach($cart as $item){
$iva += $item->precioiva * $item->quantity;
}}
return $iva;
}



private function nombremunicipio()
{
 

$precio = DB::table('municipios')->where('id', '=', session()->get('miSesionTextouno'))->get();
$nombremunicipio = 0;
foreach($precio as $item){
$nombremunicipio = $item->municipio;
}

return $nombremunicipio;
}

private function nombremunicipioid()
{
 

$precio = DB::table('municipios')->where('id', '=', session()->get('miSesionTextouno'))->get();
$nombremunicipio = 0;
foreach($precio as $item){
$nombremunicipioid = $item->id;
}

return $nombremunicipioid;
}


private function nombredepartamentoid()
{
 

$precio = DB::table('municipios')->where('id', '=', session()->get('miSesionTextouno'))->get();
$nombredepartamentoid = 0;
foreach($precio as $item){
$nombredepartamentoid += $item->departamento_id;
}

return $nombredepartamentoid;
}


private function preciomunicipio()
{
 

$precio = DB::table('municipios')->where('id', '=', session()->get('miSesionTextouno'))->get();
$preciomunicipio = 0;
foreach($precio as $item){
$preciomunicipio += $item->p_municipio;
}

return $preciomunicipio;
}


public function update($quantity){
if(!$this->tenantName){
$hola =  Product::where('slug', Request::segment(3))->get();
}else{
$hola = \DigitalsiteSaaS\Carrito\Tenant\Product::where('slug', Request::segment(3))->get();
}
    $product = json_decode($hola[0]);
$cart = session()->get('cart');
$cart[$product->slug]->quantity = $quantity;
session()->put('cart', $cart);
return Redirect('/cart/show');
}







public function orderDetail(){
if(!$this->tenantName){
$departamento = Departamento::all();
$seo = Seo::where('id','=',1)->get();
$price = Order::max('id');
$suma = $price + 1;
$configuracion = Configuracion::find(1);
$plantilla = \DigitalsiteSaaS\Pagina\Template::all();
$plantillaes = \DigitalsiteSaaS\Pagina\Template::all();
$menu = \DigitalsiteSaaS\Pagina\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
$cart = session()->get('cart');
$total = $this->total();
$subtotal = $this->subtotal();
$iva = $this->iva();
$precioenvio = $this->precioenvio();
$datos = \DigitalsiteSaaS\Carrito\User::join('departamentos', 'departamentos.id', '=', 'users.ciudad')
             ->leftjoin('municipios', 'municipios.id', '=', 'users.region')
             ->where('users.id', '=' , Auth::user()->id)->get();
$costoenvio = $this->costoenvio();
$preciomunicipio = $this->preciomunicipio();
$nombremunicipio = $this->nombremunicipio();
$descuento = $this->descuento();
$orderold  = Order::where('user_id', '=', Auth::user()->id)->get();
$categories = Pais::all();
$ordenes = Order::where('user_id', '=' ,Auth::user()->id)->where('estado', '=', 'PENDING')->get();
}else{
$departamento = \DigitalsiteSaaS\Pagina\Tenant\Departamento::all();
$seo = \DigitalsiteSaaS\Pagina\Tenant\Seo::where('id','=',1)->get();
$price = \DigitalsiteSaaS\Carrito\Tenant\Order::max('id');
$suma = $price + 1;
$configuracion = \DigitalsiteSaaS\Carrito\Tenant\Configuracion::find(1);
$plantilla = \DigitalsiteSaaS\Pagina\Tenant\Template::all();
$plantillaes = \DigitalsiteSaaS\Pagina\Tenant\Template::all();
$menu = \DigitalsiteSaaS\Pagina\Tenant\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
$cart = session()->get('cart');
$total = $this->total();
$subtotal = $this->subtotal();
$iva = $this->iva();
$precioenvio = $this->precioenvio();
$datos = \DigitalsiteSaaS\Carrito\Tenant\User::join('departamentos', 'departamentos.id', '=', 'users.ciudad')
             ->leftjoin('municipios', 'municipios.id', '=', 'users.region')
             ->where('users.id', '=' , Auth::user()->id)->get();
$costoenvio = $this->costoenvio();
$preciomunicipio = $this->preciomunicipio();
$nombremunicipio = $this->nombremunicipio();
$descuento = $this->descuento();
$orderold  = \DigitalsiteSaaS\Carrito\Tenant\Order::where('user_id', '=', Auth::user()->id)->get();
$categories = \DigitalsiteSaaS\Carrito\Tenant\Pais::all();
$ordenes = \DigitalsiteSaaS\Carrito\Tenant\Order::where('user_id', '=' ,Auth::user()->id)->where('estado', '=', 'PENDING')->get();
}
return view('carrito::order', compact('cart', 'total', 'subtotal', 'plantilla', 'menu','configuracion','price','suma', 'orderold', 'iva', 'descuento', 'costoenvio', 'categories', 'precioenvio', 'preciomunicipio', 'datos', 'plantillaes', 'nombremunicipio', 'ordenes', 'seo','departamento'));

}


public function trash()

{

session()->forget('cart');
    return Redirect('/cart/show');
}


public function delete($id){
if(!$this->tenantName){  
$hola = Product::where('slug', $id)->get();
}else{
$hola = \DigitalsiteSaaS\Carrito\Tenant\Product::where('slug', $id)->get();
}
$product = json_decode($hola[0]);
$cart = session()->get('cart');
unset($cart[$product->slug]);
session()->put('cart', $cart);

return Redirect('/cart/show');

}

/*
public function responsesite(Request $request){


$p_description = $request->input('p_description');
$p_extra1 = $request->input('p_extra1');
$p_cust_id_cliente = $request->input('p_cust_id_cliente');
$p_key = $request->input('p_key');
$p_id_invoice = $request->input('p_id_invoice');
$p_currency_code = $request->input('p_currency_code');
$p_amount_base = $request->input('p_amount_base');
$p_amount = $request->input('p_amount');
$p_tax = $request->input('p_tax');
$p_extra2 = $request->input('p_extra2');
$p_test_request = $request->input('p_test_request');
$p_url_response = $request->input('p_url_response');
$p_url_confirmation = $request->input('p_url_confirmation');
$p_confirm_method = $request->input('p_confirm_method');
$p_signature = $request->input('p_signature');
$p_billing_email = $request->input('p_billing_email');


return redirect()->away('https://secure.payco.co/checkout.php')->withInput(['p_amount'=>$p_amount,'p_description'=>$p_description,'p_extra1'=>$p_extra1,'p_cust_id_cliente'=>$p_cust_id_cliente,'p_key'=>$p_key,'p_id_invoice'=>$p_id_invoice,'p_currency_code'=>$p_currency_code,'p_amount_base'=>$p_amount_base,'p_amount'=>$p_amount,'p_tax'=>$p_tax,'p_extra2'=>$p_extra2,'p_test_request'=>$p_test_request,'p_url_response'=>$p_url_response,'p_url_confirmation'=>$p_url_confirmation,'p_confirm_method'=>$p_confirm_method,'p_signature'=>$p_signature,'p_billing_email'=>$p_billing_email]);
}
*/

public function responsesite(Request $request){
$client = new \GuzzleHttp\Client();
$p_description = $request->input('p_description');
$p_extra1 = $request->input('p_extra1');
$p_cust_id_cliente = $request->input('p_cust_id_cliente');
$p_key = $request->input('p_key');
$p_id_invoice = $request->input('p_id_invoice');
$p_currency_code = $request->input('p_currency_code');
$p_amount_base = $request->input('p_amount_base');
$p_amount = $request->input('p_amount');
$p_tax = $request->input('p_tax');
$p_extra2 = $request->input('p_extra2');
$p_test_request = $request->input('p_test_request');
$p_url_response = $request->input('p_url_response');
$p_url_confirmation = $request->input('p_url_confirmation');
$p_confirm_method = $request->input('p_confirm_method');
$p_signature = $request->input('p_signature');
$p_billing_email = $request->input('p_billing_email');

$requestapi = $client->post('https://secure.payco.co/checkout.php', [
                   'form_params' => [
                       'p_amount'=>$p_amount,
                       'p_description'=>$p_description,
                       'p_extra1'=>$p_extra1,
                       'p_cust_id_cliente'=>$p_cust_id_cliente,
                       'p_key'=>$p_key,
                       'p_id_invoice'=>$p_id_invoice,
                       'p_currency_code'=>$p_currency_code,
                       'p_amount_base'=>$p_amount_base,
                       'p_amount'=>$p_amount,
                       'p_tax'=>$p_tax,
                       'p_extra2'=>$p_extra2,
                       'p_test_request'=>$p_test_request,
                       'p_url_response'=>$p_url_response,
                       'p_url_confirmation'=>$p_url_confirmation,
                       'p_confirm_method'=>$p_confirm_method,
                       'p_signature'=>$p_signature,
                       'p_billing_email'=>$p_billing_email
                   ]
             ]);
}


public function datosesion(Request $request){

$cart = Session::get('cart');

dd($cart);
}

public function response() {
$request = request()->ref_payco;
 $client = new Client(['http_errors' => false]);
 $responsedg = $client->get('https://secure.epayco.co/validation/v1/reference/'.$request, [
 'headers' => [
 ],
 ]);
 $xmlsg = json_decode($responsedg->getBody()->getContents(), true);

 $estado = $xmlsg['data']['x_respuesta'];

$id_factura = $xmlsg['data']['x_id_factura'];
$codigo = $xmlsg['data']['x_cod_response'];
$estado = $xmlsg['data']['x_response'];
$fecha =  $xmlsg['data']['x_fecha_transaccion'];
$codigo_apr = $xmlsg['data']['x_approval_code'];
$medio =  $xmlsg['data']['x_franchise'];

if(!$this->tenantName){
Order::where('id', $id_factura)
          ->update(['codigo' => $codigo,
      'estado' => $estado,
      'fecha' =>  $fecha,
      'codigo_apr' => $codigo_apr,
      'medio' => $medio]);
        }else{

        \DigitalsiteSaaS\Carrito\Tenant\Order::where('id', $id_factura)
          ->update(['codigo' => $codigo,
      'estado' => $estado,
      'fecha' =>  $fecha,
      'codigo_apr' => $codigo_apr,
      'medio' => $medio]);
        }
dd('se actualizo');
     return Redirect ('/');
 
       
}
       


public function responsess(Request $request){


$id_factura =  Request::input('x_id_factura');

$codigo =  Request::input('x_cod_response');
$estado =  Request::input('x_response');
$fecha =  Request::input('x_fecha_transaccion');
$codigo_apr =  Request::input('x_approval_code');
$medio =  Request::input('x_franchise');


Order::where('id', $id_factura)
          ->update(['codigo' => $codigo,
      'estado' => $estado,
      'fecha' =>  $fecha,
      'codigo_apr' => $codigo_apr,
      'medio' => $medio]);

     return Redirect ('/');
}

 public function mensajes(){
 $fecha = date("Y-m-d h:i:s A");
 $envio = Input::get('p_extra2');
 $cart = Session::get('cart');
 $nombrealt = Input::get('nombrenue');
 $apellidoalt = Input::get('apellidonue');
 $direccionalt = Input::get('direccionnue');
 $telefonoalt = Input::get('telefononue');
 $inmueblealt = Input::get('inmueblenue');
 $informacionalt = Input::get('informacionnue');
 $emailalt = Input::get('emailnue');
 $ciudadalt = Input::get('p_billing_country');
 $preciomunicipio = $this->preciomunicipio();
$precioenvio = $this->precioenvio();
foreach($cart as $producto) {
}

if(session()->get('miSesionTextouno') == 0)
if(!$this->tenantName){
$order = Order::create([
'descripcion' => $producto->description,
'cantidad' => $producto->quantity,
'subtotal' => $producto->preciodescfin,
'fecha' => $fecha,
'shipping' => $producto->precioinivafin,
'iva_ord' => $producto->precioiva,
'cos_envio' => $precioenvio,
'codigo' => '000000',
'estado' => 'Pendiente',
'nombre' => Auth::user()->name,
'apellido' => Auth::user()->last_name,
'direccion' => Auth::user()->address,
'ciudad' => Auth::user()->ciudad,
'inmueble' => Auth::user()->inmueble,
'informacion' => Auth::user()->numero,
'telefono' => Auth::user()->celular,
'email' => Auth::user()->email,
'departamento' => Auth::user()->ciudad,
'codigo_apr' => '000000',
'medio' => 'N/A',
'preciodescuento' => $producto->preciodesc,
'user_id'  => Auth::user()->id
]);
}else{
$order = \DigitalsiteSaaS\Carrito\Tenant\Order::create([
'descripcion' => $producto->description,
'cantidad' => $producto->quantity,
'subtotal' => $producto->preciodescfin,
'fecha' => $fecha,
'shipping' => $producto->precioinivafin,
'iva_ord' => $producto->precioiva,
'cos_envio' => $precioenvio,
'codigo' => '000000',
'estado' => 'Pendiente',
'nombre' => Auth::user()->name,
'apellido' => Auth::user()->last_name,
'direccion' => Auth::user()->address,
'ciudad' => Auth::user()->ciudad,
'inmueble' => Auth::user()->inmueble,
'informacion' => Auth::user()->numero,
'telefono' => Auth::user()->celular,
'departamento' => Auth::user()->ciudad,
'email' => Auth::user()->email,
'codigo_apr' => '000000',
'medio' => 'N/A',
'preciodescuento' => $producto->preciodesc,
'user_id'  => Auth::user()->id
]);
}

elseif($preciomunicipio == 0)
if(!$this->tenantName){
$order = Order::create([
'descripcion' => $producto->description,
'cantidad' => $producto->quantity,
'subtotal' => $producto->preciodescfin,
'fecha' => $fecha,
'shipping' => $producto->precioinivafin,
'iva_ord' => $producto->precioiva,
'cos_envio' => $preciomunicipio,
'codigo' => '000000',
'estado' => 'Pendiente',
'nombre' => $nombrealt,
'apellido' => $apellidoalt,
'direccion' => $direccionalt,
'telefono' => $telefonoalt,
'inmueble' => $inmueblealt,
'informacion' => $informacionalt,
'departamento' => $this->nombredepartamentoid(),
'ciudad' => $this->nombremunicipioid(),
'email' => $emailalt,
'codigo_apr' => '000000',
'medio' => 'N/A',
'preciodescuento' => $producto->preciodesc,
'user_id'  => Auth::user()->id
]);
}else{
$order = \DigitalsiteSaaS\Carrito\Tenant\Order::create([
'descripcion' => $producto->description,
'cantidad' => $producto->quantity,
'subtotal' => $producto->preciodescfin,
'fecha' => $fecha,
'shipping' => $producto->precioinivafin,
'iva_ord' => $producto->precioiva,
'cos_envio' => $preciomunicipio,
'codigo' => '000000B',
'estado' => 'Pendiente',
'nombre' => $nombrealt,
'apellido' => $apellidoalt,
'direccion' => $direccionalt,
'telefono' => $telefonoalt,
'inmueble' => $inmueblealt,
'informacion' => $informacionalt,
'departamento' => $this->nombredepartamentoid(),
'ciudad' => $this->nombremunicipioid(),
'email' => $emailalt,
'codigo_apr' => '000000',
'medio' => 'N/A',
'preciodescuento' => $producto->preciodesc,
'user_id'  => Auth::user()->id
]);
}

else
if(!$this->tenantName){
$order = Order::create([
'descripcion' => $producto->description,
'cantidad' => $producto->quantity,
'subtotal' => $producto->preciodescfin,
'fecha' => $fecha,
'shipping' => $producto->precioinivafin,
'iva_ord' => $producto->precioiva,
'cos_envio' => $preciomunicipio,
'codigo' => '000000',
'estado' => 'Pendiente',
'nombre' => $nombrealt,
'apellido' => $apellidoalt,
'direccion' => $direccionalt,
'telefono' => $telefonoalt,
'inmueble' => $inmueblealt,
'informacion' => $informacionalt,
'email' => $emailalt,
'codigo_apr' => '000000',
'departamento' => $this->nombredepartamentoid(),
'ciudad' => $this->nombremunicipioid(),
'medio' => 'N/A',
'preciodescuento' => $producto->preciodesc,
'user_id'  => Auth::user()->id
]);
}else{
$order = \DigitalsiteSaaS\Carrito\Tenant\Order::create([
'descripcion' => $producto->description,
'cantidad' => $producto->quantity,
'subtotal' => $producto->preciodescfin,
'fecha' => $fecha,
'shipping' => $producto->precioinivafin,
'iva_ord' => $producto->precioiva,
'cos_envio' => $preciomunicipio,
'codigo' => '000000',
'estado' => 'Pendiente',
'nombre' => $nombrealt,
'apellido' => $apellidoalt,
'direccion' => $direccionalt,
'telefono' => $telefonoalt,
'inmueble' => $inmueblealt,
'informacion' => $informacionalt,
'email' => $emailalt,
'codigo_apr' => '000000',
'departamento' => $this->nombredepartamentoid(),
'ciudad' => $this->nombremunicipioid(),
'medio' => 'N/A',
'preciodescuento' => $producto->preciodesc,
'user_id'  => Auth::user()->id
]);
}
foreach($cart as $producto){
$this->saveOrderItem($producto, $order->id);
}

}


protected function saveOrder()
{
$cart = Session::get('cart');
$total = Request::input('x_amount_ok');
$subtotal = $this->subtotal();
$iva_ord = $this->iva();
$cos_envio = Request::input('x_extra2');
$descripcion = Request::input('x_description');
$codigo = Request::input('x_cod_response');
$estado = Request::input('x_response');
$nombre = Request::input('x_customer_name');
$fecha = Request::input('x_transaction_date');
$apellido = Request::input('x_customer_lastname');
$empresa = Request::input('x_extra2');
$direccion = Request::input('x_extra1');
$ciudad = $this->nombremunicipio();
$documento = Request::input('x_extra3');
$codigo_apr = Request::input('x_approval_code');
$medio = Request::input('x_franchise');
$descuento = $this->descuento();

foreach($cart as $producto) {
$subtotal += $producto->quantity * $producto->price;
}

   if(!$this->tenantName){
$order = Order::create([
'descripcion' => $descripcion,
'cantidad' => $producto->quantity,
'subtotal' => $subtotal,
'fecha' => $fecha,
'shipping' => $total,
'iva_ord' => $iva_ord,
'cos_envio' => $cos_envio,
'codigo' => $codigo,
'estado' => $estado,
'nombre' => $nombre,
'apellido' => $apellido,
'empresa' => $empresa,
'direccion' => $direccion,
'ciudad' => $ciudad,
'documento' => $documento,
'codigo_apr' => $codigo_apr,
'medio' => $medio,
'preciodescuento' => $descuento*$producto->quantity,
'user_id'  => Auth::user()->id
]);
}else{
$order = \DigitalsiteSaaS\Carrito\Tenant\Order::create([
'descripcion' => $descripcion,
'cantidad' => $producto->quantity,
'subtotal' => $subtotal,
'fecha' => $fecha,
'shipping' => $total,
'iva_ord' => $iva_ord,
'cos_envio' => $cos_envio,
'codigo' => $codigo,
'estado' => $estado,
'nombre' => $nombre,
'apellido' => $apellido,
'empresa' => $empresa,
'direccion' => $direccion,
'ciudad' => $ciudad,
'documento' => $documento,
'codigo_apr' => $codigo_apr,
'medio' => $medio,
'preciodescuento' => $descuento*$producto->quantity,
'user_id'  => Auth::user()->id
]);
}

foreach($cart as $producto){
$this->saveOrderItem($producto, $order->id);
}
}

protected function saveOrderItem($producto, $order_id)
{

if(!$this->tenantName){
OrderItem::create([
'price' => $producto->precio,
'quantity' => $producto->quantity,
'product_id' => $producto->id,
'order_id' => $order_id,
'user_id' => Auth::user()->id
]);
}else{
\DigitalsiteSaaS\Carrito\Tenant\OrderItem::create([
'price' => $producto->precio,
'quantity' => $producto->quantity,
'product_id' => $producto->id,
'order_id' => $order_id,
'user_id' => Auth::user()->id
]);
}
}






protected function generaplace(Request $request){

if(!$this->tenantName){
 $documentotipo = User::where('id', '=', Auth::user()->id)->get();
}else{
$documentotipo = \DigitalsiteSaaS\Carrito\Tenant\User::where('id', '=', Auth::user()->id)->get();
}
        foreach ($documentotipo as $documentotipo){
          if($documentotipo->tipo_documento == 1)
            $tipodoc = 'CC';
          elseif($documentotipo->tipo_documento == 2)
            $tipodoc = 'CE';
          elseif($documentotipo->tipo_documento == 4)
            $tipodoc = 'TI';
          elseif($documentotipo->tipo_documento == 6)
            $tipodoc = 'NIT';
        }        
                                       
     
$amount = Input::get('p_amount');
$reference = Input::get('p_id_invoice');
if(!$this->tenantName){
$servicio = Configuracion::where('id', '=', 1)->get();
}else{
$servicio = \DigitalsiteSaaS\Carrito\Tenant\Configuracion::where('id', '=', 1)->get();
}

foreach ($servicio as $servicio){
$secretKey = $servicio->trankey;
$login = $servicio->login;
$moneda = $servicio->monedaplace;
$descriptionsite = $servicio->description;
$redirect = $servicio->redirect.'/placetopay/pagowebrequest/'.$reference;
}



$seed = date('c');

if (function_exists('random_bytes')) {
    $nonce = bin2hex(random_bytes(16));
} elseif (function_exists('openssl_random_pseudo_bytes')) {
    $nonce = bin2hex(openssl_random_pseudo_bytes(16));
} else {
    $nonce = mt_rand();
}

 


$nonceBase64 = base64_encode($nonce);

$tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));
 


$Authentication = array(
    "login" =>  $login,
    "tranKey" =>  SHA1(date('c').$secretKey, false),
    "seed" =>  date('c')
   );

  $request = [
    'auth' => [
    'login' => $login,
    'seed' => date('c'),
    'nonce' => $nonceBase64,
    'tranKey' => $tranKey,
    ],

   'buyer' => [
       'name' => Auth::user()->name,
       'surname' => Auth::user()->last_name,
       'documentType' => $tipodoc,
       'document' => Auth::user()->documento,
       'email' => Auth::user()->email,
       'address' => [
           'city' => 'Bogotá',
           'street' => Auth::user()->address,
       ]
   ],
   'payment' => [
       'reference' => $reference,
       'description' => $descriptionsite,
       'amount' => [
            'currency' => $moneda,
            'total' => $amount
        ]

],
   
    'expiration' => date('c', strtotime('1 day')),
    'returnUrl' =>  $redirect,
    'ipAddress' => '127.0.0.1',
    'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
];

//return $request;
 if(!$this->tenantName){
$redireccionplace = Configuracion::where('id', '=', 1)->get();
}else{
$redireccionplace = \DigitalsiteSaaS\Carrito\Tenant\Configuracion::where('id', '=', 1)->get();
}

foreach ($redireccionplace as $redireccionplace){
$url = $redireccionplace->url_produccion;
}




//Se inicia. el objeto CUrl
$ch = curl_init($url);

//creamos el json a partir del arreglo
$jsonDataEncoded = json_encode($request);


//Indicamos que nuestra petición sera Post
curl_setopt($ch, CURLOPT_POST, 1);

//para que la peticion no imprima el resultado como un echo comun, y podamos manipularlo
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//Adjuntamos el json a nuestra petición
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);


    //Agregar los encabezados del contenido
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'User-Agent: cUrl Testing'));

//Ejecutamos la petición
$result = curl_exec($ch);


//return redirect('https://test.placetopay.com/redirection')
  //        ->header('customvalue1', $request);
//return  $result;
$p_extra1 = Request::input('p_extra1');
$p_billing_country = Request::input('p_billing_country');
$p_billing_name = Request::input('p_billing_name');
$p_billing_lastname = Request::input('p_billing_lastname');
$p_billing_phone = Request::input('p_billing_phone');
$p_extra3 = Request::input('p_extra3');
$informacion = Request::input('informacion');
$inmueble = Request::input('inmueble');
$email = Request::input('email');
$telefono = Request::input('telefono');

$decode = json_decode($result, true);

$urlprocess = $decode['processUrl'];

$requestid = $decode['requestId'];

if(!$this->tenantName){
Transaccion::insert(
    array('direccion' => $p_extra1,'ciudad' => $p_billing_country,'nombre' => $p_billing_name,'apellido' => $p_billing_lastname,'telefono' => $p_billing_phone, 'documento' => $p_extra3,'referencia' => $reference, 'request_id' => $requestid, 'process_url' => $urlprocess, 'user_id' => Auth::user()->id));
}else{
\DigitalsiteSaaS\Carrito\Tenant\Transaccion::insert(
    array('direccion' => $p_extra1,'ciudad' => $p_billing_country,'nombre' => $p_billing_name,'apellido' => $p_billing_lastname,'telefono' => $p_billing_phone, 'documento' => $p_extra3,'referencia' => $reference, 'request_id' => $requestid, 'process_url' => $urlprocess, 'user_id' => Auth::user()->id));
}

//
$decodew = json_decode($result, true);
//return $decode;

  //              $var1 = $decode['reason'];
               
 

//echo $var1.'<br />';

if(!$this->tenantName){
$servicio = Configuracion::where('id', '=', 1)->get();
}else{
$servicio = \DigitalsiteSaaS\Carrito\Tenant\Configuracion::where('id', '=', 1)->get();
}

foreach ($servicio as $servicio){
$descriptionsite = $servicio->description;
}

  $total = $this->total();
$subtotalweb = $this->subtotal();
$iva = $this->iva();
$descuento = $this->descuento();
$precioenvio = $this->precioenvio();
$costoenvio = $this->costoenvio();
$preciomunicipio = $this->preciomunicipio();
$nombremunicipio = $this->nombremunicipio();
$descuento = $this->descuento();




$cart = session()->get('cart');

foreach ($cart as $producto) {
$subtotalweb += $producto->quantity * $producto->price;
}

$nombrealt = Input::get('nombrenue');
$apellidoalt = Input::get('apellidonue');
$direccionalt = Input::get('direccionnue');
$telefonoalt = Input::get('telefononue');
$inmueblealt = Input::get('inmueblenue');
$informacionalt = Input::get('informacionnue');
$emailalt = Input::get('emailnue');
$ciudadalt = Input::get('p_billing_country');

if(session()->get('miSesionTextouno') == 0)

if(!$this->tenantName){
$order = Order::create([
'descripcion' => $descriptionsite,
'cantidad' => $producto->quantity,
'subtotal' => $subtotalweb,
'fecha' => date("Y-m-d h:i:s A"),
'shipping' => $total+$precioenvio,
'iva_ord' => $iva,
'preciodescuento' => $descuento,
'cos_envio' => $precioenvio,
'codigo' => '000000',
'mensaje' => 'Esperando la notificacion de placetoplay',
'estado' => 'PENDING',
'nombre' => Auth::user()->name,
'apellido' => Auth::user()->last_name,
'direccion' => Auth::user()->address,
'telefono' => Auth::user()->celular,
'inmueble' => Auth::user()->inmueble,
'informacion' => Auth::user()->numero,
'email' => Auth::user()->email,
'ciudad' => Auth::user()->region,
'departamento' => $this->nombredepartamentoid(),
'documento' => NULL,
'codigo_apr' => $requestid,
'medio' => 'PD',
        'tipo' => 'S/N',
'user_id'  => Auth::user()->id
]);
}else{
$order = \DigitalsiteSaaS\Carrito\Tenant\Order::create([
'descripcion' => $descriptionsite,
'cantidad' => $producto->quantity,
'subtotal' => $subtotalweb,
'fecha' => date("Y-m-d h:i:s A"),
'shipping' => $total+$precioenvio,
'iva_ord' => $iva,
'preciodescuento' => $descuento,
'cos_envio' => $precioenvio,
'codigo' => '000000',
'mensaje' => 'Esperando la notificacion de placetoplay',
'estado' => 'PENDING',
'nombre' => Auth::user()->name,
'apellido' => Auth::user()->last_name,
'direccion' => Auth::user()->address,
'telefono' => Auth::user()->celular,
'inmueble' => Auth::user()->inmueble,
'informacion' => Auth::user()->numero,
'email' => Auth::user()->email,
'ciudad' => Auth::user()->region,
'departamento' => $this->nombredepartamentoid(),
'documento' => NULL,
'codigo_apr' => $requestid,
'medio' => 'PD',
        'tipo' => 'S/N',
'user_id'  => Auth::user()->id
]);
}

elseif($preciomunicipio == 0)
if(!$this->tenantName){
$order = Order::create([
'descripcion' => $descriptionsite,
'cantidad' => $producto->quantity,
'subtotal' => $subtotalweb,
'fecha' => date("Y-m-d h:i:s A"),
'shipping' => $total+$precioenvio,
'iva_ord' => $iva,
'preciodescuento' => $descuento,
'cos_envio' => $precioenvio,
'codigo' => '000000',
'mensaje' => 'Esperando la notificacion de placetoplay',
'estado' => 'PENDING',
'nombre' => $nombrealt,
'apellido' => $apellidoalt,
'direccion' => $direccionalt,
'telefono' => $telefonoalt,
'inmueble' => $inmueblealt,
'informacion' => $informacionalt,
'email' => $emailalt,
'ciudad' => $this->nombremunicipioid(),
'departamento' => $this->nombredepartamentoid(),
'documento' => NULL,
'codigo_apr' => $requestid,
'medio' => 'PD',
        'tipo' => 'S/N',
'user_id'  => Auth::user()->id
]);
}else{
$order = \DigitalsiteSaaS\Carrito\Tenant\Order::create([
'descripcion' => $descriptionsite,
'cantidad' => $producto->quantity,
'subtotal' => $subtotalweb,
'fecha' => date("Y-m-d h:i:s A"),
'shipping' => $total+$precioenvio,
'iva_ord' => $iva,
'preciodescuento' => $descuento,
'cos_envio' => $precioenvio,
'codigo' => '000000',
'mensaje' => 'Esperando la notificacion de placetoplay',
'estado' => 'PENDING',
'nombre' => $nombrealt,
'apellido' => $apellidoalt,
'direccion' => $direccionalt,
'telefono' => $telefonoalt,
'inmueble' => $inmueblealt,
'informacion' => $informacionalt,
'email' => $emailalt,
'ciudad' => $this->nombremunicipioid(),
'departamento' => $this->nombredepartamentoid(),
'documento' => NULL,
'codigo_apr' => $requestid,
'medio' => 'PD',
        'tipo' => 'S/N',
'user_id'  => Auth::user()->id
]);
}

else
  if(!$this->tenantName){
       $order = Order::create([
'descripcion' => $descriptionsite,
'cantidad' => $producto->quantity,
'subtotal' => $subtotalweb,
'fecha' => date("Y-m-d h:i:s A"),
'shipping' => $total+$precioenvio,
'iva_ord' => $iva,
'preciodescuento' => $descuento,
'cos_envio' => $preciomunicipio,
'codigo' => '000000',
'mensaje' => 'Esperando la notificacion de placetoplay',
'estado' => 'PENDING',
'nombre' => $nombrealt,
'apellido' => $apellidoalt,
'direccion' => $direccionalt,
'telefono' => $telefonoalt,
'inmueble' => $inmueblealt,
'informacion' => $informacionalt,
'email' => $emailalt,
'ciudad' => $this->nombremunicipioid(),
'departamento' => $this->nombredepartamentoid(),
'documento' => $p_extra3,
'codigo_apr' => $requestid,
'medio' => 'PD',
'tipo' => 'S/N',
'user_id'  => Auth::user()->id
]);
}else{
$order = \DigitalsiteSaaS\Carrito\Tenant\Order::create([
'descripcion' => $descriptionsite,
'cantidad' => $producto->quantity,
'subtotal' => $subtotalweb,
'fecha' => date("Y-m-d h:i:s A"),
'shipping' => $total+$precioenvio,
'iva_ord' => $iva,
'preciodescuento' => $descuento,
'cos_envio' => $preciomunicipio,
'codigo' => '000000',
'mensaje' => 'Esperando la notificacion de placetoplay',
'estado' => 'PENDING',
'nombre' => $nombrealt,
'apellido' => $apellidoalt,
'direccion' => $direccionalt,
'telefono' => $telefonoalt,
'inmueble' => $inmueblealt,
'informacion' => $informacionalt,
'email' => $emailalt,
'ciudad' => $this->nombremunicipioid(),
'departamento' => $this->nombredepartamentoid(),
'documento' => $p_extra3,
'codigo_apr' => $requestid,
'medio' => 'PD',
'tipo' => 'S/N',
'user_id'  => Auth::user()->id
]);

}



foreach($cart as $producto){
$this->saveOrderItemplace($producto, $order->id);
}


     session()->forget('cart');
       session()->forget('miSesionTexto');
       session()->forget('miSesionTextouno');

//foreach ($decode as $value) {
  //        $website =  print_r($value['status']);

       // if($website == 'PENDIENTE')
        // return Redirect('Pendiente');
      //else
        //return Redirect('Oyta');
      // }
//



//return $urlprocess;
return redirect($urlprocess);


}





protected function ejecutaplace($id)
{


$seed = date('c');

  if (function_exists('random_bytes')) {
  $nonce = bin2hex(random_bytes(16));
} elseif (function_exists('openssl_random_pseudo_bytes')) {
  $nonce = bin2hex(openssl_random_pseudo_bytes(16));
} else {
  $nonce = mt_rand();
}

if(!$this->tenantName){
$servicio = Configuracion::where('id', '=', 1)->get();
}else{
$servicio = \DigitalsiteSaaS\Carrito\Tenant\Configuracion::where('id', '=', 1)->get();
}

foreach ($servicio as $servicio){
$login = $servicio->login;
$secretKey = $servicio->trankey;
$urlredir = $servicio->url;
}
$nonceBase64 = base64_encode($nonce);

$tranKey = base64_encode(sha1($nonce . $seed . $secretKey, true));

$request = [
  'auth' => [
  'login' => $login,
  'seed' => date('c'),
  'nonce' => $nonceBase64,
  'tranKey' => $tranKey,
  ],
];



//return $request;
if(!$this->tenantName){
$requestsd = Transaccion::where('referencia','=', $id)->get();
$redireccionplace = Configuracion::where('id', '=', 1)->get();
}else{
$requestsd = \DigitalsiteSaaS\Carrito\Tenant\Transaccion::where('referencia','=', $id)->get();
$redireccionplace = \DigitalsiteSaaS\Carrito\Tenant\Configuracion::where('id', '=', 1)->get();
}
foreach($requestsd as $requestsd){
foreach ($redireccionplace as $redireccionplace){
$url = $redireccionplace->url_produccion.$requestsd->request_id;

}
}


//Se inicia. el objeto CUrl
$ch = curl_init($url);

//creamos el json a partir del arreglo
$jsonDataEncoded = json_encode($request);


//Indicamos que nuestra petición sera Post
curl_setopt($ch, CURLOPT_POST, 1);

//para que la peticion no imprima el resultado como un echo comun, y podamos manipularlo
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//Adjuntamos el json a nuestra petición
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);


  //Agregar los encabezados del contenido
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'User-Agent: cUrl Testing'));

//Ejecutamos la petición
$result = curl_exec($ch);


$decodemen = json_decode($result, true);
$pago = $decodemen['payment'];
$requestsd = $decodemen['requestId'];
$estado = $decodemen['status']['status'];

$total = $this->total();
$subtotal = $this->subtotal();

if(!$this->tenantName){
$menu = \DigitalsiteSaaS\Pagina\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
$plantilla = \DigitalsiteSaaS\Pagina\Template::all();
$resultadowebpen =  Transaccion::join('orders', 'transaccion.request_id', '=', 'orders.codigo_apr')
             ->where('referencia', '=' , $id)->get();
 }else{
$menu = \DigitalsiteSaaS\Pagina\Tenant\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
$plantilla = \DigitalsiteSaaS\Pagina\Tenant\Template::all();
$resultadowebpen =  \DigitalsiteSaaS\Carrito\Tenant\Transaccion::join('orders', 'transaccion.request_id', '=', 'orders.codigo_apr')
             ->where('referencia', '=' , $id)->get();
 }            
if($pago == null AND $estado == 'REJECTED'){
if(!$this->tenantName){
Order::where('codigo_apr', '=', $requestsd)->delete();
}else{
\DigitalsiteSaaS\Pagina\Tenant\Order::where('codigo_apr', '=', $requestsd)->delete();
}

return redirect($urlredir);
}
elseif($pago == null AND $estado == 'PENDING'){

return view('carrito::pendiente', compact('resultadowebpen','plantilla','menu','subtotal','total'));
}


else{


//
$decodew = json_decode($result, true);
//return $decode;

  //              $var1 = $decode['reason'];
               
     

//echo $var1.'<br />';

 if(!$this->tenantName){
$servicio = Configuracion::where('id', '=', 1)->get();
}else{
$servicio = \DigitalsiteSaaS\Carrito\Tenant\Configuracion::where('id', '=', 1)->get();
}

foreach ($servicio as $servicio){
$descriptionsite = $servicio->description;
}



foreach($decodew['payment'] as $decodea){
  $internalre = $decodea['internalReference'];
  $medio = $decodea['paymentMethodName'];
  $var5 = $decodea['amount']['from']['total'];
  $autorizacion = $decodea['authorization'];
}




  $decode = json_decode($result, true);
  $requestsd = $decode['requestId'];
  $documentoid = $decode['request']['buyer']['document'];
  $nombre = $decode['request']['buyer']['name'];
  $apellido = $decode['request']['buyer']['surname'];
  $direccion = $decode['request']['buyer']['address']['street'];
  $ciudad = $decode['request']['buyer']['address']['city'];
  $tipodocumento = $decode['request']['buyer']['documentType'];
  $estado = $decode['status']['status'];
  $date = $decode['status']['date'];
  $mensajema = $decode['status']['message'];


 



  $total = $this->total();
$subtotalweb = $this->subtotal();
$iva = $this->iva();
$precioenvio = $this->precioenvio();
$costoenvio = $this->costoenvio();
$preciomunicipio = $this->preciomunicipio();
$nombremunicipio = $this->nombremunicipio();
$descuento = $this->descuento();
 



$cart = session()->get('cart');

if(!$this->tenantName){
$order = Order::where('codigo_apr','=', $requestsd)->update([
//'descripcion' => $descriptionsite,
//'cantidad' => $producto->quantity,
//'subtotal' => $subtotalweb,
'fecha' => $date,
//'shipping' => $total,
//'iva_ord' => $iva,
//'cos_envio' => $precioenvio,
'codigo' => $autorizacion,
'mensaje' => $mensajema,
'estado' => $estado,
//'nombre' => $nombre,
//'apellido' => $apellido,
//'direccion' => $direccion,
//'ciudad' => $ciudad,
//'documento' => $documentoid,
'codigo_apr' => $requestsd,
'medio' => $medio,
'tipo' => $tipodocumento,
//'user_id'  => Auth::user()->id
]);
}else{
$order = \DigitalsiteSaaS\Carrito\Tenant\Order::where('codigo_apr','=', $requestsd)->update([
//'descripcion' => $descriptionsite,
//'cantidad' => $producto->quantity,
//'subtotal' => $subtotalweb,
'fecha' => $date,
//'shipping' => $total,
//'iva_ord' => $iva,
//'cos_envio' => $precioenvio,
'codigo' => $autorizacion,
'mensaje' => $mensajema,
'estado' => $estado,
//'nombre' => $nombre,
//'apellido' => $apellido,
//'direccion' => $direccion,
//'ciudad' => $ciudad,
//'documento' => $documentoid,
'codigo_apr' => $requestsd,
'medio' => $medio,
'tipo' => $tipodocumento,
//'user_id'  => Auth::user()->id
]);
}



/*
foreach($cart as $producto){
$this->saveOrderItemplace($producto, $order->id);
}


     \Session::forget('cart');
//foreach ($decode as $value) {
  //        $website =  print_r($value['status']);

       // if($website == 'PENDIENTE')
        // return Redirect('Pendiente');
      //else
        //return Redirect('Oyta');
      // }
//

*/
$total = $this->total();
$subtotal = $this->subtotal();
 if(!$this->tenantName){
$menu = \DigitalsiteSaaS\Pagina\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
$plantilla = \DigitalsiteSaaS\Pagina\Template::all();
$resultadoweb =  Transaccion::join('orders', 'transaccion.request_id', '=', 'orders.codigo_apr')
             ->where('referencia', '=' , $id)->get();
}else{
$menu = \DigitalsiteSaaS\Pagina\Tenant\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
$plantilla = \DigitalsiteSaaS\Pagina\Tenant\Template::all();
$resultadoweb =  \DigitalsiteSaaS\Carrito\Tenant\Transaccion::join('orders', 'transaccion.request_id', '=', 'orders.codigo_apr')
             ->where('referencia', '=' , $id)->get();
}

    return view('carrito::respuesta', compact('resultadoweb','plantilla','menu','subtotal','total'));


}
}


protected function placenotificacion()
{

 $rest=json_decode(file_get_contents('php://input'), true);
   
 print_r($rest);

 $val = sha1 ($rest['requestId'] . $rest['status']['status'] . $rest['status']['date'] . 'oY692mksC16yNn6c');
 


 if ($val==$rest['signature']) {
 

  $seed = date('c');

  if (function_exists('random_bytes')) {
  $nonce = bin2hex(random_bytes(16));
  } elseif (function_exists('openssl_random_pseudo_bytes')) {
  $nonce = bin2hex(openssl_random_pseudo_bytes(16));
  } else {
  $nonce = mt_rand();
  }
$servicio = DB::table('configuracion')->where('id', '=', 1)->get();
foreach ($servicio as $servicio){
$secretKey = $servicio->login;
$secretKey = $servicio->trankey;
}


  $nonceBase64 = base64_encode($nonce);

  $tranKey = base64_encode(sha1($nonce . $seed . $servicio->trankey, true));

$request = [
  'auth' => [
  'login' => $servicio->login,
  'seed' => date('c'),
  'nonce' => $nonceBase64,
  'tranKey' => $tranKey,
  ],
];



//return $request;
$redireccionplace = DB::table('configuracion')->where('id', '=', 1)->get();
foreach ($redireccionplace as $redireccionplace){
$url = $redireccionplace->url_produccion.$rest['requestId'];
}


//Se inicia. el objeto CUrl
$ch = curl_init($url);

//creamos el json a partir del arreglo
$jsonDataEncoded = json_encode($request);


//Indicamos que nuestra petición sera Post
curl_setopt($ch, CURLOPT_POST, 1);

//para que la peticion no imprima el resultado como un echo comun, y podamos manipularlo
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//Adjuntamos el json a nuestra petición
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);


  //Agregar los encabezados del contenido
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'User-Agent: cUrl Testing'));

//Ejecutamos la petición
$result = curl_exec($ch);




//
$decodew = json_decode($result, true);
//return $decode;
print_r($decodew);
  //              $var1 = $decode['reason'];
               
     
//echo $var1.'<br />';
if($decodew['payment'] == null){
$order = Order::where('codigo_apr','=',  $decodew['requestId'])->update([

//'descripcion' => $descriptionsite,
//'cantidad' => $producto->quantity,
//'subtotal' => $subtotalweb,
//'fecha' => $date,
//'shipping' => $total,
//'iva_ord' => $iva,
//'cos_envio' => $precioenvio,
//'mensaje' => $mensaje,
//'codigo' => $autorizacion,
'estado' => 'REJECTED',
//'nombre' => $nombre,
//'apellido' => $apellido,
//'direccion' => $direccion,
//'ciudad' => $ciudad,
//'documento' => $documentoid,
//'codigo_apr' => $requestsd,
//'medio' => $medio,
//'tipo' => $tipodocumento,
//'user_id'  => Auth::user()->id
]);
}

else{

foreach($decodew['payment'] as $decodea){
  $internalre = $decodea['internalReference'];
  $medio = $decodea['paymentMethodName'];
  $autorizacion = $decodea['authorization'];
}
 



  $decode = json_decode($result, true);
  $requestsd = $decode['requestId'];
  $documentoid = $decode['request']['buyer']['document'];
  $nombre = $decode['request']['buyer']['name'];
  $apellido = $decode['request']['buyer']['surname'];
  $direccion = $decode['request']['buyer']['address']['street'];
  $ciudad = $decode['request']['buyer']['address']['city'];
  $tipodocumento = $decode['request']['buyer']['documentType'];
  $estado = $decode['status']['status'];
  $estado = $decode['status']['status'];
  $date = $decode['status']['date'];
  $mensaje = $decode['status']['message'];
 






$order = Order::where('codigo_apr','=',  $requestsd)->update([

//'descripcion' => $descriptionsite,
//'cantidad' => $producto->quantity,
//'subtotal' => $subtotalweb,
'fecha' => $date,
//'shipping' => $total,
//'iva_ord' => $iva,
//'cos_envio' => $precioenvio,
'mensaje' => $mensaje,
'codigo' => $autorizacion,
'estado' => $estado,
'nombre' => $nombre,
'apellido' => $apellido,
'direccion' => $direccion,
//'ciudad' => $ciudad,
'documento' => $documentoid,
'codigo_apr' => $requestsd,
'medio' => $medio,
'tipo' => $tipodocumento,
//'user_id'  => Auth::user()->id
]);

}


 
   
   }else{
   
    echo '<br>';
    echo 'Generado: '. $val;
    echo '<br>';
    echo 'muestra: feb3e7cc76939c346f9640573a208662f30704ab';
    echo '<br>';
    echo 'recibido: ' . $rest['signature'];
   }


}







protected function saveOrderItemplace($producto, $order_id){
   
       if(!$this->tenantName){
OrderItem::create([
'price' => $producto->precio,
'quantity' => $producto->quantity,
'product_id' => $producto->id,
'order_id' => $order_id,
'user_id' => Auth::user()->id
]);
   }else{
   \DigitalsiteSaaS\Carrito\Tenant\OrderItem::create([
   
'price' => $producto->precio,
'quantity' => $producto->quantity,
'product_id' => $producto->id,
'order_id' => $order_id,
'user_id' => Auth::user()->id
]);
   }

}









public function responseserver(Request $request) {
$description =  '150';
$medidad =  'Aceptadapor';
$codigo =  '1111';


  if($description ='150')
    {
   
    DB::table('orders')
            ->where('id', $description)
            ->update(array('estado' => $medidad,'codigo' => $codigo));

    }
}




     public function actionIndexweb()
    {
        if($_POST)
        {
            Session::put('subcategoria', Input::get('subcategoria'));
            Session::put('clientes', Input::get('clientes'));
            Session::put('autor', Input::get('autor'));
            Session::put('parametro', Input::get('parametro'));
            Session::put('area', Input::get('area'));
             return Redirect('/carrito');
        }
       
     
           
       
    }


       public function limpieza()
    {
       session()->forget('miSesionTexto');
       session()->forget('miSesionTextouno');


       return Redirect('/cart/detail');
    }


        public function limpiezaweb()
    {
       session()->forget('subcategoria');
       session()->forget('clientes');
       session()->forget('autor');
       session()->forget('parametro');
       session()->forget('area');

       return Redirect('/carrito');
    }


        public function registrar(){
        if(!$this->tenantName){
          $seo = Seo::where('id','=',1)->get();
    $plantilla = \DigitalsiteSaaS\Pagina\Template::all();
    $plantillaes = \DigitalsiteSaaS\Pagina\Template::all();
    $terminos = \DigitalsiteSaaS\Pagina\Template::all();
$cart = session()->get('cart');
$total = $this->total();
$subtotal = $this->subtotal();
$menu = \DigitalsiteSaaS\Pagina\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
$categories = Pais::all();
$colors = DB::table('colors')->get();
}else{
  $seo = \DigitalsiteSaaS\Pagina\Tenant\Seo::where('id','=',1)->get();
$plantilla = \DigitalsiteSaaS\Pagina\Tenant\Template::all();
    $plantillaes = \DigitalsiteSaaS\Pagina\Tenant\Template::all();
    $terminos = \DigitalsiteSaaS\Pagina\Tenant\Template::all();
$cart = session()->get('cart');
$total = $this->total();
$subtotal = $this->subtotal();
$menu = \DigitalsiteSaaS\Pagina\Tenant\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
$categories = \DigitalsiteSaaS\Carrito\Tenant\Pais::all();
$colors = DB::table('colors')->get();
}
return view('carrito::users.registrar')->with('plantilla', $plantilla)->with('plantillaes', $plantillaes)->with('menu', $menu)->with('cart', $cart)->with('total', $total)->with('subtotal', $subtotal)->with('categories', $categories)->with('terminos', $terminos)->with('colors', $colors)->with('seo', $seo);

   

    }
//'user_id'  => Auth::user()->id

        public function detalleuser(){
        if(!$this->tenantName){
       $plantilla = \DigitalsiteSaaS\Pagina\Template::all();
       $terminos = \DigitalsiteSaaS\Pagina\Template::all();
  $cart = session()->get('cart');
  $total = $this->total();
  $subtotal = $this->subtotal();
  $ordenes = Order::where('user_id', '=' ,Auth::user()->id )->get();
      $menu = \DigitalsiteSaaS\Pagina\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
 $categories = Pais::all();
}else{
 $plantilla = \DigitalsiteSaaS\Pagina\Tenant\Template::all();
       $terminos = \DigitalsiteSaaS\Pagina\Tenant\Template::all();
  $cart = session()->get('cart');
  $total = $this->total();
  $subtotal = $this->subtotal();
  $ordenes = \DigitalsiteSaaS\Carrito\Tenant\Order::where('user_id', '=' ,Auth::user()->id )->get();
      $menu = \DigitalsiteSaaS\Pagina\Tenant\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
 $categories = \DigitalsiteSaaS\Carrito\Tenant\Pais::all();
}
 return view('carrito::detalle')->with('plantilla', $plantilla)->with('menu', $menu)->with('cart', $cart)->with('total', $total)->with('subtotal', $subtotal)->with('categories', $categories)->with('terminos', $terminos)->with('ordenes', $ordenes);

    }

    public function webdepartamentos()
{
$cat_id = Input::get('cat_id');
if(!$this->tenantName){
$subcategories = \DigitalsiteSaaS\Carrito\Departamento::where('pais_id', '=', $cat_id)->get();
}else{
$subcategories = \DigitalsiteSaaS\Carrito\Tenant\Departamento::where('pais_id', '=', $cat_id)->get();
}
return Response::json($subcategories);
}

public function webmunicipios()
{
$cat_id = Input::get('cat_id');
if(!$this->tenantName){
        $subcategories = \DigitalsiteSaaS\Carrito\Municipio::where('departamento_id', '=', $cat_id)->get();
    }else{
    $subcategories = \DigitalsiteSaaS\Carrito\Tenant\Municipio::where('departamento_id', '=', $cat_id)->get();
    }
        return Response::json($subcategories);
}


public function actionIndex()
    {
    if($_POST)
    {
    Session::put('miSesionTexto', Input::get('ciudad'));
            Session::put('miSesionTextouno', Input::get('municipio'));
    }
    if(Input::get('pais') == null){
        return view('index');
        }
    else{
    return Redirect('/cart/detail');
    }
    }



public function importExport()
{
return view('importExport');
}


public function downloadExcel($type)
{
$data = User::where('rol_id','=','2')->get()->toArray();
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
return Excel::create('Listado-Usuarios', function($excel) use ($data) {
$excel->sheet('Usuario', function($sheet) use ($data)
       {
$sheet->fromArray($data);
       });
})->download($type);
}


public function importExcel()
{
if(Input::hasFile('import_file')){
$path = Input::file('import_file')->getRealPath();
$data = Excel::load($path, function($reader) {
})->get();
if(!empty($data) && $data->count()){
foreach ($data as $key => $value) {
$insert[] = [
'name' => $value->name,
'last_name' => $value->last_name,
'tipo_documento' => $value->tipo_documento,
'documento' => $value->documento,
'email' => $value->email,
'address' => $value->address,
'inmueble' => $value->inmueble,
'numero' => $value->numero,
'codigo' => $value->codigo,
'phone' => $value->phone,
'celular' => $value->celular,
'fax' => $value->fax,
'compania' => $value->compania,
'pais' => $value->pais,
'ciudad' => $value->ciudad,
'region' => $value->region,
'rol_id' => $value->rol_id,
'password' => $value->password,
'remember_token' => $value->remember_token

];
}
if(!empty($insert)){
DB::table('users')->insert($insert);
return Redirect('gestion/carrito')->with('status', 'ok_create');
}
}
}
return back();
}




public function importExportmun()
{
return view('importExport');
}


public function downloadExcelmun($type)
{
$data = Municipio::get()->toArray();
return Excel::create('Listado-Municipios', function($excel) use ($data) {
$excel->sheet('Municipios', function($sheet) use ($data)
       {
$sheet->fromArray($data);
       });
})->download($type);
}


public function importExcelmun()
{
if(Input::hasFile('import_file')){
$path = Input::file('import_file')->getRealPath();
$data = Excel::load($path, function($reader) {
})->get();
if(!empty($data) && $data->count()){
foreach ($data as $key => $value) {
$insert[] = [
'municipio' => $value->municipio,
'estado' => $value->estado,
'departamento_id' => $value->departamento_id,
'p_municipio' => $value->p_municipio
];
}
if(!empty($insert)){
DB::table('municipios')->insert($insert);
return Redirect('gestion/carrito/envio')->with('status', 'ok_create');
}
}
}
return back();
}



public function importExportpro()
{
return view('importExport');
}


public function downloadExcelpro($type)
{
$data = Product::get()->toArray();
return Excel::create('Listado-Productos', function($excel) use ($data) {
$excel->sheet('Products', function($sheet) use ($data)
       {
$sheet->fromArray($data);
       });
})->download($type);
}


public function importExcelpro()
{
if(Input::hasFile('import_file')){
$path = Input::file('import_file')->getRealPath();
$data = Excel::load($path, function($reader) {
})->get();
if(!empty($data) && $data->count()){
foreach ($data as $key => $value) {
$insert[] = [
'municipio' => $value->municipio,
'estado' => $value->estado,
'departamento_id' => $value->departamento_id,
'p_municipio' => $value->p_municipio
];
}
if(!empty($insert)){
DB::table('products')->insert($insert);
return Redirect('gestion/carrito/categoria')->with('status', 'ok_create');
}
}
}
return back();
}




}