<?php

namespace DigitalsiteSaaS\Carrito\Http;

use Illuminate\Http\Request;
use Input;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DigitalsiteSaaS\Carrito\Product;
use DigitalsiteSaaS\Carrito\Autor;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\HostnameRepository;
use Hyn\Tenancy\Repositories\WebsiteRepository;
use DigitalsiteSaaS\Pagina\Seo;



class StoreController extends Controller{

            protected $tenantName = null;

  public function __construct(){

  $hostname = app(\Hyn\Tenancy\Environment::class)->hostname();
        if ($hostname){
            $fqdn = $hostname->fqdn;
            $this->tenantName = explode(".", $fqdn)[0];
        }
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

    public function index()
    {

         $min_price = Input::has('min_price') ? Input::get('min_price') : 0;
       $max_price = Input::has('max_price') ? Input::get('max_price') : 10000000;
       $clientes =  Input::get('clientes');

        $plantilla = \DigitalsiteSaaS\Pagina\Template::all();
        $menu = \DigitalsiteSaaS\Pagina\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
    	$products = DB::table('products')
         ->whereBetween('precio', array($min_price, $max_price))
         ->where('category_id', 'like', '%' . $clientes . '%')
         ->get();
    	//dd($products);
    	return view('carrito::index', compact('products', 'plantilla', 'menu', 'clientes'));

    }


    public function show($slug)
    {
        if(!$this->tenantName){
        $plantilla = \DigitalsiteSaaS\Pagina\Template::all();
        $menu = \DigitalsiteSaaS\Pagina\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
        $total = $this->total();
        $subtotal = $this->subtotal();
        $cart = session()->get('cart');
        $url = DB::table('configuracion')->where('id', '=', 1)->get();
        $autores = Autor::all();
        $autoresweb = DB::table('autor')->get();
    	$product = Product::where('slug', $slug)->first();
        $categoriapro = DB::table('categoriapro')->get();
        $categoriessd = DB::table('categoriessd')->get();
        $seo = Seo::where('id','=',1)->get();
        $products = Product::inRandomOrder()->take(4)->get();
        }else{
        $plantilla = \DigitalsiteSaaS\Pagina\Tenant\Template::all();
        $menu = \DigitalsiteSaaS\Pagina\Tenant\Page::whereNull('page_id')->orderBy('posta', 'desc')->get();
        $total = $this->total();
        $subtotal = $this->subtotal();
        $seo =  \DigitalsiteSaaS\Pagina\Tenant\Seo::where('id','=',1)->get(); 
        $cart = session()->get('cart');
        $url = DB::table('configuracion')->where('id', '=', 1)->get();
        $autores = \DigitalsiteSaaS\Carrito\Tenant\Autor::all();
        $autoresweb = Autor::all();
        $product = \DigitalsiteSaaS\Carrito\Tenant\Product::where('slug', $slug)->first();
        $categoriapro = DB::table('categoriapro')->get();
        $products = \DigitalsiteSaaS\Pagina\Tenant\Product::inRandomOrder()->take(4)->get();
        $categoriessd = DB::table('categoriessd')->get();  
        }
    	return view('carrito::show', compact('product', 'plantilla', 'menu', 'total', 'subtotal', 'cart', 'url', 'autores', 'autoresweb', 'categoriapro','categoriessd','seo','products'));
    }


}

