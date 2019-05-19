<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class EmpresaRequest extends FormRequest
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
            "cedula" => "required",
            "nombre" => "required",
            "gcrif" => "required",
            "telefono" => "required",
            "email" => "required|email",
            "ubicacion" => "required",
            "max_transp" => "required",
            "seguro" => "required",
            "registro" => "required",
            "acta" => "required"
        ];
    }
    
    public function attributes()
    {
        return [
            "cedula" => "Cédula",
            "nombre" => "Nombre o Razón Social",
            "gcrif" => "Registro de Información Fiscal",
            "telefono" => "Número de Teléfono",
            "email" => "Correo",
            "ubicacion" => "Ubicación",
            "max_transp" => "Cantidad Máxima de transportes",
            "seguro" => "Seguro de carga",
            "registro" => "Registro de comercio",
            "acta" => "Acta constitutiva"
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
