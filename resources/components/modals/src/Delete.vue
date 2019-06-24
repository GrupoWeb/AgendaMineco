<template>
<el-dialog
  center
  title="Aviso de Advertencia"
  :visible="showDialog" 
  :show-close="true" 
   @close="clickClose"
    @open="handleOpen" 
  width="30%">
  <form autocomplete="off" @submit.prevent="submit" v-loading="loading" class="text-center">
  <span class="text-center"><h3>Desea Eliminar el Registro</h3></span>
  <span slot="footer" class="dialog-footer">
    <el-button @click.prevent="clickClose()">Cancelar</el-button>
    <el-button type="danger" native-type="submit" :loading="loading_submit">Confirmar</el-button>
  </span>
  </form>
</el-dialog>
</template>

<script>

    export default {
        props: ['showDialog', 'resource', 'description'],
        data() {
            return {
                loading: false,
                loading_submit: false,
                titleDialog: null,
                errors: {},
            }
        },
        created() {
            this.titleDialog = 'Eliminar'
            this.initForm()
        },
        methods: {
            initForm() {
                this.errors = {}
            },
            async handleOpen() {
                this.loading = true
                this.initForm()
                this.loading = false
            },
            submit() {
                this.loading = true
                this.loading_submit = true
                this.$http.delete(`/${this.resource}`)
                    .then(res => {
                        this.clickClose()
                        this.$message.success('Se eliminó correctamente el registro')
                        this.$eventHub.$emit('reloadData')
                    })
                    .catch(error => {
                        if (error.response.status === 500) {
                            this.$message.error('Error al intentar eliminar');
                        } else {
                            console.log(error.response.data.message)
                        }
                    })
                    .then(() => {
                        this.loading_submit = false
                        this.loading = false
                    })
            },
            clickClose() {
                this.$emit('update:showDialog', false)
            }
        }
    }
</script>