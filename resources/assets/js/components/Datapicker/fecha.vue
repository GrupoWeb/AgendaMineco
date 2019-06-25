<template>

        <div class="block" >
            <span class="demonstration">Fecha de Evento:</span>
            <el-date-picker
            v-model="value1"
            type="daterange"
            range-separator="To"
            start-placeholder="Fecha Inicial"
            end-placeholder="Fecha Final"
            name="data1"
            format="dd-MM-yyyy"

            >
            </el-date-picker>
        </div>
</template>

<style>
    .el-input__inner{
        width: 100% !important;
    }
    .el-range-separator{
        width: 100px !important;
    }
</style>


<script>
  export default {
    data() {
      return {
        pickerOptions: {
          disabledDate(time) {
            return time.getTime() > Date.now();
          },
          
        },
        value1: '',
        value2: '',
        
      };
     
    }
    
  };
</script>