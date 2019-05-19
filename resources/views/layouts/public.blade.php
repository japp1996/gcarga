<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0, minimum-scale=1" name="viewport">
        <meta name="keywords" content="Necesidad, Logistica, Carga, Transporte, Envio" />
        <meta name="description" content="Servicio de envios de carga permitiendo que selecciones el transporte y destino del viaje para transportar la carga, ahorrando tiempo y dinero con tecnología" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <link rel="stylesheet" href="{{ url('http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800')}}">
        <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/css/flexslider.css')}}"/>
        <link rel="stylesheet" href="{{asset('assets/vendor/icon-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/vendor/hamburgers/hamburgers.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/vendor/animate.css')}}">
        <link rel="stylesheet" href="{{asset('assets/vendor/slick-carousel/slick/slick.css')}}">

        <link rel="stylesheet" href="{{asset('assets/css/unify.css')}}"><!-- CSS Unify -->
        <link rel="stylesheet" href="{{asset('assets/css/styles.op-accounting.css')}}"><!-- CSS Template -->
        <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}"><!-- CSS Customization -->

        <title>@yield('title') | GCARGA</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css"-->

    </head>
    <body>
        <main id="app">
            @include('nav')
            @yield('content')
            @include('footer')
        </main>
    @yield('script')
    </body>
</html>
