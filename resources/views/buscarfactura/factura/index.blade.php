@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Listado de Facturas </h3>
		@include('buscarfactura.factura.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th> Número</th>
					<th>Fecha de Emision</th>
					<th>Total</th>
					
					<th>Opciones</th>
				</thead>
               @foreach ($factura as $cat)
				<tr>
					<td>{{ $cat->ID}}</td>
				    <td>{{ $cat->fechaEmision}}
					</td>
					<td>{{ $cat->total}}
					</td>
                  
					</td>

		
					<td>
						<a href="{{URL::action('facturaController@show',$cat->ID)}}"><button class="btn btn-primary">Detalle</button></a>
                         
					</td>
				</tr>
				
				@endforeach
			</table>
		</div>
		{{$factura->render()}}
	</div>
</div>

@endsection