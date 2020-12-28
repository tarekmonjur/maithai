<template>
    <span v-if="(loading && loading.button) || size === 'small'" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    <div class="text-center" v-else-if="(loading && loading.modal) || size === 'large'">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="text-center" v-else-if="size === 'full'">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <slot v-else></slot>

</template>

<script>
import {mapState} from "vuex";

export default {
    name: "loading.component",
    props: ['size'],
    computed: {
        ...mapState([
            'loading'
        ]),
    }
}
</script>

<style scoped>

</style>
