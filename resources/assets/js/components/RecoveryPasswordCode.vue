<template id="template-usuario-index">
	<section id="contacto" class="text-center g-color-gray-dark-v5">
		<div class="container g-max-width-770 g-back-gray g-mt-80">
			<div class="u-heading-v8-2 g-mb-80">
				<h2 id="register" class="h1 text-uppercase mt-5 u-heading-v8__title g-font-weight-700 g-font-size-26 g-mb-25 pt-5 gcfontlblue" > Recuperar Cuenta </h2>
                <h3 class="h2 text-uppercase u-heading-v8__title g-font-size-18 gcfontlblue">Escriba el código de seguridad</h3>
				<form id="form" class="form-vertical" @submit.prevent="_send()">
					
					<div class="row">
						<div class="input-group form-group col-md-12">
							<span class="input-group-addon">
								<i class='fa fa-at g-pr-5'></i>
							</span> 
							<input id="code" v-model="form.code" class="form-control" type="text" name="code" placeholder="Código" >
						</div>
					</div>
					<div class="form-group pb-5">
						<div class="form-group col-md-6 offset-md-3">
							<button class="col-md-12 g-btn-gcarga btn btn-lg g-color-white gcfontlwhite display-btn-gcarga mt-l" type="submit">
								Continuar
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
		data() {
			return {
				url: urlBase,
				form: {
					email: "",
				},
			}
		},
		methods: {
			_send(){
                axios.post(`password/recovery/code/send`, this.form)
                 .then(res => {
                     if(res.data.result == true){
                        swal('', res.data.msg, 'success')
                        setTimeout(()=>{
                            window.location.href = res.data.ruta +'/'+ this.form.code
                        },3000)
                     }else{
                         swal('', res.data.msg, 'error')
                     }
                 })
                 .catch(err =>{
                    swal('', 'Ha ocurrido un error al generar su codigo de verificacion, pedimos disculpas por las molestias ocasionadas', 'error')
                 })
            },

		},
	}
</script>