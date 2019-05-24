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
                
                <!--div class="input-field col s4">
                  <select v-model="form.modelo" id="modelo">
                    <option value="" selected></option>
                    <option v-for="(modelos, key, i) in modelo_t" > {{i}} {{key}} {{ modelos.gcnombre }}</option>
                  </select>
                  <label for="modelo">Escoge el modelo</label>
                </div-->
                <div class="input-field col s4">
                    <!--i class="material-icons prefix">email</i-->                    
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
              <img :src="url+'img/gif-gcarga.gif'" v-if="sending" alt="" width="100%">
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
                    <input-file-document :file="gccarnet_circ" image v-on:file="onCarnetChange"
                   :type-file="'carnet'" :can-document="true" :identification="''" :text="'Carnet'"
                  ></input-file-document>
                </div>
              </li>
              <li>
                <div class="col s6 file-field input-field">
                    <input-file-document :file="gctitulo_prop" image v-on:file="onTituloChange"
                   :type-file="'titulo'" :can-document="true" :identification="''" :text="'Titulo'"
                  ></input-file-document>
                </div>
              </li>
              <li>
                <div class="col s6 file-field input-field">
                    <input-file-document :file="seguro" image v-on:file="onSeguroChange"
                   :type-file="'seguro'" :can-document="true" :identification="''" :text="'Seguro'"
                  ></input-file-document>
                </div>
              </li>
              <li>
                <div class="col s6 file-field input-field">
                    <span></span>
                    <input-file-document :file="photo" image v-on:file="onFotoChange"
                   :type-file="'foto'" :can-document="true" :identification="''" :text="'Foto'"
                  ></input-file-document>
                </div>
              </li>
            </ul>
            <p>
              <!--label>
                <input type="checkbox" v-model="form.verified_docs" id="gcdoc_verificado" class="filled-in" />
                <span>Documentos verificados</span>
              </label-->
              <label>
                <input type="checkbox" v-model="form.insured" class="filled-in"/>
                <span>Carga asegurada</span>
              </label>
            </p>
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
        sending: false,
        urlP: urlBase,
        form: {
					license_plate: "",
					transport_id: "",
          brand_id: "",
          model_id: "",
          bulk_id: "",
          weight_id: "",
          user_id: "",
          color: "",
          year: "",
					capacity: "",
          tipo_capacidad: "",
					serial: "",
					property_title: "",
					asurance: "",
					circulation_card: "",
          verified_docs: "",
          carga_asegurada: "",
          fotos: {}
				},
        image: "",
        gctitulo_prop: "",
        gccarnet_circ: "",
        seguro: "",
        photo: ""
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
      },
      vehiculo: {
        type: Object,
        default: {}
      },
      fotos: {
        type: Array,
        default: {}
      }
		},
    created(){      

    },
		methods: {
      modelos() {
        axios.post(`${this.urlP}company/vehiclesModel`, {id:this.form.brand_id})
        .then(response => {
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
        this.form.circulation_card = e.file
      },
      onSeguroChange(e) {
        this.form.asurance = e.file
      },
      onTituloChange(e) {
        this.form.property_title = e.file
      },
      _setFile(file) {
        this.form.image = file.file;
      },
      formSubmit(e) {
        e.preventDefault()
        let currentObj = this
        const config = {
          headers: { 'content-type': 'multipart/form-data' }
        }
        var carga = this.form.gccarga_asegurada == true ? 1 : 0
        //var doc = this.form.gcdoc_verificado == true ? 1 : 0
        let formData = new FormData()
        formData.append('id', this.form.id)
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
        formData.append('carnet_circulacion', this.form.circulation_card)
        formData.append('fotos', this.form.fotos)

        //formData.append('doc_verificado', this.form.verified_docs)
        formData.append('insured', this.form.insured)
        formData.append('_method', 'PUT');

        axios.post(`${this.urlP}company/vehicle/`+this.form.id, formData, config)
        .then(response => {
            if (response.data.result) {
              swal("Éxito", response.data.text, "success");
              setTimeout(() => {
                window.location = `${this.urlP}company/vehicles`
              },1500)
            } else {
              swal("Atención", response.data.text, "warning");
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
      this.form = this.vehiculo
      var foto = this.fotos[0].name
      this.form.fotos = foto

      this.marca_t = this.marca
      this.tipo_t = this.tipo
      this.tamano_t = this.tamano
      this.bulk_t = this.volumen
      this.weight_t = this.peso
      this.modelos()
      this.drivers_availables()
      this.form.verified_docs = this.vehiculo.verified_docs == 1 ? true : false
      this.form.insured = this.vehiculo.insured == 1 ? true : false
      
      this.gccarnet_circ = `${this.urlP}${this.vehiculo.circulation_card}`;
      this.photo = `${this.urlP}${this.fotos[0].name}`;
      this.gctitulo_prop = `${this.urlP}${this.vehiculo.property_title}`;
      this.seguro = `${this.urlP}${this.vehiculo.asurance}`;

		}
	}
</script>