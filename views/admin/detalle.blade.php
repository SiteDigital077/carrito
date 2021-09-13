 @extends ('adminsite.layout')
 

  @section('ContenidoSite-01')

 
 <div class="content-header">
     <ul class="nav-horizontal text-center">
      <li>
      <a href="/gestion/carrito/dashboard"><i class="fa fa-keyboard-o"></i> Dashboard</a>
      </li>
      <li>
       <a href="/gestion/carrito"><i class="gi gi-parents"></i> Usuarios</a>
      </li>
      <li>
       <a href="/gestion/carrito/categorias"><i class="fa fa-th-list"></i> Categorias</a>
      </li>
      <li class="active">
       <a href="/gestion/carrito/epayco"><i class="fa fa-pencil-square-o"></i>Ordenes</a>
      </li>
      <li>
       <a href="/gestion/carrito/autores"><i class="fa fa-child"></i>Autores</a>
      </li>
      
      <li>
       <a href="/gestion/carrito/crearconfiguracion"><i class="fa fa-clipboard"></i>Configurar</a>
      </li>
      <li>
       <a href="/gestion/carrito/terminos"><i class="fa fa-clipboard"></i>Terminos y condiciones</a>
      </li>
     </ul>
    </div>

 <div class="container">
  <?php $status=Session::get('status'); ?>
  @if($status=='ok_create')
   <div class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Usuario registrado con éxito</strong>
   </div>
  @endif

  @if($status=='ok_delete')
   <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Usuario eliminado con éxito</strong>
   </div>
  @endif

  @if($status=='ok_update')
   <div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Usuario actualizado con éxito</strong>
   </div>
  @endif

 </div>

@foreach($datos as $datos)
<div class="container">
  <div class="row text-center">
    <div class="col-sm-6 col-lg-3">
     <div class="widget">
      <div class="widget-extra themed-background-success">
       <h4 class="widget-content-light"><strong>ORD.{{$datos->id}}</strong></h4>
      </div>
     <div class="widget-extra-full"><span class="h4 text-success animation-expandOpen">{{$datos->fecha}}</span></div>
    </div>
  </div>


 
    @if($datos->estado == "Aceptada" OR $datos->estado == "APPROVED")
    <div class="col-sm-6 col-lg-3">
      <div class="widget">
       <div class="widget-extra themed-background-success">
        <h4 class="widget-content-light"><i class="fa fa-paypal"></i> <strong>Estado</strong></h4>
       </div>
      <div class="widget-extra-full"><span class="h4 text-success animation-expandOpen"> Aceptada</span></div>
     </div>
    </div>
    @elseif($datos->estado == "Pendiente" OR $datos->estado == "PENDING")
    <div class="col-sm-6 col-lg-3">
     <div class="widget">
      <div class="widget-extra themed-background-warning">
       <h4 class="widget-content-light"><i class="fa fa-paypal"></i> <strong>Estado</strong></h4>
      </div>
      <div class="widget-extra-full"><span class="h4 text-warning animation-expandOpen"> Pendiente</span></div>
     </div>
    </div>
    @elseif($datos->estado == "Rechazada" OR $datos->estado == "REJECTED")
    <div class="col-sm-6 col-lg-3">
     <div class="widget">
      <div class="widget-extra themed-background-danger">
       <h4 class="widget-content-light"><i class="fa fa-paypal"></i> <strong>Estado</strong></h4>
      </div>
     <div class="widget-extra-full"><span class="h4 text-danger animation-expandOpen"> Rechazada</span></div>
    </div>
    </div>
    @endif
                        
    <div class="col-sm-6 col-lg-3">
     <div class="widget">
      <div class="widget-extra themed-background-warning">
       <h4 class="widget-content-light"><i class="fa fa-archive"></i> <strong># Aprobación</strong></h4>
      </div>
     <div class="widget-extra-full"><span class="h4 text-warning">{{$datos->codigo_apr}}</span></div>
    </div>
    </div>

    <div class="col-sm-6 col-lg-3">
     <div class="widget">
      <div class="widget-extra themed-background-muted">
       <h4 class="widget-content-light"><i class="fa fa-truck"></i> <strong>Medio de Pago</strong></h4>
      </div>
      @if($datos->medio == 'AM')
      <div class="widget-extra-full"><span class="h4 text-muted animation-pulse">Amex</span></div>
      @elseif($datos->medio == 'BA')
      <div class="widget-extra-full"><span class="h4 text-muted animation-pulse">Baloto</span></div>
      @elseif($datos->medio == 'CR')
      <div class="widget-extra-full"><span class="h4 text-muted animation-pulse">Credencial</span></div>
      @elseif($datos->medio == 'DC' OR $datos->medio == "Diners")
      <div class="widget-extra-full"><span class="h4 text-muted animation-pulse">Diners Club</span></div>
      @elseif($datos->medio == 'EF')
      <div class="widget-extra-full"><span class="h4 text-muted animation-pulse">Efecty</span></div>
      @elseif($datos->medio == 'GA')
      <div class="widget-extra-full"><span class="h4 text-muted animation-pulse">Gana</span></div>
      @elseif($datos->medio == 'PR')
      <div class="widget-extra-full"><span class="h4 text-muted animation-pulse">Punto Red</span></div>
      @elseif($datos->medio == 'RS')
      <div class="widget-extra-full"><span class="h4 text-muted animation-pulse">Red Servi</span></div>
      @elseif($datos->medio == 'MC' OR $datos->medio == "MasterCard")
      <div class="widget-extra-full"><span class="h4 text-muted animation-pulse">Master Card</span></div>
      @elseif($datos->medio == 'PSE')
      <div class="widget-extra-full"><span class="h4 text-muted animation-pulse">PSE</span></div>
      @elseif($datos->medio == 'SP')
      <div class="widget-extra-full"><span class="h4 text-muted animation-pulse">SafetyPay</span></div>
      @elseif($datos->medio == 'VS' OR $datos->medio == "Visa")
      <div class="widget-extra-full"><span class="h4 text-muted animation-pulse">Visa</span></div>
      @endif
    </div>
    </div>
  </div>
</div>

@endforeach


<div class="container">
 <div class="block">
                            <!-- Products Title -->
  <div class="block-title">
   <h2><i class="fa fa-shopping-cart"></i> <strong>Detalle de la orden</strong></h2>
  </div>

  <div class="table-responsive">
   <table class="table table-bordered table-vcenter">
    <thead>
     <tr>
      <th class="text-center" style="width: 100px;">ID</th>
      <th>Producto</th>
      <th class="text-center">Referencia</th>
      <th class="text-center">Cantidad</th>
      <th class="text-center">Vr.Unitario</th>
      <th class="text-center">Descuento</th>
      <th class="text-center">Vr.Iva</th>
      <th class="text-right" style="width: 10%;">Vr.Total</th>
     </tr>
    </thead>
                                    
    <tbody>
     @foreach($productos as $productos)
      <tr>
       <td class="text-center"><strong>IDT.{{$productos->id}}</strong></td>
       <td>{{$productos->name}} </td>
       <td class="text-center text-primary"><b>{{$productos->referencia}}</b></td>
       <td class="text-center"><strong>{{$productos->cantidad}}</strong></td>
       <td class="text-center"><strong>$ {{number_format($productos->precio,0,",",".")}}</strong></td>
       <td class="text-center"><strong>{{$productos->descuento}} %</strong></td>
       <td class="text-center"><strong>{{$productos->iva}} %</strong></td>
       <td class="text-right"><strong>$ {{number_format($productos->precio*$productos->quantity,0,",",".")}}</strong></td>
      </tr>
     @endforeach
     @foreach($totales as $totales)
     <?php
     $totalweb = $totales->subtotal-$totales->empresa;
     $ivaweb = $totalweb*$totales->iva_ord/$totales->subtotal;
     ?>
      <tr>
        <td colspan="7" class="text-right text-uppercase"><strong>Descuento</strong></td>
       <td class="text-right"><strong>$ {{number_format($totales->preciodescuento*$totales->cantidad,0,",",".")}}</strong></td>
      </tr>
      <tr>
        <td colspan="7" class="text-right text-uppercase"><strong>Cupón</strong></td>
       <td class="text-right"><strong>- {{$totales->tipo}} %</strong></td>
      </tr>
       <tr>
       <td colspan="7" class="text-right text-uppercase"><strong>Sub Total:</strong></td>
       <td class="text-right"><strong>$ {{number_format($totales->subtotal-$totales->empresa,0,",",".")}}</strong></td>
      </tr>
      <tr>
       <td colspan="7" class="text-right text-uppercase"><strong>Iva:</strong></td>
       @if($totales->tipo == '')
       <td class="text-right"><strong>$ {{number_format($totales->iva_ord,0,",",".")}}</strong></td>
       @else
       <td class="text-right"><strong>$ {{number_format($ivaweb,0,",",".")}}</strong></td>
       @endif
      </tr>
      <tr>
       <td colspan="7" class="text-right text-uppercase"><strong>Costo Envio</strong></td>
       <td class="text-right"><strong>$ {{number_format($totales->cos_envio,0,",",".")}}</strong></td>
      </tr>
      <tr class="active">
       <td colspan="7" class="text-right text-uppercase"><strong>Valor Total:</strong></td>
       <td class="text-right"><strong>
        @if($totales->tipo == '')
        ${{number_format($totales->shipping+$totales->cos_envio,0,",",".")}}
        @else
         ${{number_format($totalweb+$ivaweb+$totales->cos_envio,0,",",".")}}
        @endif
      </strong></td>
      </tr>

     @endforeach
     </tbody>
   </table>
  </div>
 </div>
</div>



            <!-- Addresses -->
                        <div class="container">
                          <div class="row">
                            
                          
                            <div class="col-sm-12">
                                <!-- Billing Address Block -->
                                <div class="block">
                                    <!-- Billing Address Title -->
                                    <div class="block-title">
                                        <h2><i class="fa fa-user"></i> <strong>Datos</strong> Envío</h2>
                                    </div>
                                    <!-- END Billing Address Title -->

                                    <!-- Billing Address Content -->
                                 
                                    <h4><strong>{{$productos->nombre}}</strong></h4>
                                    <address>
                                        <b>{{$productos->ciudad}}</b><br>
                                        {{$productos->departamento}}<br>
                                        <br>
                                        {{$productos->direccion}},
                                        <br>
                                        @if($productos->inmueble == 1)
                                        <strong>Casa</strong>
                                        @elseif($productos->inmueble == 2)
                                        <strong>Apartamento</strong>
                                        @elseif($productos->inmueble == 3)
                                        <strong>Oficina</strong>
                                        @endif
                                        <br>
                                        <br>                                
                                        <i class="fa fa-phone"></i> {{$productos->telefono}}<br>
                                        <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">{{$productos->email}}</a>
                                    </address>
                                    <!-- END Billing Address Content -->
                       

                                </div>
                                <!-- END Billing Address Block -->
                            </div>
                   
                            </div>
                                <!-- END Shipping Address Block -->
                            </div>
                         
                        <!-- END Addresses -->


    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="/adminsite/js/pages/tablesDatatables.js"></script>
    <script>$(function(){ TablesDatatables.init(); });</script>
    
  

  @stop