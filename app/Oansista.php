<?php

namespace Oansa;

use Illuminate\Database\Eloquent\Model;

class Oansista extends Model
{
    protected $table = "oansistas";
    protected $fillable = ['nombre',
    						'apellido',
                            'fullname',
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

    public static function filtrar($fullname,$club_id)
    {
        return Oansista::nombre($fullname)
                        ->club($club_id)
                        ->orderBy('grado','ASC')
                        ->get();
    }


    public function scopeObtener($query, $id)
    {
        $query->where('id',$id);
    }

    public function scopeNombre($query, $fullname)
    {
        //dd("scope: ".$fullname);
        if(trim($fullname)!="")
        {
            $query->where('fullname',"LIKE", "%$fullname%");
        }
        
    }

    public function scopeClub($query,$club_id)
    {
        $clubes = config('options.clubes');

        if($club_id > 0 && isset($clubes[$club_id]))
        {
            if($club_id == 1)
            $query->where('grado','<','4');

            if($club_id == 2)
            $query->where('grado','<','6')
                  ->where('grado','>','3');
            if($club_id == 3)
            $query->where('grado','>','5');
        }
    }
}
