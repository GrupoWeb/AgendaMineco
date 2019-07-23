<template>
  <div class="container">
    <el-row :gutter="20">
      <el-col :span="12" type="flex">
        <el-card :body-style="{ margin:'10px'}">
          <div slot="header" class="clearfix">
            <span>Mensaje Interactivo</span>
          </div>
          <div class="text item"></div>
        </el-card>
      </el-col>
    </el-row>
  </div>
</template>

<style>
.el-row {
  margin-bottom: 20px;
  margin-left: 20px;
}
</style>

<script>
export default {
    data() {
      return {
        form: {
          name: '',
          region: '',
          date1: '',
          date2: '',
          delivery: false,
          type: [],
          resource: '',
          desc: ''
        }
      }
    },
    methods: {
      onSubmit() {
        console.log('submit!');
      },
      handleRemove(file, fileList) {
        console.log(file, fileList);
      },
      handlePreview(file) {
        console.log(file);
      },
      handleExceed(files, fileList) {
        this.$message.warning(`El límite es 3, haz seleccionado ${files.length} archivos esta vez, añade hasta ${files.length + fileList.length}`);
      }
    }
};
</script>
