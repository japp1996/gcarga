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
            
            // Init: Procesar foto
            
            if($request->hasFile('carnet_circulacion')) {
                
                $carnet = $url.'circulation_card/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
                //ResizeImage::dimenssion($file_name, $file->getClientOriginalExtension(), $url);
                Intervention::make($request->file('carnet_circulacion'))->save($carnet, 70);
            }
        
            if($request->hasFile('seguro')) {
                $seguro = $url.'asurance/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
                Intervention::make($request->file('seguro'))->save($seguro, 70);
            }
            if($request->hasFile('titulo_propiedad')) {
                $titulo_propiedad = $url.'property_title/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
                Intervention::make($request->file('titulo_propiedad'))->save($titulo_propiedad, 70);
            }
            if($request->hasFile('fotos')) {
                $fotos = $url.'photo/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
                Intervention::make($request->file('fotos'))->save($fotos, 70);
            }
            // End: Procesar foto
            //CARNET
            //SEGURO
            /*$file = $request->file('seguro');
            $seguro = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
            $file->move($url, $seguro);
            if($file->getClientOriginalExtension() != "pdf") {
                ResizeImage::dimenssion($file_name, $file->getClientOriginalExtension(), $url);
            }
            $seguro = $seguro;
            
            //TITULO
            $file = $request->file('titulo_propiedad');
            $file_name = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
            $file->move($url, $file_name);
            if($file->getClientOriginalExtension() != "pdf") {
                ResizeImage::dimenssion($file_name, $file->getClientOriginalExtension(), $url);
            }
            $titulo_propiedad = $file_name;

            //FOTO
            $file = $request->file('fotos');
            $file_name = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
            $file->move($url, $file_name);
            if($file->getClientOriginalExtension() != "pdf") {
                ResizeImage::dimenssion($file_name, $file->getClientOriginalExtension(), $url);
            }
            $fotos = $file_name;*/
            
            $transporte = new Vehicle;
            $transporte->license_plate = $request->gcplaca;
            $transporte->brand_id = $request->marca;
            $transporte->model_id = $request->modelo;
            $transporte->color = $request->color;
            $transporte->year = $request->anio;
            $transporte->transport_id = $request->tipo;
            $transporte->bulk_id = $request->bulk_id;
            $transporte->weight_id = $request->weight_id;
            $transporte->capacity = $request->capacidad;

            $transporte->serial = $request->serial;
            $transporte->asurance = $seguro;
            $transporte->property_title = $titulo_propiedad;
            $transporte->circulation_card = $carnet;
            $transporte->status = '1';

            $request->doc_verificado = $request->doc_verificado === true ? 1 : 0;
            $request->insured = $request->insured === true ? 1 : 0;
            
            $transporte->verified_docs = $request->doc_verificado;
            $transporte->insured = $request->insured;
            $transporte->registered_id = Auth::user()->id;
            $transporte->save();

            $transporte_foto = new VehiclePhoto;
            $transporte_foto->vehicle_id =  $transporte->id;
            $transporte_foto->name = $fotos;
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
        $vehiculo = Vehicle::where('id', $id)->first();
        $fotos = VehiclePhoto::where('vehicle_id', $id)->get();

        return view('content.admin.vehicle')->with(['marca' => $marca, 'tipo' => $tipo, 'peso' => $peso, 'volumen' => $volumen, 'empresas' => $empresas, 'vehiculo' => $vehiculo, 'fotos' => $fotos]);
    }
    
    public function update(Request $request, $id)
    {
        $transporte = Vehicle::find($id);
        $url = "images/company/vehicles/";
        
        $carnet = $request->circulation_card;
        if ($transporte->circulation_card != $request->circulation_card) {
            if($request->hasFile('circulation_card')) {
                
                $carnet = $url.'circulation_card/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
                //ResizeImage::dimenssion($file_name, $file->getClientOriginalExtension(), $url);
                Intervention::make($request->file('circulation_card'))->save($carnet, 70);
            }
        }
        
        $seguro = $request->seguro;
        if ($transporte->asurance != $request->seguro){
            if($request->hasFile('seguro')) {
                $seguro = $url.'asurance/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
                Intervention::make($request->file('seguro'))->save($seguro, 70);
            }
        }

        $titulo_propiedad = $request->titulo_propiedad;
        if ($transporte->property_title != $request->titulo_propiedad){
            if($request->hasFile('titulo_propiedad')) {
                $titulo_propiedad = $url.'property_title/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
                Intervention::make($request->file('titulo_propiedad'))->save($titulo_propiedad, 70);
            }
        }

        $transporte->brand_id = $request->marca;
        $transporte->model_id = $request->modelo;
        $transporte->weight_id = $request->weight_id;
        $transporte->bulk_id = $request->bulk_id;
        $transporte->color = $request->color;
        $transporte->year = $request->anio;
        $transporte->transport_id = $request->tipo;
        //$transporte->gctamano = $request->tamano;
        $transporte->capacity = $request->capacidad;
       
        //$transporte->tipo_capacidad = $request->tipo_capacidad;
       
        $transporte->serial = $request->serial;
        $transporte->asurance = $seguro;
        $transporte->property_title = $titulo_propiedad;
        $transporte->circulation_card = $carnet;
        
        $transporte->status = '1';

        //$request->doc_verificado = $request->doc_verificado == true || $request->doc_verificado == 1 ? 1 : 0;
        //$request->carga_asegurada = $request->carga_asegurada == true || $request->carga_asegurada == 1 ? 1 : 0; 
        $transporte->verified_docs = $request->doc_verificado == true || $request->doc_verificado == 1 ? 1 : 0;
        $transporte->insured = $request->insured == true || $request->insured == 1 ? 1 : 0;
        //$transporte->gccarga_asegurada = $request->carga_asegurada;
        $transporte->save();

        $transporte_foto = VehiclePhoto::where('vehicle_id', $id)->first();
        $transporte_foto->name . ' ' . $request->fotos;
        if ($transporte_foto->name != $request->fotos) {
            
            $odlFile = $transporte_foto->name;
            if($request->hasFile('fotos')) {
                $fotos = $url.'photo/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
                Intervention::make($request->file('fotos'))->save($fotos, 70);
            }
            File::delete(public_path($odlFile));
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

    public function delete()
    {
    	
    }
}
