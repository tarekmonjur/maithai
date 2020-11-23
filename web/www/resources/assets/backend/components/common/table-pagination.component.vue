<template>
    <div class="d-flex">
        <div class="flex-fill" v-html="pageInfo"></div>
        <div class="flex-fill">
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm justify-content-end" style="margin-bottom: 0px">
                    <li class="page-item" :class="data.prev_page_url ? '' : 'disabled'">
                        <a class="page-link" href="#" v-on:click="this.getData(data.prev_page_url)" v-html="previousPage"></a>
                    </li>
                    <li class="page-item" v-for="page in pages">
                        <a class="page-link" href="#" v-on:click="this.getData(null, {page})">{{page}}</a>
                    </li>
                    <li class="page-item" :class="data.next_page_url ? '' : 'disabled'">
                        <a class="page-link" href="#" v-on:click="this.getData(data.next_page_url)" v-html="nextPage"></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<script>
import {mapState, mapGetters} from "vuex";

export default {
    name: "table-pagination.component",
    // data() {
    //     console.log({...mapState(['data'])});
    //   return {
    //       ...mapState(['data'])
    //   }
    // },
    computed: {
        ...mapState(['data']),
        ...mapGetters([
            'nextPage',
            'previousPage',
            'pageInfo',
            'pages'
        ]),
    },
    methods: {
        getData(url, params = {}) {
            this.$store.dispatch('getData', {url, params});
        },
    }
}
</script>

<style scoped>

</style>
