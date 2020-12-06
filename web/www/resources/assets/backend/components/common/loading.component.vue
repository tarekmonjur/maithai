<template>
    <span v-if="loading.button" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    <div class="text-center" v-else-if="loading.modal">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

</template>

<script>
import {mapState} from "vuex";

export default {
    name: "loading.component",
    computed: {
        ...mapState([
            'loading'
        ]),
    }
}
</script>

<style scoped>

</style>
