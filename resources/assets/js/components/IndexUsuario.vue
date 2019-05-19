<template id="template-usuario-index">
	<section id="contacto" class="text-center g-color-gray-dark-v5">
		<div class="container g-max-width-770 g-back-gray g-mt-80">
			<div class="u-heading-v8-2 g-mb-80">
				<h2 id="register" class="h1 text-uppercase mt-5 u-heading-v8__title g-font-weight-700 g-font-size-26 g-mb-25 pt-5 gcfontlblue" > Registrate </h2>
					<a id="showModal" href="#modal-container" role="button" class="btn" data-toggle="modal"></a>
				<div class="modal fade" id="modal-container" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="myModalLabel">
									Exito
								</h5> 
								<button type="button" class="close" data-dismiss="modal">
									<span aria-hidden="true">×</span>
								</button>
							</div>
							<div class="modal-body">
								<h2 id="messageAfterSubmit" class="h1 text-uppercase mt-5 u-heading-v8__title g-font-weight-700 g-font-size-36 g-mb-25 pt-5 gcfontlblue" ></h2>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary" data-dismiss="modal">
									Entendido
								</button> 
								<button type="button" class="btn btn-secondary" data-dismiss="modal">
									Cerrar
								</button>
							</div>
						</div>
					</div>
				</div>
				<form id="form" class="form-vertical" @submit.prevent="ajax()">
					<div class="row">
						<div class="input-group form-group col-md-12">
							<input-file-auth :title="'Logo de empresa'" v-on:get-file="_getFileProfile" :classes="'content-input-file-medium'"></input-file-auth>
						</div>
					</div>
					<div class="row">
						<div class="input-group form-group col-md-6"> 
							<span class="input-group-addon">
								<i class='fa fa-user g-pr-5'></i>
							</span> 
							<input id="ruc" v-model="form.ruc" class="form-control" type="text" name="ruc" placeholder="RIF" >
						</div>
						<div class="input-group form-group col-md-6"> 
							<span class="input-group-addon">
								<i class='fa fa-building g-pr-5'></i>
							</span> 
							<input id="company_name" v-model="form.company_name" class="form-control" type="text" name="company_name" placeholder="Nombre o Razón Social" >
						</div>
					</div>
					<div class="row">
						<div class="input-group form-group col-md-6">
							<span class="input-group-addon">
								<i class='fa fa-lock g-pr-5'></i>
							</span> 
							<input id="password" v-model="form.password" class="form-control" type="password" name="password" placeholder="Contraseña" >
							<span toggle="#password-field" id="eye" @click="showPassword('password','eye')" class="fa fa-fw fa-eye fa-1x field-icon toggle-password"></span>
						</div>
						<div class="input-group form-group col-md-6">
							<span class="input-group-addon">
								<i class='fa fa-lock g-pr-5'></i>
							</span> 
							<input id="password_confirmation" v-model="form.password_confirmation" class="form-control" type="password" name="password_confirmation" placeholder="Confirma tu contraseña" >
							<span toggle="#password-field" id="eye2" @click="showPassword('password2','eye2')" class="fa fa-fw fa-eye fa-1x field-icon toggle-password"></span>
						</div>
					</div>
					<div class="row">
						<div class="input-group form-group col-md-6">
							<span class="input-group-addon">
								<i class='fa fa-phone g-pr-5'></i>
							</span> 
							<input id="phone" v-model="form.phone" class="form-control" type="tel" name="phone" placeholder="Teléfono" >
						</div>
						<div class="input-group form-group col-md-6">
							<span class="input-group-addon">
								<i class='fa fa-at g-pr-5'></i>
							</span> 
							<input id="email" v-model="form.email" class="form-control" type="email" name="email" placeholder="Correo" >
						</div>
					</div>
					<div class="row">
						<div class="input-group form-group col-md-12">
							<span class="input-group-addon">
									<i class='fa fa-map-marker g-pr-5'></i>
								</span>
								<textarea id="address" v-model="form.address" name="address" class="form-control" placeholder="Dirección"></textarea>
						</div>
					</div>
					<p class="mb-0 g-color-black gcfonttext">Al registrarse usted acepta los 
						<a href="assets/terminosycondiciones/terminosycondiciones.pdf" target="_blank" class="text-primary wosubray">términos y condiciones
						</a> de GCARGA.
					</p>
					<input type="checkbox" v-model="form.terms" id="terms" name="terms">
					<label class="gcfonttext">Acepto los términos y condiciones de GCARGA</label>
					<div class="form-group pb-5">
						<div class="form-group col-md-6 offset-md-3">
							<!--button type="submit" id="enviar" class="form-control col-md-12 btn btn-lg btn-primary g-color-white" name="" >Registrarse</button-->
							<button class="col-md-12 g-btn-gcarga btn btn-lg g-color-white gcfontlwhite display-btn-gcarga mt-l" type="submit">
								Registrate
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		template: "#template-usuario-index",
		props: {
			'type-form': {
					type: String,
					default: ""
			}
		},
		data() {
			return {
				url: urlBase,
				form: {
					first_name: "",
					last_name: "",
					company_name: "",
					dni: "",
					email: "",
					password: "",
					password_confirmation: "",
					phone: "",
					address: "",
					avatar: "",
					type: "",
					ruc:"",
					terms: false
				},
				formData: null
			}
		},
		methods: {
			ajax() {
				if(!this.form.terms) {
					swal("", "Primero debe aceptar los terminos y condiciones", "info");
					return false;
				}

				if (this.form.password != this.form.password_confirmation){
					swal("Disculpe", "Las contraseñas no cohinciden", "info")
					return false
				}

				this._generateFormData(this.form)
				
				axios.post(`${this.url}usuario`, this.formData)
			  	.then( response => {
			  		if (response.data.result) {
				    	swal({
								text: response.data.msg,
								title: "Ok",
								timer: 3000,
								icon: "success",
								button: false
							})
							setTimeout(() => {
									window.location = urlBase + 'login'
							}, 2000)
			  		} else {
				  		console.log("then", response)
				  		console.log("then-:data", response.data)
			  		}
			  	})
			  	.catch(error => {
			  		let message = "Disculpe, ha ocurrido un error";
			  		if (error.response.status == 422) {
			  			message = error.response.data.error;
			  		}
						swal({
							text: message,
							title: "Atención",
							timer: 2500,
							icon: "warning",
							button: false
						})
			  	})
			},
			_getFileProfile(file, type) {
					this.form.avatar = file.file
			},
			showPassword(pass,eye) {
		      if ($('#'+pass).attr('type') == 'password') {
		        $('#'+pass).attr('type', 'text')
		        $('#'+eye).removeClass('fa-eye')
		        $('#'+eye).addClass('fa-eye-slash')
		      } else {
		       $('#'+pass).attr('type', 'password')
		        $('#'+eye).removeClass('fa-eye-slash')
		        $('#'+eye).addClass('fa-eye')
		      }
				},
				_generateFormData(data){
						this.formData = new FormData();
						Object.getOwnPropertyNames(data).forEach(key => {
								if(key !== "__ob__") {
										this.formData.append(key, data[key])
								}
						})
				}

		},
		mounted() {
			this.form.type = this.typeForm;
		}
	}
</script>