
  @extends ('LayoutsSD.Layout')


@section('ContenidoSite-01')




<div class="container">


    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
    	
    	<div class="row">
  <div class="row">
                            <div class="col-md-12">
                                <!-- Basic Form Elements Block -->
                                <div class="block">
                                    <!-- Basic Form Elements Title -->
                                    <div class="block-title">
                                      
                                        <h4><strong>Informe</strong> Facturación</h4>
                                    </div>
                                    <!-- END Form Elements Title -->
                                    
                                    <!-- Basic Form Elements Content -->
                                 {{ Form::open(array('method' => 'POST','class' => 'form-horizontal','id' => 'defaultForm', 'url' => array('/tienda/virtual'))) }}

                                       
                                        <div class="form-group">
                                            <label class="col-md-12 control-label" for="example-password-input">Desde</label>
                                            <div class="col-md-12">
                       
                                                {{Form::text('min_price', '', array('class' => 'form-control','placeholder'=>'Ingrese página','maxlength' => '50' ))}}
                                                <label class="col-md-12 control-label" for="example-password-input">Desde</label>
                                               	   {{Form::text('max_price', '', array('class' => 'form-control','placeholder'=>'Ingrese página','maxlength' => '50' ))}}
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-md-12 control-label" for="example-text-input">Franja</label>
                                            <div class="col-md-12">
                                             <select class="selectpicker col-xs-12 col-sm-12 col-md-12 col-lg-12 form-control input-small" data-show-subtext="true" data-live-search="true" name="clientes">
                                              <option value="" selected disabled hidden>Seleccione Cliente</option>
                                               
                                              <option value="gh" selected disabled hidden>{{$clientes}}</option>    
                                              <option value="1">Categoria 1</option>
                                              <option value="2">Categoria 2</option>
                                             
                                              </select>
                                            </div>
                                        </div>

                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                        <div class="form-group form-actions">
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-sm btn-primary col-md-12"> Filtrar</button>
                                                <a href="{{Request::url()}}" class="btn btn-sm btn-default col-md-12">Limpiar</a>
                                            </div>
                                        </div>
                                    {{ Form::close() }}
                                
                                </div>
                                <!-- END Basic Form Elements Block -->
                            </div>
                          </div>
                          
</div>



    </div>
    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
    	
<div class="products">
@foreach($products as $product)
<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
<div class="product">
<img src="{{ $product->image }}" class="img-responsive" alt="">
<h3>{{ $product->name}}</h3>
<div class="product-info">
<p>{!!substr($product->description, 0, 200)!!}...</p>


@if($product->precioivafin == $product->precioinivafin)
<p><b>Normal: ${{number_format($product->precioivafin,0)}}</b></p>
@else
<p>Normal: ${{number_format($product->precioivafin,0)}}</p>
<p>Descuento: ${{number_format($product->precioinivafin,0)}}</p>
@endif
<a href="{{ route('cart-add', $product->slug)}}" class="btn btn-primary">La quiero</a>
<a href="{{ route('product-detail', $product->slug)}}" class="btn btn-success">Leer más</a>

</div>
</div>
</div>
@endforeach
</div>
    </div>

</div>



@stop