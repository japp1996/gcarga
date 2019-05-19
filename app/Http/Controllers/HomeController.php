<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
    	return View('content.public.index');
    }

    public function why() {
    	return View('content.public.why');
    }

    public function how() {
    	return View('content.public.how');
    }
}
