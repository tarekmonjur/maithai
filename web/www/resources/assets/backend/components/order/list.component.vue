<template>
    <tr v-for="row in tableData">
        <td>{{ row.id }}</td>
        <td>
            <a href="javascript:void(0)"
               data-toggle="modal"
               data-target="#invoice"
               @click.prevent="viewInvoiceAction(row.id)">{{ row.invoice_no }}</a>
        </td>
        <td>{{ row.type }}</td>
        <td>{{ row.source }}</td>
        <td v-html="customerInfo(row.customer)"></td>
        <td>{{ row.transaction_no }}</td>
        <td>
            {{ this.lang('type') }}:
            <div class="btn-group">
                <button class="btn btn-sm dropdown-toggle" :class="this.statusBadgeClass(row.payment_type)" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ row.payment_type ? row.payment_type.toUpperCase() : ''}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0)" v-if="row.payment_type !== 'card'" @click.prevent="updateStatus({id: row.id, payment_type: 'card'})">{{this.lang('card')}}</a>
                    <a class="dropdown-item" href="javascript:void(0)" v-if="row.payment_type !== 'cash'" @click.prevent="updateStatus({id: row.id, payment_type: 'cash'})">{{this.lang('cash')}}</a>
                    <a class="dropdown-item" href="javascript:void(0)" v-if="row.payment_type !== 'none'" @click.prevent="updateStatus({id: row.id, payment_type: 'none'})">{{this.lang('none')}}</a>
                </div>
            </div>
            <br>
            {{ this.lang('status') }}:
            <div class="btn-group">
                <button class="btn btn-sm dropdown-toggle" :class="this.statusBadgeClass(row.payment_status)" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ row.payment_status ? row.payment_status.toUpperCase() : ''}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0)" v-if="row.payment_status !== 'pending'" @click.prevent="updateStatus({id: row.id, payment_status: 'pending'})">{{this.lang('pending')}}</a>
                    <a class="dropdown-item" href="javascript:void(0)" v-if="row.payment_status !== 'deu'" @click.prevent="updateStatus({id: row.id, payment_status: 'deu'})">{{this.lang('deu')}}</a>
                    <a class="dropdown-item" href="javascript:void(0)" v-if="row.payment_status !== 'completed'" @click.prevent="updateStatus({id: row.id, payment_status: 'completed'})">{{this.lang('completed')}}</a>
                </div>
            </div>
        </td>
        <td>
            <div class="btn-group">
                <button class="btn btn-sm dropdown-toggle" :class="this.statusBadgeClass(row.status)" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{row.status ? row.status.toUpperCase(): ''}}
                </button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0)" v-if="row.status !== 'placed'" @click.prevent="updateStatus({id: row.id, status: 'placed'})">{{this.lang('placed')}}</a>
                    <a class="dropdown-item" href="javascript:void(0)" v-if="row.status !== 'pending'" @click.prevent="updateStatus({id: row.id, status: 'pending'})">{{this.lang('pending')}}</a>
                    <a class="dropdown-item" href="javascript:void(0)" v-if="row.status !== 'accepted'" @click.prevent="updateStatus({id: row.id, status: 'accepted'})">{{this.lang('accepted')}}</a>
                    <a class="dropdown-item" href="javascript:void(0)" v-if="row.status !== 'delivered'" @click.prevent="updateStatus({id: row.id, status: 'delivered'})">{{this.lang('delivered')}}</a>
                    <a class="dropdown-item" href="javascript:void(0)" v-if="row.status !== 'completed'" @click.prevent="updateStatus({id: row.id, status: 'completed'})">{{this.lang('completed')}}</a>
                    <a class="dropdown-item" href="javascript:void(0)" v-if="row.status !== 'cancel'" @click.prevent="updateStatus({id: row.id, status: 'cancel'})">{{this.lang('cancel')}}</a>
                </div>
            </div>
        </td>
        <td>{{ row.table_no }}</td>
        <td>{{ row.order_details_count }}</td>
        <td>{{ row.total_qty }}</td>
        <td>{{settings.currency_symbol}}{{ row.total_sub_total_amount }}</td>
        <td>
            {{ row.offer_name }} <br>
            {{ row.coupon_code }}
        </td>
        <td>
            {{settings.currency_symbol}}{{ row.discount_amount }} <br>
            ({{ row.discount_percent }}%)
        </td>
        <td>
            {{settings.currency_symbol}}{{ row.vat_amount }} <br>
            ({{ row.vat_percent }}%)
        </td>
        <td>
            {{settings.currency_symbol}}{{ row.processing_fee }} <br>
            {{settings.currency_symbol}}{{ row.delivery_fee }}
        </td>
        <td>{{settings.currency_symbol}}{{ row.total_payable_amount }}</td>
        <td>{{settings.currency_symbol}}{{ row.total_pay_amount }}</td>
        <td>{{settings.currency_symbol}}{{ row.due_amount }}</td>
        <td>
            <div class="d-flex actions">
                <div class="flex-fill">
                    <edit-button-component :id="row.id"></edit-button-component>
                </div>
                <div class="flex-fill">
                    <view-button-component :id="row.id"></view-button-component>
                </div>
                <div class="flex-fill">
                    <delete-button-component :id="row.id"></delete-button-component>
                </div>
            </div>
        </td>
    </tr>
</template>

<script>
import {mapState, mapGetters} from "vuex";
import EditButtonComponent from "../common/edit-button.component";
import ViewButtonComponent from "../common/view-button.component";
import DeleteButtonComponent from "../common/delete-button.component";

export default {
    name: "list.component",
    components: {
        EditButtonComponent,
        ViewButtonComponent,
        DeleteButtonComponent,
    },
    computed: {
        ...mapState([
            'lang_key',
            'settings',
        ]),
        ...mapGetters(['tableData']),
    },
    methods: {
        lang(key) {
            return this.getLang(`${this.lang_key}.${key}`);
        },
        customerInfo(customer) {
            return `${_.get(customer, 'details.first_name', '')} ${_.get(customer, 'details.last_name', '')} <br/>
                ${_.get(customer, 'details.mobile_no', '')}`;
        },
        viewInvoiceAction(order_id) {
            if (order_id) {
                this.$store.dispatch('viewButtonAction', {
                    id: order_id,
                    modal: {
                        id: 'invoice',
                        title: this.lang('invoice'),
                        button: this.lang('print_invoice'),
                    }
                });
            }
        },
        updateStatus(data) {
            this.$swal({
                title: this.getLang('common.are_you_sure'),
                text: this.getLang('common.update_your_order_status'),
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: this.getLang('common.yes_update'),
                cancelButtonText: this.getLang('common.no_cancel'),
                reverseButtons: false,
            }).then((result) => {
                if (result.isConfirmed) {
                    const id = data.id;
                    _.unset(data, 'id');
                    const payload = {
                        id,
                        data: data
                    }
                    this.$store.dispatch('updateOrderAction', payload);
                }
            });
        }
    }
}
</script>

<style scoped>
.text-sm .btn {
    font-size: .70rem!important;
}
</style>
