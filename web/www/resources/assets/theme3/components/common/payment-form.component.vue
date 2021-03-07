<template>
    <div>
        <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link btn-custom active" id="pills-paypal-tab" data-toggle="pill" href="#pills-paypal" role="tab" aria-controls="pills-paypal" aria-selected="true">{{this.trans('paypal')}}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link btn-custom" id="pills-sumup-tab" data-toggle="pill" href="#pills-sumup" role="tab" aria-controls="pills-sumup" aria-selected="false">{{this.trans('sumup')}}</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active text-center" id="pills-paypal" role="tabpanel" aria-labelledby="pills-paypal-tab">
                <div class="p-5 justify-content-center">
                    <form name="" id="form" action="https://www.paypal.com/cgi-bin/webscr" method="post">
                        <input TYPE="hidden" name="charset" value="utf-8" />
                        <input type="hidden" name="cmd" value="_xclick" />
                        <input type="hidden" name="business" :value="settings.paypal_payment_email" />
                        <input type="hidden" name="image_url" :value="settings.logo" />

                        <input type="hidden" name="item_name" :value="settings.name" />
                        <input type="hidden" name="quantity" :value="shoppingCart.total_qty" />
                        <input type="hidden" name="amount" :value="shoppingCart.total_payable_amount" />
                        <input type="hidden" name="discount_amount" :value="shoppingCart.total_sub_discount_amount" />
                        <input type="hidden" name="tax" :value="shoppingCart.total_sub_vat_amount" />
                        <input type="hidden" name="currency" value="GB" />
                        <input type="hidden" name="currency_code" value="GBP" />
                        <input type="hidden" name="invoice" :value="shoppingCart.invoice_no" />
                        <input type="hidden" name="custom" :value="shoppingCart.id" />

                        <!--            <input TYPE="hidden" name="address_override" value="1" />-->
                        <!--            <input type="hidden" name="first_name" :value="firstName" />-->
                        <!--            <input type="hidden" name="last_name" :value="lastName" />-->
                        <!--            <input type="hidden" name="address1" :value="shippingDetails.address" />-->
                        <!--            <input type="hidden" name="address2" :value="shippingDetails.address" />-->
                        <!--            <input type="hidden" name="city" :value="shippingDetails.city" />-->
                        <!--            <input type="hidden" name="state" :value="shippingDetails.state" />-->
                        <!--            <input type="hidden" name="zip" :value="shippingDetails.zip_code" />-->
                        <input type="hidden" name="email" :value="shippingDetails.email" />
                        <input type="hidden" name="rm" value="1" />
                        <input type="hidden" name="return" :value="this.url('/paypal/success')" />
                        <input type="hidden" name="cancel_return" :value="this.url('/paypal/cancel')" />
                        <input type="hidden" name="notify_url" :value="this.url('/api/payment/paypal')" />

                        <input type="image" name="submit" border="0"
                               src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                               alt="PayPal - The safer, easier way to pay online" />
                        <img alt="" border="0" width="1" height="1"
                             src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-sumup" role="tabpanel" aria-labelledby="pills-sumup-tab">
                <div id="sumup-card"></div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState} from "vuex";

export default {
    name: "payment-form.component",
    mounted() {
        const checkoutId = `${_.get(this.shoppingCart, 'id', 0)}-${_.get(this.shoppingCart, 'invoice_no', 0)}-${new Date().getTime()}`;
        SumUpCard.mount({
            checkoutId: checkoutId,
            id: 'sumup-card',
            amount: _.get(this.shoppingCart, 'total_payable_amount', 0)+'',
            currency: 'GBP',
            locale: 'en-GB',
            country: 'GB',
            email: _.get(this.shippingDetails, 'email', 0),
            onLoad: function() {
            },
            onResponse: function(type, body) {
                console.log('Type', type);
                console.log('Body', body);
            }
        });
    },
    computed: {
        ...mapState([
            'settings',
            'customer',
            'shoppingCart',
            'formInput',
            'errors',
        ]),
        shippingDetails() {
            return {
                ...this.shoppingCart.shipping_details
            }
        },
        firstName() {
            if (this.shippingDetails.full_name) {
                return this.shippingDetails.full_name.split(' ')[0] || '';
            }
            return '';
        },
        lastName() {
            if (this.shippingDetails.full_name) {
                return this.shippingDetails.full_name.split(' ')[1] || '';
            }
            return '';
        }
    },
    methods: {

    },
}
</script>

<style scoped>
.btn-custom {
    background: transparent!important;
    color: #c99a5a!important;
    border: 2px solid #c99a5a!important;
}
.btn-custom:hover, .btn-custom.active {
    color: #fff!important;
    background: linear-gradient(90deg, #af7015 0%, #dbb781 55%, #f29c1e 100%) !important;
}
</style>
