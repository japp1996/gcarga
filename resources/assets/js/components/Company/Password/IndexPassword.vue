<template id="template-password-index">
	<div class="row">
      <div class="col s12 m12"></div>
      <div class="col s6 m6 offset-s2 offset-m2">
        <form class="col s12 m12">
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">password</i>
              <input id="password_old" name="password_old" type="password" v-model="form.password_old" class="validate">
              <label for="password_old">Contraseña Actual</label>
            </div>
            <div class="input-field col s12">
              <i class="material-icons prefix">password</i>
              <input id="password_new" type="password" name="password_new" v-model="form.password_new" class="validate">
              <label for="password_new">Contraseña Nueva</label>
            </div>
            <div class="input-field col s12">
              <i class="material-icons prefix">password</i>
              <input id="password_conf" type="password" name="password_conf" v-model="form.password_conf" class="validate">
              <label for="password_conf">Confirmar Nueva Contraseña</label>
            </div>
          </div>
          <div class="row">
            <div class="col s4">
              <a class="waves-effect waves-light btn" @click="formSubmit">
                <i class="material-icons right">send</i>
                Cambiar
              </a>
            </div>
          </div>
        </form>
      </div>
    </div>
</template>

<script>
	export default {
		template: "#template-password-index",
		data() {
			return {
        url: urlBase,
				form: {
					password_old: "",
          password_new: "",
          password_conf: ""
				}
			}
		},
		methods: {
      formSubmit(e) {
        e.preventDefault()
        let currentObj = this

        let formData = new FormData()

        formData.append('password_old', this.form.password_old)
        formData.append('password_new', this.form.password_new)
        formData.append('password_conf', this.form.password_conf)
        
        axios.post(`${this.url}company/password`, formData)
        .then(response => {
          if (response.data.result) {
            swal("Éxito", response.data.text, "success");
          } else {
            if (response.data.text == "") {
              response.data.text = "La contraseña no se pudo cambiar"
            }
            swal("Lo sentimos", response.data.text, "warning");
          }
        })
        .catch(error => {
            let message  = "Disculpe, ha ocurrido un error";
            if (error.response.status == 422) {
                message = error.response.data.error;
            }
            swal("Atención", message, "error");
        })
      }
		},
		mounted() {

		}
	}
</script>