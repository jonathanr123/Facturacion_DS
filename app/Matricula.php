<?php

namespace sisFactura;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $table='matricula';

    protected $primaryKey='ID';

    public $timestamps=false;

    protected $fillable =[
    	'numero',
    	'fechaAlta',
    	'Persona_ID'

    ];

    protected $guarded =[
    ];}
