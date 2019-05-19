<ul id="nav-mobile" class="sidenav sidenav-fixed" style="transform: translateX(0px);">
        <li class="logo">
          <a id="logo-container" href="" class="brand-logo">
            <img src="{{ asset('img/logo.png') }}" width="60%" alt="">
          </a>
        </li>
        <li class="version">
          <a href="#" data-target="version-dropdown" data-activates='version-dropdown' class="dropdown-trigger">
            {{ Auth::user()->name }}
            <svg class="caret" height="24" viewBox="0 0 24 24" width="24" xmlns="">
              <path d="M7 10l5 5 5-5z"></path>
              <path d="M0 0h24v24H0z" fill="none"></path>
            </svg>
          </a>
          <ul id="version-dropdown" class="dropdown-content" tabindex="0">
            @if(Auth::user()->hasRole('company'))
            <li tabindex="0"><a href="{{ url('company/password') }}">Contraseña</a></li>
            @endif
            {{--<li id="selectCompany">
              <a class="modal-trigger" href="#modalCompany">
                Empresa
              </a>
            </li>--}}
            <li id="editProfile">
              <a class="modal-trigger" href="#modal1">
                Editar Perfil
              </a>
            </li>
            <li tabindex="0"><a href="{{ url('logout') }}">Cerrar Sesión</a></li>
          </ul>
        </li>
        <li class="search">
          <div class="search-wrapper">
            <input id="search" placeholder="Buscar">
              <i class="material-icons">search</i>
            <div class="search-results"></div>
          </div>
        </li>
        @if(Auth::user()->hasRole('company'))
        <div class="side-bar-gray">
          <li class="bold">
            <a href="{{ url('company/vehicles') }}" class="waves-effect waves-teal">Vehículos</a>
          </li>
          <li class="bold">
            <a href="{{ url('company/drivers') }}" class="waves-effect waves-teal">Conductores</a>
          </li>
        </div>
        @else
        @endif
        
        {{--<li class="no-padding">
          <ul class="collapsible collapsible-accordion">
            <li class="bold">
              <a class="collapsible-header waves-effect waves-teal" tabindex="0">Tarifa de Ruta</a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="">Item 1</a></li>
                  <li><a href="">Item 2</a></li>
                  <li><a href="">Item 3</a></li>
                  <li><a href="">Item 4</a></li>
                  <li><a href="">Item 5</a></li>
                  <li><a href="">Item 6</a></li>
                  <li><a href="">Item 7</a></li>
                  <li><a href="">Item 8</a></li>
                  <li><a href="">Item 9</a></li>
                  <li><a href="">Item 10</a></li>
                </ul>
              </div>
            </li>
            <li class="bold">
              <a class="collapsible-header waves-effect waves-teal" tabindex="0">Components</a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="">Badges</a></li>
                  <li><a href="">Buttons</a></li>
                  <li><a href="">Breadcrumbs</a></li>
                  <li><a href="">Cards</a></li>
                  <li><a href="">Collections</a></li>
                  <li><a href="">Floating Action Button</a></li>
                  <li><a href="">Footer</a></li>
                  <li><a href="">Icons</a></li>
                  <li><a href="">Navbar</a></li>
                  <li><a href="">Pagination</a></li>
                  <li><a href="">Preloader</a></li>
                </ul>
              </div>
            </li> 
            <li class="bold">
              <a class="collapsible-header waves-effect waves-teal" tabindex="0">JavaScript</a>
              <div class="collapsible-body">
                <ul>
                  <li><a href="">Auto Init</a></li>
                  <li><a href="">Carousel</a></li>
                  <li><a href="">Collapsible</a></li>
                  <li><a href="">Dropdown</a></li>
                  <li><a href="">FeatureDiscovery</a></li>
                  <li><a href="">Media</a></li>
                  <li><a href="">Modals</a></li>
                  <li><a href="">Parallax</a></li>
                  <li><a href="">Pushpin</a></li>
                  <li><a href="">Scrollspy</a></li>
                  <li><a href="">Sidenav</a></li>
                  <li><a href="">Tabs</a></li>
                  <li><a href="">Toasts</a></li>
                  <li><a href="">Tooltips</a></li>
                  <li><a href="">Waves</a></li>
                </ul>
              </div>
            </li>
            <li class="bold active">
              <a class="collapsible-header waves-effect waves-teal" tabindex="0">Forms</a>
              <div class="collapsible-body" style="display: block;">
                <ul>
                  <li><a href="">Autocomplete</a></li>
                  <li><a href="">Checkboxes</a></li>
                  <li><a href="">Chips</a></li>
                  <li><a href="">Pickers</a></li>
                  <li><a href="">Radio Buttons</a></li>
                  <li><a href="">Range</a></li>
                  <li><a href="">Select</a></li>
                  <li><a href="">Switches</a></li>
                  <li class="active"><a href="">Text Inputs</a></li>
                </ul>
              </div>
            </li>
            
          </ul>
        </li>--}}
        {{--
        <li class="bold">
          <a href="" class="waves-effect waves-teal">Mobile</a>
        </li>
        <li class="bold">
          <a href="" class="waves-effect waves-teal">Showcase</a>
        </li>
        <li class="bold">
          <a href="" class="waves-effect waves-teal">Themes</a>
        </li>--}}
      </ul>