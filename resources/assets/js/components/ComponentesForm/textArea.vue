<template>
    <el-input
        type="textarea"
        :rows="4"
        placeholder="Descripción"
        name="Accion_id"
        v-model="textarea"
        >
    </el-input>
</template>


<script>
    export default {
    data() {
        return {
        textarea: ''
        }
    }
    }
</script>