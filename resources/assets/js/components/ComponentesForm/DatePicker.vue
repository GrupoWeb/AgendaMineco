<template>

  <div class="row">
          
              <span class="demonstration">Fecha::</span>
              <el-date-picker
              v-model="value1"
              type="date"
              range-separator="A"
              start-placeholder="Fecha Inicial"
              end-placeholder="Fecha Final"
              name="fecha"
              format="yyyy-MM-dd"
              >
              </el-date-picker>
          <!-- <span class="demonstration">Estado: </span>
          <el-select name="idestado" class="vue-select" v-model="select2" placeholder="Estado" >
            <el-option v-for="(item,idx) in estado" :key="idx" :label=" item.nombre " :value=" item.id "></el-option>
          </el-select> -->

          
  </div>


</template>

<style>
    .el-input__inner{
        width: 100% !important;
    }
    .el-range-separator{
        width: 100px !important;
    }
    .demonstration, .el-range-separator{
      font-weight: bold;
      padding-right: 10px;
      padding-left: 5px;
    }
    
</style>


<script>
  export default {
    props: ['estado'],
    data() {
      return {
        pickerOptions: {
          disabledDate(time) {
            return time.getTime() > Date.now();
          },
          
        },
        value1: '',
        select2: 'Seleccione una Opción',
        
      };
     
    }
    
  };
</script>