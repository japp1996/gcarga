<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class ContactoRequest extends FormRequest
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
            'name' => 'required',
            "email" => "required|email",
            "phone" => "required",
            "message" => "required"
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nombres y Apellidos',
            "email" => "Correo",
            "phone" => "Teléfono",
            "message" => "Mensaje"
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
