<?php

namespace sisFactura;

use Illuminate\Database\Eloquent\Model;

class ServicioMatriculaDetalle extends Model
{
     protected $table='serviciomatriculadetalle';

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable=[
        'fechaAlta';
        'fechaBaja';
        'monto';
        'montoPagado';
        'porcDescuento';
        'Matricula_ID';
        'ServicioComplementario_ID';
    ];
}
