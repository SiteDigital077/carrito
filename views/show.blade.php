  @extends ('LayoutsSD.Layout')


<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Page</title>

  </head>
  <body>
    @section('ContenidoSite-01')


<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-md-offset-2">
</br> 
<div class="col-xs-12 col-sm-12 col-md-4 col-lg-5">
<div class="product-block">
  <img src="{{ $product->image }}" class="img-responsive" alt="Image">
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7">


<div role="tabpanel">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
      <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Descripción producto</a>
    </li>
    <li role="presentation">
      <a href="#tab" aria-controls="tab" role="tab" data-toggle="tab">Autor</a>
    </li>
     <li role="presentation">
      <a href="#dado" aria-controls="tab" role="tab" data-toggle="tab">Video</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">
      <div class="product-block">
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
@endif

<h4><strong>Código producto:</strong><span style="color:#a8a8a8"> {{$product->referencia}}</span></h4>
@if($product->position == 0)
<h4><strong>Disponibilidad:</strong><span class="text-success"> Disponible</span></h4>
@else
<h4><strong>Disponibilidad:</strong><span class="text-danger"> No dispnible</span></h4>
@endif
<h4><strong>Categoria:</strong> 
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
</h4><br>

<div class="product-info">
<p class="text-justify">{!!$product->contenido!!}</p>
</div>
</div>
<br>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
  @foreach($url as $url)
<p><a href="/{{$url->url}}" class="btn btn-default">Regresar al catálogo</a></p>
  @endforeach
</div>

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-4">
  @if($product->position == 0)
  <a href="{{ route('cart-add', $product->slug)}}" class="btn btn-primary">Agregar al carrito</a>
  @else
  <a class="btn btn-danger" disabled>No disponible</a>
  @endif
</div>


</div>

    </div>
    <div role="tabpanel" class="tab-pane" id="tab">
      @foreach($autores as $autores)
      @if($product->autor_id == $autores->id)
      <h3>{{$autores->nombre}}</h3>
      <h4><strong>País:</strong> {{$autores->pais}}</h4>
      <h4><strong>Página web:</strong><a href="{{$autores->website}}" target="_blank"> {{$autores->website}}</a></h4>
      <h4><strong>Email:</strong> {{$autores->email}}</h4>
      <br>
      <p class="text-justify">{!!$autores->descripcion!!}</p>
      @if($autores->facebook == '')
      @else
      <a href="{{$autores->facebook}}" target="_blank">
      <div class="redface">
      <span class="fab fa-facebook-f" aria-hidden="true"></span>
      </div>
      </a>
      @endif
      @if($autores->twitter == '')
      @else
      <a href="{{$autores->twitter}}" target="_blank">
      <div class="redtwi">
      <span class="fab fa-twitter" aria-hidden="true"></span>
      </div>
      </a>
      @endif
      @if($autores->linkedin == '')
      @else
      <a href="{{$autores->linkedin}}" target="_blank">
      <div class="redlink">
      <span class="fab fa-linkedin-in" aria-hidden="true"></span>
      </div>
      </a>
      @endif
      @if($autores->vimeo == '')
      @else
      <a href="{{$autores->vimeo}}" target="_blank">
      <div class="redvime">
      <span class="fab fa-vimeo-v" aria-hidden="true"></span>
      </div>
      </a>
      @endif
      @if($autores->youtube == '')
      @else
      <a href="{{$autores->youtube}}" target="_blank">
      <div class="redyou">
      <span class="fab fa-youtube" aria-hidden="true"></span>
      </div>
      </a>
      @endif

      @endif
      @endforeach
    

    </div>
<div role="tabpanel" class="tab-pane" id="dado">
  @foreach($autoresweb as $autores)
  @if($product->autor_id == $autores->id)
  @if($autores->video == '')
  @else
<iframe src="{{$autores->video}}?controls=0" frameborder="0" allowfullscreen width="500" height="315" ></iframe>
@endif
@endif
@endforeach
</div>
  </div>

</div>















</br></br></br></br></br></br>
</div>
</div>

@stop


  </body>
</html>


