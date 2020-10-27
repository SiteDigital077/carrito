

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
      <li class="active">
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
    <strong>Categoría Registrada Con Éxito</strong> CMS...
   </div>
  @endif

  @if($status=='ok_delete')
   <div class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Categoría Eliminada Con Éxito</strong> CMS...
   </div>
  @endif

  @if($status=='ok_update')
   <div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Categoría Actualizada Con Éxito</strong> CMS...
   </div>
  @endif

 </div>


<div class="container">
  <a href="/gestion/carrito/createca" class="btn btn-primary pull-right">Crear Categoria</a>
  <br>
  <br>
  <br>
</div>

<div class="container">

  <a href="{{ URL::to('carrito/productos/downloadExcel/xls') }}"><button class="btn btn-success">Descargar productos xls</button></a>
<a href="{{ URL::to('carrito/productos/downloadExcel/xlsx') }}"><button class="btn btn-success">Descargar productos xlsx</button></a>
<a href="{{ URL::to('carrito/productos/downloadExcel/csv') }}"><button class="btn btn-success">Descargar productos CSV</button></a>
<!--<a class="btn btn-primary" data-toggle="modal" href='#modal-id'>Importar productos</a>-->
<br>
<br>

 <div class="block full">
                            <div class="block-title">
                                <h2><strong>Categorias</strong> Registradas</h2>
                            </div>

                            <div class="table-responsive">
                                <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Título</th>
                                            <th class="text-center">Descripción</th>
                                            <th>Color</th>
                                            <th>Creación</th>
                                         
                                            
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   @foreach($categories as $category) 
                                        <tr>
                                            <td class="text-center">{{ $category->nombre }}</td>
                                            <td class="text-center">{{ $category->descripcion }}</td>
                                            <td>{{ $category->color }}</td>
                                            
                                            <td>{{ $category->created_at }}</td>
                                            <td class="text-center">
                                               <a href="/gestion/carrito/subcategorias/{{$category->id}}"><span id="tip" data-toggle="tooltip" data-placement="left" title="Ver Contenidos" class="btn btn-warning"><i class="fa fa-list-alt sidebar-nav-icon"></i></span></a>
      <a href="<?=URL::to('gestion/carrito/editarcategoriaproducto/');?>/{{ $category->id }}"><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-primary"><i class="fa fa-pencil-square-o sidebar-nav-icon"></i></span></a>
      <script language="JavaScript">
function confirmar ( mensaje ) {
return confirm( mensaje );}
</script>
    <a href="<?=URL::to('gestion/carrito/eliminar/');?>/{{ $category->id }}" onclick="return confirmar('¿Está seguro que desea eliminar el registro?')"><span id="tup" data-toggle="tooltip" data-placement="bottom" title="Editar Página" class="btn btn-danger"><i class="hi hi-trash sidebar-nav-icon"></i></span></a>
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