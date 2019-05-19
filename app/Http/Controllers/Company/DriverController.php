<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Models\Vehicle;
use App\Models\Brand;
use App\Models\Modelo;
use App\Models\Bank;
use App\Models\BankUser;
use App\Models\Person;
use App\User;
use App\Libraries\SetNameImage;
use App\Libraries\ResizeImage;
use Image as Intervention;
use Carbon\Carbon;
use Auth;
use File;
use Hash;


class DriverController extends Controller
{
    public function __construct()
    {
        session()->forget('accessAuth');
    }
    
    public function index()
    {
        session()->forget('accessAuth');
        $conductor = "";
        $vehiculos = Vehicle::with(['marca' => function($query) {
            $query->with(['modelo']);
        }])
        ->with(['conductor'])
        ->where('status', '1')
        ->where('user_id', Auth::user()->id)
        ->get();
        $bancos = Bank::get();
        $empresas = User::find(Auth::user()->id);
    	
        return view('content.admin.driver')->with(['vehiculos' => $vehiculos, 'bancos' => $bancos, 'empresas' => $empresas, 'conductor' => $conductor]);

    }

    public function store(DriverRequest $request)
    {
    	// Images
        $url = "images/company/drivers/";
        
        /**
         * CARNET DE CIRCULACION
         */
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

        /**
         * FOTO DE PERFIL DEL CONDUCTOR
         */
        $file = $request->file('foto');
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

        /**
         *  CEDULA DE IDENTIDAD CONDUCTOR
         */
        $file = $request->file('cedula');
        $format = strtolower($file->getClientOriginalExtension());
        if ($format != 'jpg' && $format !=  'pdf' && $format !=  'jpeg' && $format != 'png') {
            return response()->json(['error' => 'El formato de la cedula es incorrecto. Permitimos png, jpg y pdf'],422);
        }

        if ($file->getSize() < 5000000) {
            $file_name = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
            $path = $url.'dni/';
            $file->move($path, $file_name);
            if($file->getClientOriginalExtension() != "pdf") {
                ResizeImage::dimenssion($file_name, $file->getClientOriginalExtension(), $path);
            }
            $cedula = $path.$file_name;
        } else {
            return response()->json(['error' => 'El tamano maximo para el carnet es de 2 MB'],422);
        }
        
        /**
         *  LICENCIA DIGITAL CONDUCTOR
         */
        $file = $request->file('licencia');
        $format = strtolower($file->getClientOriginalExtension());
        if ($format != 'jpg' && $format !=  'pdf' && $format !=  'jpeg' && $format != 'png') {
            return response()->json(['error' => 'El formato de la licencia digital es incorrecta. Permitimos png, jpg y pdf'],422);
        }

        if ($file->getSize() < 5000000) {
            $file_name = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
            $file->move($url.'license/', $file_name);
            if($file->getClientOriginalExtension() != "pdf") {
                ResizeImage::dimenssion($file_name, $file->getClientOriginalExtension(), $url.'license/');
            }
            $licencia = $file_name;
        } else {
            return response()->json(['error' => 'El tamano maximo para el carnet es de 2 MB'],422);
        }
    
        $conductor = new User;
        $conductor->user_id = Auth::user()->id;
        $conductor->name = $request->nombre1.' '.$request->apellido1;
        $conductor->email = $request->email;
        $conductor->avatar = $foto;
        $conductor->valoration =  0;
        //$conductor->password = Hash::make($request->password);
        $conductor->password = Hash::make(12345);
        $conductor->save();

        $person = new Person;
        $person->user_id = $conductor->id;
        $person->dni = $request->dni;
        $person->first_name = $request->nombre1;
        $person->last_name = $request->apellido1;
        
        $person->sex = $request->sex;
        $person->address = $request->address;
        $person->phone = $request->phone;

        $person->birthday = Carbon::parse($request->cumple)->format('Y-m-d');
        $person->license_grade = $request->grado_licencia;
        $person->license_digital = $licencia;
        $person->circulation_card = $carnet;
        $person->dni_digital = $cedula;
        $person->save();
        
        $cuenta = new BankUser;
        $cuenta->dni = $request->dni;
        $cuenta->name = $request->nombre1.' '.$request->apellido1;
        $cuenta->email = $request->email;
        $cuenta->user_id = $conductor->id;
        $cuenta->bank_id = $request->banco;
        $cuenta->account_number = $request->nro_cuenta;
        $cuenta->account_type = $request->tipo_cuenta;
        $cuenta->status = "1";
        $cuenta->save();


        if ($conductor->save() && $cuenta->save()) {
            return response()->json(['result' => true, 'text' => 'El conductor ha sido registrado de manera exitosa']);
        } else {
            return response()->json(['result' => false, 'text' => 'El registro no se pudo realizar. Pedimos disculpas por los inconvenientes presentados']);
        }
    }

    public function all()
    {
        session()->forget('accessAuth');
        $empresas = User::find(Auth::user()->id);
        $conductor = Person::join('users', 'persons.user_id', 'users.id')->where('users.user_id', Auth::user()->id)->get();
        return View('content.admin.drivers')->with(['conductores' => $conductor, 'empresas' => $empresas]);
    }

    public function show(Request $request, $id)
    {
        session()->forget('accessAuth');
        $cuenta = BankUser::where('user_id', $id)->first();
        $conductor = User::join('persons', 'persons.user_id', 'users.id')->where('users.id', $id)->first();
        $vehiculos = Vehicle::select('license_plate','user_id', 'brand_id')->with([
            'marca' => function($query) {
                $query->with(['modelo']);
            }
        ])
        ->with(['user'])
        ->where('status', '1')
        ->where('registered_id', Auth::user()->id)             
        ->get();
        $bancos = Bank::get();
        $empresas = User::find(Auth::user()->id);
        
        return view('content.admin.driver')->with(['vehiculos' => $vehiculos, 'bancos' => $bancos, 'empresas' => $empresas, 'conductor' => $conductor, 'cuenta' => $cuenta]);
    }

    public function update(ConductorRequest $request, $id)
    {
        $conductor = User::find($id);
        $person = Person::where('user_id', $id)->first();
        $cuenta = BankUser::where('user_id', $id)->first();

        $url = "images/company/drivers/";

        if ($person->circulation_carnet != $request->carnet_circulacion) {
            $odlFile = $person->circulation_carnet;
            $file = $request->file('carnet_circulacion');
            $carnet = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
            $path = $url.'circulation_carnet/';
            $file->move($path, $carnet);
            if($file->getClientOriginalExtension() != "pdf") {
                ResizeImage::dimenssion($carnet, $file->getClientOriginalExtension(), $path);
            }
            File::delete(public_path($path.$odlFile));
            $person->circulation_carnet = $carnet;                       
        }

        if ($conductor->avatar != $request->foto) {
            $odlFile = $conductor->avatar;
            $file = $request->file('foto');
            $foto = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
            $path = 'avatar/';
            $file->move($path, $foto);
            if($file->getClientOriginalExtension() != "pdf") {
                ResizeImage::dimenssion($seguro, $file->getClientOriginalExtension(), $path);
            }
            File::delete(public_path($path.$odlFile));
            $conductor->avatar = $foto;
        }

        if ($person->license_digital != $request->licencia) {
            $odlFile = $person->gclicencia;
            $file = $request->file('licencia');
            $licencia = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
            $path = $url.'license/';
            $file->move($path, $licencia);
            if ($file->getClientOriginalExtension() != "pdf") {
                ResizeImage::dimenssion($seguro, $file->getClientOriginalExtension(), $path);
            }
            File::delete(public_path($path.$odlFile));
            $person->license_digital = $licencia;   
        }
        
        if ($person->dni != $request->cedula) {
            $odlFile = $person->dni;
            $file = $request->file('cedula');
            $cedula = SetNameImage::set($file->getClientOriginalName(), $file->getClientOriginalExtension());
            $file->move($url, $cedula);
            if ($file->getClientOriginalExtension() != "pdf") {
                ResizeImage::dimenssion($seguro, $file->getClientOriginalExtension(), $url);
            }
            File::delete(public_path($url.$odlFile));
            $person->dni = $cedula; 
        }

        $person->first_name = $request->nombre1;
        $person->last_name = $request->apellido1;
        
        $person->sex = $request->sex;
        $person->address = $request->address;
        $person->phone = $request->phone;
        $person->license_grade = $request->grado_licencia;

        $conductor->birthday = Carbon::parse($request->cumple)->format('Y-m-d');
        $conductor->email = $request->email;
        
        $cuenta = BankUser::where('user_id', $id)->first();
        $cuenta->name = $request->nombre1.' '.$request->apellido1;
        $cuenta->email = $request->email;
        $cuenta->user_id = $conductor->id;
        $cuenta->bank_id = $request->banco;
        $cuenta->account_number = $request->nro_cuenta;
        $cuenta->account_type = $request->tipo_cuenta;
        $cuenta->status = "1";
        $cuenta->save();

        $conductor->save();
        $cuenta->save();
        $person->save();

        return response()->json(['result' => true, 'text' => 'El conductor ha sido actualizado de manera exitosa']);
    }
    
    public function status(Request $request)
    {
        $conductor = Conductor::find($request->id);
        $conductor->gcstatus = $conductor->gcstatus == '0' ? '1' : '0';
        $conductor->save();

        $transporte = Transporte::find($conductor->gcplaca);
        $transporte->gcconductor = " ";
        $transporte->save();

        return response()->json(['result' => true, 'status' => $conductor->gcstatus]);
    }

    public function delete()
    {
    	
    }
}
