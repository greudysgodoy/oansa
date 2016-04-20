<?php

namespace Oansa;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = "roles";
    protected $fillable = ['nombre',
    						'descripcion',
    						'estatus'];
}
