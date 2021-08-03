@extends ('adminsite.layout')
 

   @section('cabecera')
    @parent
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  

    @stop


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
      <li class="active">
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
  <div class="row">
                            <div class="col-md-12">
                                <!-- Basic Form Elements Block -->
                                <div class="block">
                                    <!-- Basic Form Elements Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                        </div>
                                        <h2><strong>Crear</strong> Autor</h2>
                                    </div>
                                    <!-- END Form Elements Title -->
                                    
                                    <!-- Basic Form Elements Content -->
                                     {{ Form::open(array('method' => 'POST','class' => 'form-horizontal','id' => 'defaultForm', 'url' => array('gestion/carrito/creacionautor'))) }}

                                        
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Nombre</label>
                                            <div class="col-md-9">
                                                {{Form::text('nombre', '', array('class' => 'form-control','placeholder'=>'Ingrese Nombre','required' => 'required'))}}
                                            </div>
                                        </div>

                                 
                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Descripción</label>
                                            <div class="col-md-9">
                                                {{Form::textarea('descripcion', '', array('class' => 'ckeditor','id' => 'editor','placeholder'=>'Ingrese contenido','required' => 'required'))}}
                                            </div>
                                        </div>

                                           <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-password-input">Imagen</label>
                                            <div class="col-md-9">
                                                <input type="text" name="FilePath" readonly="readonly" onclick="openKCFinder(this)" placeholder="Click para seleccionar imagen" class="form-control" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">País</label>
                                            <div class="col-md-9">
                                                {{Form::text('pais', '', array('class' => 'form-control','placeholder'=>'Ingrese País','required' => 'required'))}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Url Video</label>
                                            <div class="col-md-9">
                                                {{Form::text('video', '', array('class' => 'form-control','placeholder'=>'Ingrese facebook'))}}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Email</label>
                                            <div class="col-md-9">
                                                {{Form::text('email', '', array('class' => 'form-control','placeholder'=>'Ingrese email'))}}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Página web</label>
                                            <div class="col-md-9">
                                                {{Form::text('website', '', array('class' => 'form-control','placeholder'=>'Ingrese website'))}}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Facebook</label>
                                            <div class="col-md-9">
                                                {{Form::text('facebook', '', array('class' => 'form-control','placeholder'=>'Ingrese facebook'))}}
                                            </div>
                                        </div>

                                    

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Twitter</label>
                                            <div class="col-md-9">
                                                {{Form::text('twitter', '', array('class' => 'form-control','placeholder'=>'Ingrese twitter'))}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Linkedin</label>
                                            <div class="col-md-9">
                                                {{Form::text('linkedin', '', array('class' => 'form-control','placeholder'=>'Ingrese Linkedin'))}}
                                            </div>
                                        </div>
   
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Youtube</label>
                                            <div class="col-md-9">
                                                {{Form::text('youtube', '', array('class' => 'form-control','placeholder'=>'Ingrese youtube'))}}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Vimeo</label>
                                            <div class="col-md-9">
                                                {{Form::text('vimeo', '', array('class' => 'form-control','placeholder'=>'Ingrese vimeo'))}}
                                            </div>
                                        </div>


     

                                        <div class="form-group form-actions">
                                            <div class="col-md-9 col-md-offset-3">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Crear</button>
                                                <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Cancelar</button>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                
                                </div>
                                <!-- END Basic Form Elements Block -->
                            </div>
                          </div>
                          
</div>




<script>
  document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('button-image').addEventListener('click', (event) => {
      event.preventDefault();
      window.open('/file-manager/fm-button', 'fm', 'width=900,height=500');
    });
  });
  // set file link
  function fmSetLink($url) {
    document.getElementById('image_label').value = $url;
  }
</script>


<script src="https://cdn.ckeditor.com/4.11.2/full/ckeditor.js"></script>

<script>
  CKEDITOR.replace( 'editor', {filebrowserImageBrowseUrl: '/file-manager/ckeditor'});
</script>


  

  @stop