<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'name_menu' => ['required','max:50'],
            'url_menu' => ['required','max:100'],
            'icon_menu' => ['nullable','max:100'],
        ];
    }

    public function messages() {
        return [
            'name_menu.required' => 'El campo Nombre es obligatorio',
            'name_menu.max' => 'La longitud máxima del campo Nombre es 50',
            'url_menu.required' => 'El campo Url es obligatorio',
            'url_menu.max' => 'La longitud máxima del campo Url es 100',
            'icon_menu.max' => 'La longitud máxima del campo ícono es 100',
        ];
    }
}
