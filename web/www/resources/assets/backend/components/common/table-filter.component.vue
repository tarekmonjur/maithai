<template>
    <div class="collapse row justify-content-center" id="tableFilter">
        <div class="card col-10">
            <div class="form-row">
                <div :class="'form-group col-md-'+columnSize" v-for="(filter, index) in filters" :key="index">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <div class="input-group-text">{{filter.label}}</div>
                        </div>
                        <input v-if="filter.type === 'text'" type="text" v-model.lazy.trim="filterData[filter.name]" class="form-control">
                        <select v-if="filter.type === 'select'" v-model.lazy="filterData[filter.name]" class="form-control form-control-sm">
                            <option selected>...Select Option...</option>
                            <option v-for="option in filter.options" :value="option.value">{{option.label}}</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-5">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                From Date
                            </div>
                        </div>
                        <datepicker
                            wrapper-class="form-control datepicker"
                            input-class="form-control input"
                            placeholder="Date..."
                            v-model="filterData['from_date']"
                            iconColor="#be9653"
                            :typeable="true"
                            name="from_date">
                        </datepicker>
                    </div>
                </div>
                <div class="form-group col-md-5">
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                To Date
                            </div>
                        </div>
                        <datepicker
                            wrapper-class="form-control datepicker"
                            input-class="form-control input"
                            placeholder="Date..."
                            v-model="filterData['to_date']"
                            iconColor="#be9653"
                            :typeable="true"
                            :use-utc="true"
                            name="to_date">
                        </datepicker>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-theme btn-sm" @click.prevent="filterButton()">
                        <img :src="this.asset('/img/search.png')" alt="">
                        {{filterButtonName}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';
import Datepicker from 'vuejs3-datepicker';

export default {
    name: "table-filter.component",
    components: {Datepicker},
    data() {
      return {
          filterData: {
              from_date: new Date(),
              to_date: new Date()
          },
      }
    },
    computed: {
        ...mapGetters([
            'filterButtonName',
            'filters'
        ]),
        columnSize: function() {
            let column = 12 / (this.filters.length || 0);
            return column < 3 ? 3 : column;
        }
    },
    methods: {
        filterButton() {
            const payload = {
                params: this.filterData
            };
            this.$store.dispatch('filterButtonAction', this.filterData);
            this.$store.dispatch('getListData', payload);
        }
    }
}
</script>

<style scoped>

</style>
