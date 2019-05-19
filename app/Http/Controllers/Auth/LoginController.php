<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

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
use Mail;
use Auth;
use Validator;
use Hash;




class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    
    public function index() {
    	return View('content.admin.login');
    }

    public function login(Request $request) {
        $rules = [
            "email" => "required|email",
            "password" => "required"
        ];
        $attributes = [
            "email" => "correo electrónico",
            "password" => "contraseña"
        ];
        $validator = Validator::make($request->all(), $rules);
        $validator->setAttributeNames($attributes);
        //Validacion para Redireccion de Clientes-----------------
        $user_id = User::where('email', $request->email)
            ->first();
        if(isset($user_id)){
            $role = RoleUser::where('role_user.user_id', $user_id->id)
                ->first();
            if ($role->role_id == 6) {
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){      
                    return response()
                        ->json([
                            'msg' => "Hay que redirigir",
                            'url' => route("clients_view"),
                            'id' => $role->id
                            ], 422);
                }
            }
            //Fin de validacion para clientes ---------------------------
            if($validator->fails()){
                return response()->json(["error" => $validator->messages()->first()], 422);
            } else {
                $user = User::where('email', $request->email)->first();
                // AND role_user.user_id = users.id WHERE roles.id = role_user.role_id
                if(is_null($user)) {
                    return response()->json(['error' => "Usuario y/o contraseña invalido"], 422);
                }
                
                if($user->level === "Acudiente"){
                    return response()->json(["error" => "Los usuarios acudientes no pueden ingresar en esta area"], 422);
                }
                
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                    if (Auth::user()->hasRole('administrator|superadministrator')) {
                        return response()->json([
                            'result' => true,
                            'location' => url('/admin')
                        ]);
                    } else if(Auth::user()->hasRole('company')) {
                        return response()->json([
                            'result' => true,
                            'location' => url('/company')
                        ]);
                    } else if (Auth::user()->hasRole('independent')) {
                        return response()->json([
                            'result' => true,
                            'location' => url('/driver')
                        ]);
                    } 
                }
                return response()->json(['error' => "Usuario y/o contraseña invalido"], 422);
            }
        }else{
            return response()->json(["error" => 'Verifique que su correo eletrónico este escrito correctamente. No tenemos registros de este correo.'], 422);
        }
    }

    public function logout() {
        
        /*$auditoria = new Auditoria;
        $auditoria->number = Auth::user()->number;
        $auditoria->operacion = 'LOGIN';
        $auditoria->rama = 'LOGOUT';
        $auditoria->detalles_operacion = 'EL usuario '.
            Auth::user()->name.' C.I: '.
            Auth::user()->tipodoc
            .Auth::user()->number. ' Cerró Sesión';
        $auditoria->save();*/
        session()->forget('gcrif');
        Auth::logout();
        return redirect('');
    }
}
