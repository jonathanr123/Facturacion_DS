<?php
//pueba de factura controller
namespace sisFactura\Http\Controllers;

use Illuminate\Http\Request;

use sisFactura\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use sisFactura\Http\Requests\facturaFormRequest;
use sisFactura\Factura;
use sisFactura\Concepto;
use sisFactura\Pago;
use sisFactura\FacturaDetalle;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Collection;
use DB;


class facturaController extends Controller
{
    public function __construct()
    {

    }
    public function index(Request $request)
    {
    
        if ($request) 
        {
    
      $query=trim($request->get('searchNumb'));
      $factura=DB::table('factura')->where('ID','LIKE','%'.$query.'%')
      ->paginate(7);
      return view('buscarfactura.factura.index',["factura"=>$factura,"searchNumb"=>$query]);

       }
 //   if ($request)
 //     {
  //      $query=trim($request->get('searchNumb'));
  //      $factura=DB::table('factura as f')
  //          ->join('facturadetalle as fd','fd.Factura_ID','=','f.ID')
   //         ->join('concepto as c','fd.Concepto_ID','=','c.ID')

     //       ->select('f.ID','f.fechaEmision',DB::raw('sum(fd.cantidad*precio) as total'))

//           ->where('f.ID','LIKE','%'.$query.'%') 
//           ->groupby('f.ID','f.fechaEmision','c.nombre')         
  //      ->paginate(7);
   //         return view('buscarfactura.factura.index',["factura"=>$factura,"searchNumb"=>$query]);
   //   }

     //  }
    }
    public function create(Request $request)
    {
     $concepto=DB::table('concepto')
        
        ->select('nombre','ID')
      ->get();

      $matriculas=DB::table('matricula as matr')->join('persona as pers','matr.Persona_ID','=','pers.ID')->get();

        $mseleccion=$request->input('ID');
        $matris=DB::table('matricula as matr')->join('persona as pers','matr.Persona_ID','=','pers.ID')->where('matr.ID','=', $mseleccion)->get();

        $bancos=DB::table('banco')->get();
        

      return view("buscarfactura.factura.create",["concepto"=>$concepto,"bancos"=>$bancos,"matriculas"=>$matriculas,"matris"=> $matris]); 
    }
   

    

    public function show($id)
    {   
        $factura=DB::table('factura as f')
            ->where('f.ID','=',$id)
            
            
            ->first();
            

    /** aki en detalle lo tengo que poner a persona y concepto*/
  
        $detalle=DB::table('facturadetalle as fd')
             ->join('factura as f','fd.Factura_ID','=','f.ID')
             ->join('concepto as c','fd.Concepto_ID','=','c.ID')
             
             ->where('fd.Factura_ID','=',$id)
             
             ->get();

           

        return view("buscarfactura.factura.show",["factura"=>$factura,"detalle"=>$detalle]);
    
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