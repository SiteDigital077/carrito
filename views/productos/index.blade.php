



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
    <strong>Producto registrado con éxito</strong>
   </div>
  @endif

  @if($status=='ok_delete')
   <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Producto eliminado con éxito</strong>
   </div>
  @endif

  @if($status=='ok_update')
   <div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Producto actualizado con éxito</strong>
   </div>
  @endif

 </div>

<div class="container">
    <a href="/gestion/productos/crear/{{Request::segment(4)}}" class="btn btn-primary pull-right">Crear Producto</a>
    <br>
    <br>
    <br>
</div>

<div class="container">

 <div class="block full">
                            <div class="block-title">
                                <h2><strong>Productos</strong> Registrados</h2>
                            </div>
                         

                            <div class="table-responsive">
                                <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Imagen</th>
                                            <th class="text-center">Nombre</th>
                                           
                                            <th>Precio</th>
                                            
                                          
                                            <th>Precio iva</th>
                                            <th>Estado</th>
                                            <th>Disponibilidad</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach($productos as $producto)
                                        <tr>
                                            <td class="text-center" style="width:1%"><img src="/{{ $producto->image }}" class="img-responsive" alt="Image"></td>
                                            <td class="text-center">{{ $producto->name }}</td>
                                          
                                            <td>$ {{ number_format($producto->precio,0,",",".") }}</td>
                                            
                                  
                                            <td>$ {{number_format($producto->precioinivafin,0,",",".") }}</td>
                                            @if($producto->visible == 1)
                                            <td><span class="label label-success">Activo</span></td>
                                            @else
                                            <td><span class="label label-danger">No activo</span></td>
                                            @endif
                                            @if($producto->position == 0)
                                            <td><span class="label label-success">Disponible</span></td>
                                            @else
                                            <td><span class="label label-danger">No disponible</span></td>
                                            @endif
                                            <td class="text-center">
                                             <a href="<?=URL::to('gestion/productos/imagenes/');?>/{{ $producto->id }}"><span id="tup" data-toggle="tooltip" data-placement="bottom" title="Crear Imagen" class="btn btn-success"><i class="hi hi-trash sidebar-nav-icon"></i></span></a>
                                             <a href="<?=URL::to('gestion/productos/editarproducto/');?>/{{ $producto->id }}"><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-primary"><i class="fa fa-pencil-square-o sidebar-nav-icon"></i></span></a>
                                             <script language="JavaScript">
                                             function confirmar ( mensaje ) {
                                             return confirm( mensaje );}
                                             </script>
                                             <a href="<?=URL::to('gestion/productos/eliminar/');?>/{{ $producto->id }}" onclick="return confirmar('¿Está seguro que desea eliminar el registro?')"><span id="tup" data-toggle="tooltip" data-placement="bottom" title="Editar Página" class="btn btn-danger"><i class="hi hi-trash sidebar-nav-icon"></i></span></a>
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