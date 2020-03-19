

@extends ('LayoutsSD.Layout')


         <script type="text/javascript" src="/validaciones/vendor/jquery/jquery.min.js"></script>

    @section('ContenidoSite-01')


<div class="container">


         <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">Acceso usuarios</div>
                <div class="panel-body">
                    <form class="form-horizontal" id="defaultForm3" role="form" method="POST" action="{{ url('/gestion/usuarios/crear') }}">
                     

                            <div class="container-fluid">
                                 
                            <div class="container-fluid">                                             
                            <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Tipo Documento</label>
                                            <div class="col-md-12">
                                               <select id="example-select" name="tdocumento" class="form-control" size="1">
                                                    <option value="" selected>Seleccione tipo documento</option>
                                                    <option value="1">Cédula ciudadania</option>
                                                    <option value="2">Cédula extranjeria</option>
                                                    <option value="3">RUT</option>
                                                    <option value="4">Tarjeta identidad</option>
                                                    <option value="5">Pasaporte</option>
                                                    <option value="6">NIT</option>
                                                </select>
                                            </div>
                                        </div>

                             <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Documento</label>
                                            <div class="col-md-12">
                                                <input type="text"  name="documento" class="form-control" placeholder="Ingrese documento">
                                            </div>
                                        </div>

                             </div>           

                             <div class="container-fluid">
                            <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Compañía</label>
                                            <div class="col-md-12">
                                                <input type="text" name="compania" class="form-control" placeholder="Ingrese Compañía">
                                            </div>
                                        </div>


                            <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Nombre</label>
                                            <div class="col-md-12">
                                                <input type="text" name="name" class="form-control" placeholder="Ingrese nombre">
                                            </div>
                                        </div>
                            </div>

                            <div class="container-fluid">
                             <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Apellido</label>
                                            <div class="col-md-12">
                                                <input type="text" name="last_name" class="form-control" placeholder="Ingrese apellido">
                                            </div>
                                        </div>

                              <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Email</label>
                                            <div class="col-md-12">
                                                <input type="email" name="email" class="form-control" placeholder="Ingrese email">
                                            </div>
                                        </div>

                               </div>         


                               <div class="container-fluid">
                              <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Teléfono</label>
                                            <div class="col-md-12">
                                                <input type="phone" name="phone" class="form-control" placeholder="Ingrese teléfono">
                                            </div>
                                        </div>

                              <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Celular</label>
                                            <div class="col-md-12">
                                                <input type="phone"  name="celular" class="form-control" placeholder="Ingrese celular">
                                            </div>
                                        </div>          
                              </div>

                              <div class="container-fluid">
                              <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Fax</label>
                                            <div class="col-md-12">
                                                <input type="phone" name="fax" class="form-control" placeholder="Ingrese fax">
                                            </div>
                                        </div>

                              <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Dirección</label>
                                            <div class="col-md-12">
                                                <input type="text"  name="address" class="form-control" placeholder="Ingrese dirección">
                                            </div>
                                        </div>

                             </div>
                              <div class="container-fluid">

                                 <div class="form-group col-md-6">
                                             <label class="col-md-12" for="example-text-input">Inmueble</label>
                                            <div class="col-md-12">
                                               <select name="inmueble" class="form-control" size="1">
                                                    <option selected disabled>Seleccionar tipo de inmueble</option>
                                                    <option value="1">Apartamento</option>
                                                    <option value="2">Casa</option>
                                                    <option value="3">Oficina</option>
                                                </select>
                                            </div>
                                        </div>

                              <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Número inmueble</label>
                                            <div class="col-md-12">
                                                <input type="text" name="numero" class="form-control" placeholder="Ingrese datos inmueble número oficina, apartamento o casa, torreo o blouqe">
                                            </div>
                                        </div>
                              </div>

                             <div class="container-fluid">
                              <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Pais</label>
                                            <div class="col-md-12">
                                               <select id="pais" name="pais" class="form-control" size="1">
                                              <option value="" disabled selected>Seleccione región</option>
                                             @foreach($categories as $category)
                                              <option value="{{$category->id}}">{{$category->pais}}</option>
                                             @endforeach
                                                </select>
                                            </div>
                                        </div>
                                      
                                        <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Ciudad</label>
                                            <div class="col-md-12">
                                               <select name="ciudad" id="ciudad" class="form-control" size="1">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>
                                </div>   

                                <div class="container-fluid">

                                        <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Municipio</label>
                                            <div class="col-md-12">
                                               <select name="municipio" id="municipio" class="form-control" size="1">
                                                    <option></option>
                                                </select>
                                            </div>
                                        </div>

                                  
                             

                              <div class="form-group col-md-6">
                                            <label class="col-md-12" for="example-text-input">Código zip</label>
                                            <div class="col-md-12">
                                                <input type="text"  name="codigo" class="form-control" placeholder="Ingrese codigo zip">
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


<script type="text/javascript">
     
      $('#pais').on('change',function(e){
        console.log(e);

        var cat_id = e.target.value;

        $.get('/memo/ajax-subcatweb?cat_id=' + cat_id, function(data){
            $('#ciudad').empty();
            $.each(data, function(index, subcatObj){
              $('#ciudad').append('<option value="" style="display:none">Seleccione Ciudad</option>','<option value="'+subcatObj.id+'">'+subcatObj.departamento+'</option>' );

            });
        });
      });
   </script>  


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







 <!-- Include all compiled plugins (below), or include individual files as needed -->

  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
 {{ Html::script('Usuario/js/registro.js') }}
  {{ Html::script('//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js') }} 




@stop


