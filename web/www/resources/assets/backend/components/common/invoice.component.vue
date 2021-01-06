<template>
    <section id="print_invoice" class="invoice p-2">
        <div class="row">
            <div class="col-12">
                <h3 class="page-header">
                    MaiThai Kitchen
                    <small class="float-right">Date: {{showData.created_at}}</small>
                </h3>
            </div>
        </div>

        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                {{this.lang('form')}}
                <address>
                    <strong>MaiThai, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    {{this.lang('mobile_no')}}: (804) 123-5432<br>
                    {{this.lang('email')}}: info@almasaeedstudio.com
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                {{this.lang('to')}}
                <address>
                    <strong>{{ customer.first_name }} {{ customer.last_name }}</strong><br>
                    {{this.lang('mobile_no')}}: {{customer.mobile_no}}<br>
                    {{this.lang('email')}}: {{customer.email}} <br>
                    {{customer.city}}, {{customer.state}}, {{customer.zip_code}} <br>
                    {{customer.address}}
                </address>
            </div>
            <div class="col-sm-4 invoice-col">
                <b>Invoice #{{showData.invoice_no}}</b><br>
                <br>
                <b>{{this.lang('order_id')}}:</b> {{showData.id}}<br>
                <b>{{this.lang('order_type')}}:</b> {{showData.type}}<br>
                <b>{{this.lang('order_status')}}:</b> {{showData.status}} <br>
                <b>{{this.lang('payment_status')}}:</b> {{showData.payment_status}}<br>
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
                    <tr v-for="(item, index) in showData.order_details">
                        <td>{{ index }}</td>
                        <td>
                            {{ item.product_name }} <br>
                            {{ item.product_code }} <br>
                        </td>
                        <td>{{ item.product_price }}</td>
                        <td>{{ item.product_unit }}</td>
                        <td>{{ item.product_qty }}</td>
                        <td>
                            {{ item.vat_amount }} ({{item.var_percent}}%)
                        </td>
                        <td>
                            {{ item.discount_amount }} ({{item.discount_percent}}%) <br>
                            {{item.offer_name}}
                        </td>
                        <td>{{item.price}}</td>
                        <td>{{item.sub_total}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-6 pl-5">
                <p class="lead">{{this.lang('payment_type')}}: <b>{{showData.payment_type}}</b></p>
                <p class="lead">{{this.lang('payment_status')}}: <b>{{showData.payment_status}}</b></p>
                <p class="lead">{{this.lang('transaction_no')}}: <b>{{showData.transaction_no}}</b></p>
                <p class="lead">{{this.lang('paid_amount')}}: <b>{{showData.pay_amount}}</b></p>
                <p class="lead">{{this.lang('due_amount')}}: <b>{{showData.due_amount}}</b></p>
                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;"></p>
            </div>
            <div class="col-6">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th style="width:50%">{{this.lang('sub_total')}}:</th>
                            <td>{{showData.total_sub_total_amount}}</td>
                        </tr>
                        <tr>
                            <th>{{this.lang('vat')}} ({{showData.vat_percent}}%)</th>
                            <td>{{showData.vat_amount}}</td>
                        </tr>
                        <tr>
                            <th>{{this.lang('discount')}} ({{showData.discount_percent}}%)</th>
                            <td>{{showData.discount_amount}}</td>
                        </tr>
                        <tr>
                            <th>{{this.lang('processing_fee')}}:</th>
                            <td>{{showData.processing_fee}}</td>
                        </tr>
                        <tr>
                            <th>{{this.lang('delivery_fee')}}:</th>
                            <td>{{showData.delivery_fee}}</td>
                        </tr>
                        <tr>
                            <th>{{this.lang('total_amount')}}:</th>
                            <td>{{showData.total_payable_amount}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapGetters} from 'vuex';

export default {
    name: "invoice.component",
    computed: {
        ...mapGetters([
            'showData'
        ]),
        customer() {
            return _.get(this.showData, 'customer.details', {});
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
