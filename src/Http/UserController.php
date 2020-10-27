<?php

namespace DigitalsiteSaaS\Carrito\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DigitalsiteSaaS\Carrito\Product;
use DigitalsiteSaaS\Carrito\User;
use DigitalsiteSaaS\Carrito\Departamento;
use DigitalsiteSaaS\Carrito\Pais;
use DigitalsiteSaaS\Carrito\Municipio;
use DigitalsiteSaaS\Carrito\Category;
use Input;
use Illuminate\Support\Str;
use DB;
use Mail;
use App\Mail\Registroecommerce;
use App\Mail\Registro;
use Illuminate\Support\Facades\Hash;
use DigitalsiteSaaS\Usuario\Usuario;
use GuzzleHttp\Client;
use Session;
use Response;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\HostnameRepository;
use Hyn\Tenancy\Repositories\WebsiteRepository;

class UserController extends Controller{

  protected $tenantName = null;

  public function __construct(){

  $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
        if ($hostname){
            $fqdn = $hostname->fqdn;
            $this->tenantName = explode(".", $fqdn)[0];
        }
    }

	public function index()
    {
    if(!$this->tenantName){
    $usuarios = User::all();
    }else{
    $usuarios = \DigitalsiteSaaS\Carrito\Tenant\User::all();
    } 
    //dd($usuarios);
    return view('carrito::users.index', compact('usuarios'));
    }

     	public function ordenes($id)
    {
    $ordenes = User::find($id)->Orders;
    //dd($usuarios);
    return view('carrito::users.ordenes', compact('ordenes'));
    }

        public function pruebas($id)
    {
   $productos =DB::table('order_items')
             ->join('products', 'products.id', '=', 'order_items.product_id')
             ->where('order_items.order_id', '=' ,$id)->get();

    $usuarios = DB::table('orders')
              ->join('users', 'users.id', '=', 'orders.user_id')
              ->where('orders.user_id', '=', '21')->get();

                return view('carrito::users.pruebas', compact('productos','usuarios'));

    }

         public function show()
    {
        $plantilla = \DigitalsiteSaaS\Pagina\Template::all();
        $menu = \DigitalsiteSaaS\Pagina\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
        $cart = session()->get('cart');
        $url = DB::table('configuracion')->where('id', '=', 1)->get();
        $iva = $this->iva();
        $total = $this->total();
        $subtotal = $this->subtotal();
        $descuento = $this->descuento();
        $categoriapro = DB::table('categoriessd')->get();
        $categories = Pais::all();
       
        return view('carrito::cart', compact('cart', 'total', 'plantilla', 'menu', 'subtotal', 'iva', 'descuento', 'url', 'categoriapro', 'categories'));

    }

      
/*
 public function login(Request $request){


  
$client = new Client(['http_errors' => false]);

$response = $client->post('https://evaback.lyl.com.co:8000/api/ws/evaauthservice', [

    'form_params' => [
        'username' => Input::get('email'),
        'password' => Input::get('password'),
        'action' => 'login',
    ],
   
   ]);




 $xml = json_decode($response->getBody()->getContents(), true);

  $urlprocess = $xml['status'];
  $urlprocessa = $xml['data']['email'];
  $urlprocessb = $xml['data']['school_type'];
  $urlprocessc = $xml['data']['user_name'];
 


Session::put('miSesionTextoaaaa',$urlprocessa);
 Session::put('miSesionTextoaaac',$urlprocessb);
  Session::put('miSesionTextoaaad',$urlprocessc);

  return Redirect('/');

  //return Response::json(array($urlprocess));
    }

  public function limpiezaold() {

  session()->forget('miSesionTextoaaaa');
  session()->forget('miSesionTextoaaac');

   return Redirect('/');

}

   */







public function crear() {

    $password = Input::get('password');
    $remember = Input::get('_token');
    if(!$this->tenantName){
    $user = new Usuario;
    }else{
    $user = new \DigitalsiteSaaS\Usuario\Tenant\Usuario;  
    }
    $user->name = Input::get('name');
    $user->tipo_documento = Input::get('tdocumento');
    $user->documento = Input::get('documento');
    $user->celular = Input::get('celular');
    $user->fax = Input::get('fax');
    $user->compania = Input::get('compania');
    $user->pais_id = Input::get('pais');
    $user->ciudad = Input::get('ciudad');
    $user->region = Input::get('municipio');
    $user->last_name = Input::get('last_name');
    $user->email = Input::get('email');
    $user->address = Input::get('address');
    $user->inmueble = Input::get('inmueble');
    $user->numero = Input::get('numero');
    $user->codigo = Input::get('codigo');
    $user->phone = Input::get('phone');
    $user->rol_id = Input::get('level');
    $user->remember_token = Input::get('_token');
    $user->password = Hash::make($password);
    $user->remember_token = Hash::make($remember);
    $user->save();
/*
     $datas = DB::table('datos')->where('id','1')->get();
        foreach ($datas as $userma){
            Mail::to(Input::get('email'))
                ->bcc($userma->correo)
                ->send(new Registroecommerce($user));
*/
    return Redirect('cart/detail')->with('status', 'ok_create');
  }  



    public function editar($id){
    $user = User::find($id);
     return view('carrito::users.editar', compact('user'));
    }

     public function valiemail(){
     if(!$this->tenantName){
     $user = User::where('email', Input::get('email'))->count();
     }else{
     $user = \DigitalsiteSaaS\Carrito\Tenant\User::where('email', Input::get('email'))->count(); 
     }
     if($user > 0){
     $isAvailable = FALSE;
     }else{
     $isAvailable = TRUE;
     }
     echo json_encode(
     array(
     'valid' => $isAvailable
     )); 
    }




    public function actualizar($id){
    $input = Input::all();
    $user = User::find($id);
    $user->name = Input::get('name');
    $user->email = Input::get('email');

    $user->save();
    return Redirect('gestion/usuarios');
    }

  public function eliminar($id){

        $user = User::find($id);
        $user->delete();
        
        return Redirect('/gestion/usuarios');
    }


public function get_fama(){

    $usuarios = User::all()->random(1);
        dd($usuarios);
    }
    

 


}



