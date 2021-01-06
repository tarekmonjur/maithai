<template>
  <div class="col-3">
    <div class="row">
      <div class="col-12">
        <div class="card pos">
          <div class="card-header border-0 p-2">
            <h3 class="card-title">{{this.lang('products')}}</h3>
            <div class="card-tools col-10">
              <div class="input-group input-group-sm">
                <Select2 v-model="filterData['category_id']"
                         style="padding: 0; border: 0; border-radius: 0"
                         class="form-control"
                         :options="categoriesSelect2"
                         :settings="{placeholder: this.lang('all_category'), allowClear: true}"
                         @select="getSubCategories($event)"/>
                <Select2 v-model="filterData['sub_category_id']"
                         style="padding: 0; border: 0; border-radius: 0"
                         class="form-control"
                         :options="subCategoriesSelect2"
                         :settings="{placeholder: this.lang('all_subcategory'), allowClear: true}"/>
                  <button type="submit"
                          @click.prevent="this.filterAction()"
                          @keyup.enter="this.filterAction()"
                          :disabled="loading_list.button"
                          class="btn btn-sm btn-theme">
                    <loading-component :loader="loading_list.button">
                      <i class="fas fa-search"></i>
                    </loading-component>
                  </button>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-head-fixed text-nowrap table-hover">
              <thead>
              <tr>
                <th>{{this.lang('product_name')}}</th>
                <th>{{this.lang('product_price')}}</th>
                <th>{{this.lang('product_image')}}</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="row in tableData" v-on:click="addItemAction(row.id)" style="cursor: pointer">
                <td>
                  {{row.name}}<br>
                  {{row.code}}<br>
                  {{row.barcode}}
                </td>
                <td>
                  {{row.original_price}}<br>
                  {{row.regular_price}}<br>
                  {{row.special_price}}
                </td>
                <td>
                  <img :src="row.image" alt="" width="60">
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            <table-pagination-component></table-pagination-component>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters, mapState} from "vuex";
import TablePaginationComponent from './../common/table-pagination.component';
import LoadingComponent from '../common/loading.component';

export default {
  name: "list.component",
  components: {
    TablePaginationComponent,
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
      'loading_list',
    ]),
    ...mapGetters([
      'tableData',
      'categories',
      'subCategories',
    ]),
    categoriesSelect2() {
      return _.map(this.categories, item => ({id: item.id, text: item.name}));
    },
    subCategoriesSelect2() {
      return _.map(this.subCategories, item => ({id: item.id, text: item.name}));
    }
  },
  created() {
    this.$store.dispatch('initList');
  },
  updated() {
    console.log('list...');
  },
  methods: {
    lang(key) {
      return this.getLang(`${this.lang_key}.${key}`);
    },
    getSubCategories(event) {
      if (_.get(event, 'selected', true) === false) {
        this.$store.commit('setFormData', {
          sub_categories: {}
        });
      } else {
        this.filterAction();
        this.$store.dispatch('getSubCategories', {id: event.id});
      }
    },
    filterAction() {
      const payload = {
        params: this.filterData
      };
      this.$store.dispatch('getListData', payload);
    },
    addItemAction(product_id) {
      if (product_id) {
        this.$store.dispatch('addOrderItem', {product_id});
      }
    }
  }
}
</script>

<style scoped>
.select2-container--default .select2-selection--single {
  border-radius: 0!important;
}
</style>