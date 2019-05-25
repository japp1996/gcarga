<template id="template-company-index">
	<div class="row">
      <div class="col s12"></div>
      <div class="col m8 s8">
        <form class="col s12">
          <div class="row">
            <div class="input-field col s6">
              <input id="rif" type="text" v-model="form.dni"  class="validate">
              <label for="rif">R.I.F</label>
            </div>
            <div class="input-field col s6">
              <input class="validate" v-model="form.first_name" type="text" id="nombre">
              <label for="nombre">Nombre de la Empresa</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input class="validate" v-model="form.max_vehicle" type="text" id="max_transp">
              <label for="max_transp">Cantidad de vehículos</label>
            </div>      
            <div class="input-field col s6">
              <input id="telefono" type="text" v-model="form.phone"  class="validate">
              <label for="telefono">Teléfono</label>
            </div>
            <div class="input-field col s12">
              <textarea id="ubicacion" type="ubicacion" v-model="form.address" rows="2" class="validate"></textarea>
              <label for="ubicacion">Dirección Fiscal</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s12">
              <input id="email" type="email" v-model="form.email" class="validate">
              <label for="email">Correo</label>
            </div>
          </div>
          <div class="row">
            <div class="col s4">
              <a class="waves-effect waves-light btn" :disabled="sending" @click="formSubmit">Guardar</a>
            </div>
             <div class="col s4">
               <div v-if="sending" class="progress">
                  <div class="indeterminate"></div> 
                  <p>Guardando...</p>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="col m4 s4">
        <!--div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
          <div class="mdl-card__title mdl-card--expand mdl-color--teal-300">
            <h2 class="mdl-card__title-text"></h2>
          </div>
          <div class="mdl-card__supporting-text mdl-color-text--grey-600">
            Non dolore elit adipisicing ea reprehenderit consectetur culpa.
          </div>
          <div class="mdl-card__actions mdl-card--border">
            <a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect">Read More</a>
          </div>
        </div-->
        <div class="demo-separator mdl-cell--1-col"></div>
        <div class="demo-options mdl-card mdl-color--deep-purple-500 mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--3-col-tablet mdl-cell--12-col-desktop">
          <div class="mdl-card__supporting-text mdl-color-text--blue-grey-50">
            <ul>
              <li>
                <div class="file-field input-field">
			      <div class="btn w175">
			        <span>Seguro de carga</span>
			        <input type="file" v-on:change="onSeguroChange">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
			    </div>
              </li>
              <li>
                <div class="file-field input-field">
			      <div class="btn w175">
			        <span class="f10">Registro de Comercio</span>
			        <input type="file" v-on:change="onRegistroChange">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
			    </div>
              </li>
              <li>
                <div class="file-field input-field">
			      <div class="btn w175">
			        <span>Acta Constitutiva</span>
			        <input type="file" v-on:change="onActaChange">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
			    </div>
              </li>
              <li>
                <div class="file-field input-field">
			      <div class="btn w175">
			        <span>C.I Representante</span>
			        <input type="file" v-on:change="onCedulaChange">
			      </div>
			      <div class="file-path-wrapper">
			        <input class="file-path validate" type="text">
			      </div>
			    </div>
              </li>
              <li>
                <!--p>
                  <label for="contribuyente">
                    <input type="checkbox" @change="check()" v-model="form.gctipo" id="contribuyente" class="filled-in" />
                    <span>Contribuyente especial</span>
                  </label>
                </p-->
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
	export default {
		template: "#template-company-index",
		data() {  
			return {
        url: urlBase,
        sending:false,
				form: {
					dni: "",
          first_name: "",
          last_name: "",
					//password: "",
          address: "",
          phone: "",
					max_vehicle: "",
					email: "",
					dni_digital: "",
					asurance_charge: "",
					act_const: "",
          register: "",
          phone: "",
          latitude:null,
          longitude:null,
          avatar: ""

        }
			}
		},
		props: {
      datos: {
        type: Object,
        default: {}
      }
		},
		methods: {
      check() {
        if(document.getElemenyById('contribuyente').checked == true) {
          this.form.gctipo = 1
        } else {
          this.form.gctipo = 0
        }
      },
      onCedulaChange(e) {
        this.form.dni_digital = e.target.files[0] 
      },
      onSeguroChange(e) { 
        this.form.asurance_charge = e.target.files[0]
      },
      onActaChange(e) {
        this.form.act_const = e.target.files[0]
      },
      onRegistroChange(e) {
        this.form.register = e.target.files[0]
      },
      formSubmit(e) {
        e.preventDefault()
        let currentObj = this
        const config = {
          headers: { 'content-type': 'multipart/form-data' }
        }
        let formData = new FormData()
        
        formData.append('cedula', this.form.dni_digital)
        formData.append('seguro', this.form.asurance_charge)
        formData.append('registro', this.form.register)
        formData.append('acta', this.form.act_const)
        formData.append('gcrif', this.form.dni)
        formData.append('nombre', this.form.first_name)
        //formData.append('password', this.form.password)
        formData.append('telefono', this.form.phone)
        formData.append('ubicacion', this.form.address)
        formData.append('max_transp', this.form.max_vehicle)
        formData.append('email', this.form.email)
        
        this.sending=true
        axios.post(`${this.url}company/profile`, formData, config)
        .then(response => {
          this.sending=false
          if(response.data.result) {
            swal("Exito", response.data.text, "success");
            window.location = ""
          } else {
            swal("Información", response.data.text, "info");
          }
        })
        .catch(error => {
          this.sending=false
          let message  = "Disculpe, ha ocurrido un error";
          if (error.response.status == 422) {
              message = error.response.data.error;
          }
          swal("", message, "error");
        })
      }
		},
		mounted() {
      this.form = this.datos
		}
	}
</script>