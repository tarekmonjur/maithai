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
<!--                <div class="form-group col-md-5" v-for="(filter, index) in filtersDate" :key="index">-->
<!--                    <div class="input-group input-group-sm">-->
<!--                        <div class="input-group-prepend">-->
<!--                            <div class="input-group-text">{{filter.label}}</div>-->
<!--                        </div>-->
<!--                        <datepicker-->
<!--                            wrapper-class="form-control datepicker"-->
<!--                            input-class="form-control input"-->
<!--                            placeholder="Date..."-->
<!--                            v-model="filterData[filter.name]"-->
<!--                            iconColor="#be9653"-->
<!--                            :typeable="true"-->
<!--                            :name="filter.name">-->
<!--                        </datepicker>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="form-group col-md-2">
                    <a
                        class="btn btn-custom btn-sm"
                        :disabled="loader"
                        @click.prevent="filterButton()">
                            <loading-component :loader="loader">
                                <img :src="this.assetUrl('/icons/search.png')" alt="">
                            </loading-component>
                            {{buttonName}}
                    </a>
                </div>
                <div class="form-group col-md-2">
                    <a
                        class="btn btn-custom btn-sm"
                        :disabled="loader"
                        @click.prevent="filterButton(true)">
                        <loading-component :loader="loader2"></loading-component>
                        Clear Filter
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
// import Datepicker from 'vuejs3-datepicker';
import Select2 from 'vue3-select2-component';
import LoadingComponent from '../common/loading.component';

export default {
    name: "table-filter.component",
    props: ['filters', 'defaultData', 'buttonName'],
    components: {
      // Datepicker,
      Select2,
      LoadingComponent
    },
    data() {
        const filters = this.filters;
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
          loader: false,
          loader2: false,
          filterData: {
              ...this.defaultData,
              from_date,
              to_date,
          },
      }
    },
    computed: {
        columnSize: function() {
            let column = Math.round(12 / (this.filtersWithoutDate.length || 0));
            return column < 4 ? 4 : column;
        },
        filtersDate() {
            return _.compact(
                _.map(
                    this.filters,
                    item => item.type === 'date' ? item : false
                )
            );
        },
        filtersWithoutDate() {
            return _.compact(
                _.map(
                    this.filters,
                    item => item.type !== 'date' ? item : false
                )
            );
        },
    },
    methods: {
        async filterButton(clear = false) {
            if (clear) {
                this.loader2 = true;
                this.filterData = {
                    ...this.defaultData,
                };
            } else {
                this.loader = true;
            }

            const payload = {
                params: this.filterData
            };
            await this.$store.dispatch('filterButtonAction', payload);
            this.loader = false;
            this.loader2 = false;
        },
    }
}
</script>

<style scoped>
.btn-custom{
    font-size: 14px;
    height: 36px;
}
</style>
