<?php

namespace Oansa;

use Illuminate\Database\Eloquent\Model;
use DB;

class Manual extends Model
{
    protected $table = "manuales";
    protected $fillable = [ 'nombre',
                            'oansista_id',
                            'nivel_id',
    						'estatus'];

    public static function Crear($nombre,$oansista_id, $nivel)
    {
       return $id = DB::table('manuales')->insertGetId(
    			['nombre'=>$nombre,
                 'oansista_id' => $oansista_id,
                 'nivel' => $nivel,
                 'estatus' => 1,
                 'created_at'=>date('Y-m-d H:i:s')]
				);
    }
    public static function ExisteManual($oansista_id, $nivel){
        $manual = DB::table('manuales')
            ->where('oansista_id','=',$oansista_id)
            ->where('nivel', '=', $nivel)
            ->get();
            if(count($manual)>0)
                return true;
            else
                return false;
        
    }

    public static function ObtenerManuales($oansista_id){
        $manuales = DB::table('manuales')
            ->where('oansista_id','=',$oansista_id)
            ->get();
        return $manuales;
    }

    public function DeterminarNombre($nivel_id)
    {
        switch ($nivel_id) {
            case 1:
                return "Saltador";
                break;
            case 2:
                return "Caminante";
                break;
            case 3:
                return "Escalador";
                break;
            case 4:
                return "Paloma";
                break;
            case 5:
                return "Águila";
                break;
            case 6:
                return "Venado";
                break;
            case 7:
                return "León";
                break;
        }
    }
}
