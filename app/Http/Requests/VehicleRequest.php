<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class VehicleRequest extends FormRequest
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
            "gcplaca" => [
                "required",
                "alpha_dash",
                "unique:vehicles,license_plate"
            ],
            "tipo" => "required",
            "marca" => "required",
            "modelo" => "required",
            "color" => "required",
            "anio" => "required|numeric",
            "capacidad" => "required|numeric",
            //"tipo_capacidad" => "required",
            "serial" => "required|alpha_dash",
            //"titulo_propiedad" => "required",
            //"seguro" => "required",
            //"carnet_circulacion" => "required",
            //"fotos" => "required"
        ];
    }
    
    public function attributes()
    {
        return [
            "gcplaca" => "Placa",
            "tipo" => "Tipo de transporte",
            "marca" => "Marca",
            "modelo" => "Modelo",
            "color" => "Color",
            "anio" => "Año",
            "capacidad" => "Capacidad",
            "tipo_capacidad" => "Tipo de Capacidad",
            "serial" => "Serial",
            "titulo_propiedad" => "Título de propiedad",
            "seguro" => "Seguro de carga",
            "carnet_circulacion" => "Carnet de circulación",
            "fotos" => "Fotos"
        ];
    }

    public function messages()
    {
        return [
            'required' => 'El campo :attribute es requerido',
            'min' => 'El campo :attribute no puede contener menos de :min caracteres',
            'unique' => 'Ya existe un Usuario registrado con igual :attribute',
            'email' => 'El campo :attribute debe tener formate de correo ej. nombrecorreo@dominio.com',
            'size' => ':attribute no puede pesar más de 4mb',
            'alpha_dash' => 'El campo :attribute debe tener caracteres alfanuméricos, así como guiones y guiones bajos.',
            'numeric' => 'El campo :attribute debe ser numérico'
        ];
    }

    public function formatErrors(Validator $validator)
    {
        return [ 'error' => $validator->errors()->first() ];
    }
}
