<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class IndexController extends Controller
{
	public function __construct()
    {
        session()->forget('accessAuth');
    }
    
    public function index()
    {
        session()->forget('accessAuth');
        if (Auth::user()->hasRole('company')){
            $empresas = User::where('id', Auth::user()->id)->first();
        } else {
            $empresas = User::where('user_id', Auth::user()->user_id)->first();
        }
    	return view('content.admin.suggestion')->with(['empresas' => $empresas]);
    }
}
