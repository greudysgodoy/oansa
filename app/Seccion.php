<?php

namespace Oansa;

use Illuminate\Database\Eloquent\Model;
use DB;

class Seccion extends Model
{
    public $timestamps = false;
    protected $table = "secciones";
    protected $fillable = [ 'estacion_id',
                            'fecha_aprobada',
    						'lider_cedula'];

	public static function Crear($estacion_id, $fecha_aprobada, $lider_cedula)
    {
        DB::table('secciones')->insert(
    		['estacion_id' => $estacion_id,
    		 'fechaAprobada' => '0000/00/00 00:00:00',
    		 'lider_cedula' => $lider_cedula]
			);
    }        						
}
