<template id="template-transport-index">
	<div class="row">
      <div class="col m12 s12"></div>
      <div class="col m6 s6 offset-s1 offset-m1">
        <form class="col s12 m12">
          <div class="row">
            <div class="input-field col s6">
              <input id="placa" type="text" v-model="form.license_plate" class="validate">
              <label for="placa">Placa</label>
            </div>
            <div class="input-field col s6">
                <select class="browser-default" v-model="form.transport_id">
                  <option value=""> Tipo de vehículo </option>
                  <option v-for="(tipos, i) in tipo_t" :key="i" :value="tipos.id">{{ tipos.name }}</option>
                </select>
            </div>
          </div>
          <div class="row">

              <div class="input-field col s4">
                <select class="browser-default" v-model="form.brand_id" id="marca" @change="modelos()">
                  <option value="" selected> Marca </option>
                  <option v-for="(marcas,i) in marca_t" :key="i"  :value="marcas.id">
                  {{ marcas.name }}</option>
                  <label for="marca">Marca</label>
                </select>
              </div>
              <div class="input-field col s4">
                <select class="browser-default" v-model="form.model_id" id="modelo">
                  <option value="" selected> Modelo </option>
                  <option v-for="(modelo,i) in modelo_t" :key="i" :value="modelo.id">
                  {{ modelo.name }}</option>
                </select>
              </div>
                <div class="input-field col s4">
                    <input type="text" id="color" v-model="form.color">
                    <label for="color">Color</label>
                </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
                <input type="text" id="anio" v-model="form.year">
              <label for="anio">Año</label>
            </div>
            <div class="input-field col s6">
              <textarea id="serial" v-model="form.serial" class="materialize-textarea"></textarea>
              <label for="serial">Serial carroceria</label>
            </div>
          </div>
          <div class="row">
            
            <div class="input-field col s3">
              <select class="browser-default" v-model="form.bulk_id" id="bulk">
                <option value="" selected> Volumen </option>
                <option v-for="(bulk,i) in bulk_t" :key="i" :value="bulk.id">
                {{ bulk.bulk }}</option>
              </select>
            </div>
            <div class="input-field col s3">
              <select class="browser-default" v-model="form.weight_id" id="weight">
                <option value="" selected> Peso </option>
                <option v-for="(weight,i) in weight_t" :key="i" :value="weight.id">
                {{ weight.weight }}</option>
              </select>
            </div>
            <div class="input-field col s6">
              <select class="browser-default" v-model="form.user_id" id="user_id">
                <option value="" selected> Conductor </option>
                <option v-for="(driver,i) in drivers" :key="i" :value="driver.id">
                {{ driver.name }}</option>
              </select>
            </div>
          </div>
          <div class="row">
            
          </div>
          <div class="row">
            <div class="col s4">
              <a class="waves-effect waves-light btn" :disabled="sending" @click="formSubmit">
                  Guardar<i class="material-icons right">send</i>
              </a>
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
      <div class="col s4 m4">
        <div class="demo-separator mdl-cell--1-col"></div>
        <div class="demo-options mdl-card mdl-color--deep-purple-500 mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--3-col-tablet mdl-cell--12-col-desktop">
          <div class="mdl-card__supporting-text mdl-color-text--blue-grey-50">
            <ul>
              <li>
                <div class="col s6 file-field input-field">
                    <input-document :styles="{ margin: 'unset' }" v-on:file="onCarnetChange" :file="carnet" image :text="'Carnet'"></input-document>
      			    </div>
              </li>
              <li>
                <div class="col s6 file-field input-field">
                    <input-document :styles="{ margin: 'unset' }" :file="titulo" v-on:file="onTituloChange" image :text="'Titulo'"></input-document>
      			    </div>
              </li>
              <li>
                <div class="col s6 file-field input-field">
                    <input-document :styles="{ margin: 'unset' }" :file="seguro" v-on:file="onSeguroChange" image :text="'Seguro'"></input-document>
      			    </div>
              </li>
              <li>
                <div class="col s6 file-field input-field">
                    <input-document :styles="{ margin: 'unset' }" :file="foto" v-on:file="onFotoChange" image :text="'Foto'"></input-document>
      			    </div>
              </li>
              <!--p>
                <label>
                  <input type="checkbox" v-model="form.verified_docs" class="filled-in" checked="checked" />
                  <span>Documentos verificados</span>
                </label>
              </p-->
              
              <p>
                <label>
                  <input type="checkbox" v-model="form.insured" class="filled-in" checked="checked" />
                  <span>Carga asegurada</span>
                </label>
              </p>
            </ul>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
	export default {
		template: "#template-transport-index",
		data() {
			return {
        tipo_t: {},
        tamano_t: {},
        marca_t: {},
        modelo_t: {},
        bulk_t: {},
        weight_t: {},
        drivers: [],
        sending: false,
        url: urlBase,
        form: {
					license_plate: "",
					transport_id: "",
          brand_id: "",
          model_id: "",
          bulk_id: "",
          weight_id: "",
          color: "",
          year: "",
					capacity: "",
          tipo_capacidad: "",
					serial: "",
					property_title: "",
					asurance: "",
					circulacion_card: "",
          //verified_docs: "",
          carga_asegurada: "",
          fotos: "",
          insured:false,
          user_id: ""
				},
        carnet: "",
        titulo: "",
        foto: "",
        seguro:""
			}
		},
		props: {
      tipo: {
        type: Array,
        default: []
      },
      marca: {
        type: Array,
        default: {}
      },
      peso: {
        type: Array,
        default: []
      },
      volumen: {
        type: Array,
        default: []
      }
		},
		methods: {
      modelos() {
        axios.post(`${this.url}company/vehiclesModel`, {id:this.form.brand_id})
        .then(response => {
          console.log(response)
          this.modelo_t = response.data
        })  
        .catch(error => {
          this.modelo_t = {}
        })
      },
      drivers_availables() {
        axios.post(`${this.url}company/vehicles/drivers-available`)
        .then(response => {
          console.log(response)
          this.drivers = response.data
        })
        .catch(error => {
          this.drivers = []
        })
      },
      onFotoChange(e) {
        this.form.fotos = e.file
      },
      onCarnetChange(e) {
        this.form.circulacion_card = e.file
      },
      onSeguroChange(e) {
        this.form.asurance = e.file
      },
      onTituloChange(e) {
        this.form.property_title = e.file
      },
      formSubmit(e) {
        e.preventDefault()
        let currentObj = this
        const config = {
          headers: { 'content-type': 'multipart/form-data' }
        }
        let formData = new FormData()
        

        var carga = this.form.insured == true ? 1 : 0
        var doc = this.form.doc_verificado == true ? 1 : 0
        
        formData.append('gcplaca', this.form.license_plate)
        formData.append('tipo', this.form.transport_id)
        formData.append('marca', this.form.brand_id)
        formData.append('modelo', this.form.model_id)
        formData.append('bulk_id', this.form.bulk_id)
        formData.append('weight_id', this.form.weight_id)
        formData.append('user_id', this.form.user_id)
        formData.append('color', this.form.color)
        formData.append('anio', this.form.year)
        formData.append('capacidad', this.form.capacity)
        formData.append('tipo_capacidad', this.form.tipo_capacidad)
        formData.append('serial', this.form.serial)
        formData.append('titulo_propiedad', this.form.property_title)
        formData.append('seguro', this.form.asurance)
        formData.append('carnet_circulacion', this.form.circulacion_card)
        formData.append('fotos', this.form.fotos)
        //formData.append('doc_verificado', this.form.verified_docs)
        formData.append('insured', this.form.insured) 

        this.sending = true

        axios.post('company/vehicle', formData, config)
        .then(response => {
            if (response.data.result) {
              swal("Éxito", response.data.text, "success");
              setTimeout(() => {
                window.location = `${this.url}company/vehicles`
              },1500)
            } else {
              swal("Atención", response.data.text, "warning");
              this.sending = false
            }
        })
        .catch(error => {
          let message  = "Disculpe, ha ocurrido un error";
          if (error.response.status == 422) {
              message = error.response.data.error;
          }
          this.sending = false
          swal("", message, "error");

        })
      }
		},
    created(){

    },
		mounted() {
      this.marca_t = this.marca
      this.drivers_availables()
      this.tipo_t = this.tipo
      this.tamano_t = this.tamano
      this.bulk_t = this.volumen
      this.weight_t = this.peso
		}
	}
</script>