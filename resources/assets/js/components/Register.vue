<template id="template-registro-independiente">
    <section class="auth-template form-register" id="registro-independiente">

        <form class="columns" @submit.prevent="_doRegister">
            <div class="column is-12">
                <div class="columns is-multiline">
                    <div class="column is-12">
                        <a href="javascript:history.back()">
                            <div class="redirect-back">
                                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="arrow-left" class="svg-inline--fa fa-arrow-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path fill="#fff" d="M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8.4 34.3z"></path>
                                </svg>
                            </div>
                        </a>
                    </div>
                    <div class="column is-12 has-text-centered">
                        <input-file-auth :title="user.type == 'company' ? 'Logo de Empresa' : 'Subir foto de perfil'" classes="content-input-file-medium" v-on:get-file="_getFileProfile"></input-file-auth>
                    </div>
                    <div class="column is-12-mobile is-6 field">
                        <label class="label text" v-if="user.type !== 'company'">Nombre</label>
                        <label class="label text" v-else>Nombre de Empresa</label>
                        <div class="control" v-if="user.type !== 'company'">
                            <input class="input" type="text" name="first_name" v-model="user.first_name">
                        </div>
                        <div class="control" v-else>
                            <input class="input" type="text" name="company_name" v-model="user.company_name">
                        </div>
                    </div>
                    <div class="column is-12-mobile is-6 field" v-if="user.type == 'company'">
                        <label class="label text">RUC</label>
                        <div class="control">
                            <input class="input" type="text" name="dni" v-model="user.ruc">
                        </div>
                    </div>
                    <div class="column is-12-mobile is-6 field" v-if="user.type !== 'company'">
                        <label class="label text">Apellido</label>
                        <div class="control">
                            <input class="input" type="text" name="last_name" v-model="user.last_name">
                        </div>
                    </div>
                    <div class="column is-12-mobile is-6 field" v-if="user.type == 'independent'">
                        <label class="label text">RUC</label>
                        <div class="control">
                            <input class="input" type="text" name="dni" v-model="user.ruc">
                        </div>
                    </div>
                    <div class="column is-12-mobile is-6 field" v-if="user.type == 'client'">
                        <label class="label text" v-if="user.type == 'client'">Documento de Identidad</label>
                        <div class="control">
                            <input class="input" type="text" name="dni" v-model="user.dni">
                        </div>
                    </div>
                    <div class="column is-12-mobile is-6 field" v-if="user.type !== 'client' && user.type !== 'company'">
                        <label class="label text">Teléfono</label>
                        <div class="control">
                            <input class="input" type="number" name="phone" v-model="user.phone">
                        </div>
                    </div>
                    <div class="column is-12" v-if="user.type !== 'client' && user.type !== 'company'">
                        <label class="label text">Dirección</label>
                        <div class="control">
                            <textarea class="textarea textarea-register" name="address" v-model="user.address"></textarea>
                        </div>
                    </div>
                    <div class="column is-12-mobile is-12 field" v-if="user.type !== 'client' && user.type !== 'company'">
                        <label class="label text">Correo Electrónico</label>
                        <div class="control">
                            <input class="input" type="email" name="email" v-model="user.email">
                        </div>
                    </div>

                    <div class="column is-12-mobile is-6 field" v-if="user.type == 'company'">
                        <label class="label text">Teléfono</label>
                        <div class="control">
                            <input class="input" type="number" name="phone" v-model="user.phone">
                        </div>
                    </div>

                    <div class="column is-12-mobile is-6 field" v-if="user.type == 'client' || user.type == 'company'">
                        <label class="label text">Correo Electrónico</label>
                        <div class="control">
                            <input class="input" type="email" name="email" v-model="user.email">
                        </div>
                    </div>

                    <div class="column is-12-mobile is-6 field">
                        <label class="label text">Contraseña</label>
                        <div class="control">
                            <input class="input" type="password" name="password" v-model="user.password">
                        </div>
                    </div>

                    <div class="column is-12-mobile is-6 field">
                        <label class="label text">Confirmar Contraseña</label>
                        <div class="control">
                            <input class="input" type="password" name="password" v-model="user.password_confirmation">
                        </div>
                    </div>
                    <div class="column is-12-mobile is-6 field" v-if="user.type == 'client'">
                        <label class="label text">Teléfono</label>
                        <div class="control">
                            <input class="input" type="number" name="phone" v-model="user.phone">
                        </div>
                    </div>
                    <div class="column is-12" v-if="user.type == 'company'">
                        <label class="label text">Dirección</label>
                        <div class="control">
                            <textarea class="textarea textarea-register" name="address" v-model="user.address"></textarea>
                        </div>
                    </div>

                    <template v-if="user.type === 'independent'">
                        <div class="column is-12 divide-form"></div>
                        <div class="column is-12-mobile is-6 field">
                            <label for="tipo-vehiculo" class="label text">Tipo de Vehículo</label>
                            <div class="select">
                                <select name="tipo" id="tipo-vehiculo" v-model="vehicle.transport">
                                    <option value="">Seleccione</option>
                                    <option v-for="(transport, index) in transports" :key="'volumen-' + index" :value="transport.id">
                                        {{ transport.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="column is-12-mobile is-6 field">
                            <label for="carga" class="label text">Carga TM</label>
                            <div class="select">
                                <select name="carga" id="carga" v-model="vehicle.weight">
                                    <option value="">Seleccione</option>
                                    <option v-for="(weight, index) in weights" :key="'volumen-' + index" :value="weight.id">
                                        {{ weight.weight }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="column is-12-mobile is-6 field">
                            <label class="label text">Volumen</label>
                            <div class="control">
                                <div class="select">
                                    <select name="volumen" id="volumen" v-model="vehicle.bulk">
                                        <option value="">Seleccione</option>
                                        <option v-for="(bulk, index) in bulks" :key="'volumen-' + index" :value="bulk.id">
                                            {{ bulk.bulk }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="column is-12-mobile is-6 field">
                            <label class="label text">Placa de vehículo</label>
                            <div class="control">
                                <input class="input" type="text" placeholder="" name="phone" v-model="vehicle.placa">
                            </div>
                        </div>

                        <div class="column is-12">
                            <p class="text has-text-centered">
                                Incrementa tus clientes añadiendo una foto de tu vehículo
                            </p>
                        </div>

                        <div class="column is-12 has-text-centered">
                            <!-- <div class="content-input-file content-input-file-big">
                                <span>Subir foto de vehículo</span>
                                <input type="file" class="input-file input-file-big" @change="_getFile($event, 'vehicle')">
                            </div> -->
                            <input-file-auth title="Subir foto de vehículo" classes="content-input-file-big" v-on:get-file="_getFileVehicle"></input-file-auth>
                        </div>
                    </template>
                    <div class="column is-12" v-if="user.type == 'company'">
                        <p class="text has-text-centered">
                            El administrador confirmará su solicitud para usar la app
                        </p>
                    </div>
                    <div class="column is-12 field has-text">
                        <div class="control">
                            <label class="checkbox auth-link text">
                                <input type="checkbox" class="checkbox-input" v-model="user.terms">
                                <span class="checkbox-btn"></span>
                                <span>
                                    He leído los
                                    <a href="#" class="text auth-link text-is-green-lighten"> términos y condiciones</a>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="column is-12 has-text-centered">
                        <button type="submit" class="button button-registration is-green-light text-is-blue">
                            REGISTRAR
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </section>
</template>

<style>
    .cls-1{
        fill:none;
    }
    .cls-2{
        clip-path:url(#clip-path);
    }
    .cls-3{
        fill:#fff;
        opacity:0.19;
    }
    .redirect-back{
        width:25px;
        height:25px;
    }
    @media (max-width: 396px) {
        .responsive-swal{
            text-align: center;
        }
    }
</style>


<script>
    export default {
        template: "#template-registro-independiente",

        props: {
            asset: {
                type: String,
                default: ""
            },
            transports: {
                type: Array,
                default: []
            },
            weights: {
                type: Array,
                default: []
            },
            bulks: {
                type: Array,
                default: []
            },
            'type-form': {
                type: String,
                default: ""
            }
        },

        data() {
            return  {
                user: {
                    first_name: "",
                    last_name: "",
                    company_name: "",
                    dni: "",
                    email: "",
                    password: "",
                    password_confirmation: "",
                    phone: "",
                    avatar: "",
                    type: "",
                    ruc:"",
                    terms: false
                },
                vehicle: {
                    transport: "",
                    weight: "",
                    placa: "",
                    bulk: "",
                    photo: ""
                },
                formData: null
            }
        },

        methods: {

            _redirectback (){
                window.history.back();
            },
            showPassword(pass,eye) {
		      if ($('#'+pass).attr('type') == 'password') {
		        $('#'+pass).attr('type', 'text')
		        $('#'+eye).removeClass('fa-eye')
		        $('#'+eye).addClass('fa-eye-slash')
		      } else {
		       $('#'+pass).attr('type', 'password')
		        $('#'+eye).removeClass('fa-eye-slash')
		        $('#'+eye).addClass('fa-eye')
		      }
			},
            _doRegister () {
                if(!this.user.terms) {
                    swal('', "Primero debe aceptar los terminos y condiciones", 'error');
                    return;
                }
                this.formData = new FormData();

                this._generateFormData(this.user);

                if(this.user.type === "independent") {
                    this._generateFormData(this.vehicle);
                }

                axios.post('post-register', this.formData)
                    .then(res => {
                        swal('', 'Su registro fue exitoso \n Se ha enviado un correo con un código de validación', 'success');

                        setTimeout(() => {
                            window.location = urlBase + 'login'
                        }, 2000)
                    })
                    .catch(err => {
                        let message = "Disculpe, ha ocurrido un error";
                        console.log(err)
                        
                        if (err.response.status === 422) {
                            message = err.response.data.error
                        }
                        swal('', message, 'error');
                    })
            },

            _getFileProfile(file, type) {
                this.user.avatar = file.file
            },

            _getFileVehicle(file, type) {
                this.vehicle.photo = file.file
            },

            _generateFormData(data){
                Object.getOwnPropertyNames(data).forEach(key => {
                    if(key !== "__ob__") {
                        this.formData.append(key, data[key])
                    }
                })
            }
        },

        mounted() {
            this.user.type = this.typeForm;
            var sweetAlert = document.createElement("script");
            sweetAlert.src = "https://unpkg.com/sweetalert/dist/sweetalert.min.js";
            sweetAlert.id = "swal";
            document.getElementsByTagName('head')[0].appendChild(sweetAlert);
        }
    }
</script>
