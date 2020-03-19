<?php

namespace DigitalsiteSaaS\Carrito\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use DigitalsiteSaaS\Carrito\Product;
use DigitalsiteSaaS\Carrito\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Str;
use DB;
use Session;

class ProductoController extends Controller
{
    
	public function index()
    {
    $products = Product::orderBy('id', 'desc')->paginate(5);
    dd($products);
    }    
    
    public function digitales($id){
	$productos = Category::find($id)->Products;

	 return view('carrito::productos.index', compact('productos'));
	}

	 public function editarproducto($id){
    $autores = DB::table('autor')->get();
    $areas = DB::table('areas')->get();
    $parametros = DB::table('parametro')->get();
    $pages = \DigitalsiteSaaS\Pagina\Page::all();
    
    if(DB::table('venta')->where('id', '1')->value('comunidad') == 1)
    $productos = DB::table('products')
    ->join('areas', 'areas.id', '=', 'products.area_id')
    ->join('autor', 'autor.id', '=', 'products.autor_id')
    ->join('parametro', 'parametro.id', '=', 'products.parametro_id')
    ->where('products.id', '=' ,$id)->get();
    else
    $productos = DB::table('products')
    ->join('autor', 'autor.id', '=', 'products.autor_id')
    ->where('products.id', '=' ,$id)->get();

    //$paginas =DB::table('pages')
      //      ->join('products', 'products.page_id', '=', 'pages.id')
        //    ->where('products.id', '=' ,$id)->get();
            
     return view('carrito::productos.editar', compact('productos','paginas','pages','autores','areas','pages','parametros'))->with('status', 'ok_update');

    }

     public function crear($id)
    {
        $paginas = \DigitalsiteSaaS\Pagina\Page::all();
        $autores = DB::table('autor')->get();
        $categoria = DB::table('categoriessd')->where('id', '=', $id )->get();
        $areas = DB::table('areas')->get();
        $parametros = DB::table('parametro')->get();
        return view('carrito::productos.crear')->with('paginas', $paginas)->with('autores', $autores)->with('areas', $areas)->with('parametros', $parametros)->with('categoria', $categoria);
    }


       public function show()
    {


    $categoria = new Product;
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
    $categoria->area_id = Input::get('area');
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
    $categoria = Product::find($id);
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
    $categoria->area_id = Input::get('area');
    $categoria->ano = Input::get('ano');
    $categoria->referencia = Input::get('referencia');
    $categoria->parametro_id = Input::get('parametro');
    $categoria->autor_id = Input::get('autor');
    $categoria->categoriapro_id = Input::get('categoriapro');
    $categoria->save();
    return Redirect('gestion/productos/digitales/'.$categoria->category_id)->with('status', 'ok_update');
    }


   public function eliminar($id){

        $categoria = Product::find($id);
        $categoria->delete();
        
        return Redirect('/gestion/productos/digitales/'.$categoria->category_id)->with('status', 'ok_delete');
    }



}

