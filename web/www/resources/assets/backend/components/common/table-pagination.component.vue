<template>
    <div class="d-flex">
        <div class="flex-fill" v-if="pageInfo" v-html="pageInfo"></div>
        <div class="flex-fill">
            <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm justify-content-end" style="margin-bottom: 0px">
                    <li class="page-item" :class="previousPageUrl ? '' : 'disabled'">
                        <a class="page-link" href="javascript:void(0)" v-on:click="this.getData(previousPageUrl)" v-html="previousPage"></a>
                    </li>
                    <li class="page-item" v-for="page in getPages">
                        <a class="page-link" href="javascript:void(0)" v-on:click="this.getData(null, {page})">{{page}}</a>
                    </li>
                    <li class="page-item" :class="nextPageUrl ? '' : 'disabled'">
                        <a class="page-link" href="javascript:void(0)" v-on:click="this.getData(nextPageUrl)" v-html="nextPage"></a>
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
    computed: {
        ...mapGetters([
            'nextPage',
            'previousPage',
            'pageInfo',
            'getPages',
            'nextPageUrl',
            'previousPageUrl'
        ]),
    },
    methods: {
        getData(url, params = {}) {
            this.$store.dispatch('getListData', {url, params});
        },
    }
}
</script>

<style scoped>

</style>
