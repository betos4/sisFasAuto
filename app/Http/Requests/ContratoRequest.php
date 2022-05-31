<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContratoRequest extends FormRequest
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
            'numcontrato' => ['required', 'max:50'],
            'tipocontrato' => ['required','max:50'],
            'valorgarantia' => ['required'],
            'fechainicio' => ['required'],
            'fechafin' => ['required'],
            'email' => ['required'],
            'telefono' => ['required','max:15'],
            'celular' => ['required','max:15'],
            'estado_civil' => ['required'],
            'estado_activo' => ['required'],
            'creditoid' => ['required'],
        ];

        return $rules;
    }

    public function messages() {
        return [
            'numcontrato.required' => 'El campo Número Contrato es obligatorio',
            'numcontrato.max' => 'La longitud máxima del campo Número Contrato es 50',
            'tipocontrato.required' => 'El campo Tipo Contrato es obligatorio',
            'tipocontrato.max' => 'La longitud máxima del campo Tipo Contrato es 50',
            'valorgarantia.required' => 'El campo Valor Garantía es obligatorio',
            'fechainicio.required' => 'El campo Fecha Inicio es obligatorio',
            'fechafin.required' => 'El campo Fecha Fin es obligatorio',
            'email.required' => 'El campo Email es obligatorio',
            'telefono.required' => 'El campo Teléfono es obligatorio',
            'telefono.max' => 'La longitud máxima del campo Teléfono es 15',
            'celular.required' => 'El campo Celular es obligatorio',
            'celular.max' => 'La longitud máxima del campo Celular es 15',
            'estado_civil.required' => 'El campo Estado Civil es obligatorio',
            'creditoid.required' => 'El campo Credito es obligatorio',
        ];
    }

    public function withValidator($validator) {
        if ($validator->fails()) {
            toastr()->error('El registro no puede ser guardado. Favor verifica los datos ingresados');
        }
    }
}
