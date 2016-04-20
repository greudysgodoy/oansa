<?php

namespace Oansa;

use Illuminate\Database\Eloquent\Model;

class Lider extends Model
{
    protected $table = "lideres";
    protected $primaryKey="cedula";
    protected $fillable = [ 'cedula',
                            'nombre',
    						'apellido',
    						'fechaNacimiento',
    						'sexo',
    						'email',
    						'telefono',
    						'area_Id',
                            'rol_Id',
    						'liderGdc',
    						'telefonoLiderGdc',
                            'password',
    						'estatus'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function LideresActivos(){
    	return DB::table('lideres')
    		->where('estatus','=','1')
    		->get();
    }

   
}
