<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactoRequest;
use App\Http\Requests\UsuarioRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Codes;
use App\Models\Transport;
use App\Models\Weight;
use App\Models\Bulk;
use App\User;
use App\Models\UserTemp;
use App\Models\RoleUser;
use App\Models\PersonTemp;
use App\Models\VehicleTemp;
use App\Models\Person;
use App\Mail\VerifyAccountMail;
use App\Mail\ContactMail;
use App\Models\Role;
use App\Models\PhoneUsers;
use App\Models\Vehicule;
use App\Models\VehiculePhoto;
use Image as Intervention;
use Auth;
use Mail;
use Validator;
use Hash;

class UsuarioController extends Controller
{
    public function index() 
    {
        return view('content.public.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'avatar' => 'required|mimes:jpeg,jpg,png',
            'first_name' => 'required_unless:type,company',
            'last_name' => 'required_unless:type,company',
            'dni' => 'required_if:type,client',
            'ruc' => 'required_unless:type,client',
            'company_name' => 'required_if:type,company',
            'password' => 'required|confirmed',
            'phone'=> 'required',
            'email' => 'required|string|email|unique:users',
            'address' => 'required_unless:type,client|min:3',
            'transport' => 'required_if:type,independent',
            'weight' => 'required_if:type,independent',
            'bulk' => 'required_if:type,independent',
            'placa' => 'required_if:type,independent',
            'photo' => 'required_if:type,independent|mimes:jpeg,jpg,png'
        ];

        $messages = [
            "required" => "El campo :attribute es indispensable.",
            "required_unless" => "El campo :attribute es indispensable.",
            "required_if" => "El campo :attribute es indispensable."
        ];

        $attributes = [
            'first_name' => 'Nombre',
            'last_name' => 'Apellido',
            'company_name' => 'Nombre de Empresa',
            'sex' => 'Sexo',
            'email' => 'Correo electrónico',
            'avatar' => 'foto de perfil - logo',
            'dni' => 'Documento de identidad',
            'ruc' => 'RIF',
            'transport' => 'Tipo de vehículo',
            'weight' => 'Carga KG',
            'bulk' => 'Volumen',
            'placa' => 'Placa del vehículo',
            'photo' => "Foto del vehíclo",
            'address' => "Dirección",
            'password_confirmation' => "confirmar contraseña"
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->setAttributeNames($attributes);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first()], 422);
        }

        $user_temp_cant_email = Usertemp::where('email', $request->email)->count();
        $user_cant_email = User::where('email', $request->email)->count();

        if($user_temp_cant_email > 0 || $user_cant_email > 0) {
            return response()->json(['error'=> 'Este correo ya se encuentra en uso'], 422);
        }

        $roles = ['company' => 3, 'independent' => 4, 'client' => 6];

        // Init: Procesar foto
        $path = 'avatars/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
        Intervention::make($request->file('avatar'))->save($path, 70);

        if($request->hasFile('photo')) {
            $path_vehicle = 'img/vehicules/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
            Intervention::make($request->file('photo'))->save($path_vehicle, 70);
        }
        // End: Procesar foto

        $user_temp = new UserTemp;
        $user_temp->name = $request->first_name != "" ? $request->first_name : $request->company_name;
        $user_temp->email = $request->email;
        $user_temp->role = $roles[$request->type];
        $user_temp->avatar = $path;
        $user_temp->password = Hash::make($request->password);
        
        $user_temp->save();

        $person_temp = new PersonTemp;
        $person_temp->user_temp_id = $user_temp->id;
        $person_temp->first_name = $request->first_name != "" ? $request->first_name : $request->company_name;
        $person_temp->last_name = $request->last_name != "" ? $request->last_name : null;
        $person_temp->sex = '0';
        $person_temp->phone = $request->phone;
        $person_temp->address = $request->address;
        if(!empty($request->dni)){
            $person_temp->dni = $request->dni;
        }else{
            $person_temp->dni = $request->ruc;
        }
        $person_temp->save();

        if ($request->type == "independent") {
            $vehicle_temp = new VehicleTemp;
            $vehicle_temp->user_temp_id = $user_temp->id;
            $vehicle_temp->transport_id = $request->transport;
            $vehicle_temp->weight_id = $request->weight;
            $vehicle_temp->bulk_id = $request->bulk;
            $vehicle_temp->license_plate = $request->placa;
            $vehicle_temp->photo = $path_vehicle;
            $vehicle_temp->save();
        }

        $base_pass = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890*-';
        $code = substr(str_shuffle($base_pass), 0, 6);

        $codes = new Codes;
        $codes->user_id = $user_temp->id;
        $codes->code = $code;
        $codes->type_code = '1';
        $codes->save();

        // $user = User::findOrFail($id);
        // $m->from('hello@app.com', 'Your Application');

        // Mail::send(new VerifyAccountMail($codes), ['user' => $user_temp], function ($m) use ($user_temp) {
        //     $m->to($user->email, $user->name)
        //         ->subject('Confirmación de correo');
        // });

        Mail::to($user_temp->email)
            ->send(new VerifyAccountMail($codes));

        return response(['result'=>true, 'msg' => 'La empresa ha sido registrada con éxito', 'user_id' => $user_temp->id]);
    }

    public function postRegister(UsuarioRequest $request) 
    {
        if ($request->password != $request->password2) {
            return response()->json(['result' => false, 'text' => 'Las contraseña no cohinciden']);
        }
        $users = new Usuario;
        $users->gcdni = $request->gcdni;
        $users->name = $request->name;
        $users->password = Hash::make($request->password);
        $users->email = $request->email;
        $users->phone = $request->phone;
        $users->tipo_user = '1';
        $users->status = '1';
        $users->save();
        
        $user = Usuario::where('gcdni', $request->gcdni)->first();
        
        $empresa = new Empresa;
        $empresa->gcrif = $request->gcdni;
        $empresa->gcid_representante = $user->id;
        $empresa->save();
        
        /*$auditoria = new Auditoria;
        $auditoria->number = $request->gcdni;
        $auditoria->operacion = 'REGISTRO';
        $auditoria->rama = 'USUARIO';
        $auditoria->detalles_operacion = 'Registro de un nuevo usuario bajo C.I: '.$users->gcdni.' ';
        $auditoria->save();*/
        return response()->json(['result' => true, 'text' => 'Registro completado']);
    }

    public function contact_view() {
    	return View('content.public.contact');
    }

    public function contact(ContactoRequest $request)
    {
        $data = array(
            'asunto' => 'CONTACTO POR WEB',
            'nombre' => $request->name,
            'phone' => $request->phone,
            'message' => $request->message
        );
        Mail::to('gcargacs@gmail.com')->send(new ContactMail($data));
        return response()->json(['result' => true, 'text' => 'El correo se ha enviado nuestro equipo de soporte al usuario se comunicará con usted lo más breve posible.']);
    }

    public function verify($codigo)
    {
        $data = Codes::where('code', $codigo);
        if ($data->count() > 0) {
            $data = $data->first();
            $user_temp = UserTemp::find($data->user_id);
            $user = new User;
            $user->name = $user_temp->name;
            $user->email = $user_temp->email;
            $user->password = $user_temp->password;
            $user->avatar = $user_temp->avatar;
            $user->save();

            $person_temp = PersonTemp::where('user_temp_id', $user_temp->id)->first();
            $person = new Person;
            $person->user_id = $user->id;
            $person->first_name = $person_temp->first_name;
            $person->last_name = $person_temp->last_name != null ? $person_temp->last_name : '';
            $person->dni = $user_temp->dni;
            $person->sex = $person_temp->sex;
            $person->address = $person_temp->address;
            $person->phone = $person_temp->phone;
            $person->save();

            $user->name = $person->first_name.' '.$person->last_name;
            $user->save();
            
            $phone_user = new PhoneUsers;
            $phone_user->phone = $person_temp->phone;
            $phone_user->user_id = $user->id;
            $phone_user->save();

            //Asigno el role al usuario
            $user->attachRole($user_temp->role);

            if ($user_temp->role == 4) {
                $vehicle_temp = VehicleTemp::where('user_temp_id', $user_temp->id)->first();
                $vehicle = new Vehicule;
                $vehicle->user_id = $user->id;
                $vehicle->transport_id = $vehicle_temp->transport_id;
                $vehicle->weight_id = $vehicle_temp->weight_id;
                $vehicle->bulk_id = $vehicle_temp->bulk_id;
                $vehicle->license_plate = $vehicle_temp->license_plate;
                $vehicle->registered_id = $user->id;
                $vehicle->price = $vehicle_temp->price;
                $vehicle->save();

                $vehicle_photo = new VehiculePhoto;
                $vehicle_photo->vehicle_id = $vehicle->id;
                $vehicle_photo->name = $vehicle_temp->photo;
                $vehicle_photo->save();
            }
            
            $data->delete();
            $user_temp->delete();
            $person_temp->delete();

            return view('login')->with(['msg' => 'Correo electrónico confirmado con éxito', 'url' => url('login')]);
        } else {
            return view('errors.404');
        }
    }

}