




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








<div class="container">
  


 <div class="block full">
                            <div class="block-title">
                                <h2><strong>Ordenes</strong> Registradas</h2>
                            </div>

                            <div class="table-responsive">
                                <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Código aprobación</th>
                                            <th class="text-center"># orden</th>
                                            <th class="text-center">Cliente</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">subtotal</th>
                                            <th>Total</th>
                                            <th>Estado</th>
                                            <th>Fecha</th>
                             
                                            
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ordenes as $orden)
                                        <tr>
                                            <td class="text-center">{{ $orden->codigo_apr }}</td>
                                            <td class="text-center"><strong>ORD.{{ $orden->id }}</strong></td>
                                            <td class="text-center">{{ $orden->nombre }}</td>
                                            <td class="text-center">{{ $orden->cantidad }}</td>
                                            <td class="text-center">$ {{ number_format($orden->subtotal,0,",",".") }}</td>
                                            <td class="text-center"><strong>$ {{number_format($orden->shipping,0,",",".")}}</strong></td>
                                            @if($orden->estado == "Aceptada" OR $orden->estado == "APPROVED")
                                            <th> <span class="label label-success">Aceptada</span></th>
                                            @elseif($orden->estado == "Pendiente" OR $orden->estado == "PENDING")
                                            <th> <span class="label label-warning">Pendiente</span></th>
                                            @elseif($orden->estado == "Rechazada" OR $orden->estado == "REJECTED")
                                            <th> <span class="label label-danger">Rechazada</span></th>
                                            @endif
                                            <td>{{$orden->fecha}}</td>
                             
                                            <td class="text-center">
                                              <a href="<?=URL::to('/gestion/carrito/detalle');?>/{{ $orden->id }}"><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-warning"><i class="fa fa-list-alt sidebar-nav-icon"></i></span></a>
                                            </td>
                                        </tr>
                                      @endforeach 
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END Datatables Content -->




</div>

    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="/adminsite/js/pages/tablesDatatables.js"></script>
    <script>$(function(){ TablesDatatables.init(); });</script>



  @stop