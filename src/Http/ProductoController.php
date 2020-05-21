<?php

namespace DigitalsiteSaaS\Carrito\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DigitalsiteSaaS\Carrito\Product;
use DigitalsiteSaaS\Carrito\Autor;
use DigitalsiteSaaS\Carrito\Area;
use DigitalsiteSaaS\Carrito\Parametro;
use DigitalsiteSaaS\Carrito\Category;
use Input;
use Illuminate\Support\Str;
use DB;
use Session;
use Hyn\Tenancy\Models\Hostname;
use Hyn\Tenancy\Models\Website;
use Hyn\Tenancy\Repositories\HostnameRepository;
use Hyn\Tenancy\Repositories\WebsiteRepository;

class ProductoController extends Controller{

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
    $products = Product::orderBy('id', 'desc')->paginate(5);
    dd($products);
    }    
    
    public function digitales($id){
    if(!$this->tenantName){   
	$productos = Category::find($id)->Products;
    }else{
    $productos = \DigitalsiteSaaS\Carrito\Tenant\Category::find($id)->Products;
    }
	return view('carrito::productos.index', compact('productos'));
	}

	public function editarproducto($id){
    if(!$this->tenantName){   
    $autores = Autor::all();

    $parametros = Parametro::all();
    $pages = \DigitalsiteSaaS\Pagina\Page::all();
    if(\DigitalsiteSaaS\Pagina\Venta::where('id', '1')->value('comunidad') == 1)
    $productos = Product::join('autor', 'autor.id', '=', 'products.autor_id')
    ->leftJoin('parametro', 'parametro.id', '=', 'products.parametro_id')
    ->where('products.id', '=' ,$id)->get();
    else
    $productos = Product::join('autor', 'autor.id', '=', 'products.autor_id')
    ->where('products.id', '=' ,$id)->get();

    //$paginas =DB::table('pages')
      //      ->join('products', 'products.page_id', '=', 'pages.id')
        //    ->where('products.id', '=' ,$id)->get();
    }else{

     $autores = \DigitalsiteSaaS\Carrito\Tenant\Autor::all();

    $parametros = \DigitalsiteSaaS\Carrito\Tenant\Parametro::all();
    $pages = \DigitalsiteSaaS\Pagina\Tenant\Page::all();
    if(\DigitalsiteSaaS\Pagina\Tenant\Venta::where('id', '1')->value('comunidad') == 1)
    $productos = \DigitalsiteSaaS\Carrito\Tenant\Product::join('autor', 'autor.id', '=', 'products.autor_id')
    ->leftJoin('parametro', 'parametro.id', '=', 'products.parametro_id')
    ->where('products.id', '=' ,$id)->get();
    else
    $productos = Product::join('autor', 'autor.id', '=', 'products.autor_id')
    ->where('products.id', '=' ,$id)->get();

    //$paginas =DB::table('pages')
      //      ->join('products', 'products.page_id', '=', 'pages.id')
        //    ->where('products.id', '=' ,$id)->get();

    }     

     return view('carrito::productos.editar', compact('productos','pages','autores','pages','parametros'))->with('status', 'ok_update');

    }

     public function crear($id)
    {
        if(!$this->tenantName){
        $paginas = \DigitalsiteSaaS\Pagina\Page::all();
        $autores = Autor::all();
        $categoria = Category::where('id', '=', $id )->get();
    
        $parametros = Parametro::all();
        }else{
        $paginas = \DigitalsiteSaaS\Pagina\Tenant\Page::all();
        $autores = \DigitalsiteSaaS\Carrito\Tenant\Autor::all();
        $categoria = \DigitalsiteSaaS\Carrito\Tenant\Category::where('id', '=', $id )->get();
        
        $parametros = \DigitalsiteSaaS\Carrito\Tenant\Parametro::all();
        }
        return view('carrito::productos.crear')->with('paginas', $paginas)->with('autores', $autores)->with('parametros', $parametros)->with('categoria', $categoria);
    }


    public function show(){
    if(!$this->tenantName){
    $categoria = new Product;
    }else{
    $categoria = new \DigitalsiteSaaS\Carrito\Tenant\Product;   
    }
    $categoria->name = Input::get('nombre');
    $categoria->slug = Str::slug($categoria->name);
    $categoria->description = Input::get('descripcion');
    $categoria->contenido = Input::get('contenido');
    $categoria->precio = Input::get('precio');
    $categoria->descuento = Input::get('descuento');
    $categoria->preciodesc = $categoria->precio*$categoria->descuento/100;
    $categoria->preciodescfin = $categoria->precio-$categoria->preciodesc; 
    $categoria->iva = Input::get('iva');
    $categoria->precioiniva = $categoria->precio*$categoria->iva/100;
    $categoria->precioiva = $categoria->preciodescfin*$categoria->iva/100;
    $categoria->precioivafin = $categoria->precio+$categoria->precioiniva;
    $categoria->precioinivafin = $categoria->preciodescfin+$categoria->precioiva;
    $categoria->image = Input::get('FilePath');
    $categoria->visible = Input::get('nivel');
    $categoria->category_id = Input::get('peca');
    $categoria->position = Input::get('posicion');
    $categoria->stock = Input::get('stock');
    $categoria->responsive = Input::get('responsive');
    $categoria->animacion = Input::get('animacion');
    $categoria->ano = Input::get('ano');
    $categoria->referencia = Input::get('referencia');
    $categoria->parametro_id = Input::get('parametro');
    $categoria->autor_id = Input::get('autor');
    $categoria->categoriapro_id = Input::get('categoriapro');
    $categoria->save();
       return Redirect('/gestion/productos/digitales/'.$categoria->category_id)->with('status', 'ok_create');
    }

 
    public function actualizar($id){
    $input = Input::all();
    if(!$this->tenantName){
    $categoria = Product::find($id);
    }else{
    $categoria = \DigitalsiteSaaS\Carrito\Tenant\Product::find($id);   
    }
    $categoria->name = Input::get('nombre');
    $categoria->slug = Str::slug($categoria->name);
    $categoria->description = Input::get('descripcion');
    $categoria->contenido = Input::get('contenido');
    $categoria->precio = Input::get('precio');
    $categoria->descuento = Input::get('descuento');
    $categoria->preciodesc = $categoria->precio*$categoria->descuento/100;
    $categoria->preciodescfin = $categoria->precio-$categoria->preciodesc; 
    $categoria->iva = Input::get('iva');
    $categoria->precioiniva = $categoria->precio*$categoria->iva/100;
    $categoria->precioiva = $categoria->preciodescfin*$categoria->iva/100;
    $categoria->precioivafin = $categoria->precio+$categoria->precioiniva;
    $categoria->precioinivafin = $categoria->preciodescfin+$categoria->precioiva;
    $categoria->image = Input::get('FilePath');
    $categoria->visible = Input::get('nivel');
    $categoria->position = Input::get('posicion');
    $categoria->stock = Input::get('stock');
    $categoria->responsive = Input::get('responsive');
    $categoria->animacion = Input::get('animacion');

    $categoria->ano = Input::get('ano');
    $categoria->referencia = Input::get('referencia');
    $categoria->parametro_id = Input::get('parametro');
    $categoria->autor_id = Input::get('autor');
    $categoria->categoriapro_id = Input::get('categoriapro');
    $categoria->save();
    return Redirect('gestion/productos/digitales/'.$categoria->category_id)->with('status', 'ok_update');
    }


   public function eliminar($id){
    if(!$this->tenantName){
    $categoria = Product::find($id);
    }else{
    $categoria = \DigitalsiteSaaS\Carrito\Tenant\Product::find($id);    
    }
    $categoria->delete();
        
    return Redirect('/gestion/productos/digitales/'.$categoria->category_id)->with('status', 'ok_delete');
    }



}

