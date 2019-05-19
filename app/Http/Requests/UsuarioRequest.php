<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UsuarioRequest extends FormRequest
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
            'gcdni' => 'unique:users|required',
            'name' => 'required',
            'password' => 'required|min:8',
            "password2" => "required|min:8",
            "email" => "required|email",
            "phone" => "required"
        ];
    }
    
    public function attributes()
    {
        return [
            'gcdni' => 'Numero de Identificación',
            'name' => 'Nombre o Razón Social',
            'password' => 'Contraseña',
            "password2" => "Repetir contraseña",
            "email" => "Email",
            "phone" => "Telefono"
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido',
            'min' => 'El campo :attribute no puede contener menos de :min caracteres',
            'unique' => 'Ya existe un Usuario registrado con igual :attribute',
            'email' => 'El campo :attribute debe tener formate de correo ej. nombrecorreo@dominio.com'
        ];
    }

    public function formatErrors(Validator $validator)
    {
        return [ 'error' => $validator->errors()->first() ];
    }
}
