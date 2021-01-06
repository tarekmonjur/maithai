<template>
    <div class="collapse row justify-content-center pt-3 m-0" id="tableFilter">
        <div class="card col-10">
            <div class="form-row">
                <div :class="'form-group col-md-'+columnSize" v-for="(filter, index) in filtersWithoutDate" :key="index">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <div class="input-group-text">{{filter.label}}</div>
                        </div>
                        <input
                          v-if="filter.type === 'text'"
                          type="text" v-model.lazy.trim="filterData[filter.name]"
                          class="form-control">
                        <select
                            v-if="filter.type === 'select'"
                            v-model.lazy="filterData[filter.name]"
                            class="form-control form-control-sm">
                            <option selected value="">...Select All...</option>
                            <option v-for="option in filter.options" :value="option.value">{{option.label}}</option>
                        </select>
                        <Select2
                            v-if="filter.type === 'select2'"
                            v-model.lazy="filterData[filter.name]"
                            style="padding: 0; border: 0; border-radius: 0;"
                            class="form-control"
                            :options="filter.options"
                            :settings="{allowClear: true}"/>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5" v-for="(filter, index) in filtersDate" :key="index">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <div class="input-group-text">{{filter.label}}</div>
                        </div>
                        <datepicker
                            wrapper-class="form-control datepicker"
                            input-class="form-control input"
                            placeholder="Date..."
                            v-model="filterData[filter.name]"
                            iconColor="#be9653"
                            :typeable="true"
                            :name="filter.name">
                        </datepicker>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <button
                        type="submit"
                        class="btn btn-theme btn-sm"
                        :disabled="loading.filter"
                        @click.prevent="filterButton()">
                            <img :src="this.asset('/img/search.png')" alt="">
                            <loading-component :loader="loading.filter" size="small">
                              {{filterButtonName}}
                            </loading-component>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState, mapGetters} from 'vuex';
import Datepicker from 'vuejs3-datepicker';
import Select2 from 'vue3-select2-component';
import LoadingComponent from '../common/loading.component';

export default {
    name: "table-filter.component",
    components: {
      Datepicker,
      Select2,
      LoadingComponent
    },
    data() {
        const filters = this.$store.getters.tableFilters;
        const filterData = this.$store.state.filterData;
        const from_date = _.get(
            _.filter(filters, item => item.name === 'from_date' ? item : null),
            '[0].value',
            ''
        );
        const to_date = _.get(
            _.filter(filters, item => item.name === 'to_date' ? item : null),
            '[0].value',
            ''
        );

      return {
          filterData: {
              ...filterData,
              from_date,
              to_date,
          },
      }
    },
    computed: {
        ...mapState(['loading']),
        ...mapGetters([
            'filterButtonName',
            'tableFilters'
        ]),
        toDate() {
          return 'abcd';
        },
        columnSize: function() {
            let column = Math.round(12 / (this.filtersWithoutDate.length || 0));
            return column < 4 ? 4 : column;
        },
        filtersDate() {
            return _.compact(
                _.map(
                    this.tableFilters,
                    item => item.type === 'date' ? item : false
                )
            );
        },
        filtersWithoutDate() {
            return _.compact(
                _.map(
                    this.tableFilters,
                    item => item.type !== 'date' ? item : false
                )
            );
        },
    },
    methods: {
        filterButton() {
            const payload = {
                params: this.filterData
            };
            this.$store.dispatch('filterButtonAction', this.filterData);
            this.$store.dispatch('getListData', payload);
        },
    }
}
</script>

<style scoped>

</style>
