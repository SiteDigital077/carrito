
 
@extends ('LayoutsSD.TemaSD')

@section('ContenidoSite-01')

 @foreach($usuarios as $usuario)
 @endforeach

 <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 topper">
<table class="table table-bordered">
 <li class="list-group-item list-group-item-primary text-center">DATOS DEL COMPRADOR</li>
  <tbody>
    <tr>
      <td><b>Nombre</b></td>
      <td>{{$usuario->name}}</td>
      <td><b>Email</b></td>
      <td>  {{$usuario->email}}</td>
    </tr>
    <tr>
      <td><b>Apellido</b></td>
      <td>{{$usuario->last_name}}</td>
      <td><b>Dirección</b></td>
      <td>  {{$usuario->address}}</td>
    </tr>
    <tr>
      <td><b>Teléfono</b></td>
      <td>  {{$usuario->phone}}</td>
      <td></td>
      <td></td>
    </tr>
  
  </tbody>
</table>
</div>
 <a href="">Ver datos del comprador</a>

 {{ Html::style('//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.css') }}
 <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 col-xs-offset-1 topper">

  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
   <a href="<?=URL::to('gestion/productos/crear');?>/{{Request::segment(4)}}"><button type="button" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-star"></span> Nuevo producto</button></a>
  </div>


  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="contenido">
 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">



   <table id="example" class="table table-striped table-bordered topper" cellspacing="0" width="100%">
    <thead>
     <tr>
      <th>ID Producto</th>
      <th>subtotal</th>
      <th>Cantidad</th>
      <th>Creada</th>
      
     </tr>
    </thead>

    <tbody>
  
 @foreach($productos as $producto)
     <tr>

      <td>{{ $producto->id }}</td>
      <td>{{ $producto->name }}</td>
      <td>{{ $producto->quantity }}</td>
      <td>Creada</td>
   

     </tr>
  @endforeach
    </tbody>
   </table>
 </div>
    </div>






</div>
 



   {{ HTML::script('//code.jquery.com/jquery-1.11.1.min.js') }}
   {{ HTML::script('//cdn.datatables.net/1.10.1/js/jquery.dataTables.min.js') }}
   {{ HTML::script('//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.js') }}
 
   <script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
    $('#example').dataTable();} );
   </script>
      <script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
    $('#example1').dataTable();} );
   </script>
      <script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
    $('#example2').dataTable();} );
   </script>

  <script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
    $('#example3').dataTable();} );
   </script>

     <script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
    $('#example4').dataTable();} );
   </script>

        <script type="text/javascript" language="javascript" class="init">
    $(document).ready(function() {
    $('#example5').dataTable();} );
   </script>

   <script>
    $(document).ready (function () {
    $('.delete').click (function () {
    if (confirm("¿ Está seguro de que desea eliminar ?")) {
    var id = $(this).attr ("title");
    document.location.href=' <?=URL::to('contenidos/delete/');?>/'+id;}});});
   </script>



    <script type="text/javascript">
function confirmarRegistro()
{
   if (window.confirm("Desea eliminar el registro?") == true)
      {
        var id = $(this).attr ("title");
        document window.location = "http://localhost"+id;
      }
else
   {
      alert("Cancelado será redirigido a la pagina principal");
      window.location ="http://localhost";
   }
}
</script>
@stop
