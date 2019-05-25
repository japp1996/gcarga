<template id="template-driver-all-index">
	<div class="mdl-grid demo-content">
      <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid"></div>
      <div class="w100 col s12">
        <div class="row">
            <a href="driver" class="col s12 container-btn-add">
                <a class="waves-effect waves-light btn btn-lg">Agregar</a>
            </a>
        </div>
        <div class="row">
          <table-byte class="col s12" :set-table="setTable" :filters="['first_name','last_name', 'dni']">
              <table-row slot="table-head">
                  <table-head colspan="4">Conductor</table-head>
                  <table-head>Acción</table-head>
              </table-row>

              <table-row slot="table-row" slot-scope="{ item }">
                  <table-cell>
                      <template v-if="_getExtension(item.avatar) == 'pdf'">
                        <a :href="url+item.avatar" target="_blank">
                          <img class="circle" :src="_getPath(item.avatar)" width="40%" alt="">
                        </a>
                      </template>
                      <template v-else>
                          <img class="circle" :src="_getPath(item.avatar)" width="40%" alt="">
                      </template>
                  </table-cell>
                  <table-cell>
                    <b style="font-size:12px;">{{ item.first_name }} {{ item.last_name }} </b>
                    <br>
                    {{ item.dni }}   
                  </table-cell>
                  <table-cell><i class="material-icons prefix">bell</i></table-cell>
                  <table-cell>Valoración 
                    <i class="material-icons prefix">star</i>
                  </table-cell>
                  
                  <table-cell>
                    <button class="btn-small">Programar</button>
                  </table-cell>
                  <table-cell>
                    <a :href="'driver/'+item.id">
                      <button class="btn-small">
                        Modificar
                      </button>
                    </a>
                  </table-cell>
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
        conductores_empresa: {},
        setTable: [],
			}
		},
		props: {
      conductores: {
          type: Array,
          default(){
              return [];
          }
      }
		},
		methods: {
      _getExtension(file){
        let ext = file.split(".")
        return ext[1]
      },
      _getPath(file){
          let ext = file.split(".")
          if (ext[1] == "pdf") {
            return this.url + 'img/icons/ico-pdf.png'
          } else {
            return this.url +file
          }
      },
      _switch(id) {
        let index = this.setTable.findIndex(e => {
            return e.gcci == id
        })

        axios.post('company/drivers_status', {id:id})
        .then(response => {
            if (response.data.result) {
              this.setTable[index].gcstatus = response.data.status
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
      this.setTable = this.conductores;
		}
	}
</script>