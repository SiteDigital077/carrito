


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
       <a href="/gestion/carrito/verparametro"><i class="fa fa-clipboard"></i>Parametro</a>
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
  


<div class="container"> 
<a href="/gestion/carrito/crear-cupon" class="btn btn-primary pull-right">Crear cupon</a>
<br>
<br>
<br>
</div>

 <div class="block full">
                            <div class="block-title">
                                <h2><strong>Cupones</strong> Registrados Registrados</h2>
                            </div>

                            <div class="table-responsive">
                                <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Código</th>
                                            <th class="text-center">Porcentaje</th>
                                            <th>Estado</th>
                                            <th>Expiración</th>
                                            <th>Creación</th>
                                    
                                            <th class="text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   
                                          @foreach($cupones as $cupones)
                                      
                                        <tr>
                                            <td class="text-center">{{$cupones->codigo}}</td>
                                            <td class="text-center">{{$cupones->porcentaje}} %</td>
                                            <td></td>
                                            <td></td>
                                            <td>{{$cupones->created_at}}</td>
                                          
                                            <td class="text-center">
                                                <div class="btn-group">
                                                  <a href=""><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-warning"><i class="gi gi-envelope sidebar-nav-icon"></i></span></a>
                                                   
                                                  <a href="" onclick="return confirm('¿Está seguro que desea eliminar el registro?')"><button type="button" class="btn btn-danger"><i class="hi hi-trash sidebar-nav-icon"></i></button></a>
                                                </div>
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