<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class DriverRequest extends FormRequest
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
            "dni" => [
                "required",
                "max:11",
                Rule::unique('persons')->ignore($this->id, 'user_id')
            ],
            "nombre1" => "required",
            "apellido1" => "required",
            "cumple" => "required|date",
            "email" => [
                "required",
                "email",
                Rule::unique('users')->ignore($this->id, 'id')
            ],
            "licencia" => "required",
            "carnet_circulacion" => "required",
            "grado_licencia" => "required",
            "cedula" => "required",
            "avatar" => "required",
            "tipo_cuenta" => "required",
            "nro_cuenta" => "required|numeric|digits_between:20,20",
            "banco" => "required|numeric"
        ];
    }
    
    public function attributes()
    {
        return [
            "dni" => "Cedula",
            "nombre1" => "Nombre Completo",
            "apellido1" => "Apellido Completo",
            "cumple" => "Fecha de Nacimiento",
            "email" => "Correo Electrónico",
            "licencia" => "Licencia Digital",
            "carnet_circulacion" => "Carnet de circulacion Digital",
            "grado_licencia" => "Grado de Licencia",
            "cedula" => "Cédula (Escaneada/Imágen)",
            "foto" => "Foto",
            "tipo_cuenta" => "Tipo de cuenta",
            "nro_cuenta" => "Número de cuenta",
            "banco" => "Banco"
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido',
            'digits_between' => 'El campo :attribute debe contener :min caracteres',
            'unique' => 'Ya existe un Usuario registrado con igual :attribute',
            'mimes' => 'El campo :attribute tiene un formato inválido. Solo aceptamos JPG, PNG, SVG y PDF',
            'email' => 'El campo :attribute debe tener formate de correo ej. nombrecorreo@dominio.com',
            'numeric' => 'El campo :attribute debe ser numérico',
            'max' => ':attribute no puede tener más de :max carácteres'
        ];
    }

    public function formatErrors(Validator $validator)
    {
        return [ 'error' => $validator->errors()->first() ];
    }
}
