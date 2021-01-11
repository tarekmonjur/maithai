<template>
  <div class="col-3">
    <div class="row">
      <div class="col-12 pl-0">
        <div class="card pos2">
          <div class="card-header border-0 p-2">
            <h3 class="card-title">{{ this.lang('order') }}</h3>
            <div class="card-tools col-10">
              <div class="input-group input-group-sm">
                <select class="form-control-sm" v-model="formInput['type']">
                  <option value="sales">{{ this.lang('sales') }}</option>
                  <option value="purchase">{{ this.lang('purchase') }}</option>
                </select>
                <Select2 v-model="formInput['customer_id']"
                         style="padding: 0; border: 0; border-radius: 0"
                         class="form-control"
                         :options="customersSelect2"
                         :settings="{placeholder: this.lang('search_customer'), allowClear: true}"
                         @select="selectCustomerAction($event)"/>
                <button type="submit"
                        :disabled="loading_order.customer"
                        class="btn btn-sm btn-theme">
                  <loading-component :loader="loading_order.customer">
                    <i class="fas fa-search"></i>
                  </loading-component>
                </button>
                <a href="javascript:void(0)"
                        data-toggle="modal"
                        data-target="#shipping"
                        @click.prevent="showShippingForm()"
                        class="btn btn-sm btn-theme ml-1">
                  <i class="fas fa-plus"></i>
                </a>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive p-2">
            <div class="row">
              <div class="col">
                <h6 class="p-0 m-0">
                  {{ this.lang('bill_to') }} <br>
                  <small>
                    <address>
                      {{ customerDetails['first_name'] }} {{ customerDetails['last_name'] }} <br>
                      {{ customerDetails['mobile_no'] }} <br>
                      {{ customerDetails['email'] }} <br>
                      {{ customerDetails['city'] }}, {{ customerDetails['state'] }},
                      {{ customerDetails['zip_code'] }} <br>
                      {{ customerDetails['address'] }}
                    </address>
                  </small>
                </h6>
              </div>
              <div class="col">
                <h6 class="p-0 m-0 text-center">
                  {{ this.lang('invoice') }} <br>
                  Maithai Kitchen <br>
                  <small>35 High Street Cheshunt, Waltham Cross
                    EN80BS, UK.</small>
                </h6>
              </div>
              <div class="col">
                <h6 class="p-0 m-0 text-center">
                  {{ this.lang('ship_to') }} <br>
                  <small>
                    <address>
                      {{ shippingDetails['full_name'] }} <br>
                      {{ shippingDetails['mobile_no'] }} <br>
                      {{ shippingDetails['email'] }} <br>
                      {{ shippingDetails['city'] }}, {{ shippingDetails['state'] }},
                      {{ shippingDetails['zip_code'] }} <br>
                      {{ shippingDetails['address'] }}
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
                      <th><span class="text-md">{{ this.lang('order_source') }}: </span></th>
                      <td>
                        <div class="input-group input-group-sm">
                          <div class="form-check form-check-inline">
                            <input type="radio" id="table"
                                   v-model="formInput['source']"
                                   @click="showTables()"
                                   class="form-check-input" value="table">
                            <label for="table"
                                   class="form-check-label">{{ this.lang('table') }}</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input type="radio" id="online"
                                   v-model="formInput['source']"
                                   data-toggle="modal"
                                   data-target="#shipping"
                                   @click="showShippingForm()"
                                   class="form-check-input" value="online">
                            <label for="online"
                                   class="form-check-label">{{ this.lang('online') }}</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input type="radio" id="pos"
                                   v-model="formInput['source']"
                                   class="form-check-input" value="pos">
                            <label for="pos"
                                   class="form-check-label">{{ this.lang('pos') }}</label>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr v-if="formInput['source'] === 'table'">
                      <th><span class="text-md">{{ this.lang('table_no') }}: </span></th>
                      <td>
                        <div class="input-group input-group-sm">
                          <Select2
                            v-model="formInput['table_id']"
                            style="padding: 0; border: 0; border-radius: 0"
                            class="form-control"
                            :options="tableSelect2"
                            @select="($event) => { formInput['table_no'] = $event.text }"
                            :settings="{placeholder: this.lang('select_table_no'), allowClear: true}"/>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th><span class="text-md">{{ this.lang('payment_type') }}: </span></th>
                      <td>
                        <div class="input-group input-group-sm">
                          <div class="form-check form-check-inline">
                            <input type="radio" id="card"
                                   v-model="formInput['payment_type']"
                                   class="form-check-input" value="card">
                            <label for="card"
                                   class="form-check-label">{{ this.lang('card') }}</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input type="radio" id="cash"
                                   v-model="formInput['payment_type']"
                                   class="form-check-input" value="cash">
                            <label for="cash"
                                   class="form-check-label">{{ this.lang('cash') }}</label>
                          </div>
                          <div class="form-check form-check-inline">
                            <input type="radio" id="none"
                                   v-model="formInput['payment_type']"
                                   class="form-check-input" value="none">
                            <label for="card"
                                   class="form-check-label">{{ this.lang('none') }}</label>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th><span class="text-md">{{ this.lang('have_coupon_code') }}</span></th>
                      <td>
                        <div class="input-group input-group-sm">
                          <input type="text" v-model="formInput['coupon_code']"
                                 class="form-control float-right"
                                 :placeholder="this.lang('coupon_code')">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-theme"><i
                              class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <th class="col">{{ this.lang('subtotal') }}:</th>
                      <td class="text-right">{{ totalSubTotal }}</td>
                    </tr>
                    <tr>
                      <th class="col">
                        {{ this.lang('vat') }}:
                        <input type="number"
                               min="0"
                               v-model="formInput['vat_percent']"
                               class="col-6"> <strong>%</strong>
                      </th>
                      <td class="text-right">{{ vatAmount }}</td>
                    </tr>
                    <tr>
                      <th class="col">
                        {{ this.lang('discount') }}:
                        <input type="number"
                               min="0"
                               v-model="formInput['discount_percent']"
                               class="col-6"> <strong>%</strong>
                      </th>
                      <td class="text-right">{{ discountAmount }}</td>
                    </tr>
                    <tr>
                      <th class="col">{{ this.lang('delivery_fee') }}:</th>
                      <td class="text-right">
                        <input type="number"
                               min="0"
                               v-model="formInput['delivery_fee']">
                      </td>
                    </tr>
                    <tr>
                      <th class="col">{{ this.lang('processing_fee') }}:</th>
                      <td class="text-right">
                        <input type="number"
                               min="0"
                               v-model="formInput['processing_fee']">
                      </td>
                    </tr>
                    <tr>
                      <th class="col">{{ this.lang('total') }}:</th>
                      <td class="text-right">{{ totalAmount }}</td>
                    </tr>
                    <tr>
                      <th class="col">
                        {{ this.lang('received') }}: <br>
                        <small>{{ this.lang('back') }}:</small>
                      </th>
                      <td class="text-right">
                        <input type="number"
                               min="0"
                               v-model="formInput['received_amount']">
                        <small>{{ backAmount }}</small>
                      </td>
                    </tr>
                    <tr>
                      <th class="col">{{ this.lang('due') }}:</th>
                      <td class="text-right">{{ dueAmount }}</td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="d-flex justify-content-between">
              <button v-if="!print_bill" type="button" class="btn btn-primary"
                      :disabled="totalSubTotal <= 0 || loading_order.save || loading_order.btn_disabled"
                      @click.prevent="saveOrderAction" @keyup.enter="saveOrderAction">
                <loading-component :loader="loading_order.save">
                  {{ this.lang('save_order') }}
                </loading-component>
              </button>
              <button v-if="!print_bill" type="button" class="btn btn-success"
                      :disabled="totalSubTotal <= 0 || loading_order.complete || loading_order.btn_disabled"
                      @click.prevent="completeOrderAction" @keyup.enter="completeOrderAction">
                <loading-component :loader="loading_order.complete">
                  {{ this.lang('complete_order') }}
                </loading-component>
              </button>
              <button v-if="print_bill" type="button" class="btn btn-success"
                      :disabled="totalSubTotal <= 0 || loading_order.print_bill || loading_order.btn_disabled"
                      @click.prevent="printBillAction" @keyup.enter="printBillAction">
                <loading-component :loader="loading_order.print_bill">
                  {{ this.lang('print_bill') }}
                </loading-component>
              </button>
              <button type="button" class="btn btn-danger"
                      :disabled="totalSubTotal <= 0 || loading_order.clear || loading_order.btn_disabled"
                      @click.prevent="clearOrderAction" @keyup.enter="clearOrderAction">
                <loading-component :loader="loading_order.clear">
                  {{ this.lang('clear_order') }}
                </loading-component>
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
      'loading_order',
      'print_bill',
    ]),
    ...mapGetters([
      'totalSubTotal',
      'customers',
      'tables',
    ]),
    tableSelect2() {
      return _.map(this.tables, item => ({
        id: item.id,
        text: item.table_no,
      }));
    },
    customersSelect2() {
      return _.map(this.customers, item => ({
        id: item.id,
        text: `${_.get(item, 'details.first_name', '')} ${_.get(item, 'details.last_name', '')}
        ${_.get(item, 'details.mobile_no', '')}
        ${_.get(item, 'details.email', '')}`
      }));
    },
    customerDetails() {
      const customer_id = _.get(this.formInput, 'customer_id', null);
      const customer = _.get(this.formInput, 'customer', {});
      if (_.isEmpty(customer) && customer_id) {
        const customer = _.find(this.customers, customer => customer.id === +customer_id);
        return _.get(customer, 'details', {});
      }
      return _.get(this.formInput, 'customer.details', {});
    },
    shippingDetails(){
        if(!_.isEmpty(_.get(this.formInput, 'shipping_details'))) {
            return _.get(this.formInput, 'shipping_details', {});
        }
        return {};
    },
    vatAmount() {
      const vat_percent = +this.formInput['vat_percent'] || 0;
      const vat_amount = this.totalSubTotal * vat_percent / 100;
      return +parseFloat(vat_amount).toFixed(2);
    },
    discountAmount() {
      const discount_percent = +this.formInput['discount_percent'] || 0;
      const discount_amount = this.totalSubTotal * discount_percent / 100;
      return +parseFloat(discount_amount).toFixed(2);
    },
    totalAmount() {
      const vat_amount = this.vatAmount || 0;
      const discount_amount = this.discountAmount || 0;
      const delivery_fee = +this.formInput['delivery_fee'] || 0;
      const processing_fee = +this.formInput['processing_fee'] || 0;
      const total_amount = (this.totalSubTotal + vat_amount + delivery_fee + processing_fee) - discount_amount;
      return +parseFloat(total_amount).toFixed(2);
    },
    backAmount() {
      const received_amount = +this.formInput['received_amount'] || 0;
      const total_amount = this.totalAmount;
      let back_amount = received_amount - total_amount;
      back_amount = back_amount > 0 ? back_amount : 0;
      return +parseFloat(back_amount).toFixed(2);
    },
    dueAmount() {
      const received_amount = +this.formInput['received_amount'] || 0;
      let due_amount = this.totalAmount - received_amount;
      due_amount = due_amount > 0 ? due_amount : 0;
      return +parseFloat(due_amount).toFixed(2);
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
    selectCustomerAction(event) {
      if (!_.get(this.formInput, 'customer_id')) {
        this.formInput['customer'] = {};
      } else {
        const customer_id = _.get(event, 'id') ? _.get(event, 'id') : this.formInput['customer_id'];
        const customer = _.find(this.customers, customer => customer.id === +customer_id);
        this.formInput['customer'] = customer || {};
      }
    },
    showTables() {
      if (_.isEmpty(this.tables)) {
        this.$store.dispatch('getTables');
      }
    },
    saveOrderAction() {
      this.$swal({
        title: this.getLang('common.are_you_sure'),
        text: this.getLang('common.save_your_order_as_draft'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: this.getLang('common.yes_save'),
        cancelButtonText: this.getLang('common.no_cancel'),
        reverseButtons: false,
      }).then((result) => {
        if (result.isConfirmed) {
          this.$store.dispatch('saveOrderAction', {
            id: _.get(this.formInput, 'id', null),
            order_status: 'pending',
            button_action: 'save'
          });
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
        confirmButtonText: this.getLang('common.yes_complete'),
        cancelButtonText: this.getLang('common.no_cancel'),
        reverseButtons: false,
      }).then((result) => {
        if (result.isConfirmed) {
          this.$store.dispatch('saveOrderAction', {
            id: _.get(this.formInput, 'id', null),
            order_status: 'completed',
            button_action: 'complete'
          });
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
      this.loading_order['clear'] = true;
      this.$swal({
        title: this.getLang('common.are_you_sure'),
        text: this.getLang('common.you_wont_be_able_to_revert_this'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: this.getLang('common.yes_clear_it'),
        cancelButtonText: this.getLang('common.no_cancel'),
        reverseButtons: true
      }).then((result) => {
        this.loading_order['clear'] = false;
        if (result.isConfirmed) {
          this.$store.commit('clearOrder', {});
        } else {
          this.$swal({
            title: this.getLang('common.cancelled'),
            text: this.getLang('common.your_order_is_safe'),
            icon: 'error',
            timer: 1500,
            showConfirmButton: false,
          });
        }
      });
    },
    printBillAction() {
      this.$store.commit('printBillAction', {
        id: this.formInput.id,
        modal: {
          id: 'invoice',
          title: this.lang('invoice'),
          button: this.lang('print_invoice'),
        }
      });
    },
    showShippingForm() {
      this.$store.commit('setModal', {
          id: 'shipping',
          title: this.lang('add_shipping_details'),
          button: this.lang('submit'),
        });
    },
  },
}
</script>

<style scoped>

</style>
