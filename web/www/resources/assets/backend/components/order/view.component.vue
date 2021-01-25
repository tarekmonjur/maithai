<template>
  <table-view-component>
    <tr>
      <td>{{ lang(`id`) }}</td>
      <td>{{ showData.id }}</td>
    </tr>
    <tr>
      <td>{{ lang(`invoice_no`) }}</td>
      <td>{{ showData.invoice_no }}</td>
    </tr>
    <tr>
      <td>{{ lang(`type`) }}</td>
      <td>{{ showData.type }}</td>
    </tr>
    <tr>
      <td>{{ lang(`source`) }}</td>
      <td>{{ showData.source }}</td>
    </tr>
    <tr>
      <td>{{ lang(`table`) }}</td>
      <td>{{ showData.table_no }}</td>
    </tr>
    <tr>
      <td>{{ lang(`customer`) }}</td>
      <td>
        <table>
          <tr>
            <th>{{ lang('full_name') }}</th>
            <td>{{ customer.first_name }} {{ customer.last_name }}</td>
          </tr>
          <tr>
            <th>{{ lang('mobile_no') }}</th>
            <td>{{ customer.mobile_no }}</td>
          </tr>
          <tr>
            <th>{{ lang('email') }}</th>
            <td>{{ customer.email }}</td>
          </tr>
          <tr>
            <th>{{ lang('address') }}</th>
            <td>{{ customer.address }}</td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td>{{ lang(`transaction_no`) }}</td>
      <td>{{ showData.transaction_no }}</td>
    </tr>
    <tr>
      <td>{{ lang(`payment`) }}</td>
      <td>
        {{ this.lang('type') }}: {{ showData.payment_type }} <br>
        {{ this.lang('status') }}: {{ showData.payment_status }}
      </td>
    </tr>
    <tr>
      <td>{{ lang(`status`) }}</td>
      <td>{{ showData.status }}</td>
    </tr>
    <tr>
      <td>{{ lang(`items`) }} ({{ showData.order_details_count }})</td>
      <td>
        <table class="table table-broder">
          <thead class="bg-gray">
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
                {{ item.product_barcode }} <br>
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
      </td>
    </tr>
    <tr>
      <td>{{ lang(`total_qty`) }}</td>
      <td>{{ showData.total_qty }}</td>
    </tr>
    <tr>
      <td>{{ lang(`sub_total`) }}</td>
      <td>{{ showData.total_sub_total_amount }}</td>
    </tr>
    <tr>
      <td>{{ lang(`discount`) }}</td>
      <td>
        {{ showData.discount_amount }} ({{ showData.discount_percent }}%) <br>
        {{ showData.offer_name }} <br>
        {{ showData.coupon_code }}
      </td>
    </tr>
    <tr>
      <td>{{ lang(`vat`) }}</td>
      <td>{{ showData.vat_amount }} ({{ showData.vat_percent }}%)</td>
    </tr>
    <tr>
      <td>{{ lang(`processing_fee`) }}</td>
      <td>{{ showData.processing_fee }}</td>
    </tr>
    <tr>
      <td>{{ lang(`delivery_fee`) }}</td>
      <td>{{ showData.delivery_fee }}</td>
    </tr>
    <tr>
      <td>{{ lang(`payable_amount`) }}</td>
      <td>{{ showData.total_payable_amount }}</td>
    </tr>
    <tr>
      <td>{{ lang(`pay_amount`) }}</td>
      <td>{{ showData.total_pay_amount }}</td>
    </tr>
    <tr>
      <td>{{ lang(`due_amount`) }}</td>
      <td>{{ showData.due_amount }}</td>
    </tr>
    <tr>
      <td>{{ lang(`created`) }}</td>
      <td v-html="this.created(showData)"></td>
    </tr>
    <tr>
      <td>{{ lang(`updated`) }}</td>
      <td v-html="this.updated(showData)"></td>
    </tr>
  </table-view-component>
</template>

<script>
import {mapState, mapGetters} from 'vuex';
import TableViewComponent from "../common/table-view.component";

export default {
  name: "view.component",
  components: {
    TableViewComponent,
  },
  computed: {
    ...mapState([
      'lang_key',
    ]),
    ...mapGetters([
      'showData'
    ]),
    customer() {
      return _.get(this.showData, 'customer.details', {});
    }
  },
  methods: {
    lang(key) {
      return this.getLang(`${this.lang_key}.${key}`);
    },
  },
  updated() {
    // console.log('view..');
  }
}
</script>

<style scoped>
tr td:first-child {
  font-weight: bold
}
</style>
