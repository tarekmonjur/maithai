<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light" style="line-height: 1.8rem">
                    <table-header-component></table-header-component>
                </div>
                <div class="card-body">
                    <table-filter-component></table-filter-component>
                    <table-body-component>
                        <tr v-for="row in tableData">
                            <td >{{row.id}}</td>
                            <td >{{row.name}}</td>
                            <td >{{row.products_count}}</td>
                            <td >{{row.slug}}</td>
                            <td >{{helpers.isActive(row.is_active)}}</td>
                            <td v-html="helpers.created(row)"></td>
                            <td v-html="helpers.updated(row)"></td>
                            <td>

                            </td>
                        </tr>
                    </table-body-component>
                </div>
                <div class="card-footer">
                    <table-pagination-component></table-pagination-component>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapState, mapGetters} from 'vuex';
    import TableBodyComponent from './common/table-body.component';
    import TablePaginationComponent from './common/table-pagination.component';
    import TableFilterComponent from './common/table-filter.component';
    import TableHeaderComponent from './common/table-header.component';

    export default {
        name: "MainContentComponent",
        props: ['helpers'],
        components: {
            TableFilterComponent,
            TableHeaderComponent,
            TableBodyComponent,
            TablePaginationComponent
        },
        computed: {
            ...mapState(['data']),
            ...mapGetters(['tableData']),
        },
        created() {
            this.$store.dispatch('init');
        },
        mounted() {
            console.log('mounted', this.$store.state);
            // document.addEventListener("DOMContentLoaded", function() {
            //     OverlayScrollbars(document.querySelectorAll('.card-body'));
            // });
        },
        methods: {
        }
    }
</script>

<style scoped>

</style>
