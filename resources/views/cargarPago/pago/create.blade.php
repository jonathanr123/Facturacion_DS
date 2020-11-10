@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Pago</h3>
			
		</div>
	</div>

	{!!Form::open(array('url'=>'menuprincipal/menu','method'=>'GET','autocomplete'=>'off','files'=>'true'))!!}
    {{Form::token()}}

	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label>Legajo</label>
				<select name="legajos" id="legajos" class="form-control selectpicker" data-live-search="true">
					<option value="">Buscar...</option>
				@foreach ($matriculas as $mat)
					<option value="{{$mat->ID}}">{{$mat->numero}}-{{$mat->nombre}} {{$mat->apellido}}</option>
				@endforeach
				</select>
			</div>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label>Fecha de Pago</label>
				<input  type="date" id="fechaPago" style="width: 100%; height:30px">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<div class="form-group">
				<label>Nombre</label>
				<output style="border: 1px solid black; color: black" id="nombre_pers" value="" class="form-control"></output>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<div class="form-group">
				<label>Apellido</label>
				<output style="border: 1px solid black; color: black" id="apellido_pers" value="" class="form-control"></output>
				
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
			<div class="form-group">
				<label>DNI</label>
				<output style="border: 1px solid black; color: black" id="dni_pers" value="" class="form-control"></output>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
							<th>Concepto</th>
							<th>Descripción</th>
							<th>Fecha de Realizacion</th>
							<th>Precio</th>
							<th>Funcion</th>
					</thead>
					<tbody id="tablatura">
						
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" style="float: right">
			<div class="form-group">
				<label>Total ($)</label>
				<output id="total"  class="form-control">Salida Total</output>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<label>Forma de Pago</label>
				<select name=""  class="form-control">
					<option value="Efectivo" selected>Efectivo</option>
					<option value="Deposito">Deposito</option>
					<option value="PagoMisCuentas">Pago Mis Cuentas</option>
				</select>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<p>
				<label>CBU/Tarjeta</label>
				<input style="width: 100%; height:30px" name="tarjeta" id="tarjeta" placeholder="Escribir..." type="text">
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			<div class="form-group">
				<label>Banco</label>
				<select name="tipoBanco" id="tipoBanco" class="form-control">
					<option value="" selected>Elegir...</option>
					@foreach ($bancos as $ban)
					<option value="{{$ban->ID}}">{{$ban->nombre}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" style="float: right">
			<div class="form-group">
				<input type="submit" id="guardars" name="guardars" value="Guardar">
				<input type="submit" name="" value="Cancelar">
			</div>
		</div>
	</div>

	
{!!Form::close()!!}

@push ('scripts')
<script>
	 $(document).ready(function(){
    $("#legajos").change(function(){
      var legajoss = $(this).val();
      $.get('/cargarPago/pago/create/'+legajoss+'/matriculas', function(data){
//esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
        
            for (var i=0; i<data.length;i++)
          document.getElementById('nombre_pers').value=data[0].nombre;
          document.getElementById('apellido_pers').value=data[0].apellido;
          document.getElementById('dni_pers').value=data[0].dni;
      });
    });
  });

</script>
<script>
	var ids = new Array(); 
	var facturaID='';
	var conceptoID='';
	
	 $(document).ready(function(){
    $("#legajos").change(function(){
      var legajoss = $(this).val();
      $.get('/cargarPago/pago/create/'+legajoss+'/detalles', function(data){
//esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
        
			console.log(data)
		var contar='0';
		var filas = '<tr>';
			//estas variables no estaban
				var pepe1 = '0';
				var pepe2 = '0';
				var pepe3 = '0';
				var pepe4 = '0';
				var pepe5 = '0';
				var pepe6 = '0';
				var pepe7 = '0';

            for (var i=0; i<data.length;i++)
                {
            	filas+='<td>'+data[i].nombre+'</td>'+'<td>'+data[i].descripcion+'</td>'+'<td> '+data[i].fechaAlta+' </td>'+'<td>$'+data[i].costo+'</td>'+'<td><input type="checkbox" id="check'+data[i].ID+'" name="'+data[i].detID+'" value='+data[i].costo+'>Pagar</td></tr>'
            	};

            document.getElementById('tablatura').innerHTML=filas;

            //es la parte de guille
				$(document).ready(function()
	    		{

					$("#check1").change(function()
					{
						pepe1 = $('input:checkbox[ID=check1]').val()
		            	if ($('#check1').is(':checked'))
						{
							id1 = $('input:checkbox[ID=check1]').attr("name")
							console.log(id1);
		 					contar = parseInt(contar) + parseInt(pepe1);
		 					$.get('/cargarPago/pago/create/'+id1+'/objeto', function(dat1)
					      	{ 
					      		console.log(dat1);
					      		var data1=dat1;
					      		ids.push(data1);
					      	});
						}
						else
						{
							id1 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe1)
						};
						
						document.getElementById('total').value=contar;
					});

					$("#check2").change(function()
					{
						pepe2 = $('input:checkbox[ID=check2]').val()
		            	if ($('#check2').is(':checked'))
						{
							id2 = $('input:checkbox[ID=check2]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe2);	

					      	$.get('/cargarPago/pago/create/'+id2+'/objeto', function(dat2)
					      	{ 
					      		console.log(dat2);
					      		var data2=dat2;
					      		ids.push(data2);
					      		console.log(ids);
					      	});
						}
						else
						{
							id2 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe2)
						};

						document.getElementById('total').value=contar;
					});

					$("#check3").change(function()
					{
						pepe3 = $('input:checkbox[ID=check3]').val()
		            	if ($('#check3').is(':checked'))
						{
							id3 = $('input:checkbox[ID=check3]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe3)

		 					$.get('/cargarPago/pago/create/'+id3+'/objeto', function(dat3)
						    {
						      	console.log(dat3);
						      	var data3=dat3;
						      	ids.push(data3);
						    });
						}
						else
						{
							id3 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe3)
						};
						
						document.getElementById('total').value=contar;
					});

					$("#check4").change(function()
					{
						pepe4 = $('input:checkbox[ID=check4]').val()
		            	if ($('#check4').is(':checked'))
						{
							id4 = $('input:checkbox[ID=check4]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe4);
		 					$.get('/cargarPago/pago/create/'+id4+'/objeto', function(dat4)
					      	{ 
					      		console.log(dat4);
					      		var data4=dat4;
					      		ids.push(data4);
					      	});
						}
						else
						{
							id4 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe4)
						};
						
						document.getElementById('total').value=contar;
					});

					$("#check5").change(function()
					{
						pepe5 = $('input:checkbox[ID=check5]').val()
		            	if ($('#check5').is(':checked'))
						{
							id5 = $('input:checkbox[ID=check5]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe5);
		 					$.get('/cargarPago/pago/create/'+id5+'/objeto', function(dat5)
					      	{ 
					      		console.log(dat5);
					      		var data5=dat5;
					      		ids.push(data5);
					      	});
						}
						else
						{
							id5 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe5)
						};
						
						document.getElementById('total').value=contar;
					});

					$("#check6").change(function()
					{
						pepe6 = $('input:checkbox[ID=check6]').val()
		            	if ($('#check6').is(':checked'))
						{
							id6 = $('input:checkbox[ID=check6]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe6);
		 					$.get('/cargarPago/pago/create/'+id6+'/objeto', function(dat6)
					      	{ 
					      		console.log(dat6);
					      		var data6=dat6;
					      		ids.push(data6);
					      	});
						}
						else
						{
							id6 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe6)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check7").change(function()
					{
						pepe7 = $('input:checkbox[ID=check7]').val()
		            	if ($('#check7').is(':checked'))
						{
							id7 = $('input:checkbox[ID=check7]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe7);
		 					$.get('/cargarPago/pago/create/'+id7+'/objeto', function(dat7)
					      	{ 
					      		console.log(dat7);
					      		var data7=dat7;
					      		ids.push(data7);
					      	});
						}
						else
						{
							id7 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe7)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check8").change(function()
					{
						pepe8 = $('input:checkbox[ID=check8]').val()
		            	if ($('#check8').is(':checked'))
						{
							id8 = $('input:checkbox[ID=check8]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe8);
		 					$.get('/cargarPago/pago/create/'+id8+'/objeto', function(dat8)
					      	{ 
					      		console.log(dat8);
					      		var data8=dat8;
					      		ids.push(data8);
					      	});
						}
						else
						{
							id8 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe8)
						};
						
						document.getElementById('total').value=contar;
					});

					$("#check9").change(function()
					{
						pepe9 = $('input:checkbox[ID=check9]').val()
		            	if ($('#check9').is(':checked'))
						{
							id9 = $('input:checkbox[ID=check9]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe9);
		 					$.get('/cargarPago/pago/create/'+id9+'/objeto', function(dat9)
					      	{ 
					      		console.log(dat9);
					      		var data9=dat9;
					      		ids.push(data9);
					      	});
						}
						else
						{
							id9 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe9)
						};
						
						document.getElementById('total').value=contar;
					});


					$("#check10").change(function()
					{
						pepe10 = $('input:checkbox[ID=check10]').val()
		            	if ($('#check10').is(':checked'))
						{
							id10 = $('input:checkbox[ID=check10]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe10);
		 					$.get('/cargarPago/pago/create/'+id10+'/objeto', function(dat10)
					      	{ 
					      		console.log(dat10);
					      		var data10=dat10;
					      		ids.push(data10);
					      	});
						}
						else
						{
							id10 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe10)
						};
						
						document.getElementById('total').value=contar;
					});


					$("#check11").change(function()
					{
						pepe11 = $('input:checkbox[ID=check11]').val()
		            	if ($('#check11').is(':checked'))
						{
							id11 = $('input:checkbox[ID=check11]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe11);
		 					$.get('/cargarPago/pago/create/'+id11+'/objeto', function(dat11)
					      	{ 
					      		console.log(dat11);
					      		var data11=dat11;
					      		ids.push(data11);
					      	});
						}
						else
						{
							id11 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe11)
						};
						
						document.getElementById('total').value=contar;
					});


					$("#check12").change(function()
					{
						pepe12 = $('input:checkbox[ID=check12]').val()
		            	if ($('#check12').is(':checked'))
						{
							id12 = $('input:checkbox[ID=check12]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe12);
		 					$.get('/cargarPago/pago/create/'+id12+'/objeto', function(dat12)
					      	{ 
					      		console.log(dat12);
					      		var data12=dat12;
					      		ids.push(data12);
					      	});
						}
						else
						{
							id12 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe12)
						};
						
						document.getElementById('total').value=contar;
					});


					$("#check13").change(function()
					{
						pepe13 = $('input:checkbox[ID=check13]').val()
		            	if ($('#check13').is(':checked'))
						{
							id13 = $('input:checkbox[ID=check13]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe13);
		 					$.get('/cargarPago/pago/create/'+id13+'/objeto', function(dat13)
					      	{ 
					      		console.log(dat13);
					      		var data13=dat13;
					      		ids.push(data13);
					      	});
						}
						else
						{
							id13 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe13)
						};
						
						document.getElementById('total').value=contar;
					});


					$("#check14").change(function()
					{
						pepe14 = $('input:checkbox[ID=check14]').val()
		            	if ($('#check14').is(':checked'))
						{
							id14 = $('input:checkbox[ID=check14]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe14);
		 					$.get('/cargarPago/pago/create/'+id14+'/objeto', function(dat14)
					      	{ 
					      		console.log(dat14);
					      		var data14=dat14;
					      		ids.push(data14);
					      	});
						}
						else
						{
							id14 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe14)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check15").change(function()
					{
						pepe15 = $('input:checkbox[ID=check15]').val()
		            	if ($('#check15').is(':checked'))
						{
							id15 = $('input:checkbox[ID=check15]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe15);
		 					$.get('/cargarPago/pago/create/'+id15+'/objeto', function(dat15)
					      	{ 
					      		console.log(dat15);
					      		var data15=dat15;
					      		ids.push(data15);
					      	});
						}
						else
						{
							id15 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe15)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check16").change(function()
					{
						pepe16 = $('input:checkbox[ID=check16]').val()
		            	if ($('#check16').is(':checked'))
						{
							id16 = $('input:checkbox[ID=check16]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe16);
		 					$.get('/cargarPago/pago/create/'+id16+'/objeto', function(dat16)
					      	{ 
					      		console.log(dat16);
					      		var data16=dat16;
					      		ids.push(data16);
					      	});
						}
						else
						{
							id16 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe16)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check17").change(function()
					{
						pepe17 = $('input:checkbox[ID=check17]').val()
		            	if ($('#check17').is(':checked'))
						{
							id17 = $('input:checkbox[ID=check17]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe17);
		 					$.get('/cargarPago/pago/create/'+id17+'/objeto', function(dat17)
					      	{ 
					      		console.log(dat17);
					      		var data17=dat17;
					      		ids.push(data17);
					      	});
						}
						else
						{
							id17 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe17)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check18").change(function()
					{
						pepe18 = $('input:checkbox[ID=check18]').val()
		            	if ($('#check18').is(':checked'))
						{
							id18 = $('input:checkbox[ID=check18]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe18);
		 					$.get('/cargarPago/pago/create/'+id18+'/objeto', function(dat18)
					      	{ 
					      		console.log(dat18);
					      		var data18=dat18;
					      		ids.push(data18);
					      	});
						}
						else
						{
							id18 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe18)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check19").change(function()
					{
						pepe19 = $('input:checkbox[ID=check19]').val()
		            	if ($('#check19').is(':checked'))
						{
							id19 = $('input:checkbox[ID=check19]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe19);
		 					$.get('/cargarPago/pago/create/'+id19+'/objeto', function(dat19)
					      	{ 
					      		console.log(dat19);
					      		var data19=dat19;
					      		ids.push(data19);
					      	});
						}
						else
						{
							id19 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe19)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check20").change(function()
					{
						pepe20 = $('input:checkbox[ID=check20]').val()
		            	if ($('#check20').is(':checked'))
						{
							id20 = $('input:checkbox[ID=check20]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe20);
		 					$.get('/cargarPago/pago/create/'+id20+'/objeto', function(dat20)
					      	{ 
					      		console.log(dat20);
					      		var data20=dat20;
					      		ids.push(data20);
					      	});
						}
						else
						{
							id20 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe20)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check21").change(function()
					{
						pepe21 = $('input:checkbox[ID=check21]').val()
		            	if ($('#check21').is(':checked'))
						{
							id21 = $('input:checkbox[ID=check21]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe21);
		 					$.get('/cargarPago/pago/create/'+id21+'/objeto', function(dat21)
					      	{ 
					      		console.log(dat21);
					      		var data21=dat21;
					      		ids.push(data21);
					      	});
						}
						else
						{
							id21 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe21)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check22").change(function()
					{
						pepe22 = $('input:checkbox[ID=check22]').val()
		            	if ($('#check22').is(':checked'))
						{
							id22 = $('input:checkbox[ID=check22]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe22);
		 					$.get('/cargarPago/pago/create/'+id22+'/objeto', function(dat22)
					      	{ 
					      		console.log(dat22);
					      		var data22=dat22;
					      		ids.push(data22);
					      	});
						}
						else
						{
							id22 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe22)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check23").change(function()
					{
						pepe23 = $('input:checkbox[ID=check23]').val()
		            	if ($('#check23').is(':checked'))
						{
							id23 = $('input:checkbox[ID=check23]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe23);
		 					$.get('/cargarPago/pago/create/'+id23+'/objeto', function(dat23)
					      	{ 
					      		console.log(dat23);
					      		var data23=dat23;
					      		ids.push(data23);
					      	});
						}
						else
						{
							id23 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe23)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check24").change(function()
					{
						pepe24 = $('input:checkbox[ID=check24]').val()
		            	if ($('#check24').is(':checked'))
						{
							id24 = $('input:checkbox[ID=check24]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe24);
		 					$.get('/cargarPago/pago/create/'+id24+'/objeto', function(dat24)
					      	{ 
					      		console.log(dat24);
					      		var data24=dat24;
					      		ids.push(data24);
					      	});
						}
						else
						{
							id24 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe24)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check25").change(function()
					{
						pepe25 = $('input:checkbox[ID=check25]').val()
		            	if ($('#check25').is(':checked'))
						{
							id25 = $('input:checkbox[ID=check25]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe25);
		 					$.get('/cargarPago/pago/create/'+id25+'/objeto', function(dat25)
					      	{ 
					      		console.log(dat25);
					      		var data25=dat25;
					      		ids.push(data25);
					      	});
						}
						else
						{
							id25 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe25)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check26").change(function()
					{
						pepe26 = $('input:checkbox[ID=check26]').val()
		            	if ($('#check26').is(':checked'))
						{
							id26 = $('input:checkbox[ID=check26]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe26);
		 					$.get('/cargarPago/pago/create/'+id26+'/objeto', function(dat26)
					      	{ 
					      		console.log(dat26);
					      		var data26=dat26;
					      		ids.push(data26);
					      	});
						}
						else
						{
							id26 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe26)
						};
						
						document.getElementById('total').value=contar;
					});

					$("#check27").change(function()
					{
						pepe27 = $('input:checkbox[ID=check27]').val()
		            	if ($('#check27').is(':checked'))
						{
							id27 = $('input:checkbox[ID=check27]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe27);
		 					$.get('/cargarPago/pago/create/'+id27+'/objeto', function(dat27)
					      	{ 
					      		console.log(dat27);
					      		var data27=dat27;
					      		ids.push(data27);
					      	});
						}
						else
						{
							id27 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe27)
						};
						
						document.getElementById('total').value=contar;
					});

					$("#check28").change(function()
					{
						pepe28 = $('input:checkbox[ID=check28]').val()
		            	if ($('#check28').is(':checked'))
						{
							id28 = $('input:checkbox[ID=check28]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe28);
		 					$.get('/cargarPago/pago/create/'+id28+'/objeto', function(dat28)
					      	{ 
					      		console.log(dat28);
					      		var data28=dat28;
					      		ids.push(data28);
					      	});
						}
						else
						{
							id28 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe28)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check29").change(function()
					{
						pepe29 = $('input:checkbox[ID=check29]').val()
		            	if ($('#check29').is(':checked'))
						{
							id29 = $('input:checkbox[ID=check29]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe29);
		 					$.get('/cargarPago/pago/create/'+id29+'/objeto', function(dat29)
					      	{ 
					      		console.log(dat29);
					      		var data29=dat29;
					      		ids.push(data29);
					      	});
						}
						else
						{
							id29 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe29)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check30").change(function()
					{
						pepe30 = $('input:checkbox[ID=check30]').val()
		            	if ($('#check30').is(':checked'))
						{
							id30 = $('input:checkbox[ID=check30]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe30);
		 					$.get('/cargarPago/pago/create/'+id30+'/objeto', function(dat30)
					      	{ 
					      		console.log(dat30);
					      		var data30=dat30;
					      		ids.push(data30);
					      	});
						}
						else
						{
							id30 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe30)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check31").change(function()
					{
						pepe31 = $('input:checkbox[ID=check31]').val()
		            	if ($('#check31').is(':checked'))
						{
							id31 = $('input:checkbox[ID=check31]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe31);
		 					$.get('/cargarPago/pago/create/'+id31+'/objeto', function(dat31)
					      	{ 
					      		console.log(dat31);
					      		var data31=dat31;
					      		ids.push(data31);
					      	});
						}
						else
						{
							id31 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe31)
						};
						
						document.getElementById('total').value=contar;
					});


					$("#check32").change(function()
					{
						pepe32 = $('input:checkbox[ID=check32]').val()
		            	if ($('#check32').is(':checked'))
						{
							id32 = $('input:checkbox[ID=check32]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe32);
		 					$.get('/cargarPago/pago/create/'+id32+'/objeto', function(dat32)
					      	{ 
					      		console.log(dat32);
					      		var data32=dat32;
					      		ids.push(data32);
					      	});
						}
						else
						{
							id32 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe32)
						};
						
						document.getElementById('total').value=contar;
					});

					$("#check33").change(function()
					{
						pepe33 = $('input:checkbox[ID=check33]').val()
		            	if ($('#check33').is(':checked'))
						{
							id33 = $('input:checkbox[ID=check33]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe33);
		 					$.get('/cargarPago/pago/create/'+id33+'/objeto', function(dat33)
					      	{ 
					      		console.log(dat33);
					      		var data33=dat33;
					      		ids.push(data33);
					      	});
						}
						else
						{
							id33 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe33)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check34").change(function()
					{
						pepe34 = $('input:checkbox[ID=check34]').val()
		            	if ($('#check34').is(':checked'))
						{
							id34 = $('input:checkbox[ID=check34]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe34);
		 					$.get('/cargarPago/pago/create/'+id34+'/objeto', function(dat34)
					      	{ 
					      		console.log(dat34);
					      		var data34=dat34;
					      		ids.push(data34);
					      	});
						}
						else
						{
							id34 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe34)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check35").change(function()
					{
						pepe35 = $('input:checkbox[ID=check35]').val()
		            	if ($('#check35').is(':checked'))
						{
							id35 = $('input:checkbox[ID=check35]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe35);
		 					$.get('/cargarPago/pago/create/'+id35+'/objeto', function(dat35)
					      	{ 
					      		console.log(dat35);
					      		var data35=dat35;
					      		ids.push(data35);
					      	});
						}
						else
						{
							id35 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe35)
						};
						
						document.getElementById('total').value=contar;
					});

					$("#check36").change(function()
					{
						pepe36 = $('input:checkbox[ID=check36]').val()
		            	if ($('#check36').is(':checked'))
						{
							id36 = $('input:checkbox[ID=check36]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe36);
		 					$.get('/cargarPago/pago/create/'+id36+'/objeto', function(dat36)
					      	{ 
					      		console.log(dat36);
					      		var data36=dat36;
					      		ids.push(data36);
					      	});
						}
						else
						{
							id36 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe36)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check37").change(function()
					{
						pepe37 = $('input:checkbox[ID=check37]').val()
		            	if ($('#check37').is(':checked'))
						{
							id37 = $('input:checkbox[ID=check37]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe37);
		 					$.get('/cargarPago/pago/create/'+id37+'/objeto', function(dat37)
					      	{ 
					      		console.log(dat37);
					      		var data37=dat37;
					      		ids.push(data37);
					      	});
						}
						else
						{
							id37 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe37)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check38").change(function()
					{
						pepe38 = $('input:checkbox[ID=check38]').val()
		            	if ($('#check38').is(':checked'))
						{
							id38 = $('input:checkbox[ID=check38]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe38);
		 					$.get('/cargarPago/pago/create/'+id38+'/objeto', function(dat38)
					      	{ 
					      		console.log(dat38);
					      		var data38=dat38;
					      		ids.push(data38);
					      	});
						}
						else
						{
							id38 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe38)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check39").change(function()
					{
						pepe39 = $('input:checkbox[ID=check39]').val()
		            	if ($('#check39').is(':checked'))
						{
							id39 = $('input:checkbox[ID=check39]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe39);
		 					$.get('/cargarPago/pago/create/'+id39+'/objeto', function(dat39)
					      	{ 
					      		console.log(dat39);
					      		var data39=dat39;
					      		ids.push(data39);
					      	});
						}
						else
						{
							id39 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe39)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check40").change(function()
					{
						pepe40 = $('input:checkbox[ID=check40]').val()
		            	if ($('#check40').is(':checked'))
						{
							id40 = $('input:checkbox[ID=check40]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe40);
		 					$.get('/cargarPago/pago/create/'+id40+'/objeto', function(dat40)
					      	{ 
					      		console.log(dat40);
					      		var data40=dat40;
					      		ids.push(data40);
					      	});
						}
						else
						{
							id40 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe40)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check41").change(function()
					{
						pepe41 = $('input:checkbox[ID=check41]').val()
		            	if ($('#check41').is(':checked'))
						{
							id41 = $('input:checkbox[ID=check41]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe41);
		 					$.get('/cargarPago/pago/create/'+id41+'/objeto', function(dat41)
					      	{ 
					      		console.log(dat41);
					      		var data41=dat41;
					      		ids.push(data41);
					      	});
						}
						else
						{
							id41 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe41)
						};
						
						document.getElementById('total').value=contar;
					});

					$("#check42").change(function()
					{
						pepe42 = $('input:checkbox[ID=check42]').val()
		            	if ($('#check42').is(':checked'))
						{
							id42 = $('input:checkbox[ID=check42]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe42);
		 					$.get('/cargarPago/pago/create/'+id42+'/objeto', function(dat42)
					      	{ 
					      		console.log(dat42);
					      		var data42=dat42;
					      		ids.push(data42);
					      	});
						}
						else
						{
							id42 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe42)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check43").change(function()
					{
						pepe43 = $('input:checkbox[ID=check43]').val()
		            	if ($('#check43').is(':checked'))
						{
							id43 = $('input:checkbox[ID=check43]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe43);
		 					$.get('/cargarPago/pago/create/'+id43+'/objeto', function(dat43)
					      	{ 
					      		console.log(dat43);
					      		var data43=dat43;
					      		ids.push(data43);
					      	});
						}
						else
						{
							id43 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe43)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check44").change(function()
					{
						pepe44 = $('input:checkbox[ID=check44]').val()
		            	if ($('#check44').is(':checked'))
						{
							id44 = $('input:checkbox[ID=check44]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe44);
		 					$.get('/cargarPago/pago/create/'+id44+'/objeto', function(dat44)
					      	{ 
					      		console.log(dat44);
					      		var data44=dat44;
					      		ids.push(data44);
					      	});
						}
						else
						{
							id44 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe44)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check45").change(function()
					{
						pepe45 = $('input:checkbox[ID=check45]').val()
		            	if ($('#check45').is(':checked'))
						{
							id45 = $('input:checkbox[ID=check45]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe45);
		 					$.get('/cargarPago/pago/create/'+id45+'/objeto', function(dat45)
					      	{ 
					      		console.log(dat45);
					      		var data45=dat45;
					      		ids.push(data45);
					      	});
						}
						else
						{
							id45 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe45)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check46").change(function()
					{
						pepe46 = $('input:checkbox[ID=check46]').val()
		            	if ($('#check46').is(':checked'))
						{
							id46 = $('input:checkbox[ID=check46]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe46);
		 					$.get('/cargarPago/pago/create/'+id46+'/objeto', function(dat46)
					      	{ 
					      		console.log(dat46);
					      		var data46=dat46;
					      		ids.push(data46);
					      	});
						}
						else
						{
							id46 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe46)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check47").change(function()
					{
						pepe47 = $('input:checkbox[ID=check47]').val()
		            	if ($('#check47').is(':checked'))
						{
							id47 = $('input:checkbox[ID=check47]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe47);
		 					$.get('/cargarPago/pago/create/'+id47+'/objeto', function(dat47)
					      	{ 
					      		console.log(dat47);
					      		var data47=dat47;
					      		ids.push(data47);
					      	});
						}
						else
						{
							id47 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe47)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check48").change(function()
					{
						pepe48 = $('input:checkbox[ID=check48]').val()
		            	if ($('#check48').is(':checked'))
						{
							id48 = $('input:checkbox[ID=check48]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe48);
		 					$.get('/cargarPago/pago/create/'+id48+'/objeto', function(dat48)
					      	{ 
					      		console.log(dat48);
					      		var data48=dat48;
					      		ids.push(data48);
					      	});
						}
						else
						{
							id48 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe48)
						};
						
						document.getElementById('total').value=contar;
					});
					$("#check49").change(function()
					{
						pepe49 = $('input:checkbox[ID=check49]').val()
		            	if ($('#check49').is(':checked'))
						{
							id49 = $('input:checkbox[ID=check49]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe49);
		 					$.get('/cargarPago/pago/create/'+id49+'/objeto', function(dat49)
					      	{ 
					      		console.log(dat49);
					      		var data49=dat49;
					      		ids.push(data49);
					      	});
						}
						else
						{
							id49 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe49)
						};
						
						document.getElementById('total').value=contar;
					});

					$("#check50").change(function()
					{
						pepe50 = $('input:checkbox[ID=check50]').val()
		            	if ($('#check50').is(':checked'))
						{
							id50 = $('input:checkbox[ID=check50]').attr("name")
		 					contar = parseInt(contar) + parseInt(pepe50);
		 					$.get('/cargarPago/pago/create/'+id50+'/objeto', function(dat50)
					      	{ 
					      		console.log(dat50);
					      		var data50=dat50;
					      		ids.push(data50);
					      	});
						}
						else
						{
							id50 = 0
							ids.pop()
							contar = parseInt(contar) - parseInt(pepe50)
						};
						
						document.getElementById('total').value=contar;
					});
				});
			//hasta aca de guille

      });
    });
  });


//funcion separada

$(document).ready(function(){
	 $("#guardars").click(function(){
      console.log(ids);
      //prueba de crear factura
      nomb=document.getElementById('nombre_pers').value;
      apell=document.getElementById('apellido_pers').value;
      dnidoc=document.getElementById('dni_pers').value;
      totalx=document.getElementById('total').value;
      $.get('/cargarPago/pago/create/'+nomb+','+apell+','+dnidoc+','+totalx+'/facturas', function(devuel)
					      	{ 
					      		facturaID=devuel;
					      		console.log(facturaID);
					      	});

  	
  	//fin de crear factura

 for (var i=0; i<ids.length;i++)
                {
                	var idserv = ids[i][0].detID;
                	var perro = ids[i][0].nombre;
                	var gato = ids[i][0].descripcion;
                	var raton = ids[i][0].costo;
                	console.log(perro);
                	console.log(gato);
                	console.log(facturaID);
            		console.log(idserv);
            	$.get('/cargarPago/pago/create/'+idserv+'/cambiarmonto', function(asa)
					      	{  
					      		console.log(idserv);
					      	});
					      	

      $.get('/cargarPago/pago/create/'+perro+','+gato+'/conceptoss', function(devuelta)
				{ 
					conceptoID=devuelta;
					console.log(devuelta);
			$.get('/cargarPago/pago/create/'+facturaID+','+conceptoID+','+raton+'/factdetalles', function(listo)
					      	{  
					      	
					      	});
      		
				});

      
  	};
  	
  alert("El pago se ha cargado correctamente");

});



});



</script>
@endpush

@endsection

