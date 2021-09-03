@extends ('LayoutsSD.Layout')



 
    @section('ContenidoSite-01')


<div class="container">
  <div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
       <img id="pic" src="{{$product->image}}" class="img-responsive center-block" data-zoomed="/{{ $product->image }}" alt="zoom in pic">
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
      <h3>{{$product->name}}</h3>

       @if($product->precioivafin == $product->precioinivafin)
 <div class="product-price-and-shipping">                              
  <span class="sr-only">Price</span>
  <span itemprop="price" class="price has_discount" style="font-size:25px"><strong>$ {{number_format($product->precioinivafin,0,",",".")}}</strong></span>
 </div>
@else
 <div class="product-price-and-shipping">
  <span class="sr-only">Regular price</span>
  <span class="price regular-price" style="font-size:18px">$ {{number_format($product->precioivafin,0,",",".")}}</span>
  <span class="price discount-percentage"><strong>-5%</strong></span>
  <span class="sr-only">Price</span>
  <span itemprop="price" class="price has_discount text-primary" style="font-size:25px"><strong>$ {{number_format($product->precioinivafin,0,",",".")}}</strong></span>
 </div>
 <p>Precio en Pesos Colombianos COP</p>

<p class="text-justify">{!!$product->contenido!!}</p>

@if($product->position == 0)
<span class="text-success"> Hay Existencias</span>
@else
<span class="text-danger"> No Hay Existencias</span>
@endif
<br><br>
@endif

Categoria:
@foreach($categoriapro as $categoriapro)
@if($categoriapro->id == $product->categoriapro_id)
{{$categoriapro->nombre}} <strong>//</strong>  
@endif
@endforeach
@foreach($categoriessd as $categoriessd)
@if($categoriessd->id == $product->category_id)
<span style="color:{{$categoriessd->color}}">{{$categoriessd->name}}</span>
@endif
@endforeach

<a href="{{URL::previous()}}" class="btn btn-default btn-lg">Regresar al catálogo</a>
@if($product->position == 0)
<a href="{{ route('cart-add', $product->slug)}}" class="btn btn-primary btn-lg">Agregar al carrito</a>
@else
<a class="btn btn-danger btn-lg" disabled>No disponible</a>
@endif
    </div>
    
  </div>
  
</div>







<div class="container">
<div class="row">
 <h2>Otros Productos</h2><br>
       @foreach($products as $product)
      @if($product->position == '1')
        <div class="col-md-3 col-sm-6">
            <div class="product-grid">
                <div class="product-image">
                 
                        <img class="pic-1 img-responsive" src="/{{$product->image}}" style="width: 10%">
                        <span style="margin-top:-190px; position: absolute; margin-left:0px; text-align: center; color: #000; font-weight:bold; background: white; padding: 20px 100px">AGOTADO</span>
                   
                </div>
                <div class="product-content">
                    <h3 class="title text-primary"><a class="text-primary" href="#"><span class="text-primary">{{$product->name}}</span></a></h3>
                    <div class="price">${{number_format($product->precioinivafin,0,",",".")}}</div>
                </div>
            </div>
        </div>
        @else
        <div class="col-md-3 col-sm-6">
            <div class="product-grid">
                <div class="product-image">
                    <a href="#" class="image">
                        <img class="pic-1 img-responsive" src="{{$product->image}}">
                    </a>
                    <ul class="social">
                        <li><a href="{{ route('cart-add', $product->slug)}}"><i class="fa fa-shopping-bag"></i></a></li>
                        <li><a href="{{ route('product-detail', $product->slug)}}"><i class="fa fa-search"></i></a></li>
                    </ul>
                </div>
                <div class="product-content">
                    <h3 class="title text-primary"><a class="text-primary" href="#"><span class="text-primary">{{$product->name}}</span></a></h3>
                    <div class="price">${{number_format($product->precioinivafin,0,",",".")}}</div>
                </div>
            </div>
        </div>
        @endif
            @endforeach
              </div>
</div>



@stop

