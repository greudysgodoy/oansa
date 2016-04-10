<?php

namespace Oansa\Http\Requests;

use Oansa\Http\Requests\Request;

class OansistaRequest extends Request
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
            'nombre' => 'required',
            'apellido' => 'required',
            'fechaNacimiento' => 'required',
            'grado' => 'required',
            'sexo' => 'required',
            'direccion' => 'required',
            'representante' => 'required',
            'telefonoRepresentante' => 'required',
            'iglesia' => 'required',
        ];
    }
}