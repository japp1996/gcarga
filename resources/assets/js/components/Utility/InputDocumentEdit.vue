<template id="template-input-document">
    <div class="file-field input-field-component" :style="styles">
        <!-- <label for="">Fotografía del estudiante</label> -->
        <div class=preview-document>

            <!-- Previsualizacion de la imagen que se obtiene a traves del props -->
            <!-- style="width:500px; height:500px;" frameborder="0" -->
            <!-- <iframe :src="fileview" v-if="preview === '' && fileview !== ''"></iframe> -->
            <iframe :src="_setFile" v-if="preview === '' && file !== '' && !isImage"></iframe>

            <!-- Previsualizacion de la imagen que se obtiene a traves del methodod: -->
            <!-- style="width:500px; height:500px;" -->
            <iframe :src="preview" v-else-if="preview !== '' && !isImage" frameborder="0"></iframe>

            <img class="file-img" :src="file" v-else-if="isImage && file !== '' && preview === ''">

            <img class="file-img" :src="preview" alt="" v-else-if="isImage && preview !== ''">
            
            <!-- Previsualizacion de la imagen que se obtiene a traves del props _previsualizar-->
            <div class="no-document" v-else>
                <img :src="'img/icons/ico-' + classFile + '.png' | asset" alt="">
            </div>

        </div>

        <div class="center-add-document" v-if="!onlyPreview">
            <div class="btn btn-primary file">
                <span>{{text != "" ? text : 'Subir' }}</span>
                <input type="file" id="add-file" @change="_previsualizar($event)">
            </div>
        </div>

    </div>
</template>

<style lang="scss" scoped>
    .word {
        color: #166091; 
    }
    .powerpoint {
        color: #f44336;
    }
    .excel {
        color: #4caf50;
    }

    .input-field-component{
        width: 150px;
        margin: auto;

        .center-add-document{
            display: flex;
            justify-content: center
        }

        .preview-document{

            display: flex;
            justify-content: center;
            height: 100px;
            margin-bottom: .9rem;

            .no-document{
                flex: 0 1 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 5rem;
                background: transparent;

                img {
                    width: 60px;
                    height: auto;
                    margin-left: -1vw;
                }
            }

            iframe{
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            .file-img{
                height: 100%;
                width: 100%;
                object-fit: contain;
                object-position: top;
            }
        }
    }

</style>


<script>
export default {
    template: "#template-input-document",
    name: "inputdocument",
    props: {
        file: {
            type: String,
            default: ""
        },
        text: {
            type: String,
            default: ""
        },
        url: {
            type: String,
            default: ""
        },
        video: {
            type: Boolean,
            default: false
        },
        image: {
            type: Boolean,
            default: false
        },
        'type-file': {
            type: String,
            default: ""
        },
        identification: { 
            default: 0
        },
        styles: {
            type: Object,
            default(){
                return {
                    margin: 'auto'
                }
            }
        },
        'only-preview': {
            type: Boolean,
            default: false
        },
        'can-document': {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            fileview: "",
            preview: "",
            type: "",
            file_save: {},
            isVideo: false,
            isImage: false,
            classFile: 'subir',
            extension: ['docx', 'doc', 'xlsx', 'xls', 'pptx', 'ppt', 'pdf'],
            extensionImg: ['jpg', 'png', 'gif', 'jpeg'],
            accept: ['png', 'jpg', 'jpeg', 'gif'],
            exe: false,
            loaded: false,
            type_file_message: '',
            files: ""
        };
    },
    methods: {

        _previsualizar(evt) {
            if (!this.canDocument) {
                let format = evt.target.files[0].type.split('/')
                let answer = ((this.accept.indexOf(format[1].toLowerCase())) > -1)   
                if (!answer) {
                    this.file_save = {}
                    swal('', 'Solo puede subir imagenes con formato PNG, JPG, GIF, y JPEG', "error")
                    return false;
                }
            }
            let wordType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            let wordType2 = 'application/msword';
            let powerpointType = 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
            let excelType = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            let excelType2  = 'application/vnd.ms-excel';
            let pdfType = 'application/pdf';
            let googleViewer = 'https://docs.google.com/gview?url=';
            if (evt.target.files.length > 0) {
                this.preview = "";
                this.files = evt.target.files[0].name;
                this.file_save = evt.target.files[0];
                this.showZoneRender = true;
                this.loaded = true;

                let files = evt.target.files;
                this.isImage = false;

                for (let i = 0, f; (f = files[i]); i++) {
                    let type = "";
                    this.$emit("file", {file: files[i], type: type});

                    if (f.type == wordType || f.type == wordType2) {
                        this.classFile = 'word';
                        this.fileview = "";
                        return
                    } 

                    if (f.type == excelType || f.type == excelType2) {
                        this.classFile = 'excel';
                        this.fileview = "";
                        return
                    } 

                    if(f.type == powerpointType) {
                        this.classFile = 'powerpoint';
                        this.fileview = "";
                        return
                    }

                    if(f.type == pdfType) {
                        this.classFile = 'pdf';
                        this.fileview = "";
                        return
                    }

                    if(f.type.match("image.*")){
                        this.isImage = true;
                    }
                    
                    let reader = new FileReader();
                    reader.onload = (theFile => {
                        return e => {
                            this.preview = e.target.result;
                        };
                    })(f);

                    reader.readAsDataURL(f);
                }
            }
        },

        dataURItoBlob(dataURI) {
            // convert base64/URLEncoded data component to raw binary data held in a string
            var byteString;
            if (dataURI.split(',')[0].indexOf('base64') >= 0)
                byteString = atob(dataURI.split(',')[1]);
            else
                byteString = unescape(dataURI.split(',')[1]);

            // separate out the mime component
            var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

            // write the bytes of the string to a typed array
            var ia = new Uint8Array(byteString.length);
            for (var i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }

            return new Blob([ia], {type:mimeString});
        },

        _uploadFile(){
            let formData = new FormData();
            formData.append(this.typeFile,this.file_save)
            axios.post(this.url+`${this.identification}`, formData)
                .then(res => {
                    if(res.data.result){
                        swal({
                            title: "",
                            text: `Se ha enviado la ${this.type_file_message} con éxito`,
                            timer: 2000,
                            showConfirmButton: false,
                            type: "success"
                        });
                        this.loaded = false;
                        // this._back(false, res.data.course);
                    }
                })
                .catch(err => {
                    console.log(err)
                })
                .then(() =>{
                    quitLoading();
                    this.type_file_message = '';
                })
        },

        _processFile(){
            if(this.file != "" && this.file != undefined) {

                let me = this
                this.isImage = true;
                this.fileview = this.file;

                if (this.canDocument) {

                    let extension = this.file.split('.').pop();
                    if (this.extension.indexOf(extension) > -1) {
                        this.file = "";

                        if (extension == 'docx' || extension == 'doc') {
                            this.classFile = 'word';
                            this.fileview = "";
                            this.type_file_message = 'Documento';
                            //this._uploadFile();
                            return
                        } 

                        if (extension == 'xlsx' || extension == 'xls') {
                            this.classFile = 'excel';
                            this.fileview = "";
                            this.type_file_message = 'Documento';
                            //this._uploadFile();
                            return
                        } 

                        if(extension == 'pptx' || extension == 'ppt') {
                            this.classFile = 'powerpoint';
                            this.fileview = "";
                            this.type_file_message = 'Documento';
                            //this._uploadFile();
                            return
                        }

                        if(extension == 'pdf') {
                            this.classFile = 'pdf';
                            this.fileview = "";
                            this.type_file_message = 'Documento';
                            //this._uploadFile();
                            return
                        }

                        return
                    }

                }

                if (this.file_save.type != undefined && this.file_save.type != "") {
                    let format = this.file_save.type.split('/')
                    let answer = ((this.accept.indexOf(format[1].toLowerCase())) > -1)   
                    if (!answer) {
                        this.file_save = {}
                        swal('', 'Solo puede subir imagenes con formato PNG, JPG, GIF, y JPEG', "error")
                        return false;
                    }

                    if (!this.file_save)
                        return;
                    
                    var reader = new FileReader();
                    let tipo = format;
                    switch(tipo) {
                        case 'jpg':
                            tipo = 'image/jpeg';
                            break;

                        case 'png':
                            tipo = 'image/png';
                            break;

                        case 'jpeg':
                            tipo = 'image/jpeg';
                            break;

                        default: 
                            tipo = 'image/jpeg';
                            break;
                    }
                    //showLoading();
                    reader.readAsDataURL(this.file_save);
                    reader.onload = function(file) {
                        var tempImg = new Image();
                        tempImg.src = reader.result;

                        tempImg.onload = function() {
                            var MAX_WIDTH = 400;
                            var MAX_HEIGHT = 400;
                            var tempW = tempImg.width;
                            var tempH = tempImg.height;

                            if (tempW > tempH) {
                                if (tempW > MAX_WIDTH) {
                                tempH *= MAX_WIDTH / tempW;
                                tempW = MAX_WIDTH;
                                }
                            } else {
                                if (tempH > MAX_HEIGHT) {
                                tempW *= MAX_HEIGHT / tempH;
                                tempH = MAX_HEIGHT;
                                }
                            }
                            var resizedCanvas = document.createElement('canvas');
                            resizedCanvas.width = tempW;
                            resizedCanvas.height = tempH;
                            var ctx = resizedCanvas.getContext("2d");
                            ctx.drawImage(this, 0, 0, tempW, tempH);
                            var dataURL = resizedCanvas.toDataURL(tipo);
                            me.file_save = me.dataURItoBlob(dataURL);
                            me.type_file_message = 'Imagen';
                            //me._uploadFile()
                        }
                    }

                    return this.fileview;
                }
            }else{
                this.preview = "";
                this.file = "";
            }
        }
    },

    computed: {
        _setFile(){
            return this._processFile();
        }
    },

    watch: {
        file(value){

            if (value != undefined && value != "") {
                return this._processFile();
            }
        }
    },

    mounted(){
        this.isVideo = this.video;
        this.isImage = this.image;
    }
};
</script>
