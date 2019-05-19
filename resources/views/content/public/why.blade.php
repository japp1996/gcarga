@extends('layouts.public')
@section('title', 'Porqué nosotros')
@section('content')
      <!-- Hero Info -->

      <section id="servicios" class="u-bg-overlay g-flex-centered g-min-height-100vh g-bg-img-hero g-py-80" style="background-image:url({{ url('assets/img-temp/6000x4000/what-is-gcarga-min.jpg') }})">
        <div class="container text-center u-bg-overlay__inner">
          <h2 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-50 g-color-white g-mb-20">¿Qué es GCARGA?</h2>
          <h5 class="hidden-xs-down g-max-width-645 g-color-white-opacity-0_9 mx-auto g-mb-35 g-font-size-24"> Es una aplicación web que permite a las empresas mejorar sus envíos de mercancía, ahorrando tiempo y dinero.</h5>
          <!--a href="" class="btn btn-xl u-btn-primary text-uppercase g-font-weight-700 g-font-size-12 g-rounded-50 g-py-15 g-px-40 g-mb-15 g-mr-30--md">Empieza hoy!</a-->
           <a href="{{ url('login/') }}"><div class="gcfontlwhite g-btn-gcarga display-btn-gcarga mt-r">Empieza hoy</div></a>
          <div class="hidden-md-up"></div>
          <!--a href="register.html" class="btn btn-xl u-btn-primary text-uppercase g-font-weight-700 g-font-size-12 g-rounded-50 g-py-15 g-px-40 g-mb-15">Registro</a-->
           <a href="{{ url('contact/') }}"><div class="gcfontlwhite g-btn-gcarga display-btn-gcarga mt-l">Contactar</div></a>
          <!--a href="" class="btn btn-xl u-btn-primary text-uppercase g-font-weight-700 g-font-size-12 g-rounded-50 g-py-15 g-px-40 g-mb-15">Contactar</a-->
        </div>
      </section>
      <!-- Hero Info -->
      <!-- Main Banner -->
      <section id="inicio" class="g-overflow-hidden g-max-height-100vh mt-5 text-center">
        <div class="container mt-5 g-mb-30">
          <div class="u-heading-v8-2 g-mb-80">
            <h2 class="h1 text-uppercase u-heading-v8__title g-font-weight-700 g-font-size-26 g-color-gray-dark-v2 g-mb-25">Ventajas</h2>
            <p class="mb-0 g-font-size-18 g-color-black">GCARGA es una aplicación especial que lleva la gestión de los transportes a un nuevo nivel.</p>  
          </div>
          <div class="row">  
            <div class="col-md-12">
              <div class="row">
                <div class="col-md-4 text-center">
                  <i class="fa fa-file text-primary font-color-green fa-15x"></i>
                  <br><br>
                  <h1 class="gcfonttext">Emitimos la documentación</h1>
                  <p></p>
                </div>
                <div class="col-md-4 text-center">
                  <i class="fa fa-bell text-primary font-color-green fa-15x"></i>
                  <br><br>
                  <h1 class="gcfonttext">Recibe <br>notificaciones</h1>
                  <p></p>
                </div>
                <div class="col-md-4 text-center">
                   <i class="fa fa-search text-primary font-color-green fa-15x"></i>
                  <br><br>
                  <h1 class="gcfonttext">Búsquedas <br> cercanas</h1>
                  <p></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- End Main Banner -->
      <!-- Ventaja Info -->
      <section id="contacto" class="text-center g-color-gray-dark-v5 g-py-70">
        <div class="container mt-5 g-mb-30">

          <div class="row">  
            <div class="col-md-12">
            <div class="row">
              <div class="col-md-4 text-center">
                <i class="fa fa-thumbs-up text-primary font-color-green fa-15x"></i>
                <br><br>
                <h1 class="gcfonttext">Servicio único</h5>
                <p></p>
              </div>
              <div class="col-md-4 text-center">
                <i class="fa fa-map-marker text-primary font-color-green fa-15x"></i>
                <br><br>
                <h1 class="gcfonttext">Traza la ruta</h5>
                <p></p>
              </div>
              <div class="col-md-4 text-center">
                 <i class="fa fa-star text-primary font-color-green fa-15x"></i>
                <br><br>
                <h1 class="gcfonttext">Confiabilidad</h5>
                <p></p>
              </div>
              </div>
            </div>
          </div>
        </div>
        <!--div class="container g-max-width-770">
          <div class="u-heading-v8-2 g-mb-80">
            <h2 class="h1 text-uppercase u-heading-v8__title g-font-weight-700 g-font-size-26 g-color-gray-dark-v2 g-mb-25">Ventajas</h2>
            <p class="mb-0 g-font-size-18 g-color-black">GCARGA es una aplicación especial que lleva la gestión de los transportes a un nuevo nivel.</p>
          </div>
                  <!- Icon Blocks ->
        <div class="row no-gutters u-shadow-v21 g-mt-minus-80">
          <div class="col-sm-6 col-md-4 g-brd-right--md g-brd-gray-light-v4">
            <!- Icon Blocks ->
            <div class="g-bg-white text-center g-py-100">
              <span class="u-icon-v1 u-icon-size--xl g-color-primary mb-3">
                <i class="fa fa-sitemap fa-15x u-line-icon-pro"></i>
              </span>
              <h4 class="h5 g-font-weight-600 g-mb-5">Servicio único</h4>
              <span class="d-block  g-color-black">No existe gestión semejante en latinoamérica por medio de una aplicación que te facilite la administración de tu personal de transporte</span>
            </div>
            <!- End Icon Blocks ->
          </div>
          <div class="col-sm-6 col-md-4 g-brd-right--md g-brd-gray-light-v4">
            <!- Icon Blocks ->
            <div class="g-bg-white text-center g-py-100">
              <span class="u-icon-v1 u-icon-size--xl g-color-primary mb-3">
               <i class="fa fa-map-marker fa-15x u-line-icon-pro"></i>
              </span>
              <h4 class="h5 g-font-weight-600 g-mb-5">Traza la ruta</h4>
              <span class="d-block g-color-black">Los transportes al regresar de una carga podrán recoger su carga ya que GCARGA selecciona una ruta de acuerdo a un orden lógico de cercanía para evitar viajes sin carga</span>
            </div>
            <!- End Icon Blocks ->
          </div>
          <div class="col-sm-6 col-md-4 g-brd-right--md g-brd-gray-light-v4">
            <!- Icon Blocks ->
            <div class="g-bg-white text-center g-py-100">
              <span class="u-icon-v1 u-icon-size--xl g-color-primary mb-3">
               <i class="fa fa-star u-line-icon-pro"></i>              </span>
              <h4 class="h5 g-font-weight-600 g-mb-5">Confiabilidad</h4>
              <span class="d-block g-color-black">GCARGA permite valorar recíprocamente la calidad y responsabilidad del servicio, siendo notorio para nuestros clientes la reputación del servicio a contratar</span>
            </div>
            <!- End Icon Blocks ->
          </div>
        </div>
        <!- End Icon Blocks ->
            </div -->
      </section>
      <!-- End Ventajas -->
@endsection()