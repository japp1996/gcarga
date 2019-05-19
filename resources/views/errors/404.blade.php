<!DOCTYPE html>
<html>
    <head>
        <title>404 No encontrado</title>
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

        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Quattrocento+Sans" rel="stylesheet">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #000;
                display: table;
                font-weight: 100;
                font-family: 'Quattrocento Sans', sans-serif;
                /*font-family: 'Quattrocento Sans', sans-serif;*/
            }

            .message404 {
                display: block;
			    position: relative;
			    margin-top: 100px;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            .c404 {
				font-size: 15rem;
				color:#0971CE;
            }
        </style>
    </head>
    <body>
    	@include('nav')
	        <div class="message404">
	            <div class="content">
	            	<h1 class="c404">404</h1>
	                <h3 class="title">Lo sentimos, no pudimos encontrar la página que busca.</h3>
	                <h4>Ocurrió algún error o la página no existe.</h4>
	            </div>
	        </div>
    </body>
</html>
