<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/menuprincipal/menu', function () {
    return view('/menuprincipal/menu/index');
});



Route::resource('cargarPago/pago','PagoController');

Route::get('/cargarPago/pago/create/{id}/matriculas','PagoController@byCategory');

Route::get('/cargarPago/pago/create/{id}/detalles','PagoController@byServicioDetalle');

Route::get('/cargarPago/pago/create/{id}/objeto','PagoController@byObjeto');

Route::get('/cargarPago/pago/create/{id},{sos}/conceptoss','PagoController@byConcepto');

Route::get('/cargarPago/pago/create/{nomb},{apell},{dnidoc},{totalx}/facturas','PagoController@byFactura');

Route::get('/cargarPago/pago/create/{idfact},{idconcep},{ratons}/factdetalles','PagoController@byfactDetalle');

Route::get('/cargarPago/pago/create/{idserv}/cambiarmonto','PagoController@byServ');


//prueba de buscar Factura
Route::resource('buscarfactura/factura','facturaController');
Route::resource('buscarfactura/cuota','cuotaController');
Route::resource('buscarfactura/concepto','conceptoController');

