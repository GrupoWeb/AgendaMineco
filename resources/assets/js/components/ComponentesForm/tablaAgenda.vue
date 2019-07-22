<template>
      <el-card class="box-card">
    <div slot="header" class="clearfix">
      <span>Puntos Registrados</span>
    </div>
    <el-table
        :data="DataResult.slice((currentPage-1)*pagesize,currentPage*pagesize)"
        border
        stripe
        style="width: 100%">

        <el-table-column
          prop="accion"
          label="Accion"
          >
        </el-table-column>
        <el-table-column
          prop="nombre"
          label="nombre"
          >
        </el-table-column>
        <el-table-column
          prop="fecha_inicial"
          label="Fecha Inicial"
          >
        </el-table-column>
        <el-table-column
          prop="fecha_final"
          label="Fecha Final"
          >
        </el-table-column>
        <el-table-column
          prop="observaciones"
          label="Observaciones"
          >
        </el-table-column>
        <el-table-column
          prop="estado"
          label="Estatus">
        </el-table-column>
      <el-table-column
        width="220"
        label="Operaciones">
        <template slot-scope="scope">
          <el-link :underline=false v-bind:href="'/vaciado/'+scope.row.id" :id=scope.row.id_Asignacion>  
            <el-button
              size="small"
              type="success"
              icon="el-icon-edit"
              plain>
              Editar
            </el-button>
          </el-link>
          <el-link :underline=false v-bind:href="'/Printer/'+scope.row.id" :id=scope.row.id_Asignacion>
            <el-button
              size="small"
              type="danger"
              icon="el-icon-delete-solid"
              plain
              >Eliminar 
            </el-button>
          </el-link>
          
          <!-- <el-button
            size="small"
            type="warning"
            icon="el-icon-printer"
            plain
            href="/Printer"
            @click="handleEdit(scope.$index, scope.row)">Imprimir
          </el-button> -->
        </template>
      </el-table-column>
    </el-table>
    <div style="text-align: left;margin-top: 30px;">
      <el-pagination
        background
        layout="total,prev, pager, next"
        :total="total"
        @current-change="current_change">
      </el-pagination>
    </div>
  </el-card> 
</template>


<script>
export default {
   props: ['data'],
    data() {
      return {
        DataResult:[],
        total: 0,
        pagesize:10,
        currentPage:1
        
      };
     
    },
    mounted(){
            // invocar los métodos
            this.getData();
            
           setInterval(() => {
                  this.getData();
              }, 3000);
          },
    methods: {
      getData: function(){
              axios.get('/getData')
                .then(response => {
                  // handle success
                  this.DataResult = response.data;
                  //console.log(response.data.length);
                  this.total= response.data.length;
                  //console.log(this.DataResult);
                })
                .catch(function (error) {
                  // handle error
                  console.log(error);
                })
                .finally(function () {
                  // always executed
                });
            },
      current_change:function(currentPage){
        console.log(currentPage);
        this.currentPage = currentPage;
      },
      handleSizeChange(val) {
        console.log(`${val} items per page`);
      },
    }
    
}
</script>
