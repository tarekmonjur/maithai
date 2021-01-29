<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light" style="line-height: 1.8rem">
                    <table-header-component></table-header-component>
                </div>
                <div class="card-body table-responsive p-0">
                    <table-filter-component></table-filter-component>
                    <table-body-component>
                        <list-component></list-component>
                    </table-body-component>
                </div>
                <div class="card-footer">
                    <table-pagination-component></table-pagination-component>
                </div>
            </div>
        </div>
    </div>

    <modal-component>
        <view-component v-if="modal.id === 'view'"></view-component>
        <form-component v-else></form-component>
    </modal-component>

    <alert-component></alert-component>
</template>

<script>
    import {mapState, mapGetters} from 'vuex';
    import TableBodyComponent from './../common/table-body.component';
    import TablePaginationComponent from './../common/table-pagination.component';
    import TableFilterComponent from './../common/table-filter.component';
    import TableHeaderComponent from './../common/table-header.component';
    import ModalComponent from './../common/modal.component';
    import FormComponent from './form.component';
    import ViewComponent from './view.component';
    import ListComponent from './list.component';
    import AlertComponent from './../common/alert.component';

    export default {
        name: "MainContentComponent",
        props: ['helpers'],
        components: {
            AlertComponent,
            ListComponent,
            ViewComponent,
            FormComponent,
            ModalComponent,
            TableFilterComponent,
            TableHeaderComponent,
            TableBodyComponent,
            TablePaginationComponent,
        },
        computed: {
            ...mapState([
                'modal',
            ]),
        },
        created() {
            this.$store.dispatch('init');
        },
    }
</script>

<style scoped>

</style>
