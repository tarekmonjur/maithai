<template>
    <div class="col-md-3 col-sm-4 col-xs-12" :class="mainClass">
        <div class="forms">
            <div class="form-control search-input mb-3">
                <input
                    type="text"
                    v-model="filters['name']"
                    @keyup.enter="filterProducts()"
                    placeholder="Search for...">
                <button class="btn-food-search"><i class="fas fa-search"></i></button>
            </div>
        </div>

        <div class="food-menu-title mb-2">
            <h3 class="text-light">Food Menu</h3>
        </div>

        <div v-for="(category, index) in getCategories" :id="'accordion'+index" class="mb-2 accordion">
            <div class="card mb-0">
                <div class="card-header" :class="headerClass" @click="accordionIcon(index)" :id="'heading'+index" data-toggle="collapse" :data-target="'#collapse'+index" aria-expanded="true" :aria-controls="'collapse'+index">
                    <h6 class="text-capitalize">
                        <span>
                            <img data-toggle="collapse" :data-target="'#collapse'+index" :aria-controls="'collapse'+index" v-if="accordion[index]" :src="this.assetUrl('/icons/minus_collapse.png')" alt="-" width="20">
                            <img data-toggle="collapse" :data-target="'#collapse'+index" :aria-controls="'collapse'+index" v-else :src="this.assetUrl('/icons/plus_collapse.png')" alt="+" width="20">
                        </span>
                        <span class="ml-1">{{category.name}}</span>
                    </h6>
                </div>

                <div :id="'collapse'+index" class="collapse" :aria-labelledby="'heading'+index" :data-parent="'#accordion'+index">
                    <div class="card-body">
                        <div class="checkbox-list">
                            <ul>
                                <li class="checkbox" v-for="(sub_category, index) in category.sub_categories">
                                    <div class="cat-item">
                                        <input
                                            type="checkbox"
                                            @change="filterProducts()"
                                            v-model="filters['sub_category_id']"
                                            :value="sub_category.id">
                                        <span class="text-capitalize ml-2">{{sub_category.name}}</span>
                                    </div>
                                    <img :src="sub_category.image" :alt="sub_category.name" style="width: 100%">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {mapState, mapGetters} from 'vuex';

export default {
    name: "product-category.component",
    props: ['mainClass', 'headerClass'],
    data() {
      return {
          filters: {
              name: null,
              sub_category_id: []
          },
          accordion: [],
      }
    },
    computed: {
        ...mapState([]),
        ...mapGetters(['getCategories']),
    },
    created() {
        const payload = {
            params: {
                sublist: true,
                is_active: 1,
            }
        };
        this.$store.dispatch('getCategories', payload);
    },
    methods: {
        filterProducts() {
            // console.log(this.filters);
            this.$store.commit('setFilters', this.filters);
            const payload = {
                params: {
                    ...this.filters,
                }
            };
            window.location.href = "#products";
            this.$store.dispatch('getProducts', payload);
        },
        accordionIcon(index) {
            this.accordion[index] = !this.accordion[index];
        },
    }
}
</script>

<style scoped>
.cat-item {
    text-align: center;
    padding-bottom: 10px;
}
.cat-item span {
    font-size: 18px;
    text-align: center;
    vertical-align: bottom;
}
</style>