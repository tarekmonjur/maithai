<template>
    <div class="row">
        <div class="col-md-6" v-if="pageInfo" v-html="pageInfo"></div>
        <div class="col-md-6">
            <div aria-label="Page navigation">
                <ul class="pagination pagination-sm justify-content-end" style="margin-bottom: 0px">
                    <li class="page-item" :class="previousPageUrl ? '' : 'disabled'">
                        <a class="page-link" href="javascript:void(0)" v-on:click="this.getData(null, this.current_page-1)" v-html="previousPage"></a>
                    </li>
                    <li class="page-item" v-for="page in getPages" :class="current_page === page ? 'active': ''">
                        <a class="page-link" href="javascript:void(0)" v-on:click.prevent="this.getData(null, page)">{{page}}</a>
                    </li>
                    <li class="page-item" :class="nextPageUrl ? '' : 'disabled'">
                        <a class="page-link" href="javascript:void(0)" v-on:click="this.getData(null, this.current_page+1)" v-html="nextPage"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

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
    data() {
        return {
            current_page: 1,
        }
    },
    methods: {
        getData(url, page) {
            this.current_page = page;
            const payload = {
                paginate: this.paginate,
                url,
                params: {
                    page,
                }
            };
            this.$store.dispatch('paginationAction', payload);
        },
    }
}
</script>

<style scoped>

</style>
