<template>
    <form name="" id="form">
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label>{{getLang(lang_key+'.take_shipping_details_from_customer')}} :</label>
                    <Select2 v-model="customer_id"
                        style="padding: 0px; border: 0px"
                        class="form-control form-control-sm"
                        :options="customersSelect2"
                        :settings="{allowClear: true}"
                        @select="selectCustomerAction($event)"/>
                </div>
            </div>
        </div>
        <hr />
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="full_name">{{lang('full_name')}} :<span class="text-danger">*</span></label>
                    <input
                        type="text"
                        id="full_name"
                        v-model="shippingDetails.full_name"
                        :class="{'is-invalid' : errors.full_name}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.full_name">{{errors.full_name}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="email">{{lang('email')}} :</label>
                    <input
                        type="text"
                        id="email"
                        v-model="shippingDetails['email']"
                        :class="{'is-invalid' : errors.email}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.email">{{errors.email}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="mobile_no">{{lang('mobile_no')}} :<span class="text-danger">*</span></label>
                    <input
                        type="text"
                        id="mobile_no"
                        v-model="shippingDetails['mobile_no']"
                        :class="{'is-invalid' : errors.mobile_no}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.mobile_no">{{errors.mobile_no}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="city">{{lang('city')}} :</label>
                    <input
                        type="text"
                        id="city"
                        v-model="shippingDetails['city']"
                        :class="{'is-invalid' : errors.city}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.city">{{errors.city}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="state">{{lang('state')}} :</label>
                    <input
                        type="text"
                        id="state"
                        v-model="shippingDetails['state']"
                        :class="{'is-invalid' : errors.state}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.state">{{errors.state}}</div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="zip_code">{{lang('zip_code')}} :</label>
                    <input
                        type="text"
                        id="zip_code"
                        v-model="shippingDetails['zip_code']"
                        :class="{'is-invalid' : errors.zip_code}"
                        class="form-control form-control-sm" />
                    <div class="invalid-feedback" v-if="errors.zip_code">{{errors.zip_code}}</div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <div class="form-group">
                    <label for="address">{{lang('address')}} :</label>
                    <textarea
                        id="address"
                        v-model="shippingDetails['address']"
                        :class="{'is-invalid' : errors.address}"
                        class="form-control form-control-sm"></textarea>
                    <div class="invalid-feedback" v-if="errors.address">{{errors.address}}</div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
import {mapState, mapGetters} from "vuex";

export default {
    name: "shipping-form.component",
    data() {
      return {
        customer_id: "0",
        errors: {},
      }
    },
    computed: {
        ...mapState([
            'lang_key',
            'shippingDetails',
        ]),
        ...mapGetters([
          'customers',
        ]),
        customersSelect2() {
          return _.map(this.customers, item => ({
            id: item.id,
            text: `${_.get(item, 'details.first_name', '')} ${_.get(item, 'details.last_name', '')}
               - ${_.get(item, 'details.mobile_no', '')}`
          }));
        },
    },
    methods: {
        lang(key) {
            return this.getLang(`customer.${key}`);
        },
        selectCustomerAction(event) {
          const customer_id = _.get(event, 'id') ? _.get(event, 'id') : this.customer_id;
          const customer = _.find(this.customers, customer => customer.id === +customer_id);
          const customerDetails = _.get(customer, 'details', null);
          if (customerDetails) {
            this.shippingDetails['full_name'] = customerDetails.first_name+ ' ' +customerDetails.last_name;
            this.shippingDetails['email'] = customerDetails.email;
            this.shippingDetails['mobile_no'] = customerDetails.mobile_no;
            this.shippingDetails['city'] = customerDetails.city;
            this.shippingDetails['zip_code'] = customerDetails.zip_code;
            this.shippingDetails['state'] = customerDetails.state;
            this.shippingDetails['address'] = customerDetails.address;
          }
        }
    },
}
</script>

<style scoped>

</style>
