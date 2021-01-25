<template>
    <section id="print_invoice" class="invoice p-2">
        <div class="row">
            <div class="col-6">
                <img :src="settings.logo" :alt="settings.name" style="float: left; width: 60px; margin-right: 15px">
                <h4 class="page-header">
                    <strong>{{settings.name}}</strong><br>
                    <small>{{settings.title}}</small>
                </h4>
            </div>
            <div class="col-6">
                <h3 class="page-header">
                    <small class="float-right">Date: {{orderData.created_at}}</small>
                </h3>
            </div>
        </div>

        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                <address>
                    <span v-html="settings.address"></span><br>
                    {{this.lang('mobile_no')}}: {{settings.phone || settings.mobile }}<br>
                    {{this.lang('email')}}: {{settings.email}}
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                {{this.lang('to')}}
                <address>
                    {{this.lang('full_name')}}: <strong>{{ shipping.first_name }} {{ shipping.last_name }}</strong><br>
                    {{this.lang('mobile_no')}}: {{shipping.mobile_no}}<br>
                    {{this.lang('email')}}: {{shipping.email}} <br>
                    {{shipping.city ? shipping.city+', ' : ''}}
                    {{shipping.state ? shipping.state+', ' : ''}}
                    {{shipping.zip_code ? shipping.zip_code+', ': ''}} <br>
                    {{shipping.address}}
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>Invoice #{{orderData.invoice_no}}</b><br>
                <br>
                <b>{{this.lang('order_id')}}: </b> {{orderData.id}}<br>
                <b>{{this.lang('order_status')}}: </b>
                <span class="badge" :class="this.statusBadgeClass(orderData.status)">
                    {{ orderData.status ? orderData.status.toUpperCase() : ''}}
                </span>
                <br>
                <b>{{this.lang('payment_status')}}: </b>
                <span class="badge" :class="this.statusBadgeClass(orderData.payment_status)">
                    {{ orderData.payment_status ? orderData.payment_status.toUpperCase() : ''}}
                </span>
                <br>
            </div>
        </div>

        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>{{ lang('sl') }}</td>
                        <td>{{ lang('product_name') }}</td>
                        <td>{{ lang('product_price') }}</td>
                        <td>{{ lang('unit') }}</td>
                        <td>{{ lang('qty') }}</td>
                        <td>{{ lang('vat') }}</td>
                        <td>{{ lang('discount') }}</td>
                        <td>{{ lang('price') }}</td>
                        <td>{{ lang('sub_total') }}</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item, index) in orderData.order_details">
                        <td>{{ index }}</td>
                        <td>
                            {{ item.product_name }} <br>
                        </td>
                        <td>{{settings.currency_symbol}}{{ item.product_price }}</td>
                        <td>{{ item.product_unit }}</td>
                        <td>{{ item.product_qty }}</td>
                        <td>
                            {{settings.currency_symbol}}{{ item.vat_amount }} ({{item.vat_percent}}%)
                        </td>
                        <td>
                            {{settings.currency_symbol}}{{ item.discount_amount }} ({{item.discount_percent}}%) <br>
                            {{item.offer_name}}
                        </td>
                        <td>{{settings.currency_symbol}}{{item.price}}</td>
                        <td>{{settings.currency_symbol}}{{item.sub_total}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-6 pl-5">
                <p class="lead">
                    {{this.lang('payment_type')}} :
                    <span class="badge" :class="this.statusBadgeClass(orderData.payment_type)">
                    {{ orderData.payment_type ? orderData.payment_type.toUpperCase() : ''}}
                    </span>
                </p>
                <p class="lead">
                    {{this.lang('payment_status')}} :
                    <span class="badge" :class="this.statusBadgeClass(orderData.payment_status)">
                    {{ orderData.payment_status ? orderData.payment_status.toUpperCase() : ''}}
                    </span>
                </p>
                <p class="lead">{{this.lang('transaction_no')}}: <b>{{orderData.transaction_no}}</b></p>
                <p class="lead">{{this.lang('paid_amount')}}: <b>{{settings.currency_symbol}}{{orderData.total_pay_amount}}</b></p>
                <p class="lead">{{this.lang('due_amount')}}: <b>{{settings.currency_symbol}}{{orderData.due_amount}}</b></p>
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;"></p>
            </div>
            <div class="col-6">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">{{this.lang('sub_total')}}:</th>
                            <td>{{settings.currency_symbol}}{{orderData.total_sub_total_amount}}</td>
                        </tr>
                        <tr>
                            <th>{{this.lang('vat')}} ({{orderData.vat_percent}}%)</th>
                            <td>{{settings.currency_symbol}}{{orderData.vat_amount}}</td>
                        </tr>
                        <tr>
                            <th>{{this.lang('discount')}} ({{orderData.discount_percent}}%)</th>
                            <td>{{settings.currency_symbol}}{{orderData.discount_amount}}</td>
                        </tr>
                        <tr>
                            <th>{{this.lang('processing_fee')}}:</th>
                            <td>{{settings.currency_symbol}}{{orderData.processing_fee}}</td>
                        </tr>
                        <tr>
                            <th>{{this.lang('delivery_fee')}}:</th>
                            <td>{{settings.currency_symbol}}{{orderData.delivery_fee}}</td>
                        </tr>
                        <tr>
                            <th>{{this.lang('total_amount')}}:</th>
                            <td>{{settings.currency_symbol}}{{orderData.total_payable_amount}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapState, mapGetters} from 'vuex';

export default {
    name: "invoice.component",
    computed: {
        ...mapState([
            'settings',
        ]),
        ...mapGetters([
            'orderData'
        ]),
        shipping() {
            if (_.get(this.orderData, 'shipping_details')) {
                return _.get(this.orderData, 'shipping_details', {});
            }
            return _.get(this.orderData, 'customer.details', {});
        }
    },
    methods: {
        lang(key) {
            return this.getLang(`order.${key}`);
        },
    }
}
</script>

<style scoped>

</style>
