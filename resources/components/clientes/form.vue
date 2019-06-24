<template>
    <el-container v-if="mostrar_form">
        <el-main>



<el-form :label-position="labelPosition" :model="Form">            
  <form autocomplete="off" @submit.prevent="submit" v-loading="loading"
        element-loading-text="Cargando..."
        element-loading-spinner="el-icon-loading">
<el-card class="box-card">
  <div slot="header" class="clearfix card-headers">
    <span>
<i class="fa fa-users"></i> {{ form_title }}
    </span>
  </div>
  <div class="text item">

            <div class="row" >
            <div class="col-xs-12 col-sm-6 col-md6">
                <x-form-group label="Nombres" :error="errors.name">
                    <el-input v-model="Form.name" :class="{'has-danger': error && error.length}"></el-input>
                </x-form-group>
            </div>
            <div class="col-xs-12 col-sm-6 col-md6">
                    <x-form-group label="Apellidos Paterno" :error="errors.surnames">
                        <el-input v-model="Form.surnames"></el-input>
                    </x-form-group>
            </div>
            </div>
            <div class="row" >
                    <div class="col-xs-12 col-sm-6 col-md6">
                        <x-form-group label="Direccion" :error="errors.address">
                            <el-input v-model="Form.address"></el-input>
                        </x-form-group>
                    </div>
                <div class="col-xs-12 col-sm-6 col-md6">
                    <x-form-group label="Email" :error="errors.email">
                        <el-input v-model="Form.email"></el-input>
                    </x-form-group>
                </div>
            </div>
            <div class="row">
            <div class="col-xs-12 col-sm-2 col-md2">
                <x-form-group label="Documento" :error="errors.document">
                    <el-input v-model="Form.document" ></el-input>
                </x-form-group>

            </div>
                <div class="col-xs-12 col-sm-3 col-md3">
                    <x-form-group label="N° Documento" :error="errors.number">
                        <el-input v-model="Form.number" ></el-input>
                    </x-form-group>
                </div>
            <div class="col-xs-12 col-sm-3 col-md3">
                <x-form-group label="N° Telefono" :error="errors.telephone">
                    <el-input v-model="Form.telephone" ></el-input>
                </x-form-group>

            </div>
            <div class="col-xs-12 col-sm-2 col-md2">
                <x-form-group label="Fecha de Nacimiento" :error="errors.birthdate">
                    <el-input v-model="Form.birthdate"></el-input>
                </x-form-group>

            </div>
            <div class="col-xs-12 col-sm-2 col-md2">

                    <x-form-group label="Edad" :error="errors.age">
                        <el-input v-model="Form.age" ></el-input>
                    </x-form-group>




            </div>  
            </div>
 </div>
    <el-footer>
    <el-button type="primary" @click="submit()">Guardar</el-button>
    <el-button type="danger" @click="close_form()">Cerrar</el-button>
    </el-footer>
</el-card>
</form>
   </el-form>           
        </el-main>    
    </el-container>
</template>
 
<script>
  export default {
      props:['title_form','mostrar_form','recordId','error'],
data() {

      return {    
          loading: false,
          loading_submit: false,
          form_title: null,
          errors:{},
          resource:'clients',
          value: '',          
          Form: {   
        },
        
        labelPosition:'top'
      };
    },
        watch: {
            recordId () {
              this.getRecord();
            console.log(this.recordId)
            },
        },    
    created(){
      this.initForm()
    } ,

    methods: {
    initForm(){
        this.errors={}
       this.Form= {
             id: null,
             name: '',
            surnames: '',
            document: '',
            number: '',
            address:'',
            telephone: '',
            birthdate: '',
            age: ''          
        }
    } ,            
      async getRecord() {
        this.loading = true;
       // console.log(this.recordId)
        if(this.recordId!=0) {
          this.form_title = 'Editar registro';
                    await this.$http.get(`/${this.resource}/${this.recordId}`)
                        .then(response => {
                            //if (response.data !== '') {
                                this.Form = response.data

                            //}
                        })
                
        } else {
          this.form_title = 'Nuevo registro';
        }
        this.loading = false;
      },
    submit() {
 this.loading = true
                this.loading_submit = true
                this.$http.post(`/${this.resource}`, this.Form)
                    .then(response => {
                        if (response.data.success) {
                            this.$message.success(response.data.message)
                         this.$eventHub.$emit('reloadData')
                         this.$emit('update:mostrar_form', false);
                            this.$emit('update:recordId', 0);

                         this.initForm();
                        } else {
                           // this.errors = error.response.data.errors
                          //  console.log( error.response.data)

                            this.$message.error(response.data.message)
                        }
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors

                        } else {
                            console.log(error)
                        }
                    })
                    .then(() => {
                        this.loading_submit = false
                        this.loading = false
                    })
      },
      close_form(){
        this.$emit('update:mostrar_form', false);
        this.$emit('update:error',{});

      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
      }
    }
  }
</script>
