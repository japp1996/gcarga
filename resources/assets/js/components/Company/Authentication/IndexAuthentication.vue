<template id="template-password-index">
	<div class="mdl-grid demo-content">
      <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"></div>
      <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
        <form class="col s12 m12">
          <div class="row">
            <div class="input-field col s12">
              <i class="material-icons prefix">password</i>
              <input id="password_old" type="password" v-model="form.password_old" class="validate">
              <label for="password_old">Contraseña Actual</label>
            </div>
            <div class="input-field col s12">
              <i class="material-icons prefix">password</i>
              <input id="password_new" type="password" v-model="form.password_new" class="validate">
              <label for="password_new">Contraseña Nueva</label>
            </div>
            <div class="input-field col s12">
              <i class="material-icons prefix">password</i>
              <input id="password_conf" type="password" v-model="form.password_conf" class="validate">
              <label for="password_conf">Confirmar Nueva Contraseña</label>
            </div>
          </div>
          <div class="row">
            <div class="col s4">
              <a class="waves-effect waves-light btn" @click="formSubmit"><i class="material-icons right">send</i>Aceptar</a>
            </div>
          </div>
        </form>
      </div>
      <div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
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
        
        axios.post('', formData)
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
            swal("", message, "error");
        })
      }
		},
		mounted() {

		}
	}
</script>