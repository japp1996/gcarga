<template id="template-input-field">
  <div class="file-field input-field-component" :style="styles">
    <div class=preview-img>

      <template v-if="isVideo">
        <!-- Previsualizacion de la imagen que se obtiene a traves del props -->
        <video width="100%" height="100%" autoplay v-if="preview === '' && file !== '' && typeof file !== 'object'" loop muted>
          <source :src="[url !== '' ? file : url + '/' + file]" type="video/mp4">
        </video>
        <!-- Previsualizacion de la imagen que se obtiene a traves del methodod: -->
        <video width="100%" height="100%" autoplay v-else-if="preview !== '' && typeof preview !== 'object'" loop muted>
          <source :src="preview" type="video/mp4">
        </video>
        <!-- Previsualizacion de la imagen que se obtiene a traves del props _previsualizar -->
        <div class="no-image" v-else>
          <i class="material-icons" style="font-size: 80px">play_arrow</i>
        </div>
      </template>
        
      <template v-if="isImage">
        <!-- Previsualizacion de la imagen que se obtiene a traves del props -->
        <img :src="file" v-if="preview === '' && file !== '' && typeof file !== 'object'">

        <!-- Previsualizacion de la imagen que se obtiene a traves del methodod: -->
        <img :src="preview" v-else-if="preview !== '' && typeof preview !== 'object'">

        <!-- Previsualizacion de la imagen que se obtiene a traves del props _previsualizar-->
        <div class="no-image" v-else>
          <i class="material-icons" style="font-size: 80px;">image</i>
        </div>
      </template>

    </div>

    <div class="center-add-image">
      <div :class="btn ? 'btn' : ''">
        <span v-if="btn">
          <i class="material-icons" style="float: left">add</i>
          {{ getText() }}
        </span>
        <input type="file" id="add-file" @change="_previsualizar($event)">
      </div>
    </div>

  </div>
</template>

<style lang="scss" scoped>
  .input-field-component{
    width: 100%;
    margin: auto;

    .center-add-image{
      display: flex;
      justify-content: center
    }

    .preview-img{
      display: flex;
      justify-content: center;
      height: 180px;
      margin-bottom: .9rem;

      .no-image{
        flex: 0 1 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 5rem;
        background: #fff;
      }

      img{
        width: 100%;
        height: 100%;
        object-fit: contain;
      }
    }
  }
</style>


<script>
export default {
  template: "#template-input-field",
  name: "inputfile",
  props: {
    file: {
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
    styles: {
      type: Object,
      default(){
        return {
          margin: 'auto'
        }
      }
    },
    btn: {
      type: Boolean,
      default: true
    },
    text: {
      type: String,
      default: ""
    },
  },
  data() {
    return {
      preview: "",
      type: "",
      isVideo: false,
      isImage: false
    };
  },
  methods: {
    getText() {
      if (this.text == "") {
        this.text = añadir
      } 
      return this.text
    },
    _previsualizar(evt) {
      this.preview = "";
      this.file = "";
      this.showZoneRender = true;

      let files = evt.target.files;

      for (let i = 0, f; (f = files[i]); i++) {
        //Solo admitimos imágenes y videos.                
        if (!f.type.match("video.*") && !f.type.match("image.*")) {
          return false;
        }

        let type = "";
        if(f.type.match("video.*")){
          this.isImage = false;
          this.isVideo = true;
          type = "video";
        }

        if(f.type.match("image.*")){
          this.isVideo = false;
          this.isImage = true;
          type = "image";
        }

        this.$emit("file", {file: files[i], type: type});
          
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

  mounted(){
    this.isVideo = this.video;
    this.isImage = this.image;
  }
};
</script>
