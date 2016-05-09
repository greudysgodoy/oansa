<?php

namespace Oansa;

use Illuminate\Database\Eloquent\Model;
use DB;
class Estacion extends Model
{
    protected $table = "estaciones";
    protected $fillable = [ 'nombre',
    						'manual_id',
                            'fecha_aprobada',
    						'fecha_premiada'];

	public static function Crear($manual_id, $nombre)
    {
       return $id = DB::table('estaciones')->insertGetId(
    			['manual_id' => $manual_id,
    			 'nombre' => $nombre,
    			 'fecha_aprobada' => '00/00/0000',
    			 'fecha_premiada' => '00/00/0000']
				);
    }    						
}
