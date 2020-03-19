<?php

namespace DigitalsiteSaaS\Carrito\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DigitalsiteSaaS\Carrito\Category;
use DigitalsiteSaaS\Carrito\Categoria;
use DigitalsiteSaaS\Carrito\Order;
use DigitalsiteSaaS\Carrito\Autor;
use DigitalsiteSaaS\Carrito\Product;
use DigitalsiteSaaS\Carrito\OrderItem;
use DigitalsiteSaaS\Carrito\Configuracion;
use Illuminate\Support\Facades\Input;
use DigitalsiteSaaS\Usuario\Usuario;
use DigitalsiteSaaS\Pagina\Template;
use DB;
use Auth;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


       public function configuracion()
    {
     $categories = DB::table('configuracion')->where('id', '=', 1)->get();
     return view('carrito::configuracion', compact('categories'));

    }
    public function index()
    {
    return view('carrito::admin.home');
        
    }

  


public function show()
    {
        $categories = Categoria::all();
        //dd($categories);
        return view('carrito::admin.index', compact('categories'));
    }


    public function dashboard()
    {

    
    
        $dashboard = DB::table('order_items')
        ->join('products', 'products.id', '=', 'order_items.product_id')
        ->select(DB::raw('SUM(quantity) as cantidad'),DB::raw('(name) as product'))
        ->groupBy('product_id')
        ->get();

        $franquicia = DB::table('orders')
        ->select(DB::raw('count(medio) as conteo'),DB::raw('(medio) as nombre'))
        ->groupBy('medio')
        ->get();

        $meses = DB::table('orders')
        ->select(DB::raw('count(fecha) as conteo'),DB::raw('(fecha) as nombre'))
        ->groupBy(DB::raw("DATE_FORMAT(fecha, '%m')"))
        ->get();


        $total = DB::table('orders')->sum('shipping');
        $product = DB::table('order_items')->sum('quantity');
        $conteo = DB::table('orders')->count();


        return view('carrito::admin.dashboard', compact('dashboard','total','conteo','product','franquicia','meses','totalweb'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createca()
    {
        return view('carrito::admin.create');
    }


      public function terminos()
    {
        $plantilla = DB::table('template')->get();  
        return view('carrito::terminos')->with('plantilla', $plantilla)->with('status', 'ok_update');
    }



        public function update(){

        $input = Input::all();
        $contenido = Template::find(1);

        $contenido->terminos = Input::get('terminos');


        
        $contenido->save();
        return Redirect('/gestion/carrito/terminos')->with('status', 'ok_update');
        }




      public function createcategoria()
    {

    $categoria = new Category;
    $categoria->name = Input::get('nombre');
    $categoria->description = Input::get('descripcion');
    $categoria->color = Input::get('color');
    $categoria->categoriapro_id = Input::get('categoriapro');
    $categoria->save();
        return redirect('/gestion/carrito/subcategorias/'.$categoria->categoriapro_id)->with('status', 'ok_create');
    }


          public function createcategoriaproductos()
    {

    $categoria = new Categoria;
    $categoria->nombre = Input::get('nombre');
    $categoria->descripcion = Input::get('descripcion');
    $categoria->color = Input::get('color');
    $categoria->save();
        return redirect('gestion/carrito/categorias')->with('status', 'ok_create');
    }


         public function creacionautor()
    {

    $autor = new Autor;
    $autor->nombre = Input::get('nombre');
    $autor->descripcion = Input::get('descripcion');
    $autor->pais = Input::get('pais');
    $autor->imageaut = Input::get('FilePath');
    $autor->video = Input::get('video');
    $autor->facebook = Input::get('facebook');
    $autor->twitter = Input::get('twitter');
    $autor->linkedin = Input::get('linkedin');
    $autor->youtube = Input::get('youtube');
    $autor->vimeo = Input::get('vimeo');
    $autor->website = Input::get('website');
    $autor->email = Input::get('email');
    $autor->save();
    return redirect('/gestion/carrito/autores')->with('status', 'ok_create');;
    }


    public function actualizarautor($id){
    $input = Input::all();
    $autor = Autor::find($id);
    $autor->nombre = Input::get('nombre');
    $autor->descripcion = Input::get('descripcion');
    $autor->pais = Input::get('pais');
    $autor->imageaut = Input::get('FilePath');
    $autor->video = Input::get('video');
    $autor->facebook = Input::get('facebook');
    $autor->twitter = Input::get('twitter');
    $autor->linkedin = Input::get('linkedin');
    $autor->youtube = Input::get('youtube');
    $autor->vimeo = Input::get('vimeo');
    $autor->website = Input::get('website');
    $autor->email = Input::get('email');
    $autor->save();
    return Redirect('/gestion/carrito/autores')->with('status', 'ok_update');;
    }


    public function editarcategoriawebproducto($id){
    $input = Input::all();
    $categoria = Categoria::find($id);
    $categoria->nombre = Input::get('nombre');
    $categoria->descripcion = Input::get('descripcion');
    $categoria->color = Input::get('color');
    $categoria->save();
    return Redirect('/gestion/carrito/categorias')->with('status', 'ok_update');;
    }




    public function editarcategoriaweb($id){
    $input = Input::all();
    $categoria = Category::find($id);
    $categoria->name = Input::get('nombre');
    $categoria->description = Input::get('descripcion');
    $categoria->color = Input::get('color');
    $categoria->categoriapro_id = Input::get('categoriapro');
    $categoria->save();
    return Redirect('/gestion/carrito/subcategorias/'.$categoria->categoriapro_id)->with('status', 'ok_update');
    }






  
    public function autoreliminar($id){

        $autor = Autor::find($id);
        $autor->delete();
        
        return Redirect('/gestion/carrito/autores')->with('status', 'ok_delete');;
    }


    public function editarcategoria($id){
    $categories = Category::find($id);
     return view('carrito::admin.editar', compact('categories'));
    }

    public function editarcategoriaproducto($id){
    $categories = Categoria::find($id);
     return view('carrito::admin.editarproducto', compact('categories'));
    }


    public function autoreditar($id){
    $autores = DB::table('autor')->where('id', '=', $id)->get();
     return view('carrito::admin.editarautor', compact('autores'));
    }

    public function actualizar($id){
    $input = Input::all();
    $categoria = Category::find($id);
    $categoria->name = Input::get('nombre');
    $categoria->description = Input::get('descripcion');
    $categoria->color = Input::get('color');
    $categoria->save();
    return Redirect('gestion/carrito/categorias');
    }

    public function eliminar($id){

        $categoria = Categoria::find($id);
        $categoria->delete();
        
        return Redirect('gestion/carrito/categorias')->with('status', 'ok_delete');
    }


    public function eliminarproducto($id){

        $categoria = Category::find($id);
        $categoria->delete();
        
        return Redirect('/gestion/carrito/subcategorias/'.$categoria->categoriapro_id)->with('status', 'ok_delete');
    }


     public function epayco(){

        $ordenes = Order::OrderBy('id', 'desc')->get();


       return view('carrito::admin.epayco', compact('ordenes'));
    }


     public function createautor(){
       return view('carrito::admin.crear-autor')->with('status', 'ok_create');
    }

         public function detalle($id){

  
        $productos = OrderItem::join('products','products.id','=','order_items.product_id')
        ->join('orders','orders.id','=','order_items.order_id')
        ->where('order_id', '=', $id)->get();

        

        $users = DB::table('orders')->where('id',  $id)->get();      
        foreach ($users as $userma){
        if($userma->ciudad == 0){
        $informacion = DB::table('orders')
        ->where('orders.id', '=', $id)
        ->get();
        }
        else{
        $informacion = DB::table('orders')
        ->join('municipios', 'municipios.id', '=', 'orders.ciudad')
        ->join('departamentos', 'departamentos.id', '=', 'orders.departamento')
        ->where('orders.id', '=', $id)
        ->get();
        }
        }
      
        $informacionorder = DB::table('orders')->where('id', '=', $id)->get();
        $datos = DB::table('orders')->where('id', '=', $id)->get();

        $totales = DB::table('orders')->where('id', '=', $id)->get();

        //$envios = DB::table('orders')
        //->join('municipios', 'municipios.municipio', '=', 'orders.ciudad')
        //->where('orders.id', '=' , $id)->get();

        $users = DB::table('orders')->where('id',  $id)->get();      
        foreach ($users as $user){
        $usuarios = Usuario::join('order_items', 'order_items.user_id', '=', 'users.id')
        ->join('municipios', 'municipios.id', '=', 'users.region')
        ->join('departamentos', 'departamentos.id', '=', 'users.ciudad')
        ->where('order_items.user_id', '=', $user->user_id)->get();
        }
       return view('carrito::admin.detalle', compact('productos', 'usuarios', 'envios', 'informacion', 'totales', 'costos', 'informacionorder', 'datos'));
    }

    public function crearconfiguracion()
    {
    return redirect('gestion/carrito/configuracion');
    }

       public function crearconfiguraciontienda()
    {

    $input = Input::all();
    $categoria = Configuracion::find(1);
    $categoria->tienda = Input::get('tienda');
    $categoria->save();
    return redirect('gestion/carrito/configuracion')->with('status', 'ok_update');
    }

           public function crearconfiguracionepayco()
    {

    $input = Input::all();
    $categoria = Configuracion::find(1);

    $categoria->id_cliente = Input::get('id_cliente');
    $categoria->p_key = Input::get('p_key');
    $categoria->moneda = Input::get('moneda');
    $categoria->invoice = Input::get('factura');
    $categoria->url = Input::get('redireccion');

    $categoria->save();
    return redirect('gestion/carrito/configuracion')->with('status', 'ok_update');
    }

       public function crearconfiguracionplace()
    {

    $input = Input::all();
    $categoria = Configuracion::find(1);


    $categoria->login = Input::get('login');
    $categoria->trankey = Input::get('trankey');
    $categoria->monedaplace = Input::get('monedaplace');
    $categoria->url = Input::get('redireccion');
    $categoria->url_produccion = Input::get('url_produccion');
    $categoria->save();
    return redirect('gestion/carrito/configuracion')->with('status', 'ok_update');
    }

    }

