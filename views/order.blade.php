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

<link rel="stylesheet" href="/steps/css/multi-step-form.css" type="text/css">


</head>

<body>        
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
.shop{border:1px solid #f1f1f1; padding: 0px; margin-top:25px; margin-bottom: 30px}
.botoner{padding-bottom: 15px;}
.selector{background: #eee; border: 1px solid #f1f1f1; color: #000; font-size: 12px; margin-top: 12px}
.botnext{margin: 20px}
.btnpago{border: 2px solid #5cb85c; border-radius: 8px; color:#5cb85c; text-transform: uppercase; font-weight: 700 }
.botn{margin: 15px}
</style>


@if(Session::get('cart') == null)

@else

<!-- Inicia PLaceToPay -->

@if($configuracion->tienda == 'PlaceToPay')
 
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

<div class="container">
 @if (DB::table('orders')->where('user_id', '=', Auth::user()->id)->where('estado', '=', 'PENDING')->exists())
  <div class="alert alert-warning">
   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><strong>Atención</strong> Actualmente usted tiene transacciones en estado pendiente</h4>

     <table border="1" width="100%" bordercolor="#dbccad">
      <thead style="background:none; padding:5px">
       <tr>
        <td style="padding:5px"><b>Fecha y Hora</b></td>
        <td style="padding:5px"><b>Referencia</b></td>
        <td style="padding:5px"><b>Autorización/CUS</b></td>
        <td style="padding:5px"><b>Estado</b></td>
        <td style="padding:5px"><b>Valor</b></td>
       </tr>
      </thead>
     
     @foreach($ordenes as $ordenes)
      <tbody>
       <tr>
        <td style="padding:5px" width="30%">{{$ordenes->fecha}}</td>
        <td style="padding:5px" width="20%">{{$ordenes->codigo_apr}}</td>
        <td style="padding:5px" width="20%">{{$ordenes->codigo}}</td>
        <td style="padding:5px" width="20%">Pendiente</td>
        <td style="padding:5px" width="30%">$ {{number_format($ordenes->shipping,0,",",".")}}</td>
       </tr>
      </tbody>
     @endforeach
   </table>
  </div>
@else
@endif




<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
 <div class="container-fluid shop">
  <h2 class="secondary-title"><i class="fa fa-shopping-basket bg-primary"></i>  Confirmación del pedido</h2>
   <div class="container-fluid regla">
    <div id="row body-content">
     <form class="form-horizontal msf" method="post" action="/placetopay/pagoweb" target="_blank">
      <div class="msf-header transer">
       <div class="msf-step col-md-4 col-md-offset-1"><i class="fa fa-clipboard"></i> <span>Datos de envío</span></div>
       <div class="msf-step col-md-4"><i class="fa fa-credit-card"></i><span>Datos de facturación</span></div>
       <div class="msf-step col-md-4"><i class="fa fa-list-ul"></i> <span>Resumen de la compra</span></div>
      </div>

      <div class="msf-content">
       <div class="msf-view">
        <div class="row padcart">
         @if(Session::get('miSesionTexto') == null)
          <div class="col-md-10 col-md-offset-1">            
           <h3 class="text-center"> El costo actual para el envio a la ciudad de <strong class="text-primary">
            @foreach($datos as $datos)
             {{$datos->municipio}}
            @endforeach
            </strong> es de <strong class="text-primary"> @if($preciomunicipio > 0) ${{number_format($preciomunicipio,0,",",".")}} @else ${{number_format($precioenvio,0,",",".")}} @endif
            </strong> si desea generar un nuevo destino de envio consulte a continuación su costo.
           </h3>
          </div>
             
       
       
         @elseif($preciomunicipio == 0)
       
        <div class="col-md-8 col-md-offset-2 ">            
         <h3 class="text-center"> El costo actual para el envio a la ciudad de <strong class="text-primary"> {{$nombremunicipio}}</strong> es de
         <strong class="text-primary"> @if($preciomunicipio > 0) ${{number_format($preciomunicipio,0,",",".")}}@elseif($preciomunicipio == 0) ${{number_format($preciomunicipio,0,",",".")}} @else ${{number_format($precioenvio,0,",",".")}} @endif
         </strong> si desea generar un nuevo destino de envio consulte a continuación su costo.
         </h3>
        </div>
         
        </br>
        </br>
        </br>
             
     







         @else
         
         <div class="col-md-10 col-md-offset-1">            
          <h3 class="text-center"> El costo actual para el envio a la ciudad de <strong class="text-primary">  {{$nombremunicipio}}</strong> es de
            <strong class="text-primary"> @if($preciomunicipio > 0) ${{number_format($preciomunicipio,0,",",".")}}@elseif($preciomunicipio == 0) ${{number_format($preciomunicipio,0,",",".")}} @else ${{number_format($precioenvio,0,",",".")}} @endif
            </strong> si desea generar un nuevo destino de envio consulte a continuación su costo.
           </h3>
          </div>
         
          </br>
          </br>
          </br>
     
             
          @endif
                 
       </div>
      </div>


      <div class="msf-view">
       <div class="row padcart">
        <div class="col-md-12">

          @if(Session::get('miSesionTexto') == null)
       
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-md-offset-1 shop">
           <div class="row">
            <div class="col-md-12">

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <div class="form-group" style="padding-right:10px">
            <input id="p_description" name="p_description" type="hidden" class="form-control" value="Compras generadas por la compañía">
           </div>
          </div>
                 
          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Nombre</label>
           <div class="col-md-12">
            <input id="nombrenue" name="nombrenue" type="text" class="form-control" value="{{Auth::user()->name}}" placeholder="Nombre" disabled>
           </div>
          </div>

          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Apellido</label>
           <div class="col-md-12">
            <input id="apellidonue" name="apellidonue" type="text" class="form-control" value="{{Auth::user()->last_name}}" placeholder="Apellido" disabled>
           </div>
          </div>

          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Dirección de envio</label>
           <div class="col-md-12">
            <input id="direccionnue" name="direccionnue" type="text" class="form-control" value="{{Auth::user()->address}}" placeholder="Dirección" disabled>
           </div>
          </div>

           <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Teléfono</label>
           <div class="col-md-12">
            <input id="telefononue" name="telefononue" type="text" class="form-control" value="{{Auth::user()->celular}}" placeholder="Teléfono" disabled>
           </div>
          </div>
             
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Inmueble</label>
           <div class="col-md-12">
            <select id="inmueblenue" name="inmueblenue" class="form-control" size="1" disabled>
             <option selected>Seleccionar tipo de inmueble</option>
             @if(Auth::user()->inmueble == 1)
             <option value="1" selected>Apartamento</option>
             @elseif(Auth::user()->inmueble == 2)
             <option value="2" selected="">Casa</option>
             @elseif(Auth::user()->inmueble == 3)
             <option value="3" selected="">Oficina</option>
             @endif
            </select>
           </div>
          </div>

       
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Información inmueble</label>
           <div class="col-md-12">
            <input id="informacionnue" name="informacionnue" type="text" class="form-control" value="{{Auth::user()->numero}}" placeholder="Ingrese datos inmueble número oficina, apartamento o casa, torreo o blouqe" disabled>
           </div>
          </div>
             
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Ciudad de envio</label>
           <div class="col-md-12">
            <input  id="p_billing_country" name="p_billing_country" type="text" class="form-control" value="{{$datos->municipio}}" placeholder="Código Postal" disabled>
           </div>
          </div>

          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Email</label>
           <div class="col-md-12">
            <input id="emailnue" name="emailnue" type="text" class="form-control" value="{{Auth::user()->email}}" value="" placeholder="Email" disabled>
           </div>
          </div>
             
            </div>
           </div>
          </div>
       
         @elseif($preciomunicipio == 0)
       
        <div class="col-md-8 col-md-offset-2 ">            
         <h3 class="text-center"> El costo actual para el envio a la ciudad de <strong class="text-primary"> {{$nombremunicipio}}</strong> es de
         <strong class="text-primary"> @if($preciomunicipio > 0) ${{number_format($preciomunicipio,0,",",".")}}@elseif($preciomunicipio == 0) ${{number_format($preciomunicipio,0,",",".")}} @else ${{number_format($precioenvio,0,",",".")}} @endif
         </strong> si desea generar un nuevo destino de envio consulte a continuación su costo.
         </h3>
        </div>
         
        </br>
        </br>
        </br>
             
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-md-offset-1 shop">
         <div class="row">
          <div class="col-md-10 col-md-offset-1">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <div class="form-group" style="padding-right:10px">
            <input id="p_description" name="p_description" type="hidden" class="form-control" value="Compras generadas por la compañía">
           </div>
          </div>
                 
          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Nombre</label>
           <div class="col-md-12">
            <input id="nombrenue" name="nombrenue" type="text" class="form-control" value="" placeholder="Nombre" data-bind="value: Name" data-val="true" data-val-required="email is required">
           </div>
          </div>

          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Apellido</label>
           <div class="col-md-12">
            <input id="apellidonue" name="apellidonue" type="text" class="form-control" value="" placeholder="Apellido" data-bind="value: Lastname" data-val="true" data-val-required="email is required">
           </div>
          </div>

          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Dirección de envio</label>
           <div class="col-md-12">
            <input id="direccionnue" name="direccionnue" type="text" class="form-control" value="" placeholder="Dirección" data-bind="value: Address" data-val="true" data-val-required="email is required">
           </div>
          </div>

           <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Teléfono</label>
           <div class="col-md-12">
            <input id="telefononue" name="telefononue" type="text" class="form-control" value="" placeholder="Teléfono" data-bind="value: Telefono" data-val="true" data-val-required="email is required">
           </div>
          </div>
             
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Inmueble</label>
           <div class="col-md-12">
            <select id="inmueblenue" name="inmueblenue" class="form-control" size="1" required>
             <option selected disabled>Seleccionar tipo de inmueble</option>
             <option value="1">Apartamento</option>
             <option value="2">Casa</option>
             <option value="3">Oficina</option>
            </select>
           </div>
          </div>

          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Información inmueble</label>
           <div class="col-md-12">
            <input id="informacionnue" name="informacionnue" type="text" class="form-control" value="" placeholder="Ingrese datos inmueble número oficina, apartamento o casa, torreo o blouqe">
           </div>
          </div>
             
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Ciudad de envio</label>
           <div class="col-md-12">
            <input style="background:none" id="p_billing_country" name="p_billing_country" type="text" class="form-control" value="{{$nombremunicipio}}" placeholder="Código Postal" readonly>
           </div>
          </div>

          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Email</label>
           <div class="col-md-12">
            <input style="background:none" id="emailnue" name="emailnue" type="text" class="form-control" data-bind="value: Email" data-val="true" data-val-required="email is required" value="" placeholder="Email">
           </div>
          </div>
         
             
          </div>
         </div>  
        </div>
             







         @else
         
         <div class="col-md-8 col-md-offset-2 ">            
          <h3 class="text-center"> El costo actual para el envio a la ciudad de <strong class="text-primary">  {{$nombremunicipio}}</strong> es de
            <strong class="text-primary"> @if($preciomunicipio > 0) ${{number_format($preciomunicipio,0,",",".")}}@elseif($preciomunicipio == 0) ${{number_format($preciomunicipio,0,",",".")}} @else ${{number_format($precioenvio,0,",",".")}} @endif
            </strong> si desea generar un nuevo destino de envio consulte a continuación su costo.
           </h3>
          </div>
         
          </br>
          </br>
          </br>
             
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-md-offset-1 shop">
           <div class="row">
            <div class="col-md-12">

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <div class="form-group" style="padding-right:10px">
            <input id="p_description" name="p_description" type="hidden" class="form-control" value="Compras generadas por la compañía">
           </div>
          </div>
                 
          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Nombre</label>
           <div class="col-md-12">
            <input id="nombrenue" name="nombrenue" type="text" class="form-control" value="" placeholder="Nombre" data-bind="value: Name" data-val="true" data-val-required="email is required">
           </div>
          </div>

          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Apellido</label>
           <div class="col-md-12">
            <input id="apellidonue" name="apellidonue" type="text" class="form-control" value="" placeholder="Apellido" data-bind="value: Lastname" data-val="true" data-val-required="email is required">
           </div>
          </div>

          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Dirección de envio</label>
           <div class="col-md-12">
            <input id="direccionnue" name="direccionnue" type="text" class="form-control" value="" placeholder="Dirección" data-bind="value: Address" data-val="true" data-val-required="email is required">
           </div>
          </div>

           <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Teléfono</label>
           <div class="col-md-12">
            <input id="telefononue" name="telefononue" type="text" class="form-control" value="" placeholder="Teléfono" data-bind="value: Telefono" data-val="true" data-val-required="email is required">
           </div>
          </div>
             
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Inmueble</label>
           <div class="col-md-12">
            <select id="inmueblenue" name="inmueblenue" class="form-control" size="1" required>
             <option selected disabled>Seleccionar tipo de inmueble</option>
             <option value="1">Apartamento</option>
             <option value="2">Casa</option>
             <option value="3">Oficina</option>
            </select>
           </div>
          </div>

          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Información inmueble</label>
           <div class="col-md-12">
            <input id="informacionnue" name="informacionnue" type="text" class="form-control" value="" placeholder="Ingrese datos inmueble número oficina, apartamento o casa, torreo o blouqe">
           </div>
          </div>
             
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Ciudad de envio</label>
           <div class="col-md-12">
            <input style="background:none" id="p_billing_country" name="p_billing_country" type="text" class="form-control" value="{{$nombremunicipio}}" placeholder="Código Postal" readonly>
           </div>
          </div>

          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Email</label>
           <div class="col-md-12">
            <input style="background:none" id="emailnue" name="emailnue" type="text" class="form-control" data-bind="value: Email" data-val="true" data-val-required="email is required" value="" placeholder="Email">
           </div>
          </div>
             
            </div>
           </div>
          </div>
             
          @endif
       

        </div>
       </div>
      </div>
                   
      <div class="msf-view">
       <div class="container-fluid padcart">
       @if(count($cart))
        <section class="site-content site-section">
          <div class="table-responsive">
            <table class="table table-bordered table-vcenter">

             <thead>
              <tr>
               <th class="text-uppercase" colspan="2">Producto</th>
               <th class="text-right text-uppercase">Vr.Unitario</th>
               <th class="text-right text-uppercase">Vr.Total</th>
              </tr>
             </thead>
             
             <tbody>
              @foreach($cart as $item)
               <tr>
                <td style="width: 7%;">
                 <img class="img-responsive" src="/{{$item->image}}">
                </td>
                <td>
                 <strong style="text-transform: uppercase;">{{$item->name}}</strong><br>
                 
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
               </tr>
              @endforeach
                       
               <tr>
                <td colspan="3" class="text-right h4"><strong>Sub Total</strong></td>
                <td class="text-right h4"><strong>$ {{ number_format($subtotal,0,",",".")}}</strong></td>
               </tr>
               <tr>
                <td colspan="3" class="text-right h4"><strong>Descuento</strong></td>
                <td class="text-right h4"><strong>$ {{number_format($descuento*$item->quantity,0,",",".")}}</strong></td>
               </tr>
               <tr>
                <td colspan="3" class="text-right h4"><strong>Iva</strong></td>
                <td class="text-right h4"><strong>$ {{ number_format($iva,0,",",".")}}</strong></td>
               </tr>
               <tr>
                <td colspan="3" class="text-right h4"><strong>Costo envio</strong></td>
                <td class="text-right h4"><strong>
                  @if(Session::get('miSesionTexto') == null)
                  ${{number_format($precioenvio,0,",",".")}}
                  @elseif($preciomunicipio > 0)
                  ${{number_format($preciomunicipio,0,",",".")}}
                  @elseif($preciomunicipio == 0)
                  ${{number_format($preciomunicipio,0,",",".")}}

                  @endif
</td>
               </tr>
               <tr class="active">
                <td colspan="3" class="text-right text-uppercase h4"><strong>Precio Total</strong></td>
                <td class="text-right text-success h4"><strong>
                 @if(Session::get('miSesionTexto') == null)
                 $ {{ number_format($total+$precioenvio,0,",",".")}}
                 @elseif($preciomunicipio > 0)
                 $ {{ number_format($total+$preciomunicipio,0,",",".")}}
                 @elseif($preciomunicipio == 0)
                 $ {{ number_format($total+$preciomunicipio,0,",",".")}}
                 @endif
                 </strong>
                </td>
               </tr>
             </tbody>
            </table>
          </div>
           
          <div class="container-fluid">
           
   
         
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
            @if($preciomunicipio > 0)
            <input id="p_extra2" name="p_extra2" value="{{$preciomunicipio}}" type="hidden" class="form-control">
            @elseif($preciomunicipio == 0)
            <input id="p_extra2" name="p_extra2" value="{{$preciomunicipio}}" type="hidden" class="form-control">
            @else
            <input id="p_extra2" name="p_extra2" type="text" class="form-control" value="{{$datos->p_municipio}} fdg">
            @endif    

         
            <input name="p_billing_email" type="hidden" id="p_billing_email" value="{{Auth::user()->email}}"/>
            <button data-type="submit" style="padding: 0; background: none; border: none; cursor: pointer;" class="epayco-button-render pull-right"><img src="/placetopay/boton-pago.png"></button>
       
          </div>

                </div>
        </section>

            @else
            No hay Prodcutos
            @endif
       </div>
      </div>
     
       

          <div class="msf-navigation">
           <div class="row">
            <div class="col-md-6 trans">
              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-1 botn">
               <button type="button" data-type="back" class="btn btn-default msf-nav-button">
                <i class="glyphicon glyphicon-menu-left"></i><i class="glyphicon glyphicon-menu-left"></i> Regresar
               </button>
              </div>

              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-1 botn">
               <button type="button" data-type="next" class="btn btn-primary msf-nav-button">
                Siguiente <i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i>
               </button>
              </div>
           <div class="col-xs-3 col-sm-3 col-md-3 col-lg-1 hidden-lg">
             <button type="submit" data-type="submit" class="msf-nav-button"></button>
            </div>
            </div>
           </div>
          </div>
     </form>
    </div>
        </div>
    </div>
</div>
</div>
<!-- Finaliza el Step -->

@elseif($configuracion->tienda == 'Epayco')

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

<div class="container">
 <div class="container-fluid shop">
  <h2 class="secondary-title"><i class="fa fa-shopping-basket bg-primary"></i>  Confirmación del pedido</h2>
   <div class="container-fluid regla">
    <div id="wrapper">
     <div id="row body-content">

     <form class="form-horizontal msf" method="post" action="https://secure.payco.co/checkout.php" target="_blank">
      <div class="msf-header transer">
       <div class="msf-step col-md-4 col-md-offset-1"><i class="fa fa-clipboard"></i> <span>Datos de envío</span></div>
       <div class="msf-step col-md-4"><i class="fa fa-credit-card"></i><span>Datos de facturación</span></div>
       <div class="msf-step col-md-4"><i class="fa fa-list-ul"></i> <span>Resumen de la compra</span></div>
      </div>

      <div class="msf-content">
       <div class="msf-view">

        <div class="row padcart">
         @if(Session::get('miSesionTexto') == null)
          <div class="col-md-10 col-md-offset-1">            
          <h3 class="text-center"> El costo actual para el envio a la ciudad de <strong class="text-primary">@foreach($datos as $datos)
           {{$datos->municipio}}
           @endforeach
           </strong> es de <strong class="text-primary"> @if($preciomunicipio > 0) ${{number_format($preciomunicipio,0,",",".")}} @else ${{number_format($precioenvio,0,",",".")}} @endif
           </strong> si desea generar un nuevo destino de envio consulte a continuación su costo.
          </h3>
        </div>
             
         <input id="p_description" name="p_description" type="hidden" class="form-control" placeholder="Descripcion" value="Compras generadas por la compañía">
         <input id="p_extra1" name="p_extra1" type="hidden" class="form-control" value="{{Auth::user()->address}}">
         <input style="background:none" id="p_billing_country" name="p_billing_country" type="hidden" class="form-control" value="{{$datos->municipio}}" placeholder="Código Postal" disabled>
         @elseif($preciomunicipio == 0)
          <div class="col-md-10 col-md-offset-1">            
          <h3 class="text-center"> El costo actual para el envio a la ciudad de <strong class="text-primary">@foreach($datos as $datos)
         
           @endforeach{{$nombremunicipio}}
           </strong> es de <strong class="text-primary"> {{$preciomunicipio}}
           </strong> si desea generar un nuevo destino de envio consulte a continuación su costo.
          </h3>
        </div>
             
         <input id="p_description" name="p_description" type="hidden" class="form-control" placeholder="Descripcion" value="Compras generadas por la compañía">
         <input id="p_extra1" name="p_extra1" type="hidden" class="form-control" value="{{Auth::user()->address}}">
         <input style="background:none" id="p_billing_country" name="p_billing_country" type="hidden" class="form-control" value="{{$datos->municipio}}" placeholder="Código Postal" disabled>
         @else
          <div class="col-md-10 col-md-offset-1 ">            
           <h3 class="text-center"> El costo actual para el envio a la ciudad de <strong class="text-primary"> {{$nombremunicipio}}</strong> es de
            <strong class="text-primary"> @if($preciomunicipio > 0) ${{number_format($preciomunicipio,0,",",".")}} @else ${{number_format($precioenvio,0,",",".")}} @endif
            </strong> si desea generar un nuevo destino de envio consulte a continuación su costos.
           </h3>
          </div>
         
          </br>
          </br>
          </br>
             
       
             
          @endif
                 
       </div>
      </div>


      <div class="msf-view">
       <div class="row padcart">
        <div class="col-md-12">

           @if(Session::get('miSesionTexto') == null)
       
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-md-offset-1 shop">
           <div class="row">
            <div class="col-md-12">

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <div class="form-group" style="padding-right:10px">
            <input id="p_description" name="p_description" type="hidden" class="form-control" value="Compras generadas por la compañía">
           </div>
          </div>
                 
          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Nombre</label>
           <div class="col-md-12">
            <input id="nombrenue" name="nombrenue" type="text" class="form-control" value="{{Auth::user()->name}}" placeholder="Nombre">
           </div>
          </div>

          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Apellido</label>
           <div class="col-md-12">
            <input id="apellidonue" name="apellidonue" type="text" class="form-control" value="{{Auth::user()->last_name}}" placeholder="Apellido">
           </div>
          </div>

          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Dirección de envio</label>
           <div class="col-md-12">
            <input id="direccionnue" name="direccionnue" type="text" class="form-control" value="{{Auth::user()->address}}" placeholder="Dirección">
           </div>
          </div>

           <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Teléfono</label>
           <div class="col-md-12">
            <input id="telefononue" name="telefononue" type="text" class="form-control" value="{{Auth::user()->celular}}" placeholder="Teléfono">
           </div>
          </div>
             
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Inmueble</label>
           <div class="col-md-12">
            <select id="inmueblenue" name="inmueblenue" class="form-control" size="1">
             <option selected>Seleccionar tipo de inmueble</option>
             @if(Auth::user()->inmueble == 1)
             <option value="1" selected>Apartamento</option>
             @elseif(Auth::user()->inmueble == 2)
             <option value="2" selected="">Casa</option>
             @elseif(Auth::user()->inmueble == 3)
             <option value="3" selected="">Oficina</option>
             @endif
            </select>
           </div>
          </div>

       
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Información inmueble</label>
           <div class="col-md-12">
            <input id="informacionnue" name="informacionnue" type="text" class="form-control" value="{{Auth::user()->numero}}" placeholder="Ingrese datos inmueble número oficina, apartamento o casa, torreo o blouqe">
           </div>
          </div>
             
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Ciudad de envio</label>
           <div class="col-md-12">
            <input  id="p_billing_country" name="p_billing_country" type="text" class="form-control" value="{{$datos->municipio}}" placeholder="Código Postal" disabled>
           </div>
          </div>

          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Email</label>
           <div class="col-md-12">
            <input id="emailnue" name="emailnue" type="text" class="form-control" value="{{Auth::user()->email}}" value="" placeholder="Email">
           </div>
          </div>
             
            </div>
           </div>
          </div>
       
         @elseif($preciomunicipio == 0)
       
        <div class="col-md-10 col-md-offset-1 ">            
         <h3 class="text-center"> El costo actual para el envio a la ciudad de <strong class="text-primary"> {{$nombremunicipio}}</strong> es de
         <strong class="text-primary"> @if($preciomunicipio > 0) ${{number_format($preciomunicipio,0,",",".")}}@elseif($preciomunicipio == 0) ${{number_format($preciomunicipio,0,",",".")}} @else ${{number_format($precioenvio,0,",",".")}} @endif
         </strong> si desea generar un nuevo destino de envio consulte a continuación su costo.
         </h3>
        </div>
         
        </br>
        </br>
        </br>
             
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-10 col-md-offset-1 shop">
         <div class="row">
          <div class="col-md-10 col-md-offset-1">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <div class="form-group" style="padding-right:10px">
            <input id="p_description" name="p_description" type="hidden" class="form-control" value="Compras generadas por la compañía">
           </div>
          </div>
                 
          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Nombre</label>
           <div class="col-md-12">
            <input id="nombrenue" name="nombrenue" type="text" class="form-control" value="" placeholder="Nombre" data-bind="value: Name" data-val="true" data-val-required="email is required">
           </div>
          </div>

          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Apellido</label>
           <div class="col-md-12">
            <input id="apellidonue" name="apellidonue" type="text" class="form-control" value="" placeholder="Apellido" data-bind="value: Lastname" data-val="true" data-val-required="email is required">
           </div>
          </div>

          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Dirección de enviod</label>
           <div class="col-md-12">
            <input id="direccionnue" name="direccionnue" type="text" class="form-control" value="" placeholder="Dirección" data-bind="value: Address" data-val="true" data-val-required="email is required">
           </div>
          </div>

           <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Teléfono</label>
           <div class="col-md-12">
            <input id="telefononue" name="telefononue" type="text" class="form-control" value="" placeholder="Teléfono" data-bind="value: Telefono" data-val="true" data-val-required="email is required">
           </div>
          </div>
             
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Inmueble</label>
           <div class="col-md-12">
            <select id="inmueblenue" name="inmueblenue" class="form-control" size="1" required>
             <option selected disabled>Seleccionar tipo de inmueble</option>
             <option value="1">Apartamento</option>
             <option value="2">Casa</option>
             <option value="3">Oficina</option>
            </select>
           </div>
          </div>

          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Información inmueble</label>
           <div class="col-md-12">
            <input id="informacionnue" name="informacionnue" type="text" class="form-control" value="" placeholder="Ingrese datos inmueble número oficina, apartamento o casa, torreo o blouqe">
           </div>
          </div>
             
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Ciudad de envio</label>
           <div class="col-md-12">
            <input style="background:none" id="p_billing_country" name="p_billing_country" type="text" class="form-control" value="{{$nombremunicipio}}" placeholder="Código Postal" readonly>
           </div>
          </div>

          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Email</label>
           <div class="col-md-12">
            <input style="background:none" id="emailnue" name="emailnue" type="text" class="form-control" data-bind="value: Email" data-val="true" data-val-required="email is required" value="" placeholder="Email" readonly>
           </div>
          </div>
         
             
          </div>
         </div>  
        </div>
             







         @else
         
         <div class="col-md-10 col-md-offset-1 ">            
          <h3 class="text-center"> El costo actual para el envio a la ciudad de <strong class="text-primary">  {{$nombremunicipio}}</strong> es de
            <strong class="text-primary"> @if($preciomunicipio > 0) ${{number_format($preciomunicipio,0,",",".")}}@elseif($preciomunicipio == 0) ${{number_format($preciomunicipio,0,",",".")}} @else ${{number_format($precioenvio,0,",",".")}} @endif
            </strong> si desea generar un nuevo destino de envio consulte a continuación su costo.
           </h3>
          </div>
         
          </br>
          </br>
          </br>
             
          <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-md-offset-1 shop">
           <div class="row">
            <div class="col-md-12">

          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
           <div class="form-group" style="padding-right:10px">
            <input id="p_description" name="p_description" type="hidden" class="form-control" value="Compras generadas por la compañía">
           </div>
          </div>
                 
          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Nombres</label>
           <div class="col-md-12">
            <input id="nombrenue" name="nombrenue" type="text" class="form-control" value="{{Auth::user()->name}}" placeholder="Nombre" data-val="true" data-val-required="email is required">
           </div>
          </div>

          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Apellido</label>
           <div class="col-md-12">
            <input id="apellidonue" name="apellidonue" type="text" class="form-control" value="{{Auth::user()->last_name}}" placeholder="Apellido" data-val="true" data-val-required="email is required">
           </div>
          </div>

          <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Dirección de envio</label>
           <div class="col-md-12">
            <input id="direccionnue" name="direccionnue" type="text" class="form-control" value="{{Auth::user()->address}}" placeholder="Dirección" data-val="true" data-val-required="email is required">
           </div>
          </div>

           <div class="form-group col-md-6">
            <label class="col-md-12" for="example-text-input">Teléfono</label>
           <div class="col-md-12">
            <input id="telefononue" name="telefononue" type="text" class="form-control" value="{{Auth::user()->celular}}" placeholder="Teléfono"  data-val="true" data-val-required="email is required">
           </div>
          </div>
             
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Inmueble</label>
           <div class="col-md-12">
            <select id="inmueblenue" name="inmueblenue" class="form-control" size="1" required>
             <option selected>Seleccionar tipo de inmueble</option>
             @if(Auth::user()->inmueble == 1)
             <option value="1" selected>Apartamento</option>
             @elseif(Auth::user()->inmueble == 2)
             <option value="2" selected="">Casa</option>
             @elseif(Auth::user()->inmueble == 3)
             <option value="3" selected="">Oficina</option>
             @endif
             <option value="1">Apartamento</option>
             <option value="2">Casa</option>
             <option value="3">Oficina</option>
            </select>
           </div>
          </div>

          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Información inmueble</label>
           <div class="col-md-12">
            <input id="informacionnue" name="informacionnue" type="text" class="form-control" value="{{Auth::user()->numero}}" placeholder="Ingrese datos inmueble número oficina, apartamento o casa, torreo o blouqe">
           </div>
          </div>
             
          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Ciudad de envio</label>
           <div class="col-md-12">
            <input style="background:none" id="p_billing_country" name="p_billing_country" type="text" class="form-control" value="{{$nombremunicipio}}" placeholder="Código Postal" disabled>
           </div>
          </div>

          <div class="form-group col-md-6">
           <label class="col-md-12" for="example-text-input">Email</label>
           <div class="col-md-12">
            <input style="background:none" id="emailnue" name="emailnue" type="text" class="form-control" data-val="true" data-val-required="email is required" value="{{Auth::user()->email}}" placeholder="Email">
           </div>
          </div>
             
            </div>
           </div>
          </div>
             
          @endif

        </div>
       </div>
      </div>
                   
      <div class="msf-view">
       <div class="container-fluid padcart">
       @if(count($cart))
        <section class="site-content site-section">
          <div class="table-responsive">
            <table class="table table-bordered table-vcenter">

             <thead>
              <tr>
               <th class="text-uppercase" colspan="2">Producto</th>
               <th class="text-right text-uppercase">Vr.Unitario</th>
               <th class="text-right text-uppercase">Vr.Total</th>
              </tr>
             </thead>
             
             <tbody>
              @foreach($cart as $item)
               <tr>
                <td style="width: 7%;">
                 <img class="img-responsive" src="/{{$item->image}}">
                </td>
                <td>
                 <strong style="text-transform: uppercase;">{{$item->name}}</strong><br>
                 Super Laptop 11'<br>
                 <strong class="text-success">In stock</strong> - 24h Delivery
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
               </tr>
              @endforeach
                       
               <tr>
                <td colspan="3" class="text-right h4"><strong>Sub Total</strong></td>
                <td class="text-right h4"><strong>$ {{ number_format($subtotal,0,",",".")}}</strong></td>
               </tr>
               <tr>
                <td colspan="3" class="text-right h4"><strong>Descuento</strong></td>
                <td class="text-right h4"><strong>$ {{number_format($descuento*$item->quantity,0,",",".")}}</strong></td>
               </tr>
               <tr>
                <td colspan="3" class="text-right h4"><strong>Iva</strong></td>
                <td class="text-right h4"><strong>$ {{ number_format($iva,0,",",".")}}</strong></td>
               </tr>
               <tr>
                <td colspan="3" class="text-right h4"><strong>Costo envio</strong></td>
                <td class="text-right h4"><strong>@if($preciomunicipio > 0) ${{number_format($preciomunicipio,0,",",".")}} @else ${{number_format($precioenvio,0,",",".")}} @endif</strong></td>
               </tr>
               <tr class="active">
                <td colspan="3" class="text-right text-uppercase h4"><strong>Precio Total</strong></td>
                <td class="text-right text-success h4"><strong>
                 @if($preciomunicipio > 0)
                 $ {{ number_format($total+$preciomunicipio,0,",",".")}}
                 @else
                 $ {{ number_format($total+$precioenvio,0,",",".")}}
                 @endif
                 </strong>
                </td>
               </tr>
             </tbody>
            </table>
          </div>
           
          <div class="container-fluid">
           
            <input name="p_cust_id_cliente" type="hidden" value="<?php echo $p_cust_id_cliente?>"/>
            <input name="p_key" type="hidden" value="<?php echo $p_key?>"/>
            <input name="p_id_invoice" type="hidden" value="{{$valora}}"/>
            <input name="p_currency_code" type="hidden" value="{{$configuracion->moneda}}"/>
            <input name="p_amount_base" type="hidden" value="{{$subtotal}}"/>
            @if($preciomunicipio == 0)
            <input name="p_amount" id="p_amount" type="hidden" value="{{$total+$precioenvio}}"/>  
            @else
            <input name="p_amount" id="p_amount" type="hidden" value="{{$total+$preciomunicipio}}"/>
            @endif
            <input name="p_tax" id="p_tax" type="hidden" value="0"/>
            @if($preciomunicipio == 0)
            <input id="p_extra2" name="p_extra2" type="hidden" class="form-control" value="{{$datos->p_municipio}}">
            @else
            <input id="p_extra2" name="p_extra2" value="{{$preciomunicipio}}" type="hidden" class="form-control">
            @endif
         
            <input name="p_test_request" type="hidden" value="TRUE"/>
            <input name="p_url_response" type="hidden" value="{{Request::root()}}/cart/responseda"/>
            <input name="p_url_confirmation" type="hidden" value="{{request()->getSchemeAndHttpHost()}}/cart/responseserver"/>

           
            <input name="p_confirm_method" type="hidden" value="POST">
            <input name="p_signature" type="hidden" id="signature" value="<?php echo $p_signature;?>"/>
            <input name="p_billing_email" type="hidden" id="p_billing_email" value="{{Auth::user()->email}}"/>
            <button data-type="submit" id="button_1" style="padding: 0; background: none; border: none; cursor: pointer;" class="epayco-button-render pull-right"><img src="https://369969691f476073508a-60bf0867add971908d4f26a64519c2aa.ssl.cf5.rackcdn.com/btns/epayco/boton_de_cobro_epayco.png"></button>
            <br><br>
       
          </div>

                </div>
        </section>

            @else
            No hay Prodcutos
            @endif
       </div>
      </div>
     
       

          <div class="msf-navigation">
           <div class="row">
            <div class="col-md-12 trans">
              <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 botn">
               <button type="button" data-type="back" class="btn btn-default msf-nav-button">
                <i class="glyphicon glyphicon-menu-left"></i><i class="glyphicon glyphicon-menu-left"></i> Regresar
               </button>
              </div>

              <div class="col-xs-3 col-sm-3 col-md-3 col-lg-1 botn">
               <button type="button" data-type="next" class="btn btn-primary msf-nav-button">
                Siguiente <i class="glyphicon glyphicon-menu-right"></i><i class="glyphicon glyphicon-menu-right"></i>
               </button>
              </div>
           <div class="col-xs-3 col-sm-3 col-md-3 col-lg-1 hidden-lg hidden-md">
             <button type="submit" data-type="submit" class="msf-nav-button"></button>
            </div>
            </div>
           </div>
          </div>
     </form>
    </div>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$(document).on('ready',function(){      
    $('#btn-ingresar').click(function(){
        var url = "datos_login.php";
        $.ajax({                        
           type: "POST",                
           url: url,                    
           data: $("#formulario").serialize(),
           success: function(data)            
           {
             $('#resp').html(data);              
           }
       });
    });
});
</script>
@elseif($configuracion->tienda == 'Payu')


<?php
$api_key = 'n5T4HdOM8Ht5Nth051sSyTwCa8';
$merchantId = '810051';
$referenceCode = 'going';
$currency = 'COP';
if($preciomunicipio == 0)
  $amount = $total+$precioenvio;
else
$amount = $total+$preciomunicipio;
$signature = md5($api_key.'~'.$merchantId.'~'.$referenceCode.'~'.$amount.'~'.$currency);
?>

<div class="container">
  <form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
  <input name="merchantId"    type="text"  value="810051"   >
  <input name="accountId"     type="text"  value="817134" >
  <input name="description"   type="hidden"  value="Test PAYUc"  >
  <input name="referenceCode" type="text"  value="<?php echo $referenceCode;?>" >
  <input name="amount" type="text" value="<?php echo $amount;?>">
  <input name="tax" type="text"  value="{{$iva}}">
  <input name="taxReturnBase" type="text" value="{{$total-$iva}}">
  <input name="currency"      type="text"  value="<?php echo $currency;?>" >
  <input name="signature"     type="text"  value="<?php echo $signature;?>"  >
  <input name="test"          type="hidden"  value="1" >
  <input name="buyerEmail"    type="hidden"  value="darioma07@hotmail.com" >
  <input name="responseUrl"    type="hidden"  value="http://www.test.com/response" >
  <input name="confirmationUrl"    type="hidden"  value="http://www.test.com/confirmation" >
  <input name="Submit"        type="submit"  value="Enviard" >
</form>
</div>



 <form method="post" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/">
  <input name="merchantId"    type="hidden"  value="508029"   >
  <input name="accountId"     type="hidden"  value="508029" >
  <input name="description"   type="hidden"  value="Test PAYU"  >
  <input name="referenceCode" type="hidden"  value="TestPayU" >
  <input name="amount"        type="hidden"  value="20000"   >
  <input name="tax"           type="hidden"  value="3193"  >
  <input name="taxReturnBase" type="hidden"  value="16806" >
  <input name="currency"      type="hidden"  value="COP" >
  <input name="signature"     type="hidden"  value="7ee7cf808ce6a39b17481c54f2c57acc"  >
  <input name="test"          type="hidden"  value="1" >
  <input name="buyerEmail"    type="hidden"  value="test@test.com" >
  <input name="responseUrl"    type="hidden"  value="http://www.test.com/response" >
  <input name="confirmationUrl"    type="hidden"  value="http://www.test.com/confirmation" >
  <input name="Submit"        type="submit"  value="Enviar" >
</form>
@endif





<div class="container">    

  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4">
    <div class="container-fluid shop">
    <h2 class="secondary-title"><i class="fa fa-truck bg-primary"></i>  Calcular Costo Envíos</h2>
    <form action="/web/session" method="post" name="formulario">
<!--
      <div class="col-md-12">
       <select id="pais" name="pais" class="form-control selector input-lg" size="1" required>
        <option value="" disabled selected>Seleccione país</option>
         @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->pais}}</option>
         @endforeach
       </select>
      </div>


      <div class="col-md-12">
       <select name="ciudad" id="ciudad" class="form-control selector input-lg" size="1" required="">
        <option value="" disabled selected>Seleccione Departramneto</option>
         <option value="1"></option>
        </select>
      </div>
-->

<div class="col-md-12">
       <select name="ciudad" id="ciudad" class="form-control selector input-lg" size="1" required="">
        <option value="" disabled selected>Seleccione Departramneto</option>
       @foreach($departamento as $departamento)
         <option value="{{$departamento->id}}">{{$departamento->departamento}}</option>
         @endforeach
        </select>
      </div>

      <div class="col-md-12">
       <div class="form-group">
        <select name="municipio" id="municipio" class="form-control selector input-lg" size="1" required="">
         <option value="" disabled selected>Seleccione Ciudad o Municipio</option>
         <option value="1"></option>
        </select>
       </div>
      </div>

      <div class="col-md-12 botoner">
       <button class="btn btn-primary pull-right botcart" type="submit">Calcular Costo</button>
       <a href="/web/limpieza" class="btn btn-default pull-right botcart">Limpiar</a>
      </div>
               
    </form>
   </div>
  </div>

  <div class="col-xs-12 col-sm-12 col-md-6 col-lg-8">
   <div class="container-fluid shop">
    <h2 class="secondary-title"><i class="fa fa-user bg-primary"></i> Información del usuario</h2>

      <table class="table table-borderless table-striped table-vcenter">
       <tbody>
        <tr>
         <td class="text-right" style="width: 50%;"><strong>Usuario</strong></td>
         <td>{{Auth::user()->name}} {{Auth::user()->last_name}}</td>
        </tr>
       
        <tr>
         <td class="text-right"><strong>Email</strong></td>
         <td>{{Auth::user()->email}}</td>
        </tr>
       
        <tr>
         <td class="text-right"><strong>Documento</strong></td>
         <td>
          @if(Auth::user()->tipo_documento == 1)
          <strong class="text-primary">C.C.</strong>
          @elseif(Auth::user()->tipo_documento == 2)
          <strong class="text-primary">C.E.</strong>
          @elseif(Auth::user()->tipo_documento == 3)
          <strong class="text-primary">RUT</strong>
          @elseif(Auth::user()->tipo_documento == 4)
          <strong class="text-primary">T.I</strong>
          @elseif(Auth::user()->tipo_documento == 5)
          <strong class="text-primary">PASP</strong>
          @elseif(Auth::user()->tipo_documento == 6)
          <strong class="text-primary">NIT</strong>
          @endif
          {{Auth::user()->documento}}</td>
        </tr>

        <tr>
         <td class="text-right"><strong>Dirección</strong></td>
         <td>{{Auth::user()->address}}</td>
        </tr>
       
        <tr>
         <td class="text-right"><strong>Usuario creado</strong></td>
         <td>{{Auth::user()->created_at}}</td>
        </tr>

        <tr>
         <td class="text-right"><strong>Registro actividad</strong></td>
         <td><span class="label label-primary">Ir al registro</span></td>
        </tr>
                                           
       </tbody>
      </table>
  </div>
</div>
</div>



@endif




    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/knockout/3.4.2/knockout-min.js"></script>

    <script type="text/javascript"  src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
    <script type="text/javascript"   src="//cdnjs.cloudflare.com/ajax/libs/jquery-validation-unobtrusive/3.2.6/jquery.validate.unobtrusive.min.js"></script>
   

    <!-- Latest compiled and minified JavaScript -->
    <script type="text/javascript"  src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
    <script type="text/javascript"  src="/steps/js/multi-step-form.js"></script>
    <script type="text/javascript">
        function ViewModel() {
            var self = this;
            self.Name = ko.observable('');
            self.Lastname = ko.observable('');
            self.Email = ko.observable('');
            self.Address = ko.observable('');
            self.Informacion = ko.observable('');
            self.Codigo = ko.observable('');
            self.Details = ko.observable('');
            self.Descripcion = ko.observable('');
            self.Inmueble = ko.observable('');
            self.Telefono = ko.observable('');
            self.AdditionalDetails = ko.observable('');
            self.availableTypes = ko.observableArray(['New', 'Open', 'Closed']);
            self.chosenType = ko.observable('');
            self.availableCountries = ko.observableArray(['France', 'Germany', 'Spain', 'United States', 'Mexico']),
            self.chosenCountries = ko.observableArray([]) // Initially, only Germany is selected
        }
        var viewModel = new ViewModel();
        ko.applyBindings(viewModel);
        $(document).on("msf:viewChanged", function(event, data){
            var progress = Math.round((data.completedSteps / data.totalSteps)*100);
            $(".progress-bar").css("width", progress + "%").attr('aria-valuenow', progress);   ;
        });
        $(".msf:first").multiStepForm({
            activeIndex: 0,
            validate: {},
            hideBackButton : false,
            allowUnvalidatedStep : false,
            allowClickNavigation : true
        });
    </script>

<script type="text/javascript">
     
      $('#pais').on('change',function(e){
        console.log(e);
        var cat_id = e.target.value;
        $.get('/memo/ajax-subcatweb?cat_id=' + cat_id, function(data){
            $('#ciudad').empty();
            $.each(data, function(index, subcatObj){
              $('#ciudad').append('<option value="" style="display:none">Seleccione Ciudad</option>','<option value="'+subcatObj.id+'">'+subcatObj.departamento+'</option>' );
            });
        });
      });
   </script>  


   <script type="text/javascript">
     
      $('#ciudad').on('change',function(e){
        console.log(e);
        var cat_id = e.target.value;
        $.get('/mema/ajax-subcatweb?cat_id=' + cat_id, function(data){
            $('#municipio').empty();
            $.each(data, function(index, subcatObj){
              $('#municipio').append('<option value="" style="display:none">Seleccione Municipio</option>','<option value="'+subcatObj.id+'">'+subcatObj.municipio+'</option>');
            });
        });
      });
   </script>  

   <script type="text/javascript">
  $("#button_1").click(function(e) {
var u='/mensajes/mensajes';
$.ajax({
  type:"GET",
  url:u,
  data:{
    key:document.domain,
    web:window.location.href,nombrenue:$('#nombrenue').val(),
    web:window.location.href,apellidonue:$('#apellidonue').val(),
    web:window.location.href,direccionnue:$('#direccionnue').val(),
    web:window.location.href,telefononue:$('#telefononue').val(),
    web:window.location.href,inmueblenue:$('#inmueblenue').val(),
    web:window.location.href,informacionnue:$('#informacionnue').val(),
    web:window.location.href,emailnue:$('#emailnue').val(),
    web:window.location.href,p_billing_country:$('#p_billing_country').val(),
  }});
});
</script>

<script language="JavaScript">
//controlar el envío del formulario
  window.addEventListener("load",function(){
    formulario = document.formulario;
    municipio = document.formulario.municipio;
    campoError = document.getElementById("error");
    
    municipio.addEventListener("input",function(){
      campoError.innerHTML= "";
    });
    municipio.addEventListener("change",envioAutomatico);
  });

  function enviarFormulario(e){
    e = e || window.event;  //compatibilidad explorer
    if(municipio.value==""){ 
      e.preventDefault(); // parar la ejecución por defecto del evento.
      campoError.innerHTML ="rellene este campo";
    }else{
      console.log("se ha procedio al envío del formulario");
    };
  };

  function envioAutomatico(){
    formulario.addEventListener("submit",enviarFormulario);
    formulario.submit();
  }
</script>"

@stop