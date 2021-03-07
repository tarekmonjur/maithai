<template>
    <app-component>
        <section class="menu-search-section sticky-top mobile-sticky">
            <div class="container">
                <div class="input-group w-100">
                    <div class="form-outline food-menu-search-bar">
                        <input
                            type="search"
                            class="form-control"
                            v-model="filters['name']"
                            @keyup.enter="filterProducts()"
                            placeholder="I'm Looking for..">
                    </div>
                    <button
                        type="button"
                        @keyup.enter="filterProducts()"
                        @click.prevent="filterProducts()"
                        class="btn btn-food-menu-search">
                        <i class="fas fa-search"></i>
                        <span class="on-mobile-disable">Search</span>
                    </button>
                </div>
            </div>
        </section>
        <product-list-component></product-list-component>
    </app-component>
</template>

<script>
import AppComponent from './../app.component';
import ProductListComponent from './product-list.component';

export default {
    name: "product.component",
    components: {
        AppComponent,
        ProductListComponent
    },
    data() {
        return {
            filters: {
                name: null,
                sub_category_id: []
            },
        }
    },
    methods: {
        filterProducts() {
            // console.log(this.filters);
            this.$store.commit('setFilters', this.filters);
            const payload = {
                params: {
                    ...this.filters,
                    paginate: false,
                }
            };
            window.location.href = "#products";
            this.$store.dispatch('getProducts', payload);
        }
    }
}
</script>

<style scoped>

</style>