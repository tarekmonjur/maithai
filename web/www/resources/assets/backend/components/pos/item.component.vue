<template>
  <div class="col-6">
    <div class="row">
      <div class="col-12 pl-0">
        <div class="card pos">
          <div class="card-header border-0">
            <h3 class="card-title">{{this.lang('line_items')}}</h3>
            <div class="card-tools col-8">
              <div class="input-group input-group-sm">
                <Select2 v-model="filterData['product_id']"
                         id="search_product"
                         name="search_product"
                         style="padding: 0; border: 0; border-radius: 0"
                         class="form-control"
                         :options="productsSelect2"
                         :settings="{placeholder: this.lang('search_product'), allowClear: true}"
                         @select="addItemAction($event)"/>
                <button type="submit"
                        @click="addItemAction()"
                        @keyup.enter="addItemAction()"
                        :disabled="loading_item.button"
                        class="btn btn-sm btn-theme">
                  <loading-component :size="loading_item.button ? 'small': ''">
                    <i class="fas fa-search"></i>
                  </loading-component>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-head-fixed text-nowrap">
              <thead>
              <tr>
                <th>{{this.lang('sl')}}</th>
                <th>{{this.lang('product_name')}}</th>
                <th>{{this.lang('unit')}}</th>
                <th>{{this.lang('price')}}</th>
                <th>{{this.lang('qty')}}</th>
                <th>{{this.lang('discount')}}</th>
                <th>{{this.lang('vat')}}</th>
                <th>{{this.lang('subtotal')}}</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="(item, index) in formInput['items']">
                <td>
                  <a href="javascript:void(0)" @click.prevent="deleteItem(index)"><i class="fa fa-trash-alt"></i></a>
                  {{sl = index+1}}
                </td>
                <td>{{formInput['items'][index]['product_name']}}</td>
                <td>{{formInput['items'][index]['product_unit']}}</td>
                <td>
                  <input type="number" class="col-10" v-model="formInput['items'][index]['product_price']" @keyup="updateItem(index)" @change.lazy="updateItem(index)">
                </td>
                <td>
                  <input type="number" class="col-6" v-model="formInput['items'][index]['product_qty']" @keyup="updateItem(index)" @change.lazy="updateItem(index)">
                </td>
                <td>
                  <input type="number" class="col-6" v-model="formInput['items'][index]['discount_amount']" @keyup="updateItem(index)" @change.lazy="updateItem(index)">
                  {{formInput['items'][index]['discount_percent']}}<strong>%</strong>
                </td>
                <td>
                  <input type="number" class="col-5" v-model="formInput['items'][index]['vat_amount']" @keyup="updateItem(index)" @change.lazy="updateItem(index)">
                  {{formInput['items'][index]['vat_percent']}}<strong>%</strong>
                </td>
                <td>{{formInput['items'][index]['sub_total']}}</td>
              </tr>
              </tbody>
              <tfoot>
              <tr>
                <th colspan="3" class="text-right">{{this.lang('total')}}: </th>
                <th>{{totalPrice}}</th>
                <th>{{totalQty}}</th>
                <th>{{totalDiscount}}</th>
                <th>{{totalVat}}</th>
                <th>{{totalSubTotal}}</th>
              </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters, mapState} from "vuex";
import helpers from "../../js/helpers";
import LoadingComponent from '../common/loading.component';

export default {
  name: "item.component",
  components: {
    LoadingComponent
  },
  data() {
    return {
      filterData: {}
    }
  },
  computed: {
    ...mapState([
      'lang_key',
      'formInput',
      'loading_item',
    ]),
    ...mapGetters([
      'products',
      'totalSubTotal',
    ]),
    productsSelect2() {
      return _.map(this.products, item => ({
        id: item.id,
        text: `${item.name} - ${item.code} - ${item.barcode}`
      }));
    },
    totalPrice(){
      return this.formInput.items ?
        this.formInput.items.reduce((sum, item) => sum + +item.product_price, 0) : 0;
    },
    totalQty(){
      return this.formInput.items ?
        this.formInput.items.reduce((sum, item) => sum + +item.product_qty, 0) : 0;
    },
    totalDiscount(){
      return this.formInput.items ?
        this.formInput.items.reduce((sum, item) => sum + +item.discount_amount, 0) : 0;
    },
    totalVat(){
      return this.formInput.items ?
        this.formInput.items.reduce((sum, item) => sum + +item.vat_amount, 0) : 0;
    },
  },
  created() {
    this.$store.dispatch('initItem');
  },
  updated() {
    console.log('item...');
  },
  methods: {
    lang(key) {
      return this.getLang(`${this.lang_key}.${key}`);
    },
    addItemAction(event) {
      const product_id = _.get(event, 'id') ? _.get(event, 'id') : this.filterData['product_id'];
      if (!_.isEmpty(product_id)) {
        this.$store.dispatch('addOrderItem', {product_id});
      }
    },
    async updateItem(index) {
      const item = this.formInput['items'][index];
      this.formInput['items'][index] = await helpers.updateOrderItem(item);
    },
    async deleteItem(index) {
      if (_.get(this.formInput, `items[${index}]`)) {
        this.formInput['items'].splice(index, 1);
      }
    }
  },
}
</script>

<style scoped>
  table tfoot tr {
    position: relative;
  }
  table tfoot tr th {
    position: sticky;
    bottom: 0;
    background-color: #f8f8f8;
  }
</style>