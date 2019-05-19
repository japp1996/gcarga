<template id="template-usuario-login">
	<section class="background-login login" style="background-image: url(img/admin/login/login.jpg);background-image: url(img/admin/login/login.jpg);background-repeat: no-repeat;background-position: center;background-size: cover;height: 100vh;">
		<div class="container-fluid contain-login">
			<div class="row">
				<div class="col-sm-2 mt-3 logo">
					<img :src="'img/logo.png'" class="logo__gcarga" width="100%" alt="">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<div class="col-sm-12">
						<div class="alert alert-default text-opacity text-opacity__title" role="alert">
							<h1 class="text-white">Conecta tu transporte</h1>
						</div>
						  
						<div class="alert alert-default mt-3 text-opacity" role="alert">
							<h3 class="text-white">Con un mundo de oportunidades</h3>
						</div>
					</div>
					<div class="col-sm-12">
						
					</div>	
				</div>
				<div class="col-sm-4">
					<div class="col-sm-12">
						<div class="row">
						  	<div class="col-sm-10 col-sm-offset-1">
						      	<div class="col-sm-12 card-login-gcarga">
						        	<div class="card-action">
							        	<div class="row">
							        		<div class="col-sm-12">
								        		<div class="thumbnail mt-3">
											      <div class="caption">
											        <input class="form-control" v-model="form.email" placeholder="Correo" type="text">
											        <input class="form-control mt-3" v-model="form.password" placeholder="Contraseña" type="password">
											        
											      </div>
											    </div>
							        		</div>
							        	</div>
							        	<div class="row">
							        		<div class="col-sm-12 mt-3">
							        			<input type="button" class="btn btn-primary col-sm-12 col-sm-offset-3" value="Iniciar Sesión" @click="login()">
							        		</div>
							        	</div>
							        	<div class="row center">
						        			<a :href="url+'password/recovery'" class="text-white mt-3 text-margin-c ">¿Olvidaste tu contraseña?</a>
						        		</div>
						        	</div>
						      	</div>
						    </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
	export default {
		template: "#template-usuario-login",
		data() {
			return {
				url: urlBase,
				form: {
					email: "",
					password: ""
				}
			}
		}, 
		methods: {
			login() {
				let formData = new FormData()
				formData.append("email", this.form.email)
				formData.append("password", this.form.password)
				axios.post(`${this.url}login`, formData)
				.then(response => {
					if(response.data.result){
						window.location = response.data.location
			  		} else {
    					swal({
							text: response.data.error,
							title: "Error",
							timer: 2500,
							icon: "error",
							button: false
						})			  			
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
			}
		}
	}
</script>