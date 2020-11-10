@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Bancos</h3>
			
		</div>
	</div>

	{!!Form::open(array('url'=>'cargarPago/banco','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
    {{Form::token()}}

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<label>Bancos</label>
				<select name="ID" class="form-control">
					@foreach ($bancos as $ban)
					<option value="{{$ban->ID}}">{{$ban->nombre}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>
{!!Form::close()!!}

@endsection