<template>
<el-container>
      <el-main>
        <template  v-if="!mostrar_form">
            <el-main class="header-tool">
                <template>
                    <div class="row">
                        <div class="col-6 ">
                            <el-button v-if="mostrar_form==false"
                                       type="primary"  size="mini"
                                       icon="el-icon-document" class="text-right" @click="cargar_datos()">Nuevo</el-button>
                            <el-button v-if="mostrar_form==false"
                                       type="primary"  size="mini"
                                       icon="el-icon-document" class="text-right">Exportar</el-button>
                        </div>
                        <div class="col-6 text-right">
                            <div class="row">
                                <div class="col-6">
                                    <el-select  v-model="criterio"  size="mini">
                                        <el-option

                                            v-for="item in options"
                                            :key="item.value"
                                            :label="item.label"
                                            :value="item.value">
                                        </el-option>
                                    </el-select>

                                </div>
                                <div class="col-6">
                                    <el-input
                                        :change="listar_clientes(1,this.search,this.criterio)"
                                        size="mini"
                                        placeholder="Buscar Cliente"
                                        v-model="search"
                                        prefix-icon="el-icon-search">
                                    </el-input>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>

                </el-main >
        <template>
                    <el-main >
                        <el-table
                            class="bordess"
                            v-loading="tableloading"
                            element-loading-text="Cargando..."
                            element-loading-spinner="el-icon-loading"
                            :data="tableData"
                            style="width: 99.8%"
                            border>
                            <el-table-column
                                sortable
                                data-label="N° Documento"
                                label="N° Documento"
                                prop="number">
                            </el-table-column>

                            <el-table-column
                                label="Nombres"
                                data-label="Nombres"
                                sortable
                                prop="name">
                            </el-table-column>
                            <el-table-column
                                label="Apellidos"
                                data-label="Apellidos"
                                sortable
                                prop="surnames">
                            </el-table-column>
                            <el-table-column
                                align="center"
                                label="Acciones">
                                <template slot-scope="scope">
                                    <el-button type="primary"
                                               @click="Editar_rows(scope.$index, scope.row)" icon="el-icon-edit"></el-button>
                                    <el-button
                                        type="danger"
                                        @click="handleDelete(scope.$index, scope.row)" icon="el-icon-delete"></el-button>
                                </template>
                            </el-table-column>
                        </el-table>


                        <modal-delete-form v-if="buttonDelete"
                                           :showDialog.sync="showDialogModalDeleteForm"
                                           :resource="resourceDelete"></modal-delete-form>
                        <el-footer>

                            <template>
                                <paginacion  :mostrar_form.sync="mostrar_form"
                                             :pageActive.sync="pageActive"
                                             :per_page.sync="per_page" :total.sync="total" :loading="loading">
                                </paginacion>
                            </template>

                        </el-footer>
                    </el-main>
        </template>

        </template>
      
<form-cliente :mostrar_form.sync="mostrar_form"  :title_form="title_form"
 :recordId.sync="recordId"></form-cliente>
</el-main>

</el-container>
</template>

<script>
   import Paginacion from '../../components/paginador/pagination'
    import ModalDeleteForm from '../../components/modals/src/Delete'
    import FormCliente from '../../components/clientes/form'

  export default {
   props: {
            resource: {
                type: String,
                default: 'clients'
            },
            buttonDelete: {
                type: Boolean,
                default: true
            },
        
        },
        components: {
          ModalDeleteForm,
          FormCliente,
          Paginacion},
        
    data() {
      return {
          options: [{
              value: 'number',
              label: 'N° DNI'
          }, {
              value: 'name',
              label: 'Nombres'
          }],
          value: 'number',
        tableData: [],
        search: '',
        loading:true,
        tableloading:true,
        true:true,
        showDialog: false,
        
        listar:true,
         showDialogModalDeleteForm: false,
        mostrar_form:false, 
        per_page:null,
        total:null,
         resourceDelete: null,

         offset:3,
          criterio:'',
        buscar:'',
        title_form: null,
        recordId:null,
        pageActive:1
      }
    },
      async created() {
              this.$eventHub.$on('reloadData', () => {
                  this.tableloading=true;
              this.listar_clientes(1,'','dni_ruc');

              })
               this.$eventHub.$on('loading..', (val) => {            
                console.log(this.tableloading)
                   this.tableloading=val;
              })  
this.$eventHub.$on('paginar', (row) => {
                this.listar_clientes(row,'','number');
                this.tableloading=false;
              })  
      },
    methods: {
        listar_clientes:function(page,buscar,criterio){
        let me=this
        var url_page='/'+me.resource+'/records/?page='+page+'&buscar='+buscar+'&criterio='+criterio;
    axios.get(url_page)
        .then(function (response){
            var respuesta=response.data

            me.tableData = respuesta.clientes.data
            me.loading=false;
            me.tableloading=false;
            me.per_page=respuesta.pagination.per_page
            me.total=respuesta.pagination.total
        })
        me.loading=false;
        },        
      Editar_rows(index, row) {
        this.mostrar_form=true;
        this.recordId=row.id


},
        cargar_datos(){
        this.mostrar_form=true;
        this.recordId=0

}
      ,
      handleDelete(index, row) {
        this.showDialogModalDeleteForm = true
        this.resourceDelete = `${this.resource}/${row.id}`
      }
    },
    mounted(){
       this.listar_clientes(1,'','number');
    }
  }
</script>
