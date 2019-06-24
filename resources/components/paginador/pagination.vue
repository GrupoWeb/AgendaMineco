<template>
    <el-pagination
        @current-change="ChangePage"
        :pager-count="5"
        :page-size="per_page"
        layout="prev, pager, next"

        :total="total">
    </el-pagination>

</template>
<script>
export default {
      props:['per_page','total','pagerCount'],
      data() {
      return {

    }

      },
            async created() {
                 this.$eventHub.$on('ChangePage', (row) => {                   

            })
      },
    methods: {
     ChangePage(val) {      
         console.log(this.loading)   
         this.$eventHub.$emit('paginar',val)
         this.$eventHub.$emit('loading..',true)


      },
    }
 
}
</script>
