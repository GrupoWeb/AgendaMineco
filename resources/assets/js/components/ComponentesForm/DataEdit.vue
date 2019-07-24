<template>
  <div class="container">
    <el-row :gutter="20">
      <el-col :span="18" type="flex">
        <el-card :body-style="{ margin:'10px'}">
          <div slot="header" class="clearfix">
            <span>Documentar Evento</span>
          </div>
          <div class="text item">
            <el-form
              ref="form"
              :model="form"
              label-width="120px"
              v-for="(formulario, fm) of DataResult"
              :key="fm"
            >
              <el-form-item label="Tema:">
                <el-input v-model="formulario.accion" :disabled="true" style="font-size:1.2em;"></el-input>
              </el-form-item>
              <el-form-item label="Responsable: ">
                <el-input
                  v-model="formulario.responsable"
                  :disabled="true"
                  style="font-size:1.2em;"
                ></el-input>
              </el-form-item>
              <el-form-item label="Fecha:">
                <el-col :span="11">
                  <el-date-picker
                    type="date"
                    placeholder="Pick a date"
                    v-model="formulario.created_at"
                    style="width: 100%;"
                    :disabled="true"
                  ></el-date-picker>
                </el-col>
              </el-form-item>

              <el-form-item label="Archivo:">
                <el-upload
                  class="upload-demo"
                  action="/upload"
                  name="file[]"
                  :headers="{ 'X-CSRF-TOKEN': csrf}"
                  :on-preview="handlePreview"
                  :on-remove="handleRemove"
                  :on-success="cargaSuccess"
                  multiple
                  :limit="3"
                  :on-exceed="handleExceed"
                  :file-list="fileList"
                >
                  <el-button size="small" type="primary">Clic para subir archivo</el-button>
                  <div
                    slot="tip"
                    class="el-upload__tip"
                  >Solo archivos jpg/png con un tamaño menor de 500kb</div>
                </el-upload>

                <!-- <el-upload
                  class="upload-demo"
                  drag
                  ref="upload"
                  name="file"
                  :data="form"
                  :action="'upload/?token='+csrf"
                  :auto-upload="true"
                  
                  :on-success="cargaSuccess"
                >
                  <i class="el-icon-upload"></i>
                  <div class="el-upload__text">
                    Drop file here or
                    <em>click to upload</em>
                  </div>
                  <div class="el-upload__tip" slot="tip">jpg/png files with a size less than 500kb</div>
                </el-upload> -->
              </el-form-item>
            </el-form>

            <el-form label-width="120px">
              <el-form-item label="Mensajes:">
                <div class="chat">
                  <div class="chatbox" v-for="(chat, ch) of Message" :key="ch">
                    <div v-if="chat.user_id ===  user" class="mine messages">
                      <div class="message last">{{ chat.message}}</div>
                    </div>

                    <div v-else class="yours messages">
                      <div class="message">{{ chat.message}}</div>
                    </div>
                  </div>
                </div>
              </el-form-item>
              <el-form-item label="Anotaciones:">
                <el-input type="textarea" name="anotacion" v-model="textarea"></el-input>
              </el-form-item>
              <el-form-item>
                <el-button type="primary" @click="onSubmit">Documentar</el-button>
                <el-button>Cancel</el-button>
              </el-form-item>
            </el-form>
          </div>
        </el-card>
      </el-col>

      <!-- <el-col :span="12" type="flex">
        <el-card :body-style="{ margin:'10px'}">
          <div slot="header" class="clearfix">
            <span>Mensaje Interactivo</span>
          </div>
          <div class="text item"></div>
        </el-card>
      </el-col>-->
    </el-row>
  </div>
</template>

<style>
.el-row {
  margin-bottom: 20px;
  margin-left: 20px;
}

.chatbox {
  width: 100%;
}

.entrante {
  list-style: none;
  background-color: beige;
  border-radius: 10px;
  padding-left: 20px;
  width: 75%;
}

.messages {
  margin-top: 5px;
  display: flex;
  flex-direction: column;
}
.chat {
  width: 100%;
  border: solid 1px #eee;
  display: flex;
  flex-direction: column;
  padding: 10px;
}

.message {
  border-radius: 20px;
  padding: 4px 15px;
  margin-top: 5px;
  margin-bottom: 5px;
  display: inline-block;
}

.yours {
  align-items: flex-start;
}

.yours .message {
  margin-right: 25%;
  /* background-color: #eee; */
  background-color: #ece5dd;
  position: relative;
}

.yours .message.last:before {
  content: "";
  position: absolute;
  z-index: 0;
  bottom: 0;
  left: -7px;
  height: 20px;
  width: 20px;
  background: #eee;
  border-bottom-right-radius: 15px;
}
.yours .message.last:after {
  content: "";
  position: absolute;
  z-index: 1;
  bottom: 0;
  left: -10px;
  width: 10px;
  height: 20px;
  background: white;
  border-bottom-right-radius: 10px;
}

.mine {
  align-items: flex-end;
}

.mine .message {
  color: #000;
  margin-left: 25%;
  background: #dcf8c6;
  /*background: linear-gradient(to bottom, #00D0EA 0%, #0085D1 100%);*/
  background-attachment: fixed;
  position: relative;
}

.mine .message.last:before {
  content: "";
  position: absolute;
  z-index: 0;
  bottom: 0;
  right: -8px;
  height: 20px;
  width: 20px;
  background: #dcf8c6;
  /*background: linear-gradient(to bottom, #00D0EA 0%, #0085D1 100%);*/
  background-attachment: fixed;
  border-bottom-left-radius: 15px;
}

.mine .message.last:after {
  content: "";
  position: absolute;
  z-index: 1;
  bottom: 0;
  right: -10px;
  width: 10px;
  height: 20px;
  background: white;
  border-bottom-left-radius: 10px;
}
</style>

<script>
export default {
  
  props: {id:{type:Number}, user:{type:Number},csrf:{
                type: String
            }},
  data() {
    return {
      form: {
        name: "12",
        region: "",
        date1: "",
        date2: "",
        delivery: false,
        type: [],
        resource: "",
        desc: ""
      },
      form2: {},
      fileList: [
        {
          name: "food.jpeg",
          url:
            "https://fuss10.elemecdn.com/3/63/4e7f3a15429bfda99bce42a18cdd1jpeg.jpeg?imageMogr2/thumbnail/360x360/format/webp/quality/100"
        }
      ],
      DataResult: {
        created_at: ""
      },
      Responsables: [],
      Message: [],
      textarea: "",
      anotacion: "",
      message: "",
      id_user: "",
      id_evento: ""
    };
  },
  mounted() {
    // invocar los métodos
    this.llenado();
    this.getResponsables();

    this.getChat();
    setInterval(() => {
      this.getChat();
    }, 1000);
  },
  methods: {
    llenado: function(id) {
      axios
        .get("/searchEvento/" + id)
        .then(response => {
          // handle success
          this.DataResult = response.data;
          //console.log(response.data);
          //this.total= response.data;
          //console.log(this.DataResult);
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .finally(function() {
          // always executed
        });
    },
    getResponsables: function() {
      axios
        .get("/getDataRes")
        .then(response => {
          this.Responsables = response.data;
          //console.log(response.data);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    getChat: function(id) {
      axios
        .get("/getChat/" + id)
        .then(response => {
          this.Message = response.data;
          //console.log(response.data);
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    onSubmit() {
      let anotacion;
      anotacion = this.textarea;
      //anotacion = this.textarea;
      var url = "/addMessages";
      axios
        .post(url, {
          message: this.textarea,
          id_user: this.user,
          id_evento: this.id
        })
        .then(response => {
          // $('#table-vue-asede').DataTable().ajax.reload();
          //$("#snoAlertBox").fadeIn();
          //closeSnoAlertBox("#snoAlertBox");
          //this.$message.warning(`El límite es 3, haz seleccionado  archivos esta vez, añade hasta `);
          this.textarea = "";
          console.log("guardado");
        })
        .catch(error => {
          console.log(error.message);
        });
    },
    handleRemove(file, fileList) {
      let vm = this
        axios.delete('/upload/' + file.uid)
            .then(function () {
                let index = _.findIndex(vm.fileList, ['uid', file.uid])
                vm.$delete(vm.fileList, index)
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    handlePreview(file) {
      console.log(file);
    },
    handleExceed(files, fileList) {
      this.$message.warning(
        `El límite es 3, haz seleccionado ${
          files.length
        } archivos esta vez, añade hasta ${files.length + fileList.length}`
      );
    },
    cargaSuccess(response, file, fileList) {
      let id_fila = ''
      var vm = this
        _.map(response, function (data) {
            file['uid'] = data
            
        })
        vm.fileList = fileList;
      
      var url = "/Uploadfile";
      axios
        .post(url, {
          id_evento: this.id,
          id_file: file.uid
        })
        .then(response => {
          this.$message.success(`Documento Cargado`);
        })
        .catch(error => {
          console.log(error.message);
        });
    },
    submitForm2 () { 
      this.loading = true 
      if(this.$refs.upload._data.uploadFiles.length !== 0){ 
        return this.$refs.upload.submit() 
      } 
        return axios.post('/api/v1/news/store',this.form)
          .then((response) =>{ 
              this.$emit('news-data',response.data.data) 
              this.loading = false 
              this.closeNewsForm() 
              this.resetForm() 
          })
          .catch((error) =>{ 
              this.form.errors = error.response.data.errors 
              this.loading = false 
              console.log(error.response.data) 
          }) 
    }
  }
};
</script>
