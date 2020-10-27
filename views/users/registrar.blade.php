@extends ('LayoutsSD.Layout')


         <script type="text/javascript" src="/validaciones/vendor/jquery/jquery.min.js"></script>

          @section('cabecera')
 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="Site Digital">
    <meta http-equiv="Cache-control" content="public">
    <title></title>


    @foreach($seo as $seo)
    <link rel="canonical" href="{{$seo->canonical}}{{Request::getRequestUri()}}"/>
    <meta property="og:locale" content="{{$seo->idioma}}">
    <meta property="og:type" content="{{$seo->og_type}}">
    <meta property="og:title" content="">
    <meta property="og:description" content="">
    <meta property="og:url" content="{{$seo->og_url}}">
    <meta property="og:site_name" content="{{$seo->og_name}}">
    <meta property="og:image" content="{{$seo->canonical}}/{{$seo->og_image}}">
    <meta name="twitter:card" content="{{$seo->twitter_card}}"/>
    <meta name="twitter:site" content="{{$seo->twitter_site}}" />
    <meta name="twitter:creator" content="{{$seo->twitter_creator}}" />
    <meta name="twitter:title" content="{{$seo->twitter_title}}" />
    <meta name="twitter:description" content="{{$seo->twitter_description}}" />
    <meta name="twitter:image" content="{{$seo->twitter_image}}" />
    <link rel="shortcut icon" href="{{$seo->ico}}" type="image/icon">
    <link rel="apple-touch-icon" href="{{$seo->icoapple}}" />
    @endforeach
 
  @stop

    @section('ContenidoSite-01')

<br>
<div class="container">


         <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Acceso usuarios</div>
                <div class="panel-body">
                    <form class="form-horizontal" id="defaultForm3" role="form" method="POST" action="{{ url('/gestion/usuarios/crear') }}">
                     

                            <div class="container-fluid">
                            
                             <div class="container-fluid">
                        


                            <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Nombre</label>
                                            <div class="col-md-12">
                                                <input type="text" name="name" class="form-control" placeholder="Ingrese nombre">
                                            </div>
                                        </div>

                             <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Apellido</label>
                                            <div class="col-md-12">
                                                <input type="text" name="last_name" class="form-control" placeholder="Ingrese apellido">
                                            </div>
                                        </div>
                            </div>

                            <div class="container-fluid">
                             

                              <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Email</label>
                                            <div class="col-md-12">
                                                <input type="email" name="email" class="form-control" placeholder="Ingrese email">
                                            </div>
                                        </div>
                                  <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Teléfono</label>
                                            <div class="col-md-12">
                                                <input type="phone" name="phone" class="form-control" placeholder="Ingrese teléfono">
                                            </div>
                                        </div>

                               </div> 

                              <div class="container-fluid">

                                 <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Ciudad</label>
                                            <div class="col-md-12">
                                               <select name="ciudad" id="ciudad" class="form-control" size="1">
                                                @foreach($ciudades as $ciduades)
                                                    <option value="{{$ciduades->id}}">{{$ciduades->departamento}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Municipio</label>
                                            <div class="col-md-12">
                                               <select name="municipio" id="municipio" class="form-control" size="1">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                         
                                      </div>      

                                   <div class="container-fluid">  
                                     <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Contraseña</label>
                                            <div class="col-md-12">
                                                <input type="password"  name="password" class="form-control" placeholder="Ingrese contraseña">
                                            </div>
                                        </div>
                              <div class="form-group col-md-6">
                                            <label class="col-md-12">Repetir Contraseña</label>
                                            <div class="col-md-12">
                                                <input type="password" name="confirmPassword" class="form-control" placeholder="Repita contraseña">
                                            </div>
                                        </div>
                                      </div>
                               <input type="hidden" id="example-text-input" name="level" class="form-control" value="2">

                            </div>  

                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                             <div class="container-fluid">
                               <div class="form-group col-md-6">
                                <label class="checkbox-inline">
                                  <div class="col-md-12">
                                     <input type="checkbox" id="terms" name="terms">Aceptar terminos y condiciones <a data-toggle="modal" href='#modal-id'>Ver terminos</a> </label>
                                  </div>
                               </div>
                              <div class="modal fade" id="modal-id">
                                <div class="modal-dialog modal-lg">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                      <h4 class="modal-title">Terminos y condiciones</h4>
                                    </div>
                                    <div class="modal-body">
                                      <div class="container-fluid">
                                         @foreach($terminos as $terminos)
                                         {!!$terminos->terminos!!}
                                         @endforeach
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                             </div>
                            </div>

                        <div class="form-group col-sm-12">
                            <div class="col-md-12">
                              <div class="container-fluid">
                                <button type="submit" class="btn btn-primary btn-lg pull-right">
                                    <i class="fa fa-btn fa-sign-in"></i> Registrar Usuario
                                </button>
                                </div>
                               
                            </div>
                        </div>
                    </form>
                </div>
                 

      </div>
        </div>
   
 
</div>









 <!-- Include all compiled plugins (below), or include individual files as needed -->

  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
 {{ Html::script('Usuario/js/registro.js') }}
  {{ Html::script('//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js') }}

 <script type="text/javascript">
     
      $('#ciudad').on('change',function(e){
        console.log(e);

        var cat_id = e.target.value;

        $.get('/mema/ajax-subcatweb?cat_id=' + cat_id, function(data){
            $('#municipio').empty();
            $.each(data, function(index, subcatObj){
              $('#municipio').append('<option value="" style="display:none">Seleccione Municipio</option>','<option value="'+subcatObj.id+'">'+subcatObj.municipio+'</option>');

            });
        });
      });
   </script>  


@stop