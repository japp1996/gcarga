<header id="js-header" class="u-header u-header--sticky-top u-header--change-appearance" data-header-fix-moment="100">
	<div class="u-header__section g-bg-white-opacity-0_7 g-transition-0_3 g-py-15" data-header-fix-moment-exclude="g-bg-white-opacity-0_7" data-header-fix-moment-classes="u-shadow-v27 g-bg-white-opacity-0_9">
	  <nav class="navbar navbar-toggleable-md py-0">
	    <div class="container nav-logo-center" >
	      <!-- Logo -->
	        <img class="img-fluid u-header__logo-img u-header__logo-img--main" width="150px" src="{{asset('assets/img/logo.png') }}" alt="Image Description">
	      <!-- End Logo -->
	      <div id="navBar" class="collapse navbar-collapse w-100">
	        <!-- Navigation -->
	        <div class="navbar-collapse align-items-center flex-sm-row">
	          <ul class="navbar-nav text-uppercase g-font-weight-700 g-font-size-13 text-center g-pt-20 g-pt-0--lg gcfonttext">
	            <li class="underline nav-item g-mx-20--lg g-mb-7 g-mb-0--lg">
	              <a href="{{ url('') }}" class="nav-link g-color-blue p-0">Inicio <span class="sr-only">(current)</span></a>
	            </li>
	            <li class="underline nav-item g-mx-20--lg g-mb-7 g-mb-0--lg">
	              <a href="{{ url('why/') }}" class="nav-link p-0">¿Porqué GCARGA?</a>
	            </li>
	               <li class="underline nav-item g-mx-20--lg g-mb-7 g-mb-0--lg">
	              <a href="{{ url('how/') }}" class="nav-link p-0">¿Cómo funciona?</a>
	            </li>
	            <li class="underline nav-item g-mx-20--lg g-mb-7 g-mb-0--lg">
	              <a href="{{ url('usuario/') }}" class="nav-link p-0">Regístrate</a>
	            </li>
	            <li class="underline nav-item g-mx-20--lg g-mb-7 g-mb-0--lg">
	              <a href="{{ url('contact/') }}" class="nav-link p-0">Contácto</a>
	            </li>
	          </ul>
	        </div>
	        <!-- End Navigation -->
	        <!--a class="btn btn-lg text-uppercase u-btn-primary g-font-weight-700 g-font-size-12 g-rounded-30 g-px-40 mb-0 g-padding-bottom" href="login.html">Iniciar Sesión</a-->
	        <a href="{{ url('login/') }}" class="txt-decore">
	          <div class="gcfontlwhite g-btn-gcarga">Iniciar Sesión</div>
	        </a>
	      </div>
	      <!-- Responsive Toggle Button -->
	      <button class="navbar-toggler btn g-line-height-1 g-brd-none g-pa-0 g-mt-15 ml-auto" type="button" aria-label="Toggle navigation" aria-expanded="false" aria-controls="navBar" data-toggle="collapse" data-target="#navBar">
	        <span class="hamburger hamburger--slider">
	          <span class="hamburger-box">
	            <span class="hamburger-inner"></span>
	          </span>
	        </span>
	      </button>
	      <!-- End Responsive Toggle Button -->
	    </div>
	  </nav>
	</div>
</header>