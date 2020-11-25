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
                                <div class="d-flex actions">
                                    <div class="flex-fill">
                                        <a v-if="buttons.edit"
                                           :href="buttons.edit.type === 'link' ? buttons.add.link : 'javascript:void(0)'"
                                           :data-toggle="buttons.edit.type"
                                           :data-target="buttons.edit.type === 'modal'? '#'+buttons.edit.modal_id : false"
                                           v-on:click.prevent="addButton()">
                                            <img :src="this.asset('/img/pencil.png')" alt="">
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a href="" data-toggle="tooltip" data-placement="top" title="View.">
                                            <img :src="this.asset('/img/seo.png')" alt="">
                                        </a>
                                    </div>
                                    <div class="flex-fill">
                                        <a href="" data-toggle="tooltip" data-placement="top" title="Delete.">
                                            <img :src="this.asset('/img/trash.png')" alt="">
                                        </a>
                                    </div>
                                </div>
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

    <modal-component
        v-if="modal_id"
        :id="modal_id">
        <form-component></form-component>
    </modal-component>


</template>

<script>
    import {mapState, mapGetters} from 'vuex';
    import TableBodyComponent from './../common/table-body.component';
    import TablePaginationComponent from './../common/table-pagination.component';
    import TableFilterComponent from './../common/table-filter.component';
    import TableHeaderComponent from './../common/table-header.component';
    import ModalComponent from './../common/modal.component';
    import FormComponent from './form.component';

    export default {
        name: "MainContentComponent",
        props: ['helpers'],
        components: {
            FormComponent,
            ModalComponent,
            TableFilterComponent,
            TableHeaderComponent,
            TableBodyComponent,
            TablePaginationComponent
        },
        computed: {
            ...mapState(['buttons', 'modal_id']),
            ...mapGetters(['tableData']),
            modalId() {
                return _.get(this.buttons, 'add.modal_id', null);
            },
        },
        created() {
            this.$store.dispatch('init');
        },
        mounted() {
            console.log('mounted', this.$store.state);
        },
        methods: {
        }
    }
</script>

<style scoped>

</style>
