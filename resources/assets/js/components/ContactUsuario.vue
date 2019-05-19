<template id="template-contacto-index">
	<section id="contacto" class="text-center g-color-gray-dark-v5">
		<div class="container g-max-width-770 g-back-gray g-mt-80">
			<div class="u-heading-v8-2 g-mb-80">
				<h2 id="register" class="h1 text-uppercase mt-5 u-heading-v8__title g-font-weight-700 g-font-size-26 g-mb-25 pt-5 gcfontlblue" > Contácto </h2>
				<form id="form" class="form-vertical">
					<div class="row">
						<div class="input-group form-group col-md-12"> 
							<span class="input-group-addon">
								<i class='fa fa-user g-pr-5'></i>
							</span> 
							<input id="name" v-model="form.name" class="form-control" type="text" name="name" placeholder="Nombre y Apellido" >
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
								<i class='fa fa-envelope g-pr-5'></i>
							</span> 
							<textarea id="message" v-model="form.message" class="form-control" type="text" name="message" placeholder="Mensaje" ></textarea>
						</div>
					</div>
					<div class="form-group pb-5">
						<div class="form-group col-md-6 offset-md-3">
							<!--button type="submit" id="enviar" class="form-control col-md-12 btn btn-lg btn-primary g-color-white" name="" >Registrarse</button-->
							<button class="col-md-12 g-btn-gcarga btn btn-lg g-color-white gcfontlwhite display-btn-gcarga mt-l" @click="ajax()" type="button">
								Enviar
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
		template: "#template-contacto-index",
		data() {
			return {
				form: {
					phone: "",
					name: "",
					email: "",
					message: ""
				}
			}
		},
		methods: {
			ajax() {
				let formData = new FormData();
           		formData.append("phone", this.form.phone);
           		formData.append("name", this.form.name);
           		formData.append("email", this.form.email);
           		formData.append("message", this.form.message);
				
				axios.post("contact", formData)
			  	.then( response => {
			  		console.log("then", response)
			  		swal({
						text: response.data.text,
						title: "Ok",
						timer: 3000,
						icon: "success",
						button: false
					})
			  	})
			  	.catch(error => {
			  		console.log("catch", error.response.status)
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
			}
		}
	}
</script>