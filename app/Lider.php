<?php

namespace Oansa;


use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Lider extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;

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

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['deleted_at'];

    public function setPasswordAttribute($valor){
        if(!empty($valor)){
            $this->attributes['password'] = \Hash::make($valor);
        }
    }

    public static function LideresActivos(){
    	return DB::table('lideres')
    		->where('estatus','=','1')
    		->get();
    }

   
}
