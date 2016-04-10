<?php

namespace Oansa;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = "areas";
    protected $fillable = ['nombre',
    						'descripcion',
    						'estatus'];
}
