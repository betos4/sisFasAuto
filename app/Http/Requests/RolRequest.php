<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolRequest extends FormRequest
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
            'name_rol' => ['required','max:100'],
            'description_rol' => ['required','max:250'],
            'status_rol' => ['required'],
            'is_superadministrator_rol' => ['required'],
        ];
    }

    public function messages() {
        return [
            'name_rol.required' => 'El campo Nombre es obligatorio',
            'name_rol.max' => 'La longitud máxima del campo Nombre es 100',
            'description_rol.required' => 'El campo Descripción es obligatorio',
            'description_rol.max' => 'La longitud máxima del campo Descripción es 250',
        ];
    }
}
