<?php

namespace sisFactura\Http\Controllers;

use Illuminate\Http\Request;

use sisFactura\Http\Requests;
use sisFactura\Pago;
use Illuminate\Support\Facades\Redirect;
use sisFactura\Http\Requests\PagoFormRequest;
use sisFactura\Concepto;
use sisFactura\FacturaDetalle;
use sisFactura\Factura;
use sisFactura\ServicioMatriculaDetalle;
use Carbon\Carbon;
use DB;


class PagoController extends Controller
{
    public function __construct ()
    {

    }
    public function index(Request $request)
    {
    	if ($request)
    	{
    		$query=trim($request->get('searchText'));
    		$bancos=DB::table('banco')->where('nombre','LIKE','%'.$query.'%')
    		->orderBy('ID','desc')
    		->paginate(7);
            return view('cargarPago.banco.index',["bancos"=>$bancos,"searchText"=>$query]);
    	}
    }
    public function create(Request $request)
    {
    	$matriculas=DB::table('matricula as matr')->join('persona as pers','matr.Persona_ID','=','pers.ID')->get();

    	$mseleccion=$request->input('ID');
    	$matris=DB::table('matricula as matr')->join('persona as pers','matr.Persona_ID','=','pers.ID')->where('matr.ID','=', $mseleccion)->get();

        $bancos=DB::table('banco')->get();
    	return view("cargarPago.pago.create",["bancos"=>$bancos,"matriculas"=>$matriculas,"matris"=> $matris]);
    }
    public function store (Request $request)
    {
        
	}

	public function byCategory($id)
	{
		return DB::table('matricula as matr')->join('persona as pers','matr.Persona_ID','=','pers.ID')->where('matr.ID','=',$id)->get();
	}

	public function byServicioDetalle($id)
	{
		return DB::table('matricula as matr')->join('serviciomatriculadetalle as detalle','matr.ID','=','detalle.Matricula_ID')->join('serviciocomplementario as servicio','detalle.ServicioComplementario_ID','=','servicio.ID')->where('matr.ID','=',$id)->where('detalle.montoPagado','=',0)->select('*','detalle.ID as detID')->get();
	}


    public function byObjeto($id)
    {
        return DB::table('serviciomatriculadetalle as detalle')->join('serviciocomplementario as servicio','detalle.ServicioComplementario_ID','=','servicio.ID')->where('detalle.ID','=',$id)->select('*','detalle.ID as detID')->get();
    }

    public function byFactura($nomb, $apell, $dnidoc, $totalx)
    {
        $nom=$nomb;
       $apel=$apell;
       $dni=$dnidoc;
       $tot=$totalx;
       $facturas=new Factura;   

        $facturas->nombrePersona=$nom;
        $facturas->apellidoPersona=$apel;
        $facturas->dniPersona=$dni;
        $date = Carbon::now();    
        $facturas->fechaEmision=$date;
        $facturas->total=$tot;

        $facturas->save();

       $pas=$facturas->id;
        return $pas;
        //$torta=$id->get('ids');
        //$torta=2; 
        //return $torta;
    }



    public function byConcepto($id, $sos)
    {
        $asa=$id;
       $rasa=$sos;

       $conceptos=new Concepto;   
        $conceptos->nombre=$asa;
        $conceptos->descripcion=$rasa;
        $conceptos->save();

$pas=$conceptos->id;
       
        return $pas;
    }
    
    public function byfactDetalle($idfact, $idconcep, $ratons)
    {
        $idfactu=$idfact;
       $idconcepto=$idconcep;
       $costo=$ratons;

        $detallefact=new FacturaDetalle;   
            $detallefact->precio=$costo;
            $detallefact->Concepto_ID=$idconcepto;
            $detallefact->Factura_ID=$idfactu;
        $detallefact->save();

        return 0;

        //$torta=$id->get('ids');
        //$torta=2; 
        //return $torta;
    }

public function byServ($idserv)
    {
        
        $serv=DB::table('matricula as matr')->join('serviciomatriculadetalle as detalle','matr.ID','=','detalle.Matricula_ID')->join('serviciocomplementario as servicio','detalle.ServicioComplementario_ID','=','servicio.ID')->where('detalle.ID','=',$idserv)->update(["montoPagado" => 1]);
       
        return $serv;

    }

	




    
    public function show($id)
    {
        
    }
    public function edit($id)
    {
        
    }
    public function update(PagoFormRequest $request,$id)
    {
        
    }
    public function destroy($id)
    {
       
    }
}
