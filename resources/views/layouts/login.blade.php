<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0, minimum-scale=1" name="viewport">
        <meta name="keywords" content="" />
        <meta name="description" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
        <link rel="stylesheet" href="{{ url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800')}}">
        <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('assets/vendor/icon-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <title>@yield('title') | GCARGA</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css"-->

    </head>
    <body>
        <main id="app">
            @yield('content')
        </main>
    @yield('script')
    </body>
</html>
