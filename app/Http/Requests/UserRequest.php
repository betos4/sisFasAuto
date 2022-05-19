<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            'identification_user' => ['required','unique:users,identification_user'],
            'name_user' => ['required','max:250'],
            'lastname_user' => ['required','max:250'],
            'email_user' => ['required'],
            'username' => ['required','unique:users,username'],
            'password' => ['required','min:8'],
            'status_user' => ['required'],
            'rol' => ['required'],
        ];

        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            $user = $this->route()->parameter('user');

            $rules['identification_user'] = [
                Rule::unique('users')->ignore($user),
            ];

            $rules['username'] = [
                Rule::unique('users')->ignore($user),
            ];

            $rules['password'] = [
                Rule::unique('users')->ignore($user),
            ];
        }

        return $rules;
    }

    public function messages() {
        return [
            'identification_user.required' => 'El campo Identificación es obligatorio',
            'identification_user.unique' => 'La identificación ingresada ya se encuentra registrada',
            'name_user.required' => 'El campo Nombre es obligatorio',
            'name_user.max' => 'La longitud máxima del campo Nombre es 250',
            'lastname_user.required' => 'El campo Apellido es obligatorio',
            'lastname_user.max' => 'La longitud máxima del campo Apellido es 250',
            'email_user.required' => 'El campo Email es obligatorio',
            'email_user.unique' => 'El Email ingresado ya se encuentra registrado',
            'username.required' => 'El campo Username es obligatorio',
            'username.unique' => 'El Username ingresado ya se encuentra registrado',
            'password.required' => 'El campo Password es obligatorio',
            'password.min' => 'El campo Password debe contener como mínimo 8 caracteres',
            'rol.required' => 'El campo Rol es obligatorio',
        ];
    }

    public function withValidator($validator) {
        if ($validator->fails()) {
            toastr()->error('El registro no puede ser guardado. Favor verifica los datos ingresados');
        }
    }
}
