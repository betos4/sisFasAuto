<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoReferenciaRequest extends FormRequest
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
        $rules = [
            'nombre' => ['required','max:250'],
            'estado_activo' => ['required'],
        ];

        return $rules;
    }

    public function messages() {
        return [
            'nombre.required' => 'El campo Nombre es obligatorio',
            'nombre.max' => 'La longitud máxima del campo Nombre es 250',
        ];
    }
     
    public function withValidator($validator) {
        if ($validator->fails()) {
            toastr()->error('El registro no puede ser guardado. Favor verifica los datos ingresados');
        }
    }
}
