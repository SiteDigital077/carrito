

 @extends ('LayoutsSD.Layout')


    @section('ContenidoSite-01')

<style type="text/css">
.secondary-title{
  background: #f1f1f1;
  font-size: 15px;
  margin-top: 0px
}
.secondary-title i{
padding: 10px;
font-size: 15px;
color:#fff;
}
.trans{
  width: 100%;
  background-color: #f1f1f1;
  display: flex;
  justify-content: center;
  padding: 0px
}
.transer{
  width: 100%;
  background-color: #f1f1f1;
  display: flex;
  justify-content: center;
  padding: 10px;
  margin-bottom: 20px;
}
.trans i { font-size: 10px; font-weight: 700}
.shop{border:1px solid #f1f1f1; padding: 0px; margin-top:25px; margin-bottom: 30px}
.botoner{padding-bottom: 15px;}
.selector{background: #eee; border: 1px solid #f1f1f1; color: #000; font-size: 12px; margin-top: 12px}
.botnext{margin: 20px}

.btnpago{border: 2px solid #5cb85c; border-radius: 8px; color:#5cb85c; text-transform: uppercase; font-weight: 700 }
.botn{margin: 15px}
.h4{padding: 4px;margin: 5px; font-size: 12px; border-radius: 4px; color:#fff}
</style>



@foreach($resultadoweb as $resultadoweb)

@endforeach
<div class="container">
	


  <div class="col-xs-4 col-sm-4 col-md-4 col-lg-8 col-lg-offset-2">
   <div class="container-fluid shop">
    <h2 class="secondary-title"><i class="fa fa-list bg-primary"></i> Información de la transacción</h2>

      <table class="table table-borderless table-striped table-vcenter">
       <tbody>
        <tr>
         <td class="text-right" style="width: 50%;"><strong>Estado de la transacción</strong></td>
          @if($resultadoweb->estado == "Aceptada" OR $resultadoweb->estado == "APPROVED")
         <td><span class="h4 text-success animation-expandOpen" style="background:green"> Aceptada</span></td>
         @elseif($resultadoweb->estado == "Pendiente" OR $resultadoweb->estado == "PENDING")
         <td><span class="h4 text-warning animation-expandOpen" style="background:#ff8000"> Pendiente</span></td>
         @elseif($resultadoweb->estado == "Rechazada" OR $resultadoweb->estado == "REJECTED")
         <td><span class="h4 text-danger animation-expandOpen" style="background:red"> Rechazada</span></td>
         @endif
      
        </tr>
        
        <tr>
         <td class="text-right"><strong>ID de la transacción</strong></td>
         <td>{{$resultadoweb->referencia}}</td>
        </tr>
        
        <tr>
         <td class="text-right"><strong>Fecha y hora de la transacción</strong></td>
         <td>{{$resultadoweb->fecha}}</td>
        </tr>

        <tr>
         <td class="text-right"><strong>Número de autorización</strong></td>
         <td>{{$resultadoweb->codigo}}</td>
        </tr>
        
        <tr>
         <td class="text-right"><strong>Total</strong></td>
         <td>$ {{number_format($resultadoweb->shipping+$resultadoweb->cos_envio,0,",",".")}}</td>
        </tr>
        <tr>
         <td class="text-right"><strong>Registro actividad</strong></td>
         <td><span class="label label-primary">Ir al registro</span></td>
        </tr>
                                            
       </tbody>
      </table>
  </div>
</div>
</div>




</div>







@stop


