<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Models\Codes;
use App\Mail\CodeRecoveryPassword;
use App\User;
use Hash;
use Mail;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    public function index(){
        return view('auth.passwords.email')->with(['code' => 0]);
    }
    
    public function verify_email(Request $request){
        $user = User::select(
                'email',
                'id'
            )
        ->where('email', $request->email)
        ->first();
        if(isset($user)){
            $base_pass = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890*-';
            $code = substr(str_shuffle($base_pass), 0, 6);
                $codes = new Codes;
                $codes->user_id = $user->id;
                $codes->code = $code;
                $codes->type_code = 2;
                $codes->save();
            Mail::to($user->email)->send(new CodeRecoveryPassword($codes));
            return response(['result'=>true, 'msg' => 'El Codigo se envió correctamente, revise su buzon de correo.', 'ruta' => route('verify_code')]);
        }else{
            return response(['result'=>false, 'msg' => 'El correo ingresado es incorrecto o no existe, verifique e intente nuevamente']);
        }
    }
    public function verify_code_by_input(){
        return view('auth.passwords.verify_code');
    }

    public function verify_code(Request $request){
        $code = Codes::select(
                'id',
                'user_id',
                'code',
                'type_code'
            )
            ->where('code', $request->code)
            ->where('type_code', "2")
            ->first();
        if(isset($code)){
            return response(['result'=>true, 'msg' => 'El codigo ingresado es correcto, sera redirigido en unos segundos...','ruta' => url('password/recovery/code/pw/')]);
        }else{
            return response(['result'=>false, 'msg' => 'El codigo ingresado es incorrecto, intente nuevamente']);
        }
    }
    public function verify_password_by_input($codigo){

        $users = User::join('codes', 'codes.user_id', '=', 'users.id')
            ->where('codes.code', $codigo)
            ->first();
        $users->ruta = route('verify_password');
        return view('auth.passwords.new_password')->with(['data' => $users]);
    }
    
    public function verify_password(Request $request){
        if($request->password != $request->password_confirmation){
            return response(['result'=>false, 'msg' => 'Las Claves ingresadas no son iguales']);
        }else{
            $user = User::where('id', $request->user_id)
                ->where('email', $request->email)
                ->first();
            $user->password = Hash::make($request->password);
            $user->save();
            return response(['result'=>true, 'msg' => 'Su Clave se ha recuperado y guardado exitosamente, será redirigido en unos segundos...', 'ruta' => route('login')]);
        }
    }

}
