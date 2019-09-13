<template >
  <div >
    <div  v-for="(inbox, inb) of Responsable" :key="inb" >
        <h1 class="m-0 text-dark">{{ inbox.nombre}}</h1>

        <el-row :gutter="25" justify="center"  >
            <el-col :span="6"   type="flex" v-for="(mensaje,ms) of DataResult" :key="ms" v-if="mensaje.nombre == inbox.nombre">
                <el-card  class="box-card" shadow="always" body-style="cars">
                <div slot="header" class="clearfix">
                    <span>{{ mensaje.nombre }}</span>
                    <!-- <template slot-scope="scope"> -->
                      <!-- <el-link :underline=false v-bind:href="'/editMensaje/'+mensaje.id_evento" :id=mensaje.id_evento >
                        <el-button style="float: right" class="shadow" type="success" icon="el-icon-check" circle ></el-button>
                      </el-link> -->
                    <!-- </template> -->
                </div>
                <div class="card-text item">
                    Fecha: {{ mensaje.fecha_final }} <br>
                    Evento: {{ mensaje.accion }}
                </div>
                <div  v-if="mensaje.estado === 'En Proceso'" class="clearfix card-footer bg-info">{{ mensaje.estado }} 
                    <el-link style="padding-left:23%;" :underline=false v-bind:href="'editMensaje/'+mensaje.id_evento" :id=mensaje.id_evento >
                      <el-button  class="shadow" type="primary" plain size="mini">Documentar</el-button>
                    </el-link>
                    <!-- <el-link style="padding-left:1%;" :underline=false v-bind:href="'chat/'+mensaje.id_evento" :id=mensaje.id_evento >
                      <el-button  class="shadow" type="primary" plain size="mini">Chat</el-button>
                    </el-link> -->
                </div>
                <div v-else class="card-footer bg-danger">{{ mensaje.estado }} <span>Editar</span></div>
                </el-card>
            </el-col>
        </el-row>
    </div> 
    
<!-- 
    <div class="row">
      <div
        v-for="item in DataResult"
        :key="item.id_evento"
        class="card border-info mb-3"
        style="max-width: 18rem;"
      >
        <div class="card-header">Evento: {{ item.fecha_final }}</div>
        <div class="card-body text-info">
          <h5 class="card-title">{{ item.nombre }}</h5>
          <p class="card-text">{{ item.accion }}</p>
        </div>

        <div v-if="item.estado === 'En Proceso'" class="card-footer bg-success">{{ item.estado }}</div>
        <div v-else class="card-footer bg-danger">{{ item.estado }}</div>
      </div>
    </div> -->
  </div>
</template>


<style>
.el-card__body{

    padding:0px;
}

.item{
    padding-bottom: 10px;
    margin-bottom: 18px;
}

.el-col{
    padding-bottom: 20px;
}
</style>

<script >
export default {
  data() {
    return {
      DataResult: [],
      Responsable:[]
    };
  },
  mounted() {
    this.getData();
    this.getResponsable();
    this.Calcular();
    setInterval(() => {
      this.getData();
      this.getResponsable();
    }, 3000);
  },
  observable() {
    this.DataResult;
  },
  methods: {
    nextTick: function() { 
      this.getData();
    },
    getData: function() {
      let contexto = this;
      axios
        .get("/getEvento")
        .then(response => {
          contexto.DataResult = response.data;
        })
        .catch(function(error) {
          // handle error
          console.log(error);
        })
        .finally(function() {
          // always executed
        });
    },
    getResponsable: function(){
        axios.get('getDataR')
        .then(res =>{
            this.Responsable = res.data;
        })
        .catch(function(error){
            console.log(error);
        })
    },
    Calcular: function(){
      //console.log(this.Responsable);
    }
  }
};
</script>
