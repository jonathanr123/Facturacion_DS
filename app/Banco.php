<?php

namespace sisFactura;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    protected $table='banco';

    protected $primaryKey='ID';

    public $timestamps=false;

    protected $fillable =[
    	'nombre'
    ];

    protected $guarded =[
    ];
}
