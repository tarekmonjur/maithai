<template>
    <span v-if="loader && size === 'small'" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    <div class="text-center" v-else-if="loader && size === 'large'">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="text-center" v-else-if="loader && size === 'full'">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <span v-else-if="loader" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    <slot v-else></slot>

</template>

<script>

export default {
    name: "loading.component",
    props: ['loader','size'],
}
</script>

<style scoped>

</style>
