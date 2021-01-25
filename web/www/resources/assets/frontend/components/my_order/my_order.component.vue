<template>
    <app-component>
        <section id="order" class="mt-5 mb-5">
            <div class="container">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="flex-fill">
                                <i class="fas fa-shopping-cart"></i>
                                &nbsp;
                                <span class="card-title">My Orders</span>
                            </div>
                            <div class="flex-fill text-right">
                                <a class="btn-sm"
                                    data-toggle="collapse"
                                    href="#tableFilter"
                                    role="button"
                                    aria-expanded="false"
                                    aria-controls="tableFilter">
                                    <img :src="this.assetUrl('/icons/filter.png')" alt="">
                                    &nbsp;
                                    {{this.getLang('order.filter')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table-filter-component
                            :filters="orderFilters"
                            :default-data="{}"
                            :button-name="this.getLang('order.filter')">
                        </table-filter-component>
                        <table-body-component :columns="orderColumns">
                            <tr v-for="(row, index) in ordersData">
                                <td>{{index+1}}</td>
                                <td>
                                    <a href="javascript:void(0)"
                                       data-toggle="modal"
                                       data-target="#Invoice"
                                       @click.prevent="showInvoice(row.id)">
                                        {{row.invoice_no}}
                                    </a>
                                </td>
                                <td>{{row.transaction_no}}</td>
                                <td>
                                    {{ this.getLang('order.type') }}:
                                    <span class="badge" :class="this.statusBadgeClass(row.payment_type)">
                                        {{ row.payment_type ? row.payment_type.toUpperCase() : ''}}
                                    </span>
                                    <br>
                                    {{ this.getLang('order.status') }}:
                                    <span class="badge" :class="this.statusBadgeClass(row.payment_status)">
                                        {{ row.payment_status ? row.payment_status.toUpperCase() : ''}}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge" :class="this.statusBadgeClass(row.status)">
                                        {{row.status ? row.status.toUpperCase(): ''}}
                                    </span>
                                </td>
                                <td>{{row.order_details_count}}</td>
                                <td>{{row.total_qty}}</td>
                                <td>{{settings.currency_symbol}}{{row.total_payable_amount}}</td>
                                <td>{{settings.currency_symbol}}{{row.total_pay_amount}}</td>
                                <td>{{settings.currency_symbol}}{{row.due_amount}}</td>
                            </tr>
                        </table-body-component>
                    </div>
                    <div class="card-footer">
                        <table-pagination-component></table-pagination-component>
                    </div>
                </div>
            </div>
        </section>
        <modal-component v-if="modal.id === 'Invoice'">
            <invoice-component v-if="modal.id === 'Invoice'"></invoice-component>
        </modal-component>
    </app-component>
</template>

<script>
import {mapState, mapGetters} from "vuex";
import AppComponent from './../app.component';
import LoaderComponent from "../common/loading.component";
import TableFilterComponent from "../common/table-filter.component";
import TableBodyComponent from "../common/table-body.component";
import TablePaginationComponent from "../common/table-pagination.component";
import ModalComponent from './../common/modal.component';
import InvoiceComponent from './invoice.component';

export default {
    name: "my-order.component",
    components: {
        AppComponent,
        LoaderComponent,
        TableFilterComponent,
        TableBodyComponent,
        TablePaginationComponent,
        ModalComponent,
        InvoiceComponent
    },
    created() {
        this.$store.dispatch('getOrders');
    },
    data() {
        return {
            loader: false,
        }
    },
    computed: {
        ...mapState([
            'settings',
            'modal',
        ]),
        ...mapGetters([
            'orderColumns',
            'orderFilters',
            'ordersData'
        ])
    },
    methods: {
        showInvoice(order_id) {
            if (order_id) {
                this.$store.dispatch('showInvoiceAction', {
                    id: order_id,
                    modal: {
                        id: 'Invoice',
                        title: this.getLang('order.invoice'),
                        button: this.getLang('order.print_invoice'),
                    }
                });
            }
        },
    }
}
</script>

<style scoped>

</style>