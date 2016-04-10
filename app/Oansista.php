<?php

namespace Oansa;

use Illuminate\Database\Eloquent\Model;

class Oansista extends Model
{
    protected $table = "oansistas";
    protected $fillable = ['nombre',
    						'apellido',
    						'fechaNacimiento',
    						'grado',
    						'sexo',
    						'direccion',
    						'telefono',
    						'representante',
    						'telefonoRepresentante',
    						'iglesia',
    						'estatus'];

    public static function OansistasActivos(){
    	return DB::table('oansistas')
    		->where('estatus','=','1')
    		->get();
    }
}
