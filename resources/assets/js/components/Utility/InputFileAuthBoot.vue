<template id="template-input-auth">
    <div class="container-input-file" :class="classes">
        <div class="content-input-file-preview">
            <div class="no-image" v-if="preview === ''"></div>
            <img :src="preview" v-else class="preview-img">
        </div>

        <div class="content-input-file">
            <span>{{ title }}</span>
        </div>
        <input type="file" class="input-file" @change="_previsualizar($event)">
    </div>
</template>

<style>
    .no-image {
        height: 100px;
        width: 100px;
        background-color: rgba(250, 250, 250, 0.64);
        border-radius: 50%;
        margin: auto;
        margin-bottom: 1rem;
        border: 1px solid #2580D3;
    }

    .container-input-file {
        margin: auto;
        position: relative;
        overflow: hidden;
    }

    .custom-file {
        position: relative;
        display: inline-block;
        max-width: 100%;
        height: 2.5rem;
        margin-bottom: 0;
        cursor: pointer;
    }

    .custom-file-label {
        color: #2580D3;
        display: block;
    }

    .preview-img {
        height: 100px;
        width: 100px;
        border-radius: 50%;
        margin: auto;
        margin-bottom: 1rem;
        object-fit: contain;
    }

    .input-file {
        width: calc(100% + 200px);
        left: -200px;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 1;
    }

    .content-input-file {
        border: 2px solid #2580D3;
        color: #2580D3;
        position: relative;
        cursor: pointer;
        margin: auto;
    }

    .content-input-file-medium {
        width: 192px;
    }

    .container-input-file-preview {
        margin: auto;
        position: relative;
        overflow: hidden;
    }
</style>

<script>
export default {
    template: "#template-input-auth",

    data() {
        return {
            preview: ""
        }
    },

    props: {
        classes: {
            type: "",
            default: String
        },
        
        title: {
           type: "",
            default: String 
        }
    },

    methods: {
        _previsualizar(evt) {
            this.preview = "";

            let files = evt.target.files;

            for (let i = 0, f; (f = files[i]); i++) {
                //Solo admitimos imágenes.                
                if (!f.type.match("image.*")) {
                    return false;
                }

                let type = "";

                if(f.type.match("image.*")){
                    this.isVideo = false;
                    this.isImage = true;
                    type = "image";
                }

                this.$emit("get-file", {file: files[i], type: type});
                
                let reader = new FileReader();

                reader.onload = (theFile => {
                    return e => {
                        this.preview = e.target.result;
                    };
                })(f);

                reader.readAsDataURL(f);
            }
        }
    }
}
</script>
