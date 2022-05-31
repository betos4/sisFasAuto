<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'email' => ['required'],
            'telefono' => ['required','max:15'],
            'celular' => ['required','max:15'],
            'estado_activo' => ['required'],
            'estado_civil' => ['required'],
        ];

        return $rules;
    }

    public function messages() {
        return [
            'email.required' => 'El campo Email es obligatorio',
            'telefono.required' => 'El campo Teléfono es obligatorio',
            'telefono.max' => 'La longitud máxima del campo Teléfono es 15',
            'celular.required' => 'El campo Celular es obligatorio',
            'celular.max' => 'La longitud máxima del campo Celular es 15',
            'estado_civil.required' => 'El campo Estado Civil es obligatorio',
        ];
    }

    public function withValidator($validator) {
        if ($validator->fails()) {
            toastr()->error('El registro no puede ser guardado. Favor verifica los datos ingresados');
        }
    }
}
