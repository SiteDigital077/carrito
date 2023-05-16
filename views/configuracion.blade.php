
 @extends ('adminsite.layout')
 

   @section('cabecera')
    @parent
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>  
    <script src="/vendors/ckeditor/ckeditor.js"></script>  
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
      <li class="active">
       <a href="/gestion/carrito/crearconfiguracion"><i class="fa fa-clipboard"></i>Configurar</a>
      </li>
      <li>
       <a href="/gestion/carrito/terminos"><i class="fa fa-clipboard"></i>Terminos y condiciones</a>
      </li>
     </ul>
    </div>

 <div class="container">
  <?php $status=Session::get('status'); ?>




  @if($status=='ok_update')
   <div class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Configuración actualizada con éxito</strong>
   </div>
  @endif

 </div>

@foreach($categories as $categories)
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
                                        <h2><strong>Seleccione </strong>Pasarela de Pagos</h2>
                                    </div>
                                    <!-- END Form Elements Title -->
                                    
                                    <!-- Basic Form Elements Content -->
                                     {{ Form::open(array('method' => 'GET','class' => 'form-horizontal','id' => 'defaultForm', 'url' => array('gestion/carrito/crearconfiguraciontienda'))) }}
                                      {{Form::hidden('login', $categories->login, array('class' => 'form-control','placeholder'=>'Ingrese Logine'))}}
                                        {{Form::hidden('trankey', $categories->trankey, array('class' => 'form-control','placeholder'=>'Ingrese Trankey'))}}
                                        {{Form::hidden('monedaplace', $categories->monedaplace, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}

                                        {{Form::hidden('id_cliente', $categories->id_cliente, array('class' => 'form-control','placeholder'=>'Ingrese ID Cliente'))}}
                                        {{Form::hidden('p_key', $categories->p_key, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}
                                        {{Form::hidden('moneda', $categories->moneda, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-select">Seleccione pasarela</label>
                                            <div class="col-md-9">
                                              {{ Form::select('tienda', [$categories->tienda => $categories->tienda,
                                              'PlaceToPay' => 'PlaceToPay',
                                              'Epayco' => 'Epayco',  
                                              'Cotizador' => 'Cotizador',     
                                              ], null, array('class' => 'form-control')) }}
                                             </div>
                                        </div>



                                     <div class="form-group">
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

@if($categories->tienda == 'Epayco')

<div class="container">
  <div class="row">
                            <div class="col-md-12">
                                <!-- Basic Form Elements Block -->
                                <div class="block">
                                    <!-- Basic Form Elements Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            
                                        </div>
                                        <h2><strong>Configuración </strong>Epayco</h2>
                                    </div>
                                    <!-- END Form Elements Title -->
                                    
                                    <!-- Basic Form Elements Content -->
                                     {{ Form::open(array('method' => 'POST','class' => 'form-horizontal','id' => 'defaultForm', 'url' => array('gestion/carrito/crearconfiguracionepayco'))) }}
                                      {{Form::hidden('tienda', $categories->tienda, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}
                                        {{Form::hidden('login', $categories->login, array('class' => 'form-control','placeholder'=>'Ingrese Logine'))}}
                                        {{Form::hidden('trankey', $categories->trankey, array('class' => 'form-control','placeholder'=>'Ingrese Trankey'))}}
                                        {{Form::hidden('monedaplace', $categories->monedaplace, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}


 
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">ID Cliente</label>
                                            <div class="col-md-9">
                                                {{Form::text('id_cliente', $categories->id_cliente, array('class' => 'form-control','placeholder'=>'Ingrese ID Cliente'))}}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">P_Key</label>
                                            <div class="col-md-9">
                                                {{Form::text('p_key', $categories->p_key, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Descripcón de la compra</label>
                                            <div class="col-md-9">
                                                {{Form::text('descripcion', $categories->description, array('class' => 'form-control','placeholder'=>'Ingrese Descripción'))}}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-select">Dirección de Pago</label>
                                            <div class="col-md-9">
                                              {{ Form::select('direccion', [$categories->direccion => $categories->direccion,
                                              '1' => 'Interna',
                                              '2' => 'Externa',     
                                              ], null, array('class' => 'form-control')) }}
                                             </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-select">Tipo moneda</label>
                                            <div class="col-md-9">
                                              {{ Form::select('moneda', [$categories->moneda => $categories->moneda,
                                              'COP' => 'COP',
                                              'USD' => 'USD',     
                                              ], null, array('class' => 'form-control')) }}
                                             </div>
                                        </div>

                          

                                  

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Redirección</label>
                                            <div class="col-md-9">
                                                {{Form::text('redireccion', $categories->url, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}
                                            </div>
                                        </div>

                                  

                                        <div class="form-group form-actions">
                                            <div class="col-md-9 col-md-offset-3">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                                                <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                
                                </div>
                                <!-- END Basic Form Elements Block -->
                            </div>
                          </div>
                          
</div>

@elseif($categories->tienda == 'PlaceToPay')

<div class="container">
  <div class="row">
                            <div class="col-md-12">
                                <!-- Basic Form Elements Block -->
                                <div class="block">
                                    <!-- Basic Form Elements Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            
                                        </div>
                                        <h2><strong>Configuración </strong>Place To Pay</h2>
                                    </div>
                                    <!-- END Form Elements Title -->
                                    
                                    <!-- Basic Form Elements Content -->
                                     {{ Form::open(array('method' => 'POST','class' => 'form-horizontal','id' => 'defaultForm', 'url' => array('gestion/carrito/crearconfiguracionplace'))) }}
                                      {{Form::hidden('tienda', $categories->tienda, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}
                                      {{Form::hidden('id_cliente', $categories->id_cliente, array('class' => 'form-control','placeholder'=>'Ingrese ID Cliente'))}}
                                      {{Form::hidden('p_key', $categories->p_key, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}
                                      {{Form::hidden('moneda', $categories->moneda, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Login</label>
                                            <div class="col-md-9">
                                                {{Form::text('login', $categories->login, array('class' => 'form-control','placeholder'=>'Ingrese Logine'))}}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Trankey</label>
                                            <div class="col-md-9">
                                                {{Form::text('trankey', $categories->trankey, array('class' => 'form-control','placeholder'=>'Ingrese Trankey'))}}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-select">Tipo moneda</label>
                                            <div class="col-md-9">
                                              {{ Form::select('monedaplace', [$categories->monedaplace => $categories->monedaplace,
                                              'COP' => 'COP',
                                              'USD' => 'USD',     
                                              ], null, array('class' => 'form-control')) }}
                                             </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Redirección</label>
                                            <div class="col-md-9">
                                                {{Form::text('redireccion', $categories->url, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Url producción</label>
                                            <div class="col-md-9">
                                                {{Form::text('url_produccion', $categories->url_produccion, array('class' => 'form-control','placeholder'=>'Ingrese Url_producción'))}}
                                            </div>
                                        </div>

                                        <div class="form-group form-actions">
                                            <div class="col-md-9 col-md-offset-3">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                                                <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                
                                </div>
                                <!-- END Basic Form Elements Block -->
                            </div>
                          </div>
                          
</div>

@elseif($categories->tienda == 'Cotizador')

<div class="container">
  <div class="row">
                            <div class="col-md-12">
                                <!-- Basic Form Elements Block -->
                                <div class="block">
                                    <!-- Basic Form Elements Title -->
                                    <div class="block-title">
                                        <div class="block-options pull-right">
                                            
                                        </div>
                                        <h2><strong>Configuración </strong>Cotizador</h2>
                                    </div>
                                    <!-- END Form Elements Title -->
                                    
                                    <!-- Basic Form Elements Content -->
                                     {{ Form::open(array('method' => 'POST','class' => 'form-horizontal','id' => 'defaultForm', 'url' => array('gestion/carrito/crearconfiguracionplace'))) }}
                                      {{Form::hidden('tienda', $categories->tienda, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}
                                      {{Form::hidden('id_cliente', $categories->id_cliente, array('class' => 'form-control','placeholder'=>'Ingrese ID Cliente'))}}
                                      {{Form::hidden('p_key', $categories->p_key, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}
                                      {{Form::hidden('moneda', $categories->moneda, array('class' => 'form-control','placeholder'=>'Ingrese P_Key'))}}
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Email Notificación</label>
                                            <div class="col-md-9">
                                                {{Form::text('cot_email', $categories->cot_email, array('class' => 'form-control','placeholder'=>'Ingrese Mail Notificación'))}}
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Sujeto</label>
                                            <div class="col-md-9">
                                                {{Form::text('cot_sujeto', $categories->cot_sujeto, array('class' => 'form-control','placeholder'=>'Ingrese Sujeto Mensaje '))}}
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Asunto</label>
                                            <div class="col-md-9">
                                                {{Form::text('cot_asunto', $categories->cot_asunto, array('class' => 'form-control','placeholder'=>'Cuerpo Mensaje Mensaje '))}}
                                            </div>
                                        </div>

                                       
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="example-text-input">Mensaje</label>
                                            <div class="col-md-9">
                                                {{Form::textarea('cot_mensaje', $categories->cot_mensaje, array('class' => 'form-control','placeholder'=>'Ingrese Mensaje'))}}
                                            </div>
                                        </div>

                                         

                                        <div class="form-group form-actions">
                                            <div class="col-md-9 col-md-offset-3">
                                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-angle-right"></i> Submit</button>
                                                <button type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Reset</button>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                
                                </div>
                                <!-- END Basic Form Elements Block -->
                            </div>
                          </div>
                          
</div>

@endif
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

  @stop