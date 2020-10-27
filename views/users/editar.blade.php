@extends ('LayoutsSD.TemaSD')

  @section('titulo')
  Gestor de Usuarios 
  @stop

  @section('cabecera')
  @parent
   {{ Html::style('//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.css') }}
   {{ Html::style('//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css') }}
  @stop

  @section('ContenidoSite-01')


 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-lg-offset-1">
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
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-lg-offset-2">

    {{ Form::open(array('method' => 'PUT','class' => 'form-horizontal','id' => 'defaultForm', 'url' => array('gestion/usuarios/actualizar',$user->id))) }}

      
      
       <div class="form-group">
        {{Form::label('name', 'Nombre' )}}
         <div class="col-lg-12">
          {{Form::text('name', $user->name, array('class' => 'form-control','placeholder'=>'Ingrese nombre'))}}
         </div>
       </div>

       <div class="form-group">
        {{Form::label('email', 'Email' )}}
         <div class="col-lg-12">
          {{Form::text('email', $user->email, array('class' => 'form-control','placeholder'=>'Ingrese email'))}}
         </div>
       </div>

    
       <input type="hidden" name="_token" value="{{ csrf_token() }}">
   

    
      {{Form::hidden('level', '2', array('class' => 'form-control','placeholder'=>'Ingrese la descripción de la página'))}}
    

     <div class="modal-footer">
      {{ Form::reset('Borrar', array('class' => 'btn btn-default')) }}
      {{Form::submit('Editar', array('class' => 'btn btn-primary')  )}}
     </div>
     

{{ Form::close() }}
</div>
  @foreach($user as $users)
  @endforeach


  @stop

  @section('footer')
   @parent
    {{ Html::script('Usuario/js/Actualizar.js') }}
    {{ Html::script('//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js') }} 
    {{ Html::script('//cdn.datatables.net/1.10.1/js/jquery.dataTables.min.js') }}
    {{ Html::script('//cdn.datatables.net/plug-ins/be7019ee387/integration/bootstrap/3/dataTables.bootstrap.js') }}

    <script type="text/javascript" language="javascript" class="init">
     $(document).ready(function() {
     $('#example').dataTable();} );
    </script>
  
    <script>
     $(document).ready (function () {
     $('.delete').click (function () {
     if (confirm("¿ Está seguro de que desea eliminar el usuario? ")) {
     var id = $(this).attr ("title");
     document.location.href='Users/delete/'+id;}}) ;}) ;
    </script>

    <script>
     $(document).ready(function() {
     $('.edit').click(function() {
     $('[name=user]').val($(this).attr ('id'));
     var faction = "<?php echo URL::to('user/getuser/data'); ?>";
     var fdata = $('#val').serialize();
     $('#load').show();
     $.post(faction, fdata, function(json) {
     if (json.success) {
     $('#defaultForm1 input[name="user_id"]').val(json.id);
     $('#defaultForm1 input[name="name_edit"]').val(json.name);
     $('#defaultForm1 input[name="last_name_edit"]').val(json.last_name);
     $('#defaultForm1 input[name="email_edit"]').val(json.email);
     $('#defaultForm1 input[name="address_edit"]').val(json.address);
     $('#defaultForm1 input[name="phone_edit"]').val(json.phone);
     $('#defaultForm1 input[name="username_edit"]').val(json.username);
     if(json.level == '1'){
     $('#level_ad').prop('checked', 'true');}
     else{
     $('#level_us').prop('checked', 'true');
     }
     $('#load').hide();
     } else {
     $('#errorMessage').html(json.message);
     $('#errorMessage').show();
     }});});});
    </script>
  
  @show