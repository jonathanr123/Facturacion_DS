{!! Form::open(array('url'=>'buscarfactura/factura','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<div class="input-group">
		<input type="numb" class="form-control" name="searchNumb" placeholder="N° Factura" value="{{$searchNumb}}">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>

{{Form::close()}} 