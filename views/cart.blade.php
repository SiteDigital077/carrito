@extends ('LayoutsSD.Layout')
 
 @section('ContenidoSite-01')

   @if(count($cart))
    <section class="site-content site-section">
     <div class="container">
      <div class="table-responsive">
       <table class="table table-bordered table-vcenter">
        <thead>
         <tr>
          <th class="text-uppercase" colspan="2">Producto</th>
          <th class="text-center text-uppercase">Cantidad</th>
          <th class="text-right text-uppercase">Vr.Unitario</th>
          <th class="text-right text-uppercase">Vr.Total</th>
          <th class="text-center text-uppercase">Eliminar Producto</th>
         </tr>
        </thead>
        
        <tbody>
         @foreach($cart as $item)
          <tr>
           <td style="width: 7%;">
            <img class="img-responsive" src="{{$item->image}}">
           </td>
           <td>
            <strong style="text-transform: uppercase;">{{$item->name}}</strong><br>
            @foreach($categoriapro as $categoriaprod)
            @if($item->category_id == $categoriaprod->id)
            <em>{{$categoriaprod->name}}</em><br>
            @endif
            @endforeach
           </td>
           <td class="text-center">
            <input type="number" min="1" max="100" value="{{ $item->quantity}}" id="product_{{ $item->id}}">
            <a href="#" class="btn btn-warning btn-update-item btn-xs" data-href="{{ route('cart-update', $item->slug) }}" data-id="{{ $item->id}}">
            <span class="glyphicon glyphicon-refresh" aria-hidden="true"></span>
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
           <td><a href="{{ route('cart-delete', $item->slug)}}"><button type="button" class="btn btn-danger center-block btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</button></a></td>
          </tr>
         @endforeach

          <tr>
           <td colspan="5" class="text-right h4"><strong>Sub Total</strong></td>
           <td class="text-right h4"><strong>$ {{ number_format($subtotal,0,",",".")}}</strong></td>
          </tr>
          <tr>
           <td colspan="5" class="text-right h4"><strong>Descuento</strong></td>
           <td class="text-right h4"><strong>$ {{number_format($descuento*$item->quantity,0,",",".")}}</strong></td>
          </tr>
          <tr>
           <td colspan="5" class="text-right h4"><strong>Iva</strong></td>
           <td class="text-right h4"><strong>$ {{ number_format($iva,0,",",".")}}</strong></td>
          </tr>
          <tr class="active">
           <td colspan="5" class="text-right text-uppercase h4"><strong>Precio Total</strong></td>
           <td class="text-right text-success h4"><strong>$ {{ number_format($total,0,",",".")}}</strong></td>
          </tr>
        </tbody>
       </table>
      </div>
      
      <div class="row">
       <div class="col-xs-7 col-md-3">
        <a href="{{ route('cart-trash')}}"><button type="button" class="btn btn-danger pull-left botcart"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Vaciar carrito</button></a>
       </div>
       <div class="col-xs-5 col-md-4 col-md-offset-5">
        <a href="{{ route('tienda-detail') }}"><button type="button" class="btn btn-primary pull-right botcart">Continuar</button></a>
        @foreach($url as $url)
        <a href="/{{$url->url}}"><button type="button" class="btn btn-default pull-right botcart">Seguir comprando</button></a>
        @endforeach
       </div>
      </div>
     </div>
    </section>
            <!-- END Shopping Cart -->
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