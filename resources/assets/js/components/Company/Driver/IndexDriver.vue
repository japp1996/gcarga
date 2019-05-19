<template id="template-driver-index">
	<div class="row">
      <div class="col s12"></div>
      <div class="col m8 s8">
        <form class="col s12">
          <div class="row">
            <div class="input-field col s6">
              <input type="text" id="first_name" v-model="form.first_name" class="validate">
              <label for="first_name">Nombre Completo</label>
            </div>
            <div class="input-field col s6">
              <input type="text" id="last_name" v-model="form.last_name" class="validate">
              <label for="last_name">Apellido Completo</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="dni" type="text" maxlength="10" v-model="form.dni" class="validate">
              <label for="dni">Cedula de Identidad</label>
            </div>
            <div class="input-field col s6">
              <select v-model="form.sex" name="sex" id="sex" class="browser-default" >
                <option value="" selected>Seleccione Sexo</option>
                <option value="1">Masculino</option>
                <option value="2">Femenino</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <input id="fecha" name="fecha" type="text" class="datepicker" v-model="form.birthday">
              <label for="fecha">Fecha de nacimiento</label>
            </div>
            <div class="input-field col s6">
              <input id="phone" type="text" v-model="form.phone" class="validate">
              <label for="phone">Telefono</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
              <select id="bank" v-model="form.bank_id" class="browser-default">
                <option value="" selected>Seleccione Banco</option>
                <option v-for="(banco, i) in bancos_todos" :key="i" :value="banco.id">{{ banco.name }}</option>
              </select>
            </div>
            <div class="input-field col s6">
              <input id="nro_cuenta" type="text" v-model="form.bank_user.account_number" class="validate">
              <label for="nro_cuenta">Numero de Cuenta</label>
            </div>
            <div class="input-field col s6">
              <select id="tipo_cuenta" v-model="form.bank_user.account_type" class="browser-default">
                <option value="" selected>Tipo de cuenta</option>
                <option value="1">Ahorro</option>
                <option value="2">Corriente</option>
              </select>
            </div>
            <div class="input-field col s6">
              <input id="email" type="text" v-model="form.bank_user.email" class="validate">
              <label for="email">Correo Electrónico</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s3">
              <select v-model="form.license_grade" name="license_grade" id="license_grade" class="browser-default" >
                <option value="" selected>Grado de licencia</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div>
            <div class="input-field col s9">
              <textarea name="address" id="address" class="validate" v-model="form.address" placeholder="Direccion" cols="30" rows="10"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col s4">
              <a class="waves-effect waves-light btn" @click="formSubmit">Guardar</a>
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
                <div class="col s6 file-field input-field">
                  <input-file-document :file="foto"  image v-on:file="onCarnetChange"
                   :type-file="'carnet'" :canDocument="true" :identification="''" :text="'Carnet'"
                  ></input-file-document>
      			      
      			    </div>
              </li>
              <li>
                <div class="col s6 file-field input-field">
                  <input-file-document :file="ci"  image v-on:file="onCedulaChange"
                   :type-file="'ci'" :canDocument="true" :identification="''" :text="'Cédula'"
                  ></input-file-document>
      			    </div>
              </li>
              <li>
                <div class="col s6 file-field input-field">
                  <input-file-document :file="licencia" image v-on:file="onLicenciaChange"
                   :type-file="'license'" :canDocument="true" :identification="''" :text="'Licencia'"
                  ></input-file-document>
      			    </div>
              </li>
              <li>
                <div class="col s6 file-field input-field">
                  <input-file-document :file="foto" image v-on:file="onFotoChange"
                   :type-file="'foto'" :canDocument="true" :identification="''" :text="'Foto'"
                  ></input-file-document>
                </div>
              </li>
              <li>
                <!--p>
                  <label for="doc_verificados">
                    <input type="checkbox" v-model="form.doc_verificados" id="doc_verificados" class="filled-in" checked="checked" />
                    <span>Documentos verificados</span>
                  </label>
                </p-->
              </li>
              <!--li>
                <div class="file-field input-field">
      			      <div class="btn">
      			        <span>Identidad</span>
      			        <input type="file" v-on:change="onCedulaChange">
      			      </div>
      			      <div class="file-path-wrapper">
      			        <input class="file-path validate" type="text">
      			      </div>
      			    </div>
              </li-->
            </ul>
          </div>
          <!--div class="mdl-card__actions mdl-card--border">
            <a href="#" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--blue-grey-50">Ubicación</a>
            <div class="mdl-layout-spacer"></div>
            <i class="material-icons">location_on</i>
          </div-->
        </div>
      </div>
    </div>
</template>

<script>
	export default {
		template: "#template-driver-index",
		data() {  
			return {
        bancos_todos: {},
        url: urlBase,
				form: {
					first_name: "",
					last_name: "",
          dni: "",
					birthday: "",
					license_digital: "",
					circulation_card: "",
					dni_digital: "",
          license_grade: "",
          address: "",
          sex:"",
          phone:"",
          bank_user: {
            account_number: "",
            email: "",
            account_type: ""
          },
          bank_id: "",
          gcfoto: "",
          doc_verificados: false
				},
        carnet: "",
        ci: "",
        foto: "",
        licencia:""
			}
		},
		props: {
      bancos: {
        type: Array,
        default: []
      },
		},
		methods: {
      onCarnetChange(e) {
        this.form.circulation_card = e.file
      },
      onLicenciaChange(e) {
        this.form.license_digital = e.file
      },
      onCedulaChange(e) {
        this.form.dni_digital = e.file
      },
      onFotoChange(e){
        this.form.gcfoto = e.file
      },
      formSubmit(e) {
        e.preventDefault()
        let currentObj = this
        const config = {
          headers: { 'content-type': 'multipart/form-data' }
        }
        let formData = new FormData()
        var datosVerif = this.form.doc_verificados === true ? '1' : '0'
        formData.append('nombre1', this.form.first_name)
        formData.append('apellido1', this.form.last_name)
        formData.append('dni', this.form.dni)
        formData.append('cumple', this.form.birthday)
        formData.append('address', this.form.address)
        formData.append('sex', this.form.sex)
        formData.append('phone', this.form.phone)
        formData.append('licencia', this.form.license_digital)
        formData.append('carnet_circulacion', this.form.circulation_card)
        formData.append('cedula', this.form.dni_digital)
        formData.append('grado_licencia', this.form.license_grade)
        formData.append('doc_verificados', datosVerif)
        formData.append('email', this.form.bank_user.email)
        formData.append('nro_cuenta', this.form.bank_user.account_number)
        formData.append('banco', this.form.bank_id)
        formData.append('foto', this.form.gcfoto)
        formData.append('tipo_cuenta', this.form.bank_user.account_type)
        
        axios.post('company/driver', formData, config)
        .then(response => {
          if (response.data.result) {
            swal("Éxito", response.data.text, "success");
            setTimeout(() => {
              window.location = `${this.url}company/drivers`
            },1500)
          } else {
            swal("Éxito", "Disculpe el registro no se ha podido realizar", "warning");
          }
        })
        .catch(error => {
            let message  = "Disculpe, ha ocurrido un error";
            if (error.response.status == 422) {
                message = error.response.data.error;
            }
            swal("", message, "error");
        })
      },
      _setearFecha(date, i) {
        
        this.form.birthday = moment(date).format('DD-MM-YYYY');
        console.log(this.form.birthday)
      }
		},
		mounted() {
      $('.datepicker').datepicker({
          format: 'dd-mm-yyyy',
          yearRange: 50,
          i18n: pickDateI18n,
          onSelect: this._setearFecha,
          maxDate: new Date
      });
      /*setTimeout(() => {
        M.Datepicker.init(document.querySelector('#date_picker_end'), {
            format: "yyyy-mm-dd",
            onSelect: this._setearFecha,
            i18n: pickDateI18n
        });
      }, 100);*/
      this.bancos_todos = this.bancos
		}
	}
</script>