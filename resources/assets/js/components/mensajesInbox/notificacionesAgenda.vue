<template>
    <el-badge :value=total class="item">
        <el-link href="bandeja">
            <el-button size="small">Puntos Agenda</el-button>
        </el-link>
    </el-badge>
</template>



<style>
    .item {
    margin-top: 10px;
    margin-right: 40px;
    }
</style>


<script>
export default {
    data() {
      return {
        total: 0,
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
    }
    
}
</script>
