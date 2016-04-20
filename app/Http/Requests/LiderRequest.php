<?php

namespace Oansa\Http\Requests;

use Oansa\Http\Requests\Request;

class LiderRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cedula' => 'required',
            'nombre' => 'required',
            'apellido' => 'required',
            'fechaNacimiento' => 'required',
            'sexo' => 'required',
            'telefono' => 'required',
            'email' => 'required',
            'password'=>'required',
            'area_Id' => 'required',
            'rol_Id' => 'required',
            'liderGdc' => 'required',
            'telefonoLiderGdc' => 'required',
        ];
    }
}
