<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Requests\VehicleRequest;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehiclePhoto;
use App\Models\Brand;
use App\Models\Modelo;
use App\Models\Weight;
use App\Models\Bulk;
use App\Models\Transport;
use App\Models\Person;
use App\User;
//use Illuminate\Support\Facades\Storage;
use App\Libraries\SetNameImage;
use App\Libraries\ResizeImage;
use Image as Intervention;
use File;
use Auth;

class VehicleController extends Controller
{
    public function __construct()
    {
        session()->forget('accessAuth');
    }
    
    public function index()
    {
        session()->forget('accessAuth');
        $vehiculo = "";
        $empresas = User::find(Auth::user()->id);
        $marca = Brand::get();
        $tipo = Transport::get();
        $peso = Weight::get();
        $volumen = Bulk::get();
    	return view('content.admin.vehicle')->with(['marca' => $marca, 'tipo' => $tipo, 'peso' => $peso, 'volumen' => $volumen, 'empresas' => $empresas,  'vehiculo' => $vehiculo]);
    }

    public function store(VehicleRequest $request)
    {
        // Images
        $empresa = Person::select('dni', 'max_vehicle')->where('user_id', Auth::user()->id)->first();
        $cantVeh = Vehicle::select('license_plate', 'user_id')->where('user_id', Auth::user()->id)->get();
        if (count($cantVeh) >= $empresa->max_vehicle) {
            return response()->json(['result' => false, 'text' => 'No puede registrar mas vehiculos del maximo permitido por su empresa']);
        } else {
            $url = "images/company/vehicles/";
                
            $carnet = "";
            $seguro = "";
            $titulo_propiedad = "";
            $foto = "";

            // CARNET
            if ($request->hasFile('carnet_circulacion')) {    
                $file = $request->file('carnet_circulacion');
                $format = strtolower($file->getClientOriginalExtension());
                
                if ($format != 'jpg' && $format !=  'pdf' && $format !=  'jpeg' && $format != 'png') {
                    return response()->json(['error' => 'El formato de carnet de circulación es incorrecto. Permitimos png, jpg y pdf'],422);
                }

                if ($file->getSize() < 5000000) {
                    $file_name = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
                    $path = $url.'circulation_card/';
                    $file->move($path, $file_name);
                    if($file->getClientOriginalExtension() != "pdf") {
                        ResizeImage::dimenssion($file_name, $file->getClientOriginalExtension(), $path);
                    }
                    $carnet = $path.$file_name;
                } else {
                    return response()->json(['error' => 'El tamano maximo para el carnet es de 2 MB'],422);
                }
            }

            // SEGURO

            if($request->hasFile('seguro')) {
                $file = $request->file('seguro');
                $format = strtolower($file->getClientOriginalExtension());
                if ($format != 'jpg' && $format !=  'pdf' && $format !=  'jpeg' && $format != 'png') {
                    return response()->json(['error' => 'El formato de la foto es incorrecto. Permitimos png, jpg y pdf'],422);
                }

                if ($file->getSize() < 5000000) {
                    $file_name = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
                    $path = $url.'asurance/';
                    $file->move($path, $file_name);
                    if($file->getClientOriginalExtension() != "pdf") {
                        ResizeImage::dimenssion($file_name, $file->getClientOriginalExtension(), $path);
                    }
                    $seguro = $path.$file_name;
                } else {
                    return response()->json(['error' => 'El tamano maximo para el carnet es de 2 MB'],422);
                }
            }

            // TITULO PROPIEDAD
            
            if($request->hasFile('titulo_propiedad')) {
                
                $file = $request->file('titulo_propiedad');
                $format = strtolower($file->getClientOriginalExtension());
                if ($format != 'jpg' && $format !=  'pdf' && $format !=  'jpeg' && $format != 'png') {
                    return response()->json(['error' => 'El formato de la foto es incorrecto. Permitimos png, jpg y pdf'],422);
                }

                if ($file->getSize() < 5000000) {
                    $file_name = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
                    $path = $url.'property_title/';
                    $file->move($path, $file_name);
                    if($file->getClientOriginalExtension() != "pdf") {
                        ResizeImage::dimenssion($file_name, $file->getClientOriginalExtension(), $path);
                    }
                    $titulo_propiedad = $path.$file_name;
                } else {
                    return response()->json(['error' => 'El tamano maximo para el carnet es de 2 MB'],422);
                }

            }

            // FOTO

            if($request->hasFile('fotos')) {
                $file = $request->file('fotos');
                $format = strtolower($file->getClientOriginalExtension());
                if ($format != 'jpg' && $format !=  'pdf' && $format !=  'jpeg' && $format != 'png') {
                    return response()->json(['error' => 'El formato de la foto es incorrecto. Permitimos png, jpg y pdf'],422);
                }

                if ($file->getSize() < 5000000) {
                    $file_name = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
                    $path = 'avatars/';
                    $file->move($path, $file_name);
                    if($file->getClientOriginalExtension() != "pdf") {
                        ResizeImage::dimenssion($file_name, $file->getClientOriginalExtension(), $path);
                    }
                    $foto = $path.$file_name;
                } else {
                    return response()->json(['error' => 'El tamano maximo para el carnet es de 2 MB'],422);
                }
            }
            
            $transporte = new Vehicle;
            $transporte->license_plate = $request->gcplaca;
            $transporte->brand_id = $request->marca;
            $transporte->model_id = $request->modelo;
            $transporte->user_id = $request->user_id;
            $transporte->color = $request->color;
            $transporte->year = $request->anio;
            $transporte->transport_id = $request->tipo;
            $transporte->bulk_id = $request->bulk_id;
            $transporte->weight_id = $request->weight_id;
            //$transporte->capacity = $request->capacidad;

            $transporte->serial = $request->serial;
            $transporte->asurance = $seguro;
            $transporte->property_title = $titulo_propiedad;
            $transporte->circulation_card = $carnet;
            $transporte->status = '1';

            $request->doc_verificado = $request->doc_verificado == true ? 1 : 0;
            $request->insured = $request->insured == true ? 1 : 0;
            
            $transporte->verified_docs = $request->doc_verificado;
            $transporte->insured = $request->insured;
            $transporte->registered_id = Auth::user()->id;
            $transporte->save();

            $transporte_foto = new VehiclePhoto;
            $transporte_foto->vehicle_id =  $transporte->id;
            $transporte_foto->name = $foto;
            $transporte_foto->save();

            return response()->json(['result' => true, 'text' => 'Transporte Registrado con éxito']);

        }
    }

    public function all()
    {
        session()->forget('accessAuth');
        $empresas = Person::where('user_id', Auth::user()->id)->first();
        
        $vehiculos = Vehicle::with(['marca' => function($query) {
            $query->with(['modelo']);
        }])
        ->with(['fotos'])
        ->with(['user'])
        ->where('registered_id', Auth::user()->id)                    
        ->get();
        
        return View('content.admin.vehicles')->with(['vehiculos' => $vehiculos, 'empresas' => $empresas]);
    }
    
    public function modelo(Request $request)
    {
        $modelo = Modelo::where('brand_id', $request->id)->get();
        return response()->json($modelo);
    }

    public function show(Request $request, $id)
    {
        session()->forget('accessAuth');
        $empresas = User::where('id', Auth::user()->id)->first();
        $marca = Brand::get();
        $tipo = Transport::get();
        $peso = Weight::get();
        $volumen = Bulk::get();
        $vehiculo = Vehicle::with(['user' => function($us){
            $us->select('id', 'name');
        }])->where('id', $id)->first();
        $fotos = VehiclePhoto::where('vehicle_id', $id)->get();

        return view('content.admin.vehicle')->with(['marca' => $marca, 'tipo' => $tipo, 'peso' => $peso, 'volumen' => $volumen, 'empresas' => $empresas, 'vehiculo' => $vehiculo, 'fotos' => $fotos]);
    }
    
    public function update(Request $request, $id)
    {
        $transporte = Vehicle::find($id);
        $photoVeh = VehiclePhoto::where('vehicle_id', $id)->first();
        $url = "images/company/vehicles/";
        
        $seguro = $transporte->asurance;
        $carnet = $transporte->circulation_card;
        $titulo_propiedad = $transporte->property_title;
        $fotos = $photoVeh->name;

        // CARNET
        if ($request->hasFile('carnet_circulacion')) {    
            $file = $request->file('carnet_circulacion');
            $format = strtolower($file->getClientOriginalExtension());
            
            if ($format != 'jpg' && $format !=  'pdf' && $format !=  'jpeg' && $format != 'png') {
                return response()->json(['error' => 'El formato de carnet de circulación es incorrecto. Permitimos png, jpg y pdf'],422);
            }

            if ($file->getSize() < 5000000) {
                $file_name = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
                $path = $url.'circulation_card/';
                $file->move($path, $file_name);
                if($file->getClientOriginalExtension() != "pdf") {
                    ResizeImage::dimenssion($file_name, $file->getClientOriginalExtension(), $path);
                }
                $carnet = $path.$file_name;
            } else {
                return response()->json(['error' => 'El tamano maximo para el carnet es de 2 MB'],422);
            }
        }

        // SEGURO
        if($request->hasFile('seguro')) {
            $file = $request->file('seguro');
            $format = strtolower($file->getClientOriginalExtension());
            if ($format != 'jpg' && $format !=  'pdf' && $format !=  'jpeg' && $format != 'png') {
                return response()->json(['error' => 'El formato de seguro es incorrecto. Permitimos png, jpg y pdf'],422);
            }

            if ($file->getSize() < 5000000) {
                $file_name = SetNameImage::set($file->getClientOriginalName(), $format);
                $path = $url.'asurance/';
                $file->move($path, $file_name);
                if($file->getClientOriginalExtension() != "pdf") {
                    ResizeImage::dimenssion($file_name, $format, $path);
                }
                $seguro = $path.$file_name;
            } else {
                return response()->json(['error' => 'El tamano maximo para el carnet es de 2 MB'],422);
            }
        }

        // TITULO PROPIEDAD 
        if($request->hasFile('titulo_propiedad')) {
            $file = $request->file('titulo_propiedad');
            $format = strtolower($file->getClientOriginalExtension());
            if ($format != 'jpg' && $format !=  'pdf' && $format !=  'jpeg' && $format != 'png') {
                return response()->json(['error' => 'El formato del titulo de propiedad es incorrecto. Permitimos png, jpg y pdf'],422);
            }

            if ($file->getSize() < 5000000) {
                $file_name = SetNameImage::set($file->getClientOriginalName(), $format);
                $path = $url.'property_title/';
                $file->move($path, $file_name);
                if($format != "pdf") {
                    ResizeImage::dimenssion($file_name, $format, $path);
                }
                $titulo_propiedad = $path.$file_name;
            } else {
                return response()->json(['error' => 'El tamano maximo para el carnet es de 2 MB'],422);
            }

        }

        $transporte->brand_id = $request->marca;
        $transporte->model_id = $request->modelo;
        $transporte->weight_id = $request->weight_id;
        $transporte->bulk_id = $request->bulk_id;
        $transporte->color = $request->color;
        $transporte->year = $request->anio;
        $transporte->transport_id = $request->tipo;
        $transporte->user_id = $request->user_id == NULL ? NULL : $request->user_id;
        //$transporte->capacity = $request->capacidad;
       
        //$transporte->tipo_capacidad = $request->tipo_capacidad;
       
        $transporte->serial = $request->serial;
        $transporte->asurance = $seguro;
        $transporte->property_title = $titulo_propiedad;
        $transporte->circulation_card = $carnet;
        
        $transporte->status = '1';

        //$request->carga_asegurada = $request->carga_asegurada == true || $request->carga_asegurada == 1 ? 1 : 0; 
        $transporte->insured = $request->insured == true || $request->insured == 1 ? 1 : 0;
        //$transporte->gccarga_asegurada = $request->carga_asegurada;
        $transporte->save();

        $transporte_foto = VehiclePhoto::where('vehicle_id', $id)->first();
        $transporte_foto->name . ' ' . $request->fotos;
        if ($transporte_foto->name != $request->fotos) {
            
            // FOTO

            if($request->hasFile('fotos')) {
                $file = $request->file('fotos');
                $format = strtolower($file->getClientOriginalExtension());
                if ($format != 'jpg' && $format !=  'pdf' && $format !=  'jpeg' && $format != 'png') {
                    return response()->json(['error' => 'El formato de la foto es incorrecto. Permitimos png, jpg y pdf'],422);
                }

                if ($file->getSize() < 5000000) {
                    $file_name = SetNameImage::set($file->getClientOriginalName(), $format);
                    $path = 'avatars/';
                    $file->move($path, $file_name);
                    if($format != "pdf") {
                        ResizeImage::dimenssion($file_name, $format, $path);
                    }
                    $fotos = $path.$file_name;
                } else {
                    return response()->json(['error' => 'El tamano maximo para el carnet es de 2 MB'],422);
                }
            }

            $transporte_foto->name = $fotos;
            $transporte_foto->vehicle_id =  $id;
            $transporte_foto->save();
        }    

        return response()->json(['result' => true, 'text' => 'Transporte Actualizado con éxito']);
    }

    public function status(Request $request)
    {
        $tranport = Vehicle::find($request->id);
        $tranport->status = $tranport->status == '0' ? '1' : '0';
        $tranport->save();

        /*$conductor = Conductor::find($transport->gcconductor);
        $conductor->gcplaca = " ";
        $conductor->save();*/

        return response()->json(['result' => true, 'status' => $tranport->status]);
    }

    public function drivers(Request $request)
    {
        
       $drivers = User::whereDoesntHave('vehicle', function($veh) use($request){
            if (!is_null($request->id)){
                $veh->where('user_id', $request->id);
            } 
        })
        ->where('user_id', Auth::user()->id)
        ->get();
        return response()->json($drivers);
    }

    public function delete()
    {
    	
    }
}
