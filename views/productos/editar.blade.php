
 @extends ('adminsite.layout')
 

   @section('cabecera')
    @parent
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  
    <script src="/vendors/ckeditor/ckeditor.js"></script>
    <link rel="stylesheet" href="/validaciones/dist/css/bootstrapValidator.css"/>
    <script type="text/javascript" src="/validaciones/dist/js/bootstrapValidator.js"></script>
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





@foreach($productos as $productos)
@endforeach

<div class="container">
  <div class="row">
                            <div class="col-md-12">
                                <!-- Basic Form Elements Block -->
                                <div class="block">
                                    <!-- Basic Form Elements Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                           
                                        </div>
                                        <h2><strong>Editar</strong> Producto</h2>
                                    </div>
                                    <!-- END Form Elements Title -->
                                    
                                    <!-- Basic Form Elements Content -->
                                     {{ Form::open(array('method' => 'POST','class' => 'form-horizontal','id' => 'defaultForm', 'url' => array('gestion/productos/actualizar',Request::segment(4)))) }}

                                       
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Nombre</label>
                                            <div class="col-md-9">
                                                {{Form::text('nombre', $productos->name, array('class' => 'form-control','placeholder'=>'Ingrese Nombre','required' => 'required'))}}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Descripción</label>
                                            <div class="col-md-9">
                                                {{Form::text('descripcion', $productos->description, array('class' => 'form-control','placeholder'=>'Ingrese Descripción','required' => 'required'))}}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Contenido</label>
                                            <div class="col-md-9">
                                                {{Form::textarea('contenido', $productos->contenido, array('class' => 'ckeditor','id' => 'editor','placeholder'=>'Ingrese contenido'))}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Cantidad Stock</label>
                                            <div class="col-md-9">
                                                {{Form::text('stock', $productos->stock, array('class' => 'form-control','placeholder'=>'Ingrese Stock'))}}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Año publicación</label>
                                            <div class="col-md-9">
                                                {{Form::text('ano', $productos->ano, array('class' => 'form-control','placeholder'=>'Ingrese año publicación'))}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Referencia producto</label>
                                            <div class="col-md-9">
                                                {{Form::text('referencia', $productos->referencia, array('class' => 'form-control','placeholder'=>'Ingrese año publicación'))}}
                                            </div>
                                        </div>     

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Precio</label>
                                            <div class="col-md-9">
                                                {{Form::text('precio', $productos->precio, array('class' => 'form-control','placeholder'=>'Ingrese Precio','required' => 'required'))}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Porcentaje de Descuento</label>
                                            <div class="col-md-9">
                                                {{Form::text('descuento', $productos->descuento, array('class' => 'form-control','placeholder'=>'Ingrese Descuento'))}}
                                            </div>
                                        </div>
   
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Iva</label>
                                            <div class="col-md-9">
                                                {{Form::text('iva', $productos->iva, array('class' => 'form-control','placeholder'=>'Ingrese Iva'))}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-select">Estado de compra</label>
                                            <div class="col-md-9">
                                                {{ Form::select('posicion', [$productos->position => $productos->position,
                                                   '0' => 'Disponible para comprar',
                                                   '1' => 'No Disponible para comprar'], null, array('class' => 'form-control')) }}
                                             </div>
                                        </div>

                                        @if(DB::table('venta')->where('id', '1')->value('comunidad') == 1)
                                          <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Área</label>
                                            <div class="col-md-9">
                                                <select name="area" class="form-control">
                                                   <option value="{{$productos->area_id}}" selected="selected">{{$productos->areaweb}}</option>
                                                  @foreach($areas as $areas)
                                                 <option value="{{$areas->id}}">{{$areas->areaweb}}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                        </div>
                                     


                                      <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Grado</label>
                                            <div class="col-md-9">
                                                <select name="parametro" class="form-control">
                                                   <option value="{{$productos->parametro_id}}" selected="selected">{{$productos->parametro}}</option>
                                                  @foreach($parametros as $parametros)
                                                 <option value="{{$parametros->id}}">{{$parametros->parametro}}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                        </div>

                                           @else
                                        @endif



                                          <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Autor</label>
                                            <div class="col-md-9">
                                                <select name="autor" class="form-control">
                                                  <option value="{{$productos->autor_id}}" selected="selected">{{$productos->nombre}}</option>
                                                  @foreach($autores as $autores)
                                                 <option value="{{$autores->id}}">{{$autores->nombre}}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                        </div>
            
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-password-input">Imagen</label>
                                            <div class="col-md-9">
                                                <input type="text" name="FilePath" readonly="readonly" onclick="openKCFinder(this)" value="{{$productos->image}}" class="form-control" />
                                            </div>
                                        </div>

                                           <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-select">Visualización</label>
                                            <div class="col-md-9">
                                                 {{ Form::select('nivel', [$productos->visible => $productos->visible,
                                                '1' => 'Visible',
                                                '0' => 'No Visible'], null, array('class' => 'form-control')) }}
                                             </div>
                                        </div>

                                          {{Form::hidden('categoriapro', $productos->categoriapro_id, array('class' => 'form-control','placeholder'=>'Ingrese Iva'))}}
                                          
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-password-input">Responsive</label>
                                            <div class="col-md-9">
                                                 {{Form::text('responsive', $productos->responsive, array('class' => 'form-control','placeholder'=>'Ingrese responsive'))}}
                                            </div>
                                        </div>

                                
                                         
                                           <input type="hidden" name="peca" value="{{Request::segment(4)}}"></input>

                                        <div class="form-group form-actions">
                                            <div class="col-md-9 col-md-offset-3">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Editar</button>
                                                <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Cancelar</button>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                
                                </div>
                                <!-- END Basic Form Elements Block -->
                            </div>
                          </div>
                          
</div>


<script src="/validaciones/carrito/crear-producto.js" type="text/javascript"></script>

  <script type="text/javascript">  
       CKEDITOR.replace( 'editor' );  
    </script>  


<script type="text/javascript">
function openKCFinder(field) {
    window.KCFinder = {
        callBack: function(url) {
            field.value = url;
            window.KCFinder = null;
        }
    };
    window.open('/vendors/kcfinder/browse.php?type=images&dir=files/public', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}
</script>

<script src="/vendors/ckeditor/config.js?t=HBDD" type="text/javascript"></script>

  

  @stop