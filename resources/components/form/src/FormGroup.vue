<template>
    <div class="form-group" :class="{'has-danger': error && error.length}">
        <label class="control-label">
            {{ label }}
            <slot name="label-action"></slot>
        </label>
        <slot></slot>
        <small class="form-control-feedback" v-if="error && error.length" v-text="error[0]"></small>
    </div>
</template>
<script type="text/javascript">
    export default {
        props: {
            label: {
                required: true,
                type: String
            },
            error: {
                default: null
            },
        }
    }
</script>
