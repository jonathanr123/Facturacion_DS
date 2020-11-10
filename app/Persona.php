<?php

namespace sisFactura;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table='persona';

    protected $primaryKey='ID';

    public $timestamps=false;

    protected $fillable =[
    	'dni',
    	'nombre',
    	'apellido',
    	'telefono',
    	'fechaNacimiento',
    	'email'

    ];

    protected $guarded =[
    ];
}
