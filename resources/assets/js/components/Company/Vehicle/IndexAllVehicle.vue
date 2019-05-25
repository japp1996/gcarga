<template id="template-driver-all-index">
	<div class="mdl-grid demo-content">
      <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"></div>
      <div class="w100 col s12">
        <div  class="row">
            <a v-if="setTable.length < max" href="vehicle" class="col s12 container-btn-add">
                <a class="waves-effect waves-light btn">Agregar</a>
            </a>
        </div>
        <div class="row">
          <table-byte class="col s12" :set-table="setTable" :filters="['license_plate', 'marca.name']">
              <table-row slot="table-head">
                  <table-head width="10%"></table-head>
                  <table-head class="th">Placa </table-head>
                  <table-head>Marca</table-head>
                  <table-head>Conductor</table-head>
                  <table-head width="5%" colspan="2">Acción</table-head>
              </table-row>

              <table-row slot="table-row" slot-scope="{ item }">
                  <table-cell> <img class="circle" :src="url+item.fotos.name" width="100%" alt=""> </table-cell>
                  <table-cell>{{item.license_plate}}</table-cell>
                  <table-cell>{{item.marca.name}}</table-cell>
                  <table-cell>{{item.user == null ? 'SIN ASIGNAR' : item.user.name }}</table-cell>
                  <table-cell class="icon-margin"><button class="btn">Programar</button></table-cell>
                  <table-cell class="icon-margin"><a :href="'vehicle/'+item.id" class="btn">Modificar</a></table-cell>
                  <table-cell>
                    <div class="switch">
                      <label >
                        <template v-if="item.status == '0'">Inactivo</template>
                        <template v-else>Activo</template>
                        <input type="checkbox" @click="_switch(item.id)" v-if="item.status == '0'">
                        <input type="checkbox" @click="_switch(item.id)" v-else checked="checked">
                        <span class="lever"></span>
                      </label>
                    </div>
                  </table-cell>
              </table-row>

              <table-row slot="empty-rows">
                  <table-cell colspan="5">
                      No se encontraron registros.
                  </table-cell>
              </table-row>

          </table-byte>
        </div>
      </div>
  </div>
</template>
<style>
    .icon-margin{
        width: 195px;
    }

    .img-width{
        width:100%;
        height: 300px;
        object-fit: contain;
    }

    .w100 {
        width:100%;
    }

    .th {
        width: 200px;
    }
</style>

<script>
	export default {
		template: "#template-driver-all-index",
		data() {  
			return {
        url: urlBase,
        max: "",
        vehiculos_empresa: {},
        setTable: [],
			}
		},
		props: {
      vehiculos: {
          type: Array,
          default(){
              return [];
          }
      },
      max_transp: {
        type: Number,
        default: 0
      }
		},
		methods: {
      _switch(id) {
        let index = this.setTable.findIndex(e => {
            return e.gcplaca == id
        })

        axios.post('company/vehicles/status', {id:id})
        .then(response => {
            if (response.data.result) {
              this.setTable[index].gcestatus = response.data.status
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
      this.setTable = this.vehiculos;
      this.max = this.max_transp
		}
	}
</script>