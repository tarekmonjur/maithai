<template>
    <div class="pagination" v-if="getPages">
        <ul class="pagination pagination-sm">
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
</template>

<script>
import {mapGetters} from "vuex";

export default {
    name: "product-pagination.component",
    props: ['paginate'],
    data() {
        return {
            current_page: 1,
        }
    },
    computed: {
        ...mapGetters([
            'getPages',
            'previousPageUrl',
            'nextPageUrl',
            'nextPage',
            'previousPage',
        ]),
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