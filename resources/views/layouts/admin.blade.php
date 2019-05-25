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
    <link href="{{ asset('css/prism.css') }} " rel="stylesheet">
    <link href="{{ asset('css/ghpages-materialize.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    
  <body cz-shortcut-listen="true">
    <header>
      <nav class="top-nav">
        <div class="container-fluid">
          <div class="nav-wrapper">
            <div class="row">
              <div class="col s12 m10 offset-m1">
                <h1 class="header">
                  @yield('text')
                </h1>
              </div>
            </div>
          </div>
        </div>
      </nav>
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
      <div></div>
      <div class="container">
        @yield('content')
      </div>
      <div id="modal1" class="modal">
        
          @if(Auth::user()->password_auth == null)
            <form  onsubmit="configAuth(event)">  
          @else
            <form  onsubmit="accessAuth(event)">
          @endif()
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
              <button type="submit" class="waves-effect waves-green btn btn-flat" >Aceptar</a>
          </div>
        </form>
      </div>
    </main>
    
    <footer class="page-footer docs-footer"></footer>

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
    {{--<script type="text/javascript" src="{{ asset('js/materialize.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/init.js') }} "></script>--}}
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

    <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function() {
        var instances = M.Modal.init(document.querySelectorAll('#modal1'));
        var instances = M.Dropdown.init(document.querySelectorAll('.dropdown-trigger'));
      });
      
      function showPassword(pass,eye) {
        if ($('#'+pass).attr('type') == 'password') {
          $('#'+pass).attr('type', 'text')
          $('#'+eye).removeClass('fa-eye')
          $('#'+eye).addClass('fa-eye-slash')
        } else {
         $('#'+pass).attr('type', 'password')
          $('#'+eye).removeClass('fa-eye-slash')
          $('#'+eye).addClass('fa-eye')
        }
      }

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