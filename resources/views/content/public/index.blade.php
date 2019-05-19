@extends('layouts.public')
@section('title', 'Inicio')
@section('content')
 <section id="flex" class="flexslider">
   <ul class="slides">
       <li class="slide-li" style="background-size:100%;background-image:url({{ url('assets/img-temp/1000x500/carousel1.jpg') }});background-attachment: fixed;width: 1000px;height: 100vh;">
         <h2 class="g-font-weight-700 g-font-size-50 g-font-size-36--md g-color-white g-mb-20">
           <span class=" g-font-size-50--md g-font-size-50">Un servicio adaptado a sus 
           <br>necesidades, pensamos en todo.</span>
         </h2>
       </li>
       <li class="slide-li" style="background-size:100%;background-image:url({{ url('assets/img-temp/1000x500/carousel2.jpg') }});background-attachment: fixed;width: 1000px;height: 100vh;">
         <h2 class="g-font-weight-700 g-font-size-50 g-font-size-50--md g-color-white g-mb-20">Obtenga un servicio personalizado
           <br> Lleva tus cargas simple y rápido
         </h2>
       </li>
       <li class="slide-li" style="background-size:100%;background-image:url({{ url('assets/img-temp/1000x500/carousel3.jpg') }});background-attachment: fixed;width: 1000px;height: 100vh;">
         <h2 class="g-font-weight-700 g-font-size-50 g-font-size-50--md g-color-white g-mb-20">De principio a fin
           <br> un viaje de confianza
       </li>
       <li class="slide-li" style="background-size:100%;background-image:url({{ url('assets/img-temp/1000x500/carousel4.jpg') }});background-attachment: fixed;width: 100%;height: 100vh;">
         </h2>
         <h2 class="g-font-weight-700 g-font-size-50 g-font-size-50--md g-color-white g-mb-20">
         En cada viaje tu calificación ayuda a mejorar el servicio!
         </h2>
       </li>
   </ul>
 </section>
<!-- Main Banner -->
 <!--section id="inicio" class="js-carousel g-overflow-hidden g-max-height-100vh"
          data-autoplay="1"
          data-infinite="1"
          data-pagi-classes="u-carousel-indicators-v29 container text-center text-uppercase g-absolute-centered--x g-bottom-50 g-line-height-1_2 g-font-weight-600 g-font-size-11 g-color-white g-bg-black-opacity-0_1--after">
   <div class="js-slide"
        data-title="">
     <!-- Promo Block ->
     <div class="g-flex-centered g-height-100vh g-min-height-500--md g-bg-cover g-bg-pos-center g-bg-img-hero g-bg-black-opacity-0_5--after" style="background-attachment: fixed;background-image: url(assets/img-temp/1900x1265/img1.jpg);">
       <div class="container text-center g-z-index-1">
         <h2 class="g-font-weight-700 g-font-size-50 g-font-size-36--md g-color-white g-mb-20"><span class=" g-font-size-50--md g-font-size-50">Un servicio adaptado a sus necesidades, pensamos en todo.</span>
         </h2>
          <h3 class="hidden-xs-down g-max-width-645 g-color-white-opacity-0_9 mx-auto g-mb-35 "> </h3>
 </p>
       </div>
     </div>
     <!-- End Promo Block ->
   </div>
   <div class="js-slide"
        data-title="">
     <!-- Promo Block ->
     <div class="g-flex-centered g-height-100vh g-min-height-500--md g-bg-cover g-bg-pos-center g-bg-img-hero g-bg-black-opacity-0_4--after" style="background-attachment: fixed;background-image: url(assets/img-temp/1900x1265/200.png);">
       <div class="container text-center g-z-index-1">
         <h2 class="g-font-weight-700 g-font-size-50 g-font-size-50--md g-color-white g-mb-20">Obtenga un servicio personalizado
           <br> Lleva tus cargas simple y rápido
         </h2>
       </div>
     </div>
     <!-- End Promo Block ->
   </div>
   <div class="js-slide"
        data-title="">
     <!-- Promo Block ->
     <div class="g-flex-centered g-height-100vh g-min-height-500--md g-bg-cover g-bg-pos-center g-bg-img-hero g-bg-black-opacity-0_4--after" style="background-attachment: fixed;background-image: url(assets/img-temp/1900x1265/img3.jpg);">
       <div class="container text-center g-z-index-1">
         <h2 class="g-font-weight-700 g-font-size-50 g-font-size-50--md g-color-white g-mb-20">De principio a fin
           <br> un viaje de confianza
         </h2>
           <h3 class="hidden-xs-down g-max-width-645 g-color-white-opacity-0_9 mx-auto g-mb-35 "></h3>
         <!--a class="btn btn-lg u-btn-primary g-font-weight-600 g-font-size-13 text-uppercase g-rounded-50 g-px-25 g-py-15" href="login.html">Inicia ya!</a->
           <a href="login.html" class="txt-decore"><div class="gcfontlwhite g-btn-gcarga">Iniciar ya!</div></a>
       </div>
     </div>
     <!-- End Promo Block ->
   </div>
   <div class="js-slide"
        data-title="">
     <!-- Promo Block ->
     <div class="g-flex-centered g-height-100vh g-min-height-500--md g-bg-cover g-bg-pos-center g-bg-img-hero g-bg-black-opacity-0_4--after" style="background-attachment: fixed;background-image: url(assets/img-temp/1900x1265/img4.jpg);">
       <div class="container text-center g-z-index-1">
         <h2 class="g-font-weight-700 g-font-size-50 g-font-size-50--md g-color-white g-mb-20">
         En cada viaje tu calificación ayuda a mejorar el servicio!
         </h2>
       </div>
       <!-- End Promo Block ->
     </div>
 </section>
 <!-- End Main Banner -->
<!-- Section Content -->

 <section id="clientes">
   <div class="container-fluid">
     <div class="row text-center text-md-left">
       <div class="col-lg-4 g-theme-bg-blue-dark-v1 px-0">
         <img class="img-fluid" src="{{ url('assets/img-temp/800x869/img1.jpg') }} " alt="Image description">
         <div class="g-py-50 g-px-15 g-pa-50--md">
           <h3 class="text-uppercase g-font-weight-700 g-font-size-16 g-color-white g-mb-15 gcfonttext">Logística e Inspección</h3>
           <p class="mb-0 g-color-white g-font-size-14 gcfonttext">Antes tenías que pagar  por los tiempos muertos de un transporte, eso es cosa del pasado, ahora conocer cuando y donde estará disponible un vehículo te permitirá planificarte ahorrando tiempo y dinero.</p>
         </div>
       </div>
       <div class="col-md-6 col-lg-4 g-flex-centered g-theme-bg-gray-light-v2 px-0">
         <div class="g-py-50 g-px-15 g-pa-50--md">
           <h2 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-30 g-mb-30 gcfonttext">Transporte Terrestre</h2>
           <p class="g-mb-30 g-color-black g-font-size-15 gcfonttext">GCARGA ofrece una respuesta rápida y sencilla a la necesidad de envíos de carga terrestre. Afíliate y disfruta las ventajas de estar conectado  en tiempo real  y conocer  todo el trayecto de tu carga  y  siempre a la mejor tarifa del país.</p>
         </div>
       </div>
       <div class="col-md-6 col-lg-4 g-theme-bg-mustard-dark-v1 px-0">
         <div class="g-theme-bg-mustard-dark-v4--hover g-brd-bottom g-theme-brd-mustard-dark-v2 g-py-50 g-px-15 g-pa-50--md g-transition-0_2 g-transition--ease-in">
           <h3 class="text-uppercase g-font-weight-700 g-font-size-16 g-color-white g-mb-15 gcfonttext">Experiencia en Logística</h3>
           <p class="mb-0 g-color-white g-font-size-14 gcfonttext">Combinamos el  transporte  y  la distribución de carga con la tecnología, para ofrecerle un  servicio justo a tiempo, esencial en el complicado mundo de la logística.</p>
           <br/>
         </div>
         <div class="g-theme-bg-mustard-dark-v4--hover g-brd-bottom g-theme-brd-mustard-dark-v2 g-py-50 g-px-15 g-pa-50--md g-transition-0_2 g-transition--ease-in">
           <h3 class="text-uppercase g-font-weight-700 g-font-size-16 g-color-white g-mb-15 gcfonttext">Procura y Asesoramiento</h3>
           <p class="mb-0 g-color-white g-font-size-14 gcfonttext">Tenemos la experiencia  y el conocimiento para asesorar a nuestros clientes y socios comerciales. cumpliendo con el objetivo y compromiso de apoyar.</p>
           <br/>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- End Section Content -->
  <!-- Main Banner -->
 <section id="howitwork" class="u-bg-overlay g-flex-centered g-min-height-100vh g-bg-img-hero g-py-80" style="background-attachment: fixed;background-image:url({{ url('assets/img-temp/1200x960/img5.jpg') }});">
   <div class="container text-center u-bg-overlay__inner">
     <h1 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-50 g-color-white g-mb-20">¿Cómo uso GCARGA?</h1>
     <h3 class="hidden-xs-down g-max-width-645 g-color-white-opacity-0_9 mx-auto g-mb-35 "> Sigue los siguientes pasos, es fácil y efectivo.</h3>
     <!--a href="#transportistas" class="btn btn-xl btn-primary text-uppercase g-font-weight-700 g-font-size-12  g-color-white  g-rounded-50 g-py-15 g-px-40 g-mb-15 g-mr-30--md">Aprender</a-->
     <a href="#transportistas" class="txt-decore">
       <div class="gcfontlwhite g-btn-gcarga">Aprender</div>
     </a>
     <div class="hidden-md-up"></div>
     </a>
   </div>
 </section>
 <!-- End Main Banner -->
 <!-- Section Content -->

 <section id="transportistas" class="g-pt-50">
   <div class="text-center g-mb-60">
     <div class="container g-max-width-770">
       <h2 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-30 g-mb-30 gcfonttext">Transportistas</h2>
       <p class="mb-0 g-color-black gcfonttext">Cuando quieras ganar dinero, Inicia sesión en GCARGA y comenzarás a recibir pedidos de viajes. Obtendrás información sobre el usuario e indicaciones para llegar a su ubicación y destino. Cuando termine el viaje, recibirás otro pedido de una ubicación cercana. Y si necesitas descansar, puedes desconectarte cuando quieras.</p>
     </div>
   </div>
   <!-- Dynamic Process -->
   <div class="js-carousel g-pb-50 g-pb-0--md g-pt-130--md"
        data-infinite="1"
        data-pagi-classes="u-carousel-indicators-v6 text-center g-width-780--md">
     <div class="js-slide"
          data-title="Genera ganancias">
       <div class="row mx-0">
         <div class="col-md-6 text-center text-md-left g-theme-bg-blue-dark-v1 g-color-white g-py-50 g-py-100--md g-px-15 g-px-50--md" style="height: 380px;">
           <h3 class="text-uppercase g-font-weight-700 g-font-size-default g-color-white g-mb-25">Genera ganancias</h3>
           <p class="g-mb-30 g-color-white gcfonttext">Las tarifas de los viajes comienzan con un monto base, que luego aumenta según el tiempo y la distancia. Cuando la demanda es superior a lo normal, los conductores ganan más.
           Puedes conducir y ganar todo lo que quieras. Entre más conduzcas, más ganarás. Además, recibirás tu ganancias semanalmente y las tarifas se depositarán de manera automática.</p>
         </div>
         <div class="col-md-6 g-min-height-360 g-bg-img-hero g-px-0"
              style="background-image:url({{url('assets/img-temp/1200x960/img3.jpg')}})">
         </div>
       </div>
     </div>
     
     <div class="js-slide"
          data-title="Fija tu propio horario">
       <div class="row mx-0">
         <div class="col-md-6 text-center text-md-left g-theme-bg-mustard-dark-v1 g-color-white g-py-50 g-py-100--md g-px-15 g-px-50--md" style="height: 380px;">
           <h3 class="text-uppercase g-font-weight-700 g-font-size-default g-color-white g-mb-25">Fija tu propio horario</h3>
           <p class="g-mb-30 g-color-white gcfonttext">Puedes conducir cuando quieras, día y noche, los 365 días del año. Tú decides cuándo conducir para que nunca te pierdas las cosas importantes en tu vida.</p>
           <p class="g-mb-30 g-color-white gcfonttext">
           No hay oficina ni jefe. Lo que significa que siempre podrás comenzar y parar según tu tiempo. Con <strong>GCARGA</strong>, tú decides.</p>
         </div>
         <div class="col-md-6 g-min-height-360 g-bg-img-hero g-px-0"
              style="background-image:url({{url('assets/img-temp/1200x960/img5.jpg')}})"></div>
       </div>
     </div>
     <div class="js-slide" data-title="Deja que GCARGA guíe el camino">
       <div class="row mx-0">
         <div class="col-md-6  text-center text-md-left g-theme-bg-blue-dark-v1 g-color-white g-py-50 g-py-100--md g-px-15 g-px-50--md" style="height: 380px;">
           <h3 class="text-uppercase g-font-weight-700 g-font-size-default g-color-white g-mb-25 ">Deja que GCARGA guíe el camino</h3>
           <p class="g-mb-30 g-color-white gcfonttext">Te daremos indicaciones detalladas, herramientas para ayudarte a incrementar tus ganancias y soporte las 24 horas. Regístrate hoy y estarás al volante muy pronto. No esperes para comenzar a ganar excelente dinero con tu auto.</p>
           <a class="text-uppercase btn btn-xl g-btn-gcarga g-font-weight-700 g-font-size-13" href="{{ url('register/') }}">
             <span class="hidden-xs-down">Regístrate ahora</span>
           </a><br>
         </div>
         
         <div class="col-md-6 g-min-height-360 g-bg-img-hero g-px-0"
              style="background-image: url({{url('assets/img-temp/1200x960/img6.jpg')}})"></div>
       </div>
     </div>
   </div>
   <!-- End Dynamic Process -->
 </section>
 <!-- End Section Content -->
 <!-- Section Content -->
 <section id="contacto" class="text-center g-color-gray-dark-v5 g-py-70">
   <div class="container g-max-width-770">
     <div class="u-heading-v8-2 g-mb-80">
       <h2 class="h1 text-uppercase u-heading-v8__title g-font-weight-700 g-font-size-26 g-color-gray-dark-v2 g-mb-25 gcfonttext">Contáctanos</h2>

       <p class="mb-0 g-color-black gcfonttext">Gracias por visitar nuestro sitio. Por favor, siéntase libre de usar cualquiera de la información de contácto más abajo para comunicarse con nosotros.</p>
     </div>

             <!-- Icon Blocks -->
   <div class="row no-gutters u-shadow-v21 g-mt-minus-80">
     <div class="col-sm-6 col-md-4 g-brd-right--md g-brd-gray-light-v4">
       <!-- Icon Blocks -->
       <div class="g-bg-white text-center g-py-100">
         <span class="fa fa-map fa-7x g-color-primary mb-3">
           <i class="icon-real-estate-027 u-line-icon-pro"></i>
         </span>
         <h4 class="h5 g-font-weight-600 g-mb-5 gcfonttext">Dirección</h4>
         <span class="d-block g-color-black gcfonttext">61 Oxford str., London, 3DG</span>
       </div>
       <!-- End Icon Blocks -->
     </div>

     <div class="col-sm-6 col-md-4 g-brd-right--md g-brd-gray-light-v4">
       <!-- Icon Blocks -->
       <div class="g-bg-white text-center g-py-100">
         <span class="fa fa-phone fa-7x g-color-primary mb-3">
           <i class="icon-electronics-005 u-line-icon-pro"></i>
         </span>
         <h4 class="h5 g-font-weight-600 g-mb-5 gcfonttext">Teléfono</h4>
         <span class="d-block g-color-black gcfonttext">+58-414-555-5555</span>
       </div>
       <!-- End Icon Blocks -->
     </div>
     <div class="col-sm-6 col-md-4 g-brd-right--md g-brd-gray-light-v4">
       <!-- Icon Blocks -->
       <div class="g-bg-white text-center g-py-100">
         <span class="fa fa-envelope fa-7x g-color-primary mb-3">
          <i class="icon-communication-062 u-line-icon-pro"></i>
        </span>
         <h4 class="h5 g-font-weight-600 g-mb-5 gcfonttext">Email</h4>
         <span class="d-block g-color-black gcfonttext">gcargacs@gmail.com</span>
       </div>
       <!-- End Icon Blocks -->
     </div>
   </div>
   <!-- End Icon Blocks -->
       </div>
 </section>
 <!-- End Section Content -->
@endsection()	

@section('script')
    <!-- JS Global Compulsory -->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/jquery.easing/js/jquery.easing.js')}}"></script>
    <script src="{{asset('assets/vendor/tether.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/bootstrap.min.js')}}"></script>    
    <!-- JS Implementing Plugins -->
    <script src="{{asset('assets/vendor/smoothScroll.js')}}"></script>
    <script src="{{asset('assets/vendor/appear.js')}}"></script>
    <script src="{{asset('assets/vendor/slick-carousel/slick/slick.js')}}"></script>
    <!-- JS Unify -->
    <script src="{{asset('assets/js/hs.core.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.header.js')}}"></script>
    <script src="{{asset('assets/js/helpers/hs.hamburgers.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.scroll-nav.js')}}"></script>
    <script src="{{asset('assets/js/helpers/hs.height-calc.js')}}"></script>
    <script src="{{asset('assets/js/components/hs.carousel.js')}}"></script>
    <script src="{{asset('assets/js/components/jquery.flexslider.js')}}"></script>
    <!-- JS Customization -->
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script type="text/javascript">
	    $(window).load(function() {
		    $('.flexslider').flexslider();
	    });
    </script><!-- JS Plugins Init Carousel. -->
    <script>
      $(document).on('ready', function () {
        // Initialization of HSScrollNav
        $.HSCore.components.HSScrollNav.init($('#js-scroll-nav'), {
          duration: 700,
          easing: 'easeOutExpo'
        });
        // Initialization of Hamburgers
        $.HSCore.helpers.HSHamburgers.init('.hamburger');
        // Initialization of HSHeader
        $.HSCore.components.HSHeader.init($('#js-header'));
        $.HSCore.helpers.HSHeightCalc.init();
        // custom function
        $('#carousel5').on('click', '.js-thumb', function (e) {
          e.stopPropagation();
          //Variables
          var i;
          //Variables values
          i = $(this).data('slick-index');

          if ($('#carousel5').slick('slickCurrentSlide') !== i) {
            $('#carousel5').slick('slickGoTo', i);
          }
        });
        // Initialization of HSHeader component
        $.HSCore.components.HSHeader.init($('#js-header'));

        // initialiation of carousel
        $.HSCore.components.HSCarousel.init('.js-carousel');
       
        $('#carouselCus1').slick('setOption', 'responsive', [{
          breakpoint: 1350,
          settings: {
            slidesToShow: 4
          }
        }, {
          breakpoint: 1200,
          settings: {
            slidesToShow: 4
          }
        }, {
          breakpoint: 992,
          settings: {
            slidesToShow: 2
          }
        }, {
          breakpoint: 670,
          settings: {
            slidesToShow: 2
          }
        }, {
          breakpoint: 500,
          settings: {
            slidesToShow: 1
          }
        }], true);
        $('#carousel5').slick('setOption', 'responsive', [{
          breakpoint: 768,
          settings: {
            slidesToShow: 3
          }
        }, {
          breakpoint: 554,
          settings: {
            slidesToShow: 1
          }
        }], true);
      });
    </script>
@endsection