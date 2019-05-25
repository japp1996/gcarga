<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmpresaRequest;
use Image as Intervention;
use App\User;
use App\Models\Person;
use App\Libraries\SetNameImage;
use App\Libraries\ResizeImage;
use Auth;
use File;

class ProfileController extends Controller
{
    public function index() {
        $empresas = User::join('persons', 'persons.user_id', 'users.id')
        ->where('users.id', Auth::user()->id)
        ->first();
       	return view('content.admin.company')->with(['empresas' => $empresas]);
    }

    public function store(EmpresaRequest $request) {
        // Images
        $empresa = Person::where('user_id', Auth::user()->id)->first();
        
        $cedula = $empresa->dni;
        $seguro = $empresa->asurance_charge;
        $acta = $empresa->act_const;
        $registro = $empresa->register;

        // Init: Procesar foto
        if ($empresa->dni_digital == null ) {
            if($request->hasFile('cedula')) {
                $cedula = 'images/company/dni/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
                Intervention::make($request->file('cedula'))->save($cedula, 70);
            }
        }
        if ($empresa->asurance_charge  == null ) {
            if($request->hasFile('seguro')) {
                $seguro = 'images/company/asurance/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
                Intervention::make($request->file('seguro'))->save($seguro, 70);
            }
        }
        if ( $empresa->act_const  == null ) {
            if($request->hasFile('acta')) {
                $acta = 'images/company/act/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
                Intervention::make($request->file('acta'))->save($acta, 70);
            }
        }
        if ($empresa->register  == null ) {
            if($request->hasFile('registro')) {
                $registro = 'images/company/act/'.substr(str_replace(array('/','.'),array('',''),bcrypt(strtotime(date('Y-m-d H:i:s')))),7,32).'.jpg';
                Intervention::make($request->file('registro'))->save($registro, 70);
            }
        }
        // End: Procesar foto 
        
        $empresa->first_name = $request->nombre;
        $empresa->last_name = $request->nombre;
        $empresa->max_vehicle = $request->max_transp;
        $empresa->address = $request->ubicacion;
        $empresa->phone = $request->telefono;
        $empresa->dni_digital = $cedula;
        $empresa->asurance_charge = $seguro;
        $empresa->act_const = $acta;
        $empresa->register = $registro;
        $empresa->save();

        $user = User::find(Auth::user()->id);
        $user->email = $request->email;
        $user->valoration = 0;
        $user->save();

        
        /*$auditoria = new Auditoria;
        $auditoria->number = $request->number;
        $auditoria->operacion = 'REGISTRO';
        $auditoria->rama = 'USUARIO';
        $auditoria->detalles_operacion = 'Registro de un nuevo usuario bajo C.I: '.$users->number.' ';
        $auditoria->save();*/
        return response()->json(['result' => true, 'text' => 'Registro completado']);
    }

    public function passAuth()
    {
        
    }

}
