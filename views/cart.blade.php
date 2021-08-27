@extends ('LayoutsSD.Layout')
 
 @section('cabecera')
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Site Digital">
    <meta http-equiv="Cache-control" content="public">
    <title></title>


    @foreach($seo as $seo)
    <link rel="canonical" href="{{$seo->canonical}}{{Request::getRequestUri()}}"/>
    <meta property="og:locale" content="{{$seo->idioma}}">
    <meta property="og:type" content="{{$seo->og_type}}">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:url" content="{{$seo->og_url}}">
    <meta property="og:site_name" content="{{$seo->og_name}}">
    <meta property="og:image" content="{{$seo->canonical}}/{{$seo->og_image}}">
    <meta name="twitter:card" content="{{$seo->twitter_card}}"/>
    <meta name="twitter:site" content="{{$seo->twitter_site}}" />
    <meta name="twitter:creator" content="{{$seo->twitter_creator}}" />
    <meta name="twitter:title" content="{{$seo->twitter_title}}" />
    <meta name="twitter:description" content="{{$seo->twitter_description}}" />
    <meta name="twitter:image" content="{{$seo->twitter_image}}" />
    <link rel="shortcut icon" href="{{$seo->ico}}" type="image/icon">
    <link rel="apple-touch-icon" href="{{$seo->icoapple}}" />
    @endforeach
 
  @stop
@section('ContenidoSite-01')

@if(count($cart))
<div class="container mt-5">
 <table class="table table-hover">
  
  <thead>
   <tr>
    <th>Product</th>
    <th>Cantidad</th>
    <th class="text-right">Vr.Unitario</th>
    <th class="text-right">Vr.Total</th>
    <th class="text-center"> Eliminar</th>
   </tr>
  </thead>
  
  <tbody>
   @foreach($cart as $item)
   <tr>
    <td class="">
     <div class="media">
      <a class="thumbnail pull-left" href="#"> <img class="media-object" src="{{$item->image}}" style="width: 7%"> </a>
       <div class="media-body">
        <h4 class="media-heading"><a href="#">{{$item->name}}</a></h4>
        <span>Status: </span><span class="text-warning"><strong>In Stock</strong></span>
       </div>
     </div>
    </td>
    <td class="text-left">
     <input type="number" min="1" max="100" value="{{ $item->quantity}}" id="product_{{ $item->id}}">
      <a href="#" class="btn btn-warning btn-update-item btn-xs" data-href="{{ route('cart-update', $item->slug) }}" data-id="{{ $item->id}}">
       <i class="fa fa-refresh" aria-hidden="true"></i>
      </a>
    </td>
    @if($item->precioivafin == $item->precioinivafin)
    <td class="text-right">$ {{ number_format($item->precioivafin,0,",",".")}}</td>
    @else
    <td class="text-right">$ {{ number_format($item->precioinivafin,0,",",".")}}</td>
    @endif
    @if($item->precioivafin == $item->precioinivafin)
    <td class="text-right">$ {{ number_format ($item->precioivafin * $item->quantity,0,",",".") }}</td>
    @else
    <td class="text-right">$ {{ number_format ($item->precioinivafin * $item->quantity,0,",",".") }}</td>
    @endif
    <td class="text-center">
     <a href="{{ route('cart-delete', $item->slug)}}"><button type="button" class="btn btn-danger">
      <i class="fa fa-times" aria-hidden="true"></i>
      </button>
     </a>
    </td> 
   </tr>
   @endforeach         
   <tr>
    <td>   </td>
    <td>   </td>
    <td>   </td>
    <td><h5>Subtotal</h5></td>
    <td class="text-right"><h5><strong>$ {{ number_format($subtotal,0,",",".")}}</strong></h5></td>
   </tr>
   <tr>
    <td>   </td>
    <td>   </td>
    <td>   </td>
    <td><h5>Descuento</h5></td>
    <td class="text-right"><h5><strong>$ {{number_format($descuento*$item->quantity,0,",",".")}}</strong></h5></td>
   </tr>
   <tr>
    <td>   </td>
    <td>   </td>
    <td>   </td>
    <td><h5>Iva</h5></td>
    <td class="text-right"><h5><strong>$ {{ number_format($iva,0,",",".")}}</strong></h5></td>
   </tr>
   <tr>
    <td>   </td>
    <td>   </td>
    <td>   </td>
    <td><h5>Total</h5></td>
    <td class="text-right"><h5><strong>$ {{ number_format($total,0,",",".")}}</strong></h5></td>
   </tr>
   <tr>
    <td>
     <a href="{{ route('cart-trash')}}"><button type="button" class="btn btn-danger">
     <span class="fa fa-shopping-cart"></span> Vaciar Carrito
     </button></a>
    </td>
    <td>   </td>
    <td>   </td>
    <td class="text-right">
     @foreach($url as $url)
     <a href="/{{$url->url}}"><button type="button" class="btn btn-warning">
     <span class="fa fa-shopping-cart"></span> Seguir Comprando
     </button></a>
     @endforeach
    </td>
    <td class="text-right">
     <a href="{{ route('tienda-detail') }}"><button type="button" class="btn btn-success">
     Continuar <span class="fa fa-play"></span>
     </button></a>
    </td>
   </tr>
  </tbody>
 </table>
</div>
@else
 No hay Prodcutos
@endif





























    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script type="text/javascript">
     $(document).ready(function() {

     $(".btn-update-item").on('click', function(e){
     e.preventDefault();

     var id = $(this).data('id');
     var href = $(this).data('href');
     var quantity = $("#product_" + id).val();

     window.location.href = href + "/" + quantity;
     });
     });
    </script>

@stop