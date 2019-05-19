<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    
    Route::group(['prefix' => '/'], function () {
        Route::get('', 'HomeController@index');
        //Quienes Somos
        Route::get('/why', 'HomeController@why');
        //Productos
        Route::get('/how', 'HomeController@how');

        Route::get('/usuario', 'UsuarioController@index');
        Route::post('/usuario', 'UsuarioController@store');
        //Contáctanos
        Route::get('/contact', 'UsuarioController@contact_view');
        Route::post('/contact', 'UsuarioController@contact');
        
        Route::any('/verify/{codigo}','UsuarioController@verify');

        // PAYPAL
        Route::get('paypal/pay', 'PaypalController@pay');
        Route::get('paypal/status',  ['as' => 'paypal.status', 'uses' => 'PaypalController@status']);
        Route::get('paypal/form', function () { return view('pay.form'); });
        Route::get('paypal/success', function () { return view('pay.success'); });
        Route::get('paypal/cancel', function () { return view('pay.cancel'); });
        Route::get('paypal/error', function () { return view('pay.error'); });

        //Login
        Route::get('/login', 'Auth\LoginController@index')->name('login');
        Route::post('/login', 'Auth\LoginController@login');
        
        //Logout
        Route::get('/logout', 'Auth\LoginController@logout');        

        //Olvido contraseña
        Route::get('password/recovery', 'Auth\ResetPasswordController@index')->name('password_recovery');
        Route::post('password/recovery/send', 'Auth\ResetPasswordController@verify_email')->name('verify_code');
        Route::get('password/recovery/code', 'Auth\ResetPasswordController@verify_code_by_input')->name('verify_code');
        Route::post('password/recovery/code/send', 'Auth\ResetPasswordController@verify_code')->name('verify_code_send');
        Route::get('password/recovery/code/pw/{codigo}', 'Auth\ResetPasswordController@verify_password_by_input')->name('pw_recovery');
        Route::post('password/recovery/password/save', 'Auth\ResetPasswordController@verify_password')->name('verify_password');

    });

    Route::group(['prefix'=>'admin', 'namespace'=> 'Admin', 'middleware' => ['auth', 'role:superadministrator|administrator']], function() {

    });

    Route::group(['prefix'=>'company', 'namespace' => 'Company', 'middleware'=>['auth', 'role:company']], function() {
        
        //Sugerencias Diarias
        Route::resource('/', 'IndexController');
        
        //Perfil
		Route::get('/profile', 'ProfileController@index')->middleware('auth.pass');
		Route::post('/profile', 'ProfileController@store');
		
		Route::post('/selectCompany', 'EmpresaController@store');
		
			
		//Vehiculos
		Route::resource('/vehicle', 'VehicleController');
		Route::get('/vehicles', 'VehicleController@all');
		Route::post('/vehicles/status', 'VehicleController@status');
		Route::post('/vehiclesModel', 'VehicleController@modelo');
		Route::post('/vehicles/vehiclesModel', 'VehicleController@modelo');

		//Conductor
		Route::resource('/driver', 'DriverController');
		Route::get('/drivers', 'DriverController@all');
		Route::post('/drivers/{id}', 'DriverController@update');
        Route::post('/drivers/status', 'DriverController@status');
        
		//Contraseña
		Route::get('/password', 'PasswordController@index');
		Route::post('/password', 'PasswordController@store');
		Route::post('/passwordCompany', 'PasswordController@auth');
		Route::post('/passwordConfig', 'PasswordController@configAuth');

    });

    Route::group(['prefix'=>'client', 'namespace' => 'Client', 'middleware'=>['auth', 'role:client']], function() {

    });

    Route::group(['prefix'=>'driver', 'namespace'=>'Company', 'middleware'=>['auth','role:independent']], function(){

    });
