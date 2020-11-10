@extends('layouts.admin')
@section('contenido')


<div class="row">


<div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
  	<div class="form-group">
      <label for="factura">N° Factura</label>  	<p>{{$factura->ID}}</p>	
  	</div>
  </div>

  
<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
    <div class="form-group">
      <label for="factura">Fecha</label>   <p>{{$factura->fechaEmision}}</p> 
    </div>
  </div>

 </div>

<div class="row">

<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
    <div class="form-group">
      <label for="factura">Nombre:</label>   <p>{{$factura->nombrePersona}}</p> 
    </div>
  </div>
<div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
    <div class="form-group">
      <label for="factura">Apellido:</label>   <p>{{$factura->apellidoPersona}}</p> 
    </div>
  </div>
 <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
    <div class="form-group">
      <label for="factura">DNI:</label>   <p>{{$factura->dniPersona}}</p> 
    </div>
 </div>
 <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
    <div class="form-group">
    </div>
 </div>

</div>
       



<div class="row">
  	<div class="panel-body">
  		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        	<table id="detalle" class="table table-striped table-bordered table-condensed table-hover">
              <thead>	
              <th>Concepto</th>
             	<th>Descripcion</th>
             	<th>Precio</th>
              </thead>	
              <tfoot>
              	<th>
                  
                  <th>
              	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                	<div class="form-group">
                   <td><label>Total : </label> $ {{$factura->total}}</td>
                	</div>
                 </div>

              </tfoot>
              	@foreach($detalle as $de)
              	<tr>
                   <td>{{$de->nombre}}</td>
              		 <td>{{$de->descripcion}}</td>
                     <td>{{$de->precio}}</td>
                     
              	</tr>

              	@endforeach
             

              </tbody> 
  	        </table>
        </div>  
    </div>

    <div class="row">

      <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
        </div>
      <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
        </div>
       <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
       </div>
       <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
          <a href="/buscarfactura/factura"><button class="btn btn-primary">Volver</button></a>
       </div>

    </div>
    
  </div>
  
@endsection