


 @extends ('adminsite.layout')
 

  @section('ContenidoSite-01')


  <div class="content-header">
     <ul class="nav-horizontal text-center">
      <li class="active">
      <a href="/gestion/carrito/dashboard"><i class="fa fa-keyboard-o"></i> Dashboard</a>
      </li>
      <li>
       <a href="/gestion/carrito"><i class="gi gi-parents"></i> Usuarios</a>
      </li>
      <li>
       <a href="/gestion/carrito/categorias"><i class="fa fa-th-list"></i> Categorias</a>
      </li>
      <li>
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


<div class="container">

   <div class="col-sm-6 col-lg-3">
      <div class="widget">
       <div class="widget-extra themed-background-success">
        <h4 class="widget-content-light"><i class="fa fa-paypal"></i> <strong>Ventas Totales</strong></h4>
       </div>
      <div class="widget-extra-full"><span class="h4 text-success animation-expandOpen">$ {{number_format($total,0,",",".")}}</span></div>
     </div>
    </div>

     <div class="col-sm-6 col-lg-3">
      <div class="widget">
       <div class="widget-extra themed-background-success">
        <h4 class="widget-content-light"><i class="fa fa-paypal"></i> <strong>Cantidad Ordenes</strong></h4>
       </div>
      <div class="widget-extra-full"><span class="h4 text-success animation-expandOpen"> {{$conteo}}</span></div>
     </div>
    </div>

     <div class="col-sm-6 col-lg-3">
      <div class="widget">
       <div class="widget-extra themed-background-success">
        <h4 class="widget-content-light"><i class="fa fa-paypal"></i> <strong>Cantidad Productos</strong></h4>
       </div>
      <div class="widget-extra-full"><span class="h4 text-success animation-expandOpen"> {{$product}}</span></div>
     </div>
    </div>

     <div class="col-sm-6 col-lg-3">
      <div class="widget">
       <div class="widget-extra themed-background-success">
        <h4 class="widget-content-light"><i class="fa fa-paypal"></i> <strong>Estado</strong></h4>
       </div>
      <div class="widget-extra-full"><span class="h4 text-success animation-expandOpen"> Aceptada</span></div>
     </div>
    </div>
  
</div>

<div class="container">
  

 <div class="col-lg-6">
                                <!-- Top Products Block -->
                                <div class="block">
                                    <!-- Top Products Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            <a href="page_ecom_products.html" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Show All"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
                                        </div>
                                        <h2><strong>Top</strong> Productos</h2>
                                    </div>
                                    <!-- END Top Products Title -->

                                    <!-- Top Products Content -->
                                    <table class="table table-borderless table-striped table-vcenter table-bordered">
                                        <tbody>
                                          @foreach($dashboard as $dashboard)
                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="page_ecom_product_edit.html"><strong>ID.</strong></a></td>
                                                <td><a href="page_ecom_product_edit.html">{{$dashboard->product}}</a></td>
                                                <td class="text-center"><strong>{{$dashboard->cantidad}}</strong> Productos vendidos</td>
                                                <td class="hidden-xs text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach                             
                                        </tbody>
                                    </table>
                                    <!-- END Top Products Content -->
                                </div>
                                <!-- END Top Products Block -->
                            </div>



 <div class="col-lg-6">
                                <!-- Top Products Block -->
                                <div class="block">
                                    <!-- Top Products Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            <a href="page_ecom_products.html" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Show All"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
                                        </div>
                                        <h2><strong>Top</strong> Medios de Pago</h2>
                                    </div>
                                    <!-- END Top Products Title -->

                                    <!-- Top Products Content -->
                                    <table class="table table-borderless table-striped table-vcenter table-bordered">
                                        <tbody>
                                         @foreach($franquicia as $franquicia)
                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="page_ecom_product_edit.html"><strong>ID.</strong></a></td>
                                                <td><a href="page_ecom_product_edit.html">{{$franquicia->nombre}}</a></td>
                                                <td class="text-center"><strong>{{$franquicia->conteo}}</strong> Transacciones</td>
                                                <td class="hidden-xs text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach                             
                                        </tbody>
                                    </table>
                                    <!-- END Top Products Content -->
                                </div>
                                <!-- END Top Products Block -->
                            </div>

<div class="col-lg-6">
                                <!-- Top Products Block -->
                                <div class="block">
                                    <!-- Top Products Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            <a href="page_ecom_products.html" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Show All"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Settings"><i class="fa fa-cog"></i></a>
                                        </div>
                                        <h2><strong>Top</strong>Meses</h2>
                                    </div>
                                    <!-- END Top Products Title -->

                                    <!-- Top Products Content -->
                                    <table class="table table-borderless table-striped table-vcenter table-bordered">
                                        <tbody>
                                         @foreach($meses as $meses)
                                            <tr>
                                                <td class="text-center" style="width: 100px;"><a href="page_ecom_product_edit.html"><strong>ID.</strong></a></td>
                                                <td><a href="page_ecom_product_edit.html">
                                                  @if(date('m', strtotime($meses->nombre))== '01')
                                                   Enero
                                                  @elseif(date('m', strtotime($meses->nombre))== '02')
                                                   Febrero
                                                  @elseif(date('m', strtotime($meses->nombre))== '03')
                                                   Marzo
                                                  @elseif(date('m', strtotime($meses->nombre))== '04')
                                                   Abril
                                                  @elseif(date('m', strtotime($meses->nombre))== '05')
                                                   Mayo
                                                  @elseif(date('m', strtotime($meses->nombre))== '06')
                                                   Junio
                                                  @elseif(date('m', strtotime($meses->nombre))== '07')
                                                   Julio
                                                  @elseif(date('m', strtotime($meses->nombre))== '08')
                                                   Agosto
                                                  @elseif(date('m', strtotime($meses->nombre))== '09')
                                                   Septiembre
                                                  @elseif(date('m', strtotime($meses->nombre))== '10')
                                                   Octubre
                                                  @elseif(date('m', strtotime($meses->nombre))== '11')
                                                   Noviembre
                                                  @elseif(date('m', strtotime($meses->nombre))== '12')
                                                   Diciembre
                                                  @endif
                                                </a></td>
                                                <td class="text-center"><strong>{{$meses->conteo}}</strong> Transacciones</td>
                                                <td class="hidden-xs text-center">
                                                    <div class="text-warning">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half-o"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach                             
                                        </tbody>
                                    </table>
                                    <!-- END Top Products Content -->
                                </div>
                                <!-- END Top Products Block -->
                            </div>



                        </div>
                        <!-- END Orders and Products -->
           
                    <!-- END Page Content -->



<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

    <script src="/adminsite/js/pages/tablesDatatables.js"></script>
        <script>$(function(){ TablesDatatables.init(); });</script>
  

  @stop