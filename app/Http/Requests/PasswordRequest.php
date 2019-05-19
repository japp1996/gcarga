<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class PasswordRequest extends FormRequest
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
            "password_old" => "required",
            "password_new" => "required",
            "password_conf" => "required"
        ];
    }
    
    public function attributes()
    {
        return [
            "password_old" => "Contraseña actual",
            "password_new" => "Contraseña nueva",
            "password_conf" => "Confirmación de contraseña"
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido'
        ];
    }

    public function formatErrors(Validator $validator)
    {
        return [ 'error' => $validator->errors()->first() ];
    }
}
