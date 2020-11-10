<?php

namespace sisFactura;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    protected $table='facturadetalle';

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable=[
        'precio',
        'Concepto_ID',
        'Factura_ID'
    ];
}
