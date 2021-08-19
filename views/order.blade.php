@extends ('LayoutsSD.Layout')
 @section('ContenidoSite-01')

 <style type="text/css">
 .secondary-title{
  background: #f1f1f1;
  font-size: 15px;
  margin-top: 0px
 }
.secondary-title i{
padding: 10px;
font-size: 15px;
color:#fff;
}
.trans{
  width: 100%;
  background-color: #f1f1f1;
  display: flex;
  justify-content: center;
  padding: 0px
}
.transer{
  width: 100%;
  background-color: #f1f1f1;
  display: flex;
  justify-content: center;
  padding: 10px;
  margin-bottom: 20px;
}
.trans i { font-size: 10px; font-weight: 700}
.shop{border:1px solid #f1f1f1; padding: 0px; margin-top:25px; margin-bottom: 30px; padding: 20px}
.botoner{padding-bottom: 15px;}
.selector{background: #eee; border: 1px solid #f1f1f1; color: #000; font-size: 12px; margin-top: 12px}
.botnext{margin: 20px}
.btnpago{border: 2px solid #5cb85c; border-radius: 8px; color:#5cb85c; text-transform: uppercase; font-weight: 700 }
.botn{margin: 15px}
</style>

@if(Session::get('cart') == null)
@else


<!-- Precio Envio -->
<div class="container shop">
 <h2 class="secondary-title"><i class="fa fa-shopping-basket bg-primary"></i>  Confirmación de Envío</h2>
  <div class="row padcart">
    <div class="col-md-12">
     <h3 class="text-center"> El costo actual para el envio a la ciudad de <strong class="text-primary">
      @foreach($datos as $datos)
       {{$datos->municipio}}
      @endforeach
      </strong> es de <strong class="text-primary">$ {{number_format(Session::get('miSesionTextouno',0,",","."))}}
      </strong> si desea generar un nuevo destino de envio consulte a continuación su costo.
     </h3> 

     <form action="/web/session" method="post" name="formulario">
     @csrf 
      <div class="col-md-12">
       <select name="ciudad" id="ciudad" class="form-control selector input-lg" size="1">
        <option value=""  selected>Seleccione Departramneto</option>
         @foreach($departamento as $departamento)
          <option value="{{$departamento->id}}">{{$departamento->departamento}}</option>
         @endforeach
       </select>
      </div>

      <div class="col-md-12">
       <div class="form-group">
        <select onchange="this.form.submit()" name="municipio" id="municipio" class="form-control selector input-lg" size="1">
         <option value=""  selected>Seleccione Ciudad o Municipio</option>
          <option value="1"></option>
        </select>
       </div>
      </div>
      <!--
      <div class="col-md-12 mb-3">
       <button class="btn btn-primary pull-right botcart" type="submit">Calcular Costo</button>
        <a href="/web/limpieza" class="btn btn-default pull-right botcart">Limpiar</a><br><br>
      </div>
      -->
     </form>
    </div>
             
 </div> 
</div>

<div class="container">
 <div class="row">
  
  <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12 shop">
   <h2 class="secondary-title"><i class="fa fa-shopping-basket bg-primary"></i>  Confirmación de Envío</h2>
   

 
        
       <form action="/session/datos" method="post" name="formulario">
        <!--<h4 class="ml-3">Datos Facturación</h4>-->  

        <div class="container">
         <div class="row">      
        <div class="form-group col-lg-6">
         <label class="col-md-12" for="example-text-input">Nombres</label>
          <div class="col-md-12">
           <input id="nombres" name="nombres" type="text" class="form-control" value="{{session::get('nombres')}}" placeholder="Nombre" required="required">
          </div>
        </div>

        <div class="form-group col-lg-6">
         <label class="col-md-12" for="example-text-input">Documento</label>
          <div class="col-md-12">
           <input id="documento" name="documento" type="text" class="form-control" value="{{session::get('documento')}}" placeholder="Apellido">
          </div>
        </div>

        <div class="form-group col-md-6">
         <label class="col-md-12" for="example-text-input">Dirección</label>
          <div class="col-md-12">
           <input id="direccion" name="direccion" type="text" class="form-control" value="{{session::get('direccion')}}" placeholder="Dirección">
          </div>
        </div>

        <div class="form-group col-md-6">
         <label class="col-md-12" for="example-text-input">Teléfono</label>
          <div class="col-md-12">
           <input id="telefono" name="telefono" type="text" class="form-control" value="{{session::get('telefono')}}" placeholder="Teléfono">
          </div>
        </div>

        <div class="form-group col-md-6">
         <label class="col-md-12" for="example-text-input">Email</label>
          <div class="col-md-12">
           <input id="email" name="email" type="text" class="form-control" value="{{session::get('email')}}" value="" placeholder="Email">
          </div>
        </div>
             
        <div class="form-group col-md-6">
         <label class="col-md-12" for="example-text-input">Confirmar Email</label>
          <div class="col-md-12">
           <input id="emailnue" name="emailnue" type="text" class="form-control" value="{{Auth::user()->email}}" value="" placeholder="Email">
          </div>
        </div>
        
        <!--<h4 class="ml-3">Datos Envio</h4>--> 

          <div class="form-group col-md-6">
         <label class="col-md-12" for="example-text-input">Dirección Envío</label>
          <div class="col-md-12">
           <input id="direnvio" name="direnvio" type="text" class="form-control" value="{{session::get('direnvio')}}" value="" placeholder="Email">
          </div>
        </div>

        <div class="form-group col-md-6">
         <label class="col-md-12" for="example-text-input">Inmueble</label>
          <div class="col-md-12">
           <select id="inmueble" name="inmueble" class="form-control" size="1">
            <option selected>Seleccionar tipo de inmueble</option>
           
            <option value="1" selected>Apartamento</option>
            <option value="2" selected="">Casa</option>
            <option value="3" selected="">Oficina</option>
         
           </select>
          </div>
        </div>

        <div class="form-group col-md-6">
         <label class="col-md-12" for="example-text-input">Información inmueble</label>
          <div class="col-md-12">
           <input id="informacion" name="informacion" type="text" class="form-control" value="{{session::get('informacion')}}" placeholder="Ingrese datos inmueble número oficina, apartamento o casa, torreo o blouqe">
          </div>
        </div>

        @if(session::get('identificador') == '')
        <div class="form-group col-md-6">
         <label class="col-md-12" for="example-text-input">Identificador</label>
          <div class="col-md-12">
           <input id="identificador" name="identificador" type="text" class="form-control" value="{{rand(154887854655,484846545450656556)}}" placeholder="Ingrese datos inmueble número oficina, apartamento o casa, torreo o blouqe">
          </div>
        </div>
        @else
        <div class="form-group col-md-6">
         <label class="col-md-12" for="example-text-input">Identificador</label>
          <div class="col-md-12">
           <input id="identificador" name="identificador" type="text" class="form-control" value="{{session::get('identificador')}}" placeholder="Ingrese datos inmueble número oficina, apartamento o casa, torreo o blouqe">
          </div>
        </div>
        @endif
        
       <div class="col-md-12 mb-3">
       <button class="btn btn-primary pull-right botcart" id="epayco-button" type="submit">Siguiente</button>
        <a href="/web/limpieza" class="btn btn-default pull-right botcart">Limpiar</a><br><br>
      </div>
     </form>
                                 
</div>
</div>

    
  </div>


@if($configuracion->tienda == 'Epayco')
@if(Session::get('miSesionTextouno') == '')
@else
<div class="col-xs-6 col-sm-6 col-md-6 col-lg-12 shop">
 <?php
  $valora = $suma + 0;
  $p_cust_id_cliente = $configuracion->id_cliente;
  $p_key = $configuracion->p_key;
  $p_id_invoice = $valora;
  $totalenvio = $total+Session::get('miSesionTextouno');
  $identificador = Session::get('identificador');
  if($preciomunicipio > 0)
   $p_amount = $total+$preciomunicipio; 
  else
   $p_amount = $total+$precioenvio;                              
   $p_currency_code = $configuracion->moneda;
   $p_signature = md5($p_cust_id_cliente.'^'.$p_key.'^'.$p_id_invoice.'^'.$p_amount.'^'.$p_currency_code);
 ?>
 
 <h2 class="secondary-title"><i class="fa fa-shopping-basket bg-primary"></i>  Confirmación de Envío</h2>
  <div class="container-fluid regla">
   <div id="wrapper">
    <div id="row body-content">
     @if(count($cart))
     <table class="table table-striped">
      <thead>
      </thead>
      <tbody>
       @foreach($cart as $item)
       <tr>
        <td style="width: 7%;">
         <img class="img-responsive" src="/{{$item->image}}">
        </td>
        <td>{{$item->name}}</td>
         @if($item->precioivafin == $item->precioinivafin)
          <td class="text-right">$ {{ number_format($item->precioivafin,0,",",".")}}</td>
           @else{{$item->name}}
          <td class="text-right">$ {{ number_format($item->precioinivafin,0,",",".")}}</td>
         @endif
       </tr>
      @endforeach
     </tbody>
    </table>

    <table class="table table-hover">
     <tbody>
      <tr>
       <th class="text-right">Subtotal</th>
       <td class="text-right">$ {{ number_format($subtotal,0,",",".")}}</td>
      </tr>
      <tr>
       <th class="text-right">Descuento</th>
       <td class="text-right">$ {{number_format($descuento*$item->quantity,0,",",".")}}</td>
      </tr>
      <tr>
       <th class="text-right">Iva</th>
       <td class="text-right">$ {{ number_format($iva,0,",",".")}}</td>
      </tr>
      <tr>
       <th class="text-right">Costo Envio</th>
       <td class="text-right">$ {{number_format(Session::get('miSesionTextouno',0,"."."."))}}</td>
      </tr>
      <tr>
       <th class="text-right">Total</th>
       <td class="text-right">
        $ {{ number_format($total+Session::get('miSesionTextouno'),0,",",".")}}
       </td>
      </tr>
     </tbody>
    </table>

    <div class="offset-lg-8 mb-3" >
     <form>
      <script
       src="https://checkout.epayco.co/checkout.js"
       class="epayco-button"
       data-epayco-key="<?php echo $p_key?>"
       data-epayco-amount="<?php echo $totalenvio?>"
       data-epayco-name="Vestido Mujer Primavera"
       data-epayco-description="Vestido Mujer Primavera"
       data-epayco-currency="{{$configuracion->moneda}}"
       data-epayco-extra1="<?php echo $identificador?>"
       data-epayco-country="co"
       data-epayco-test="true"
       data-epayco-external="true"
       data-epayco-response="{{Request::root()}}/cart/responseda"
       data-epayco-confirmation="{{request()->getSchemeAndHttpHost()}}/cart/responseserver">
      </script>
    </form>

   </div>
   @else
   No hay Prodcutos
   @endif
    </div> 
   </div>
  </div>
 </div>
@endif
@elseif($configuracion->tienda == 'PlaceToPay')
<?php
  $valora = $suma + 0;
  $p_cust_id_cliente = $configuracion->id_cliente;
  $p_key = $configuracion->p_key;
  $p_id_invoice = $valora;
  if($preciomunicipio > 0)
   $p_amount = $total+$preciomunicipio;
  else
  $p_amount = $total+$precioenvio;                              
  $p_currency_code = $configuracion->moneda;
  $p_signature = md5($p_cust_id_cliente.'^'.$p_key.'^'.$p_id_invoice.'^'.$p_amount.'^'.$p_currency_code);
?>

<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 shop">

 <h2 class="secondary-title"><i class="fa fa-shopping-basket bg-primary"></i>  Confirmación de Envío</h2>
  <div class="container-fluid regla">
   <div id="wrapper">
    <div id="row body-content">
    @if(count($cart))
     <table class="table table-striped">
      <thead>
      </thead>
      <tbody>
       @foreach($cart as $item)
       <tr>
        <td style="width: 7%;">
         <img class="img-responsive" src="/{{$item->image}}">
        </td>
        <td>{{$item->name}}</td>
         @if($item->precioivafin == $item->precioinivafin)
          <td class="text-right">$ {{ number_format($item->precioivafin,0,",",".")}}</td>
           @else{{$item->name}}
          <td class="text-right">$ {{ number_format($item->precioinivafin,0,",",".")}}</td>
         @endif
       </tr>
      @endforeach
     </tbody>
    </table>

    <table class="table table-hover">
     <tbody>
      <tr>
       <th class="text-right">Subtotal</th>
       <td class="text-right">$ {{ number_format($subtotal,0,",",".")}}</td>
      </tr>
      <tr>
       <th class="text-right">Descuento</th>
       <td class="text-right">$ {{number_format($descuento*$item->quantity,0,",",".")}}</td>
      </tr>
      <tr>
       <th class="text-right">Iva</th>
       <td class="text-right">$ {{ number_format($iva,0,",",".")}}</td>
      </tr>
      <tr>
       <th class="text-right">Costo Envio</th>
       <td class="text-right">$ {{number_format(Session::get('miSesionTextouno',0,"."."."))}}</td>
      </tr>
      <tr>
       <th class="text-right">Total</th>
       <td class="text-right">
       $ {{ number_format($total+Session::get('miSesionTextouno'),0,",",".")}}
       </td>
      </tr>
     </tbody>
    </table>
    @else
   No hay Prodcutos
   @endif
 <div class="container-fluid">
  <form class="form-horizontal msf" method="post" action="/placetopay/pagoweb" target="_blank">
   <input name="p_id_invoice" type="hidden" value="{{$valora}}-{{rand(1,10000)}}"/>
   <input name="p_amount_base" type="hidden" value="{{$subtotal}}"/>
   @if(Session::get('miSesionTexto') == null)
   <input name="p_amount" id="p_amount" type="hidden" value="{{$total+$precioenvio}}"/>
   @elseif($preciomunicipio > 0)
   <input name="p_amount" id="p_amount" type="hidden" value="{{$total+$preciomunicipio}}"/>  
   @elseif($preciomunicipio == 0)
   <input name="p_amount" id="p_amount" type="hidden" value="{{$total+$preciomunicipio}}"/>  
   @endif
   <input name="p_tax" id="p_tax" type="hidden" value="0"/>
   <input id="p_extra2" name="p_extra2" value="{{Session::get('miSesionTextouno')}}" type="hidden" class="form-control">
   <input name="p_billing_email" type="hidden" id="p_billing_email" value="{{Auth::user()->email}}"/>
   <button data-type="submit" style="padding: 0; background: none; border: none; cursor: pointer;" class="epayco-button-render pull-right"><img src="https://lyl.com.co/placetopay/boton-pago.png"></button>
  </form>
 </div>
</div>
</div></div></div>
@endif

 </div>
</div>
@endif


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript">
      var jq = $.noConflict();
jq(document).ready(function(){
 $('#ciudad').on('change',function(e){
 console.log(e);
 var cat_id = e.target.value;
 $.get('/mema/ajax-subcatweb?cat_id=' + cat_id, function(data){
 $('#municipio').empty();
 $.each(data, function(index, subcatObj){
 $('#municipio').append('<option value="" style="display:none">Seleccione Municipio</option>','<option value="'+subcatObj.p_municipio+'">'+subcatObj.municipio+'</option>');
   });
  });
 });
 });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<button type="submit" class="btn btn-primary" id="epayco-buttons">Submit {{rand(1548,50656556)}}</button>
   <script type="text/javascript">
  $("#epayco-buttons").click(function(e) {
var u='/mensajes/mensajes';
$.ajax({
  type:"GET",
  url:u,
  data:{
    key:document.domain,
    web:window.location.href,nombres:$('#nombres').val(),
    web:window.location.href,direccion:$('#direccion').val(),
    web:window.location.href,email:$('#email').val(),
    web:window.location.href,documento:$('#documento').val(),
    web:window.location.href,telefono:$('#telefono').val(),
    web:window.location.href,direnvio:$('#direnvio').val(),
    web:window.location.href,inmueble:$('#inmueble').val(),
    web:window.location.href,informacion:$('#informacion').val(),
    web:window.location.href,identificador:$('#identificador').val(),
  }});
});
</script>


<script type="text/javascript">
   var html=window.opener.getElementById("response").innerHTML,
  html="el envió del formulario finalizo con exito!"
</script>

@stop