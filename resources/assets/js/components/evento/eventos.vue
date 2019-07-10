<template >

    <div  class="row">
        <div v-for="item in DataResult" :key="item.id_evento" class="card border-info mb-3" style="max-width: 18rem;">
            <div class="card-header">Evento: {{ item.fecha_final }} </div>
            <div class="card-body text-info">
                <h5 class="card-title">{{ item.nombre }}</h5>
                <p class="card-text">{{ item.accion }}</p>
            </div>

            <div v-if="item.estado === 'En Proceso'" class="card-footer bg-success">{{ item.estado }}</div>
            <div v-else class="card-footer bg-danger">{{ item.estado }}</div>
        </div>
    </div>
</template>


<style>


</style>

<script >
    export default {
       
        data() {
            return {
                DataResult:[],
            }
        },
        mounted(){
            this.getData(); 
//             console.log(
//         'outside nextTick callback:', this.$el.textContent
//             ) ;
//             this.$nextTick(() => {
//     // The whole view is rendered, so I can safely access or query
//     // the DOM. ¯\_(ツ)_/¯
//   });
            setInterval(() => {
                  this.getData();
              }, 3000);
          },
        observable(){
            this.DataResult; 
            
        },
        methods: {
            nextTick:function () {
                this.getData();
                },
            getData: function(){
                let contexto = this;
              axios.get('/getEvento')
                .then(response => {
                  contexto.DataResult = response.data;
                  
                })
                .catch(function (error) {
                  // handle error
                  console.log(error);
                })
                .finally(function () {
                  // always executed
                });
            },
            
         },
         
    }
</script>
