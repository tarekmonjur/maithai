<template>
  <div class="col-3">
    <div class="row">
      <div class="col-12 pl-0">
        <div class="card pos2">
          <div class="card-header border-0">
            <h3 class="card-title">{{this.lang('order')}}</h3>
            <div class="card-tools col-10">
              <div class="input-group input-group-sm">
                <select class="form-control-sm" v-model="formInput['type']">
                  <option value="sales">{{this.lang('sales')}}</option>
                  <option value="purchase">{{this.lang('purchase')}}</option>
                </select>
                <Select2 v-model="this.formInput['customer_id']"
                  style="padding: 0; border: 0; border-radius: 0"
                  class="form-control"
                  :options="customersSelect2"
                  :settings="{placeholder: this.lang('search_customer'), allowClear: true}"
                  @select="addCustomerAction($event)"/>
                <button type="submit"
                        :disabled="loading_order.customer"
                        class="btn btn-sm btn-theme">
                  <loading-component :size="loading_order.customer ? 'small': ''">
                    <i class="fas fa-search"></i>
                  </loading-component>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive p-2">
            <div class="row">
              <div class="col">
                <h6 class="p-0 m-0">
                  {{this.lang('bill_to')}} <br>
                  <small>
                    <address>
                      {{customerDetails['first_name']}} {{customerDetails['last_name']}} <br>
                      {{customerDetails['mobile_no']}} <br>
                      {{customerDetails['email']}}
                    </address>
                  </small>
                </h6>
              </div>
              <div class="col">
                <h6 class="p-0 m-0 text-center">
                  {{this.lang('invoice')}} <br>
                  Maithai Kitchen <br>
                  <small>35 High Street Cheshunt, Waltham Cross
                    EN80BS, UK.</small>
                </h6>
              </div>
              <div class="col">
                <h6 class="p-0 m-0 text-center">
                  {{this.lang('ship_to')}} <br>
                  <small>
                    <address>
                      {{customerDetails['city']}}, {{customerDetails['state']}}, {{customerDetails['zip_code']}} <br>
                      {{customerDetails['address']}}
                    </address>
                  </small>
                </h6>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                    <tr>
                      <th><span class="text-md">{{this.lang('table_no')}}: </span></th>
                      <td>
                        <div class="input-group input-group-sm">
                          <Select2
                            v-model="formInput['table_no']"
                            id="table_no"
                            name="table_no"
                            style="padding: 0; border: 0; border-radius: 0"
                            class="form-control"
                            :options="[1,2,3,4,5]"
                            :settings="{placeholder: this.lang('select_table_no'), allowClear: true}"/>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th><span class="text-md">{{this.lang('payment_type')}}: </span></th>
                      <td>
                        <div class="input-group input-group-sm">
                          <div class="form-check form-check-inline">
                            <input type="radio" id="card" v-model="formInput['payment_type']" class="form-check-input" value="card">
                            <label for="card" class="form-check-label">{{this.lang('card')}}</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input type="radio" id="cash" v-model="formInput['payment_type']" class="form-check-input" value="cash">
                            <label for="cash" class="form-check-label">{{this.lang('cash')}}</label>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th><span class="text-md">{{this.lang('have_coupon_code')}}</span></th>
                      <td>
                        <div class="input-group input-group-sm">
                          <input type="text" v-model="formInput['coupon_code']" class="form-control float-right" :placeholder="this.lang('coupon_code')">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-theme"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th class="col">{{this.lang('subtotal')}}:</th>
                      <td class="text-right">{{totalSubTotal}}</td>
                    </tr>
                    <tr>
                      <th class="col">
                        {{this.lang('vat')}}:
                        <input type="number"
                               v-model="formInput['vat_percent']"
                               class="col-6"> <strong>%</strong>
                      </th>
                      <td class="text-right">{{vatAmount}}</td>
                    </tr>
                    <tr>
                      <th class="col">
                        {{this.lang('discount')}}:
                        <input type="number"
                               v-model="formInput['discount_percent']"
                               class="col-6"> <strong>%</strong>
                      </th>
                      <td class="text-right">{{discountAmount}}</td>
                    </tr>
                    <tr>
                      <th class="col">{{this.lang('delivery_fee')}}: </th>
                      <td class="text-right">
                        <input type="number" v-model="formInput['delivery_fee']">
                      </td>
                    </tr>
                    <tr>
                      <th class="col">{{this.lang('processing_fee')}}: </th>
                      <td class="text-right">
                        <input type="number" v-model="formInput['processing_fee']">
                      </td>
                    </tr>
                    <tr>
                      <th class="col">{{this.lang('total')}}:</th>
                      <td class="text-right">{{totalAmount}}</td>
                    </tr>
                    <tr>
                      <th class="col">
                        {{this.lang('received')}}: <br> <small>{{this.lang('back')}}:</small>
                      </th>
                      <td class="text-right">
                        <input type="number" v-model="formInput['received_amount']">
                        <small>{{backAmount}}</small>
                      </td>
                    </tr>
                    <tr>
                      <th class="col">{{this.lang('due')}}:</th>
                      <td class="text-right">{{dueAmount}}</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
          <div class="card-footer">
            <div class="d-flex justify-content-between">
              <button type="button" class="btn btn-primary"
                      @click.prevent="saveOrderAction" @keyup.enter="saveOrderAction">
                {{this.lang('save_order')}}
              </button>
              <button type="button" class="btn btn-success"
                      @click.prevent="completeOrderAction" @keyup.enter="completeOrderAction">
                {{this.lang('complete_order')}}
              </button>
              <button type="button" class="btn btn-danger"
                      @click.prevent="clearOrderAction" @keyup.enter="clearOrderAction">
                {{this.lang('clear_order')}}
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapState, mapGetters} from "vuex";
import LoadingComponent from '../common/loading.component';

export default {
  name: "order.component",
  components: {
    LoadingComponent
  },
  computed: {
    ...mapState([
      'lang_key',
      'formInput',
      'errors',
      'loading_order',
    ]),
    ...mapGetters([
      'totalSubTotal',
      'customers'
    ]),
    customersSelect2() {
      return _.map(this.customers, item => ({
        id: item.id,
        text: `${_.get(item, 'details.first_name','')} ${_.get(item, 'details.last_name','')}
        ${_.get(item, 'details.mobile_no','')}
        ${_.get(item, 'details.email','')}`
      }));
    },
    customerDetails(){
      const customer_id = _.get(this.formInput, 'customer_id', null);
      const customer = _.get(this.formInput, 'customer', {});
      if (_.isEmpty(customer) && customer_id) {
        const customer = _.find(this.customers, customer => customer.id === +customer_id);
        return _.get(customer, 'details', {});
      }
      return _.get(this.formInput, 'customer.details', {});
    },
    vatAmount(){
      const vat_percent = +this.formInput['vat_percent'] || 0;
      const vat_amount = this.totalSubTotal * vat_percent / 100;
      return +vat_amount;
    },
    discountAmount(){
      const discount_percent = +this.formInput['discount_percent'] || 0;
      const discount_amount = this.totalSubTotal * discount_percent / 100;
      return +discount_amount;
    },
    totalAmount(){
      const vat_amount = this.vatAmount || 0;
      const discount_amount = this.discountAmount || 0;
      const delivery_fee = +this.formInput['delivery_fee'] || 0;
      const processing_fee = +this.formInput['processing_fee'] || 0;
      const total_amount = (this.totalSubTotal + vat_amount + delivery_fee + processing_fee) - discount_amount;
      return +total_amount;
    },
    backAmount(){
      const received_amount = +this.formInput['received_amount'] || 0;
      const total_amount = this.totalAmount;
      let back_amount = received_amount - total_amount;
      back_amount = back_amount > 0 ? back_amount : 0;
      return +back_amount;
    },
    dueAmount(){
      const received_amount = +this.formInput['received_amount'] || 0;
      let due_amount = this.totalAmount - received_amount;
      due_amount = due_amount > 0 ? due_amount : 0;
      return +due_amount;
    }
  },
  created() {
    this.$store.dispatch('initOrder');
  },
  updated() {
    console.log('order...');
  },
  methods: {
    lang(key) {
      return this.getLang(`${this.lang_key}.${key}`);
    },
    addCustomerAction(event) {
      if (!_.get(this.formInput, 'customer_id')) {
        this.formInput['customer'] = {};
      } else {
        const customer_id = _.get(event, 'id') ? _.get(event, 'id') : this.formInput['customer_id'];
        const customer = _.find(this.customers, customer => customer.id === +customer_id);
        this.formInput['customer'] = customer || {};
      }
    },
    saveOrderAction() {
      this.$swal({
        title: this.getLang('common.are_you_sure'),
        text: this.getLang('common.save_your_order_as_draft'),
        icon: 'warning',
        showCancelButton: true,
        showDenyButton: true,
        confirmButtonText: this.getLang('common.yes_save'),
        cancelButtonText: this.getLang('common.no_cancel'),
        denyButtonText: this.getLang('common.save_&_print'),
        reverseButtons: false,
      }).then((result) => {
        if (result.isConfirmed) {
          // this.$store.dispatch('deleteButtonAction', {
          //   id: this.id,
          // });
        } else if (result.isDenied) {

        } else {
          this.$swal({
            title: this.getLang('common.cancelled'),
            text: this.getLang('common.your_order_is_safe'),
            icon: 'error',
            timer: 1500,
            showConfirmButton: false,
          })
        }
      });
    },
    completeOrderAction() {
      this.$swal({
        title: this.getLang('common.are_you_sure'),
        text: this.getLang('common.complete_your_order'),
        icon: 'warning',
        showCancelButton: true,
        showDenyButton: true,
        confirmButtonText: this.getLang('common.yes_complete'),
        cancelButtonText: this.getLang('common.no_cancel'),
        denyButtonText: this.getLang('common.complete_&_print'),
        reverseButtons: false,
      }).then((result) => {
        if (result.isConfirmed) {
          // this.$store.dispatch('deleteButtonAction', {
          //   id: this.id,
          // });
        } else if (result.isDenied) {

        } else {
          this.$swal({
            title: this.getLang('common.cancelled'),
            text: this.getLang('common.your_order_is_safe'),
            icon: 'error',
            timer: 1500,
            showConfirmButton: false,
          })
        }
      });
    },
    clearOrderAction() {
      this.$swal({
        title: this.getLang('common.are_you_sure'),
        text: this.getLang('common.you_wont_be_able_to_revert_this'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: this.getLang('common.yes_clear_it'),
        cancelButtonText: this.getLang('common.no_cancel'),
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          this.$store.commit('clearFormInput');
        } else {
          this.$swal({
            title: this.getLang('common.cancelled'),
            text: this.getLang('common.your_order_is_safe'),
            icon: 'error',
            timer: 1500,
            showConfirmButton: false,
          })
        }
      });
    }
  },
}
</script>

<style scoped>

</style>