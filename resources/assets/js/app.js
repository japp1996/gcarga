
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

//variables globales
window.port = '11060'

//importar paquetes y archivos
require('./bootstrap');
require("materialize-css");
window.Vue = require('vue')
window.moment = require("moment");
window.io = require('socket.io-client');
import VueScrollbar from 'vue2-scrollbar'
import asset from './filters/asset'
const swal = require('sweetalert')

//funciones globales

window.showLoading = function () {
    $("#prepage-loader").fadeIn('fast');
};

window.quitLoading = function () {
    $("#prepage-loader").fadeOut('slow');
};

//configuraciones
window.pickDateI18n = {
    nextMonth: 'Mes siguiente',
    previousMonth: 'Mes anterior',
    // Months and weekdays
    months: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
    monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
    weekdays: [ 'Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado' ],
    weekdaysShort: [ 'Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
    // Materialize modified
    weekdaysAbbrev: [ 'D', 'L', 'M', 'M', 'J', 'V', 'S' ],
    // Today and clear
    today: 'Hoy',
    clear: 'Limpiar',
    done: 'Aceptar',
    cancel: 'Cancelar'
};

window.SocketApp = io.connect(location.protocol + '//' + location.host+':' + port, {
    'reconnection': true,
    'reconnectionDelay': 500,
    'reconnectionAttempts': 10,
    'transport' : ['websocket']
});

moment.locale("es");


//registro de componentes vue
Vue.use(asset)


Vue.component('table-byte', require("./components/Company/Table/Table"));
Vue.component("table-row", require("./components/Company/Table/TableRow"));
Vue.component('table-head', require("./components/Company/Table/TableHead"));
Vue.component("table-cell", require("./components/Company/Table/TableCell"));

Vue.component("input-file", require("./components/Utility/InputFile"));
Vue.component("input-document", require("./components/Utility/InputDocument"));
Vue.component("input-file-document", require("./components/Utility/InputDocumentEdit"));
Vue.component("input-file-auth", require("./components/Utility/InputFileAuthBoot"));

Vue.component('usuario-index', require('./components/IndexUsuario'))
Vue.component('usuario-login', require('./components/LoginUsuario'))
Vue.component('contacto-index', require('./components/ContactUsuario'))
Vue.component('password-index', require('./components/Company/Password/IndexPassword'))
Vue.component('password-recovery', require('./components/RecoveryPassword'))
Vue.component('password-recovery-code', require('./components/RecoveryPasswordCode'))
Vue.component('password-make-new', require('./components/MakeNewPassword'))
//Vue.component('suggestion-index', require('./components/Admin/Suggestion/IndexSuggestion'))

Vue.component('company-index', require('./components/Company/Company/IndexCompany'))

Vue.component('vehicle-index', require('./components/Company/Vehicle/IndexVehicle'))
Vue.component('vehicle-edit-index', require('./components/Company/Vehicle/IndexEditVehicle'))
Vue.component('vehicle-all-index', require('./components/Company/Vehicle/IndexAllVehicle'))

Vue.component('driver-index', require('./components/Company/Driver/IndexDriver'))
Vue.component('driver-edit-index', require('./components/Company/Driver/IndexEditDriver'))
Vue.component('driver-all-index', require('./components/Company/Driver/IndexAllDriver'))

Vue.component("VueScrollbar", VueScrollbar);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
    methods: {
        onComplete: function(){
            axios.post('/validate-data', this.$data.model)
            .then(this.onSuccess)
            .catch(error => this.errors.record(error.response.data.errors));
         },
      },
      data: {
        defaultColor: '#FF0000'
      }
});
