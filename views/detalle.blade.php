

 @extends ('LayoutsSD.Layout')



    @section('ContenidoSite-01')



<style type="text/css">

.pagination {
    display: inline-block;
    padding-left: 0;
    margin: 20px 0;
    border-radius: 0px;
    float: right;
}
.dataTables_filter{

  float: right;
}

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
.block-title h3{
  color: #fff;
  padding: 12px;
  text-align: center;
}
.table-responsive {
    overflow-x: hidden;
    min-height: 0.01%;
}
</style>





  


<div class="container">
  

<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10 col-lg-offset-1">

 <div class="block full">
                            <div class="block-title bg-primary">
                                <h3>Compras Registradas</h3>
                            </div>

                            <div class="table-responsive">
                                <table id="example-datatable" class="table table-vcenter table-condensed table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Fecha y hora</th>
                                            <th class="text-center">Referencia</th>
                                            <th class="text-center">Autorización/CUS</th>
                                            <th class="text-center">Estado</th>
                                            <th class="text-center">Valor</th>               
                                            <th class="text-center">>Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($ordenes as $ordenes)
                                        <tr>
                                            <td class="text-center">{{$ordenes->fecha}}</td>
                                            <td class="text-center"><strong>{{$ordenes->codigo_apr}}</strong></td>
                                            <td class="text-center">{{$ordenes->codigo}}</td>

                                            @if($ordenes->estado == "Aceptada" OR $ordenes->estado == "APPROVED")
                                            <th> <span class="label label-success">Aceptada</span></th>
                                            @elseif($ordenes->estado == "Pendiente" OR $ordenes->estado == "PENDING")
                                            <th> <span class="label label-warning">Pendiente</span></th>
                                            @elseif($ordenes->estado == "Rechazada" OR $ordenes->estado == "REJECTED")
                                            <th> <span class="label label-danger">Rechazada</span></th>
                                            @endif
                                         
                                            <td><b>$ {{number_format($ordenes->shipping,0,",",".")}}</b></td>
                                            <td class="text-center">
                                            <a href="<?=URL::to('#');?>/"><span  id="tip" data-toggle="tooltip" data-placement="top" title="Editar Contenido" class="btn btn-warning"><i class="fa fa-list-alt sidebar-nav-icon"></i></span></a>
                                            </td>
                                        </tr>
                                      @endforeach                
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END Datatables Content -->


</div>


</div>


    
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="/adminsite/js/pages/tablesDatatables.js"></script>
    <script>$(function(){ TablesDatatables.init(); });</script>






@stop


