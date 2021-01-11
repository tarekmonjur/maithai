<template>
    <section id="home-cover" class=" food-list-home-banner">
        <div class="jumbotron">
            <div class="dark-bg">
                <div id="intro">
                    <div id="intro-section" class="mb-4">
                        <h5 class="intro-title food-list-intro text-uppercase mb-4">Find The Best Food.</h5>
                    </div>

                    <div class="search-food mb-5">
                        <input
                            type="text"
                            v-model="search_product"
                            @keyup="this.searchProductHide()"
                            @keyup.enter="this.searchProduct()"
                            placeholder="Find Your Choice!" class="form-control">
                        <button
                            type="submit"
                            @click.prevent="this.searchProduct()"
                            @submit.prevent="this.searchProduct()"
                            @keyup.enter="this.searchProduct()"
                            class="btn btn-danger btn-custom text-uppercase">
                            <i class="fas fa-search"></i>
                            <span>Search</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <product-search-component v-if="show_search_product" className="search-dropdown-menu-food-list"></product-search-component>
    </section>
</template>

<script>
import ProductSearchComponent from './product-search.component';

export default {
    name: "product-banner.component",
    components: {
        ProductSearchComponent,
    },
    data() {
        return {
            search_product: '',
            show_search_product: false,
        }
    },
    methods: {
        searchProductHide() {
            if (_.isEmpty(this.search_product)) {
                this.show_search_product = false;
            }
        },
        searchProduct() {
            if (_.isEmpty(this.search_product)) {
                this.show_search_product = false;
            } else {
                this.show_search_product = true;
                this.$store.dispatch('getSearchProducts', {params: {name: this.search_product}});
            }
        }
    }
}
</script>

<style scoped>

</style>