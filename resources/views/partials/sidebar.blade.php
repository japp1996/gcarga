<header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
  <div class="mdl-layout__header-row">
    <span class="mdl-layout-title">GCARGA</span>
    <div class="mdl-layout-spacer"></div>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
      <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
        <i class="material-icons">search</i>
      </label>
      <div class="mdl-textfield__expandable-holder">
        <input class="mdl-textfield__input" type="text" id="search">
        <label class="mdl-textfield__label" for="search">¿Qué buscas?</label>
      </div>
    </div>
    <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
      <i class="material-icons">more_vert</i>
    </button>
    <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
      <li class="mdl-menu__item"><a href="{{ url('logout') }}">Cerrar Sesión</a></li>
    </ul>
  </div>
</header>
<div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
  <header class="demo-drawer-header">
    <img src="{{ asset('img/logo.png') }}" style="height:auto;width:100%" class="demo-avatar">
    <div class="demo-avatar-dropdown">
      <span>gcargacs@gmail.com</span>
      <div class="mdl-layout-spacer"></div>
      <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
        <i class="material-icons" role="presentation">arrow_drop_down</i>
        <span class="visuallyhidden">Accounts</span>
      </button>
      <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
        <li class="mdl-menu__item"><a href="#modal1">Editar Perfil</a></li>
        <li class="mdl-menu__item"><a href="{{ url('admin/password') }}">Cambiar Contraseña</a></li>
        <!--li class="mdl-menu__item"><i class="material-icons">Añadir</i>Add another account...</li-->
      </ul>
    </div>
  </header>
  <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
    <a class="mdl-navigation__link" href="">
      <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>GCARGA</a>
    <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">attach_money</i>Tarifas Rutas</a>
    <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">highlight</i>Planificador</a>
    <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">account_balance</i>Estado de Cuenta</a>
    <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">bar_chart</i>Estadisticas</a>
    <a class="mdl-navigation__link" href="{{ url('admin/vehicule') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">time_to_leave</i>Vehiculos</a>
    <a class="mdl-navigation__link" href="{{ url('admin/driver') }}"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">perm_identity</i>Conductores</a>
    <div class="mdl-layout-spacer"></div>
    <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
  </nav>
</div>