


 @extends ('adminsite.layout')
 

  @section('ContenidoSite-01')


   <div class="content-header">
     <ul class="nav-horizontal text-center">
      <li>
      <a href="/gestion/carrito/dashboard"><i class="fa fa-keyboard-o"></i> Dashboard</a>
      </li>
      <li class="active">
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
  
    @if($status=='ok_import')
   <div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Usuarios importados con éxitp</strong>
   </div>
  @endif


 </div>








<div class="container">
  
<a href="{{ URL::to('carrito/pruebas/downloadExcel/xls') }}"><button class="btn btn-success">Descargar usuarios xls</button></a>
<a href="{{ URL::to('carrito/pruebas/downloadExcel/xlsx') }}"><button class="btn btn-success">Descargar usuarios xlsx</button></a>
<a href="{{ URL::to('carrito/pruebas/downloadExcel/csv') }}"><button class="btn btn-success">Descargar usuarios CSV</button></a>
<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Importar usuarios</a>

<br>
<br>


<div class="modal fade" id="modal-id">
  <div class="modal-dialog">
    <div class="modal-content">
      <form style="margin-top: 15px;padding: 10px;" action="{{ URL::to('carrito/pruebas/importExcel') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Importar usuarios</h4>
      </div>
      <div class="modal-body">
        <input type="file" name="import_file" required/>
        <br>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Importar usuarios</button>
      </div>
      </form>
    </div>
  </div>
</div>


 <div class="block full">
                            <div class="block-title">
                                <h2><strong>Usuarios</strong> Registrados Ecommerce</h2>
                            </div>

                            <div class="table-responsive">
                                <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Apellido</th>
                                            <th>E-mail</th>
                                            <th>Dirección</th>
                                            <th>Teléfono</th>
                                            <th>Rol</th>
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                          @foreach($usuarios as $usuario)
                                         @if($usuario->rol_id == 2)
                                        <tr>
                                            <td class="text-center">{{$usuario->name}}</td>
                                            <td class="text-center">{{$usuario->last_name}}</td>
                                            <td>{{$usuario->email}}</td>
                                            <td>{{$usuario->address}}</td>
                                            <td>{{$usuario->phone}}</td>
                                            <td>{{$usuario->rol_id}}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                  <a href=""><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-warning"><i class="gi gi-envelope sidebar-nav-icon"></i></span></a>
                                                   <a href="<?=URL::to('gestion/usuario/editar/');?>/{{ $usuario->id }}"><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-primary"><i class="fa fa-pencil-square-o sidebar-nav-icon"></i></span></a>
                                                  <a href="<?=URL::to('gestion/usuario/eliminar/');?>/{{$usuario->id}}" onclick="return confirm('¿Está seguro que desea eliminar el registro?')"><button ="button" class="btn btn-danger"><i class="hi hi-trash sidebar-nav-icon"></i></button></a>
                                                </div>
                                            </td>
                                        </tr>
                                        @else
                                        @endif
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