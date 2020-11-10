<?php

namespace sisFactura\Http\Controllers;

use Illuminate\Http\Request;

use sisFactura\Http\Requests;
use sisFactura\Banco;
use Illuminate\Support\Facades\Redirect;
use sisFactura\Http\Requests\BancoFormRequest;
use DB;

class BancoController extends Controller
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
    public function create()
    {
        $bancos=DB::table('banco')->get();
    	return view("cargarPago.banco.create",["bancos"=>$bancos]);
    }
    public function store (BancoFormRequest $request)
    {
        $banco=new Banco;
        $banco->nombre=$request->get('nombre');
        $banco->save();
        return Redirect::to('cargarPago/banco');

    }
    public function show($id)
    {
        return view("cargarPago.banco.show",["banco"=>Banco::findOrFail($id)]);
    }
    public function edit($id)
    {
        return view("cargarPago.banco.edit",["banco"=>Banco::findOrFail($id)]);
    }
    public function update(BancoFormRequest $request,$id)
    {
        $banco=Banco::findOrFail($id);
        $banco->nombre=$request->get('nombre');
        $banco->update();
        return Redirect::to('cargarPago/banco');
    }
    public function destroy($id)
    {
        $banco=Banco::findOrFail($id);
        $banco->delete();
        return Redirect::to('cargarPago/banco');
    }



}
