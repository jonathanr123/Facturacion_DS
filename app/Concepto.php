<?php

namespace sisFactura;

use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    protected $table='concepto';

    protected $primaryKey='id';
    
    public $timestamps=false;

    protected $fillable=[
        'nombre',
        'descripcion',
        'precio',
        'Cuota_ID',
        'ServicioComplementarios_ID'
    ];
}
