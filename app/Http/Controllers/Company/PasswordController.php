<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\PasswordRequest;
use App\User;
use Auth;

class PasswordController extends Controller
{
    public function __construct()
    {
        session()->forget('accessAuth');
    }

    public function index()
    {
        session()->forget('accessAuth');
        $empresa = User::where('id', Auth::user()->id)->first();
    	return view('content.admin.password')->with(['empresas' => $empresa]);
    }

    public function store(PasswordRequest $request)
    {
    	if ($request->password_new != $request->password_conf) {
    		return response()->json(['result' => false, 'text' => 'Disculpe las nuevas contraseñas no cohinciden']);
    	}

		$usuario = User::where('id', Auth::user()->id)->first();
 		
    	if (Hash::check($request->password_old, $usuario->password)) {
    		$usuario->password = Hash::make($request->password_new);
    	} else {
    		return response()->json(['result' => false, 'text' => 'La contraseña actual no cohincide con la contraseña ingresada. Verifique e intente de nuevo']);
    	}
    	$usuario->save();
    	return response()->json(['result' => true, 'text' => 'Su contraseña ha sido actualizada con éxito']);
    }
    
    public function auth(Request $request)
    {
        $empresa = User::where('id', Auth::user()->id)->first();
        if(Hash::check($request->gcpassword, $empresa->password_auth)) {
            session()->put('accessAuth', true);
            return response()->json([ 'result' => true, 'location' => url('/company/profile') ]);
        } else {

        }
    }

    public function configAuth(Request $request)
    {
        $empresa = User::where('id', Auth::user()->id)->first();
        $empresa->password_auth = Hash::make($request->gcpassword);
        $empresa->save();
        session()->put('accessAuth', true);
        return response()->json(['result' => true, 'location' => url('/company/profile')]);
    }
}
