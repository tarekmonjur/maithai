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
            <span class="badge" :class="this.statusBadgeClass(row.payment_type)">
                {{ row.payment_type ? row.payment_type.toUpperCase() : ''}}
            </span>
            <br>
            {{ this.lang('status') }}:
            <span class="badge" :class="this.statusBadgeClass(row.payment_status)">
                {{ row.payment_status ? row.payment_status.toUpperCase() : ''}}
            </span>
        </td>
        <td>
            <span class="badge" :class="this.statusBadgeClass(row.status)">
                {{row.status ? row.status.toUpperCase(): ''}}
            </span>
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
        }
    }
}
</script>

<style scoped>

</style>
