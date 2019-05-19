@extends('layouts.public')
@section('title', 'Productos')
@section('content')

<section id="servicios" class="u-bg-overlay g-flex-centered g-min-height-100vh g-bg-img-hero g-py-80" style="background-image:url({{ url('assets/img-temp/1000x500/howitwork.jpg') }})">
	<div class="container text-center u-bg-overlay__inner">
		<h1 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-50 g-color-white g-mb-20">¿Cómo uso GCARGA?</h1>
		<h3 class="hidden-xs-down g-max-width-645 g-color-white-opacity-0_9 mx-auto g-mb-35 "> Sigue los siguientes pasos, es fácil y efectivo.</h3>
		<!--a href="#transportistas" class="btn btn-xl btn-primary text-uppercase g-font-weight-700 g-font-size-12  g-color-white  g-rounded-50 g-py-15 g-px-40 g-mb-15 g-mr-30--md">Aprender</a-->
		<a href="#transportistas" class="txt-decore"><div class="gcfontlwhite g-btn-gcarga">Aprender</div></a>
		<div class="hidden-md-up"></div>
	</a>
</div>
</section>
<!-- Hero Info -->

<section id="transportistas" class="g-pt-50">
	<div class="text-center g-mb-60">
		<div class="container g-max-width-770">
			<h2 class="text-uppercase g-line-height-1 g-font-weight-700 g-font-size-30 g-mb-30"></h2>
		</div>
	</div>
	<!-- End Dynamic Process -->
</section>

<!-- Main Banner -->
<section id="inicio" class="g-overflow-hidden g-max-height-100vh">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12 col-sm-4 mt-md-1 mt-sm-5">
						<div class="row">
							<div class="col-md-3">  
								<span class="fa-stack fa-3x text-primary d-inline-block">
									<span class="fa fa-circle-o fa-stack-2x"></span>
									<strong class="fa-stack-1x">
										1    
									</strong>

								</span>
							</div>
							<div class="col-md-9"> 
								<h2 class="text-green ">Ubica un camión disponible cercano a tu ubicación.</h2>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-4 mt-md-5 mt-sm-5">   
						<div class="row mt-md-5">
							<div class="col-md-3">  
								<span class="fa-stack fa-3x text-primary d-inline-block">
									<span class="fa fa-circle-o fa-stack-2x"></span>
									<strong class="fa-stack-1x">
										2    
									</strong>

								</span>
							</div>
							<div class="col-md-9"> 
								<h2 class="text-green">Selecciona el destino, carga a enviar, día y hora del viaje.</h2>
							</div>
						</div>   
					</div>

					<div class="col-md-12 col-sm-4 mt-md-5 mt-sm-5">
						<div class="row mt-md-5">
							<div class="col-md-3">  
								<span class="fa-stack fa-3x text-primary d-inline-block">
									<span class="fa fa-circle-o fa-stack-2x"></span>
									<strong class="fa-stack-1x">
										3    
									</strong>
								</span>
							</div>
							<div class="col-md-9"> 
								<h2 class="text-green">Notifica al despachador para agilizar la recolecta.</h2><h2 class="text-green hidden-sm-up">, nuestros colaboradores son puntuales</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 ">
				<img class="img-responsive" src="{{ asset('assets/img-temp/wallpaper/Laptop.jpg') }}" width="100%">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<img class="img-responsive mt-5 mt-6" src="{{ asset('assets/img-temp/wallpaper/Laptop.jpg') }}" width="100%">
			</div>    
			<div class="col-md-6">
				<div class="row">
					<div class="col-md-12 col-sm-4 mt-md-5 mt-sm-5">
						<div class="row">
							<div class="col-md-3">  
								<span class="fa-stack fa-3x text-primary d-inline-block">
									<span class="fa fa-circle-o fa-stack-2x"></span>
									<strong class="fa-stack-1x">
										4    
									</strong>

								</span>
							</div>
							<div class="col-md-9"> 
								<h2 class="text-green">Imprime los soportes de carga, solicita al colaborador la firma y sello conforme.</h2>
							</div>
						</div>
					</div>
					<div class="col-md-12 col-sm-4 mt-md-5 mt-sm-5">   
						<div class="row">
							<div class="col-md-3">  
								<span class="fa-stack fa-3x text-primary d-inline-block">
									<span class="fa fa-circle-o fa-stack-2x"></span>
									<strong class="fa-stack-1x">
										5    
									</strong>

								</span>
							</div>
							<div class="col-md-9"> 
								<h2 class="text-green">Visualiza el trayecto de tu carga y tiempo de llegada.</h2>
							</div>
						</div>   
					</div>
					<div class="col-md-12 col-sm-4 mt-md-5 mt-sm-5">
						<div class="row ">
							<div class="col-md-3">  
								<span class="fa-stack fa-3x text-primary d-inline-block">
									<span class="fa fa-circle-o fa-stack-2x"></span>
									<strong class="fa-stack-1x">
										6    
									</strong>

								</span>
							</div>
							<div class="col-md-9"> 
								<h2 class="text-green">Califica el servicio prestado, para ayudar a mejorar nuestro servicio.</h2>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>  
	<br>
</section>
<!-- End Main Banner -->
@endsection()