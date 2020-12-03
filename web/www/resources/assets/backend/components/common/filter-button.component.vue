<template>
    <a
        data-toggle="collapse"
        href="#tableFilter"
        role="button"
        aria-expanded="false"
        aria-controls="tableFilter">
        <img :src="this.asset('/img/filter.png')" alt="">
        &nbsp;
        {{filterButtonName}}
    </a>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "filter-button.component",
    computed: {
        ...mapGetters([
            'filterButtonName',
        ]),
    }
}
</script>

<style scoped>

</style>
