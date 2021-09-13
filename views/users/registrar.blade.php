@extends ('LayoutsSD.Layout')


        <link rel="stylesheet" href="//cdn.jsdelivr.net/bootstrap/3.2.0/css/bootstrap.min.css"/>

    <!-- Include FontAwesome CSS if you want to use feedback icons provided by FontAwesome -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/fontawesome/4.1.0/css/font-awesome.min.css" />

    <!-- BootstrapValidator CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.0/css/bootstrapValidator.min.css"/>

    <!-- jQuery and Bootstrap JS -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- BootstrapValidator JS -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.0/js/bootstrapValidator.min.js"></script>

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
  <div class="panel">
   <div class="panel-heading bg-primary">Acceso usuarios</div>
    <div class="panel-body">
     
     <form class="form-horizontal" id="registrationForm" role="form" method="POST" action="{{ url('/gestion/usuarios/crear') }}">
                     
      <div class="container-fluid">
       <div class="row">
                    
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
        
        <input type="hidden" id="example-text-input" name="level" class="form-control" value="2">

        <div class="form-group col-md-6">
         <label class="checkbox-inline"></label>
          <div class="col-md-12">
            <input type="checkbox" id="cbox2" value="second_checkbox"> <label for="cbox2">Aceptar terminos y condiciones  <a data-toggle="modal" href='#modal-id'>Ver terminos</a></label> 
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

        <div class="form-group col-sm-12">
         <div class="col-md-12">
          <div class="container-fluid">
           <button type="submit" class="site-button btn-lg pull-right">
            <i class="fa fa-btn fa-sign-in"></i> Registrar Usuario
           </button>
          </div>
         </div>
        </div>
        </div>
        </div>

      </form>
                </div>
                 

      </div>
        </div>
   
 
</div>





<script>
$(document).ready(function() {
    $('#registrationForm').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            name: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9]+$/,
                        message: 'The username can only consist of alphabetical and number'
                    },
                    different: {
                        field: 'password',
                        message: 'The username and password cannot be the same as each other'
                    }
                }
            },
             last_name: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    },
                    stringLength: {
                        min: 6,
                        max: 30,
                        message: 'The username must be more than 6 and less than 30 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9]+$/,
                        message: 'The username can only consist of alphabetical and number'
                    },
                    different: {
                        field: 'password',
                        message: 'The username and password cannot be the same as each other'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Debe registrar un email'
                    },
                    emailAddress: {
                        message: 'El email registrado no es valido'
                    },

                    remote: {
                        type: 'GET',
                        url: '/validacion/email',
                        message: 'Este email ya se encuentra registrado',
                        delay: 10
                    }
                }
            },

           password: {
                validators: {
                    notEmpty: {
                        message: 'La contraseña es requerido'
                    },
                    stringLength: {
                        min: 8,
                        max: 330,
                        message: 'La contraseña debe contener un minimo de 8 Caracteres'
                    },
                    identical: {
                        field: 'confirmPassword',
                        message: 'Las Contraseñas no Coinciden'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'La Confirmación de la contraseña es Requerida'
                    },
                    identical: {
                        field: 'password',
                        message: 'La contraseña no coincide'
                    }
                }
            },
            birthday: {
                validators: {
                    notEmpty: {
                        message: 'The date of birth is required'
                    },
                    date: {
                        format: 'YYYY/MM/DD',
                        message: 'The date of birth is not valid'
                    }
                }
            },
            gender: {
                validators: {
                    notEmpty: {
                        message: 'The gender is required'
                    }
                }
            }
        }
    });
});
</script>

@stop