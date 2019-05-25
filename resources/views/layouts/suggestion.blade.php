<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a modern responsive CSS framework based on Material Design by Google. ">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title>
      @yield('title') | GCARGA
    </title>
    <!-- Favicons-->
    <meta name="msapplication-TileColor" content="#FFFFFF">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--  Android 5 Chrome Color-->
    <meta name="theme-color" content="#EE6E73">
    <!-- CSS-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" >
    <link href="{{ asset('css/prism.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/ghpages-materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet" >
  <body cz-shortcut-listen="true">
    <header>
      <div class="container">
        <a href="" data-target="nav-mobile" class="top-nav sidenav-trigger full hide-on-large-only">
          <i class="material-icons">
            menu
          </i>
        </a>
      </div>
      @include('partials.header-left')
    </header>
    
    <main id="app">
      <div class="container-fluid">
        @yield('content')
      </div>
      <div id="modal1" class="modal">
        <form>
          <div class="modal-content">
            <h4>Contraseña de autorización</h4>
            @if(Auth::user()->password_auth == null) 
              <p>Configure su contraseña de seguridad. Ya que ésta le servirá para acceder los datos de su empresa.</p>
            @else
              <p>Para acceder a los datos de su empresa debe ingresar su clave</p>
            @endif()
            <div class="input-field">
              <input type="password" autocomplete="off" id="passwordAuthCompany" class="col s12 m12">
              <label for="passwordAuthCompany">Ingrese la Contraseña</label>
            </div>
          </div>
          <div class="modal-footer">
            @if(Auth::user()->password_auth == null)
              <a href="#!" class="waves-effect waves-green btn btn-flat" @click="configAuth()">Aceptar</a>
            @else
              <a href="#!" class="waves-effect waves-green btn btn-flat" @click="accessAuth()">Aceptar</a>
            @endif()
          </div>
        </form>
    </div>
    </main>

    <!--  Scripts-->
    <script type="text/javascript" src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script type="text/javascript">
      if (!window.jQuery) { 
        document.write('<script src="bin/jquery-3.2.1.min.js"><\/script>'); 
      }
    </script>
    <script type="text/javascript" src="{{ asset('js/jquery.timeago.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/prism.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/lunr.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/search.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/materialize.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/init.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript">
      $('#editProfile').click(function(){
        $('#modal1').modal('open')
      })

      function accessAuth(e) {
          e.preventDefault()
          let pass = document.getElementById("passwordAuthCompany").value
          axios.post("company/passwordCompany", {'gcpassword': pass})
          .then(response => {
            if (response.data.result) {
              $('#modal1').modal('close')
                window.location = response.data.location
            } else {
              swal("Atención", "Usted ha ingresado una contraseña inválida", "info")
            }
          })
          .catch(error => {
            swal("Disculpe, ha habido un problema técnico. Pedimos disculpas por las molestias ocasionadas")
          })
  
        }
  
        function configAuth(e) {
          e.preventDefault()
          let pass = document.getElementById("passwordAuthCompany").value
          axios.post("company/passwordConfig", {'gcpassword': pass})
          .then(response => {
            if (response.data.result) {
              $('#modal1').modal('close')
              window.location = response.data.location
            } else {
              swal("Atención", "Usted ha ingresado una contraseña inválida", "info")
            }
          })
          .catch(error => {
            swal("Disculpe, ha habido un problema técnico. Pedimos disculpas por las molestias ocasionadas")
          })
        }
    </script>
</body>
</html>